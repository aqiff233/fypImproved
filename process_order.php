<?php
$user_id = $_COOKIE['user_id'];
$username = $_COOKIE['username'];
$role = $_COOKIE['role'];

require_once('mysqli.php');
global $dbc;

// Function to get orders for the current day
function getOrdersForToday($dbc) {
    $today = date('Y-m-d');
    $sql = "SELECT o.order_id, o.user_id, o.table_number, o.total_price, o.status, o.created_at,
                   od.product_id, od.quantity, od.price, m.name AS product_name
            FROM orders o
            LEFT JOIN orderdetails od ON o.order_id = od.order_id
            LEFT JOIN menus m ON od.product_id = m.menus_id
            WHERE DATE(o.created_at) = ?
            ORDER BY o.order_id, od.order_details_id";

    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orderId = $row['order_id'];
        if (!isset($orders[$orderId])) {
            $orders[$orderId] = [
                'order_id' => $orderId,
                'user_id' => $row['user_id'],
                'table_number' => $row['table_number'],
                'total_price' => $row['total_price'],
                'status' => $row['status'],
                'created_at' => $row['created_at'],
                'items' => []
            ];
        }
        // Add item details if available
        if ($row['product_id']) {
            $orders[$orderId]['items'][] = [
                'product_name' => $row['product_name'],
                'quantity' => $row['quantity'],
                'price' => $row['price']
            ];
        }
    }

    return $orders;
}

function getUnavailableTables($dbc) {
    $sql = "SELECT table_number FROM orders WHERE status = 'In Progress'";
    $result = $dbc->query($sql);

    $tablesInProgress = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tablesInProgress[] = (int)$row['table_number'];
        }
    }
    return $tablesInProgress;
}

// Handle different actions based on the 'action' parameter
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'fetch_orders') {
        // Fetch orders for the current day
        $orders = getOrdersForToday($dbc);

        // Return orders as JSON
        header('Content-Type: application/json');
        echo json_encode($orders);
        exit;
    } elseif ($action === 'update_status') {
        // Update order status
        $orderId = $_POST['order_id'];
        $newStatus = $_POST['new_status'];

        // Validate the status
        if (!in_array($newStatus, ['In Progress', 'Paid', 'Cancelled', 'Ready','Served'])) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid status']);
            exit;
        }

        $updateSql = "UPDATE orders SET status = ? WHERE order_id = ?";
        $stmtUpdate = $dbc->prepare($updateSql);
        $stmtUpdate->bind_param("si", $newStatus, $orderId);
        $stmtUpdate->execute();

        if ($stmtUpdate->affected_rows > 0) {
            echo json_encode(['message' => 'Order status updated successfully']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Failed to update order status']);
        }
        exit;
    }
    elseif ($action === 'get_unavailable_tables') {
        // Get unavailable tables
        $unavailableTables = getUnavailableTables($dbc);

        // Return the list as JSON
        header('Content-Type: application/json');
        echo json_encode($unavailableTables);
        exit;
    }
}

// Handle order placement (existing code)
$json = file_get_contents('php://input');
$orderData = json_decode($json, true);

if ($orderData) {
    // Extract order details
    $tableNumber = $orderData['tableNumber'];
    $items = $orderData['items'];
    $totalPrice = $orderData['total'];

    // Start a transaction
    mysqli_begin_transaction($dbc);

    try {
        // Insert into orders table
        $insertOrderSql = "INSERT INTO orders (user_id, table_number, total_price, status) VALUES (NULL, ?, ?, 'In Progress')";
        $stmtOrder = $dbc->prepare($insertOrderSql);
        $stmtOrder->bind_param("id", $tableNumber, $totalPrice);
        $stmtOrder->execute();
        $orderId = $dbc->insert_id;

        // Insert into orderdetails table
        $insertOrderDetailsSql = "INSERT INTO orderdetails (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmtDetails = $dbc->prepare($insertOrderDetailsSql);

        foreach ($items as $itemId => $item) {
            $productId = (int)$itemId;
            $quantity = (int)$item['quantity'];
            $price = (float)$item['price'];

            $stmtDetails->bind_param("iiid", $orderId, $productId, $quantity, $price);
            $stmtDetails->execute();
        }

        // Commit the transaction
        mysqli_commit($dbc);

        // Return a success response
        echo json_encode(['message' => 'Order placed successfully', 'order_id' => $orderId]);
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($dbc);

        // Log the error
        error_log("Error processing order: " . $e->getMessage());

        // Return an error response
        http_response_code(500);
        echo json_encode(['error' => 'Failed to place order']);
    }
} else {
    // Invalid request
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>