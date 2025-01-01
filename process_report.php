<?php
require_once('mysqli.php');
global $dbc;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'fetch_all_reports') {
        $reports = getAllReports($dbc);
        header('Content-Type: application/json');
        echo json_encode($reports);
        exit;
    } elseif ($action === 'fetch_report') {
        $reportId = $_GET['report_id'];
        $report = getReportDetails($dbc, $reportId);
        header('Content-Type: application/json');
        echo json_encode($report);
        exit;
    } elseif ($action === 'generate_report') {
        generateDailyReport($dbc); // Call the function to generate the report
        exit;
    }
    else if ($action === 'fetch_reports_by_date') {
        $date = $_GET['date'];
        $reports = fetchReportsByDate($dbc, $date);
        echo json_encode($reports);
        exit;
    }
}

function getAllReports($dbc) {
    $sql = "SELECT rs.*, m.name AS popular_item_name FROM salesreport rs LEFT JOIN menus m ON rs.popular_item_id = m.menus_id ORDER BY report_date DESC";
    $stmt = $dbc->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $reports = [];
    while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }
    return $reports;
}

function fetchReportsByDate($dbc, $date) {
    // Modify this query according to your database schema
    $sql = "SELECT rs.*, m.name AS popular_item_name FROM salesreport rs LEFT JOIN menus m ON rs.popular_item_id = m.menus_id WHERE DATE(report_date) = ? ORDER BY report_date DESC";
    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $reports = [];
    while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }
    return $reports;
}

function getReportDetails($dbc, $reportId) {
    $sql = "SELECT rs.*, m.name AS popular_item_name FROM salesreport rs LEFT JOIN menus m ON rs.popular_item_id = m.menus_id WHERE report_id = ?";
    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("i", $reportId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row;
    }
    return null;
}

function generateDailyReport($dbc) {
    // Set the time zone to Malaysia
    date_default_timezone_set('Asia/Kuala_Lumpur');

    // Calculate the start and end of today
    $startOfToday = date('Y-m-d 00:00:00');
    $endOfToday = date('Y-m-d 23:59:59');

    /*

    $checkQuery = "SELECT COUNT(*) AS report_count FROM salesreport WHERE report_date BETWEEN ? AND ?";
    $stmtCheck = $dbc->prepare($checkQuery);
    $stmtCheck->bind_param("ss", $startOfToday, $endOfToday);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result()->fetch_assoc();
    $reportsToday = $result['report_count'];

    // Set the limit
    $dailyLimit = 1; // Allow only 1 report per day

    if ($reportsToday >= $dailyLimit) {
        echo json_encode(['success' => false, 'error' => 'Daily report limit reached.']);
        exit;
    }*/

    // Fetch total sales and total orders for today
    $salesQuery = "SELECT SUM(total_price) AS total_sales, COUNT(order_id) AS total_orders FROM orders WHERE created_at BETWEEN ? AND ?";
    $stmtSales = $dbc->prepare($salesQuery);
    $stmtSales->bind_param("ss", $startOfToday, $endOfToday);
    $stmtSales->execute();
    $salesResult = $stmtSales->get_result()->fetch_assoc();

    // Fetch the most popular item for today
    $popularItemQuery = "SELECT product_id, COUNT(product_id) AS count FROM orderdetails WHERE order_id IN (SELECT order_id FROM orders WHERE created_at BETWEEN ? AND ?) GROUP BY product_id ORDER BY count DESC LIMIT 1";
    $stmtPopularItem = $dbc->prepare($popularItemQuery);
    $stmtPopularItem->bind_param("ss", $startOfToday, $endOfToday);
    $stmtPopularItem->execute();
    $popularItemResult = $stmtPopularItem->get_result()->fetch_assoc();
    $popularItemId = $popularItemResult['product_id'] ?? null;

    // Fetch total payment received for today
    $paymentReceivedQuery = "SELECT SUM(payment_amount) AS total_payment_received FROM payment WHERE payment_date BETWEEN ? AND ?";
    $stmtPaymentReceived = $dbc->prepare($paymentReceivedQuery);
    $stmtPaymentReceived->bind_param("ss", $startOfToday, $endOfToday);
    $stmtPaymentReceived->execute();
    $paymentReceivedResult = $stmtPaymentReceived->get_result()->fetch_assoc();

    // Fetch total payment received for today by cash and card
    $paymentMethodsQuery = "SELECT payment_method, SUM(payment_amount) AS total FROM payment WHERE payment_date BETWEEN ? AND ? GROUP BY payment_method";
    $stmtPaymentMethods = $dbc->prepare($paymentMethodsQuery);
    $stmtPaymentMethods->bind_param("ss", $startOfToday, $endOfToday);
    $stmtPaymentMethods->execute();
    $paymentMethodsResult = $stmtPaymentMethods->get_result();
    $paymentCash = $paymentCard = 0;
    while ($row = $paymentMethodsResult->fetch_assoc()) {
        if ($row['payment_method'] == 'Cash') {
            $paymentCash = $row['total'];
        } elseif ($row['payment_method'] == 'Credit/Debit Card') {
            $paymentCard = $row['total'];
        }
    }

    // Insert the report into the reportsales table
    $insertReportSql = "INSERT INTO salesreport (report_date, total_sales, total_orders, popular_item_id, total_payment_received, payment_cash, payment_card) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $dbc->prepare($insertReportSql);
    $reportDate = date('Y-m-d');
    $stmtInsert->bind_param("sdddddd", $reportDate, $salesResult['total_sales'], $salesResult['total_orders'], $popularItemId, $paymentReceivedResult['total_payment_received'], $paymentCash, $paymentCard);
    $stmtInsert->execute();

    if ($stmtInsert->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to generate report', 'db_error' => $stmtInsert->error]);
    }
    exit;
}
?>