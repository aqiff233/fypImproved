<?php
$user_id = $_COOKIE['user_id'];
$username = $_COOKIE['username'];
$role = $_COOKIE['role'];

require_once('mysqli.php');
global $dbc;

// Function to get orders for the current day
function getOrdersForToday($dbc)
{
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

function getOrdersForKDS($dbc)
{
    $today = date('Y-m-d');
    $sql = "SELECT o.order_id, o.user_id, o.table_number, o.total_price, o.status, o.created_at,
                   od.product_id, od.quantity, od.price, m.name AS product_name
            FROM orders o
            LEFT JOIN orderdetails od ON o.order_id = od.order_id
            LEFT JOIN menus m ON od.product_id = m.menus_id
            WHERE o.status NOT IN ('Ready', 'Served', 'Cancelled')
            AND DATE(o.created_at) = ?
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



function getUnavailableTables($dbc)
{
    $sql = "SELECT DISTINCT table_number FROM orders WHERE status IN ('In Progress', 'Ready', 'Served')";
    $result = $dbc->query($sql);

    $tablesInProgress = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tablesInProgress[] = (int)$row['table_number'];
        }
    }
    return $tablesInProgress;
}

// Function to get tickets (orders with status 'Ready' or 'Served')
// Add following to filter : WHERE o.status IN ('Ready', 'Served')
function getTickets($dbc)
{
    $sql = "SELECT o.order_id, o.table_number, o.total_price, o.status, u.username
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.user_id
            WHERE o.status != 'Paid'
            ORDER BY o.created_at DESC";

    $stmt = $dbc->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $tickets = [];
    while ($row = $result->fetch_assoc()) {
        $tickets[$row['order_id']] = [
            'order_id' => $row['order_id'],
            'table_number' => $row['table_number'],
            'total_price' => $row['total_price'],
            'status' => $row['status'],
            'username' => $row['username']
        ];
    }

    return $tickets;
}

// Function to get a specific order's details
function getOrderDetails($dbc, $orderId)
{
    $sql = "SELECT o.order_id, o.table_number, o.total_price, o.status, o.user_id,
                   od.product_id, od.quantity, od.price, m.name AS product_name
            FROM orders o
            LEFT JOIN orderdetails od ON o.order_id = od.order_id
            LEFT JOIN menus m ON od.product_id = m.menus_id
            WHERE o.order_id = ?
            ORDER BY od.order_details_id";

    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    $order = [
        'order_id' => null,
        'table_number' => null,
        'total_price' => null,
        'status' => null,
        'user_id' => null,
        'items' => []
    ];

    while ($row = $result->fetch_assoc()) {
        if (!$order['order_id']) {
            $order['order_id'] = $row['order_id'];
            $order['table_number'] = $row['table_number'];
            $order['total_price'] = $row['total_price'];
            $order['status'] = $row['status'];
            $order['user_id'] = $row['user_id'];
        }
        $order['items'][] = [
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'price' => $row['price']
        ];
    }

    return $order;
}

function getUsername($dbc, $userId)
{
    $sql = "SELECT username FROM users WHERE user_id = ?";
    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['username'];
    }
    return null;
}

function getAllReceipts($dbc)
{
    $sql = "SELECT receipt_id, order_id, payment_id, total_amount, payment_method, issued_at FROM receipts ORDER BY issued_at DESC";
    $stmt = $dbc->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $receipts = [];
    while ($row = $result->fetch_assoc()) {
        $receipts[] = $row;
    }
    return $receipts;
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
    } else if ($action == 'fetch_orders_for_kds') {
        // Fetch orders for KDS using the new function
        $orders = getOrdersForKDS($dbc);
        header('Content-Type: application/json');
        echo json_encode($orders);
        exit;
    } elseif ($action === 'update_status') {
        // Update order status
        $orderId = $_POST['order_id'];
        $newStatus = $_POST['new_status'];

        // Validate the status
        if (!in_array($newStatus, ['In Progress', 'Paid', 'Cancelled', 'Ready', 'Served'])) {
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
    } elseif ($action === 'get_unavailable_tables') {
        // Get unavailable tables
        $unavailableTables = getUnavailableTables($dbc);

        // Return the list as JSON
        header('Content-Type: application/json');
        echo json_encode($unavailableTables);
        exit;
    } elseif ($action === 'fetch_tickets') {
        // Fetch tickets
        $tickets = getTickets($dbc);

        // Return tickets as JSON
        header('Content-Type: application/json');
        echo json_encode($tickets);
        exit;
    } elseif ($action === 'fetch_order_details') {
        $orderId = $_GET['order_id'];
        $orderDetails = getOrderDetails($dbc, $orderId);

        header('Content-Type: application/json');
        echo json_encode($orderDetails);
        exit;
    } elseif ($action === 'update_payment') {
        $orderId = $_POST['order_id'];
        $paymentAmount = $_POST['payment_amount'];
        $paymentMethod = $_POST['payment_method'];
        $paymentStatus = $_POST['payment_status'];

        try {
            $insertPaymentSql = "INSERT INTO payment (order_id, payment_method, payment_amount, payment_status) VALUES (?, ?, ?, ?)";
            $stmtPayment = $dbc->prepare($insertPaymentSql);
            $stmtPayment->bind_param("isds", $orderId, $paymentMethod, $paymentAmount, $paymentStatus); //i=int,s=string,d=double
            $stmtPayment->execute();

            if ($stmtPayment->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                // No rows affected, but there might still be an error
                throw new Exception("Failed to update payment: No rows affected. Error: " . $stmtPayment->error);
            }
        } catch (Exception $e) {
            // Log the error to a file or error logging system
            error_log("Error updating payment: " . $e->getMessage());

            echo json_encode(['success' => false, 'error' => 'Failed to update payment: ' . $e->getMessage()]);
        }
        exit;
    } elseif ($action === 'generate_receipt') {
        $orderId = $_POST['order_id'];
        $paymentMethod = $_POST['payment_method'];
        $orderDetails = getOrderDetails($dbc, $orderId);
        $totalAmount = $orderDetails['total_price'];

        // No need to generate receipt_id here
        $insertReceiptSql = "INSERT INTO receipts (order_id, total_amount, payment_method) VALUES (?, ?, ?)"; // Removed payment_id
        $stmtReceipt = $dbc->prepare($insertReceiptSql);
        $stmtReceipt->bind_param("ids", $orderId, $totalAmount, $paymentMethod);
        $stmtReceipt->execute();

        if ($stmtReceipt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to generate receipt']);
        }
        exit;
    } elseif ($action === 'fetch_receipt_details') {
        $orderId = $_GET['order_id'];
        $orderDetails = getOrderDetails($dbc, $orderId);
        $username = getUsername($dbc, $orderDetails['user_id']); // Fetch username
        // Fetch payment details
        $paymentDetailsSql = "SELECT payment_method, payment_date FROM payment WHERE order_id = ? AND payment_status = 'Completed' ORDER BY payment_date DESC LIMIT 1";
        $stmtPayment = $dbc->prepare($paymentDetailsSql);
        $stmtPayment->bind_param("i", $orderId);
        $stmtPayment->execute();
        $paymentResult = $stmtPayment->get_result();
        $paymentDetails = $paymentResult->fetch_assoc();
        $receiptDetails = [
            'order_id' => $orderId,
            'table_number' => $orderDetails['table_number'],
            'total_amount' => $orderDetails['total_price'],
            'payment_method' => $paymentDetails['payment_method'],
            'payment_date' => $paymentDetails['payment_date'],
            'items' => $orderDetails['items'],
            'username' => $username
        ];
        header('Content-Type: application/json');
        echo json_encode($receiptDetails);
        exit;
    } elseif ($action === 'fetch_all_receipts') {
        $receipts = getAllReceipts($dbc); // Implement this function
        header('Content-Type: application/json');
        echo json_encode($receipts);
        exit;
    }
}

// Handle order placement (existing code)
$json = file_get_contents('php://input');
$orderData = json_decode($json, true);

if ($orderData) {
    // Extract order details
    $userId = $orderData['user_id'];
    $tableNumber = $orderData['tableNumber'];
    $items = $orderData['items'];
    $totalPrice = $orderData['total'];

    // Start a transaction
    mysqli_begin_transaction($dbc);

    try {
        // Insert into orders table
        $insertOrderSql = "INSERT INTO orders (user_id, table_number, total_price, status) VALUES (?, ?, ?, 'In Progress')";
        $stmtOrder = $dbc->prepare($insertOrderSql);
        $stmtOrder->bind_param("iid", $userId, $tableNumber, $totalPrice);
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
