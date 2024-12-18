<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>POS for Siddiqie</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    .modern-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Example font */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .modern-table th,
        .modern-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .modern-table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        .modern-table tbody tr:hover {
            background-color: #f5f5f5;
            cursor: pointer; /* Indicate clickable rows */
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            .modern-table {
                display: block;
                overflow-x: auto;
            }
        }
        /* Offcanvas styling */
    #receiptOffcanvas {
      width: 400px;
      /* Adjust as needed */
    }

    .receipt-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .receipt-header h5 {
      font-weight: bold;
      font-size: 1.5rem;
    }

    .receipt-details p {
      margin-bottom: 5px;
    }

    .receipt-items {
      margin-top: 20px;
      border-top: 1px dashed #000;
      border-bottom: 1px dashed #000;
      padding: 10px 0;
    }

    .receipt-items ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .receipt-items li {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
    }

    .receipt-total {
      margin-top: 20px;
      font-weight: bold;
      text-align: right;
    }

    .receipt-footer {
      text-align: center;
      margin-top: 20px;
    }

    .receipt-body {
      color: black;
    }

    .receipt-header img {
      width: 50%;
    }

  </style>
</head>

<body>
<?php
// Check if the user is logged in via cookies
if (!isset($_COOKIE['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

$user_id = $_COOKIE['user_id'];
$username = $_COOKIE['username'];
$role = $_COOKIE['role'];
?>


    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard.php" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block mx-auto">SIDDIQIE</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div><!-- End Logo -->

        <div class="main mt-3 ms-3">
            <p id="datetime"></p>
        </div>

        <div class="main ms-auto me-3">
            <i class="ri ri-account-circle-fill"></i>
            <span><?php echo $username; ?></span>
        </div>



    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="take_order.php">
                    <i class="bi bi-bell-fill"></i>
                    <span>Take Order</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="orders.php">
                    <i class="bi bi-card-text"></i>
                    <span>Orders</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="tickets.php">
                    <i class="bi bi-card-heading"></i>
                    <span>Tickets</span>
                </a>
            </li>
            
            <?php if ($role == 'admin' || $role == 'manager'): ?>
            <li class="nav-heading">Catalogs</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-seam"></i><span>Menus</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="view_menu.php">
                            <i class="bi bi-circle"></i><span>View List Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="menu.php">
                            <i class="bi bi-circle"></i><span>Create Menu</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
            

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-list"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="view_category.php">
                            <i class="bi bi-circle"></i><span>View List Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="category.php">
                            <i class="bi bi-circle"></i><span>Create Category</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
            <?php endif; ?>

            <li class="nav-heading">Users</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Logout Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Receipts</h1>
    </div><!-- End Page Title -->

    <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Receipt List</h5>
                            <table class="table modern-table" id="receiptsTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Receipt ID</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Payment ID</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Issued At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Receipts will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Receipt Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="receiptOffcanvas" aria-labelledby="receiptOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="receiptOffcanvasLabel">Receipt</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body receipt-body">
                <!-- Receipt content will be loaded here -->
            </div>
        </div>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const now = new Date();
      const options = { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' };
      const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(now);
      document.getElementById("datetime").textContent = formattedDate;
      
      fetchReceipts();

    });

    function fetchReceipts() {
        fetch('process_order.php?action=fetch_all_receipts')
            .then(response => response.json())
            .then(receipts => {
                displayReceipts(receipts);
            })
            .catch(error => console.error('Error fetching receipts:', error));
    }
    function displayReceipts(receipts) {
        const tableBody = document.getElementById('receiptsTable').getElementsByTagName('tbody')[0];
        tableBody.innerHTML = ''; // Clear existing rows
        receipts.forEach(receipt => {
            const row = tableBody.insertRow();
            row.insertCell().textContent = receipt.receipt_id;
            row.insertCell().textContent = receipt.order_id;
            row.insertCell().textContent = receipt.payment_id;
            row.insertCell().textContent = 'RM' + parseFloat(receipt.total_amount).toFixed(2);
            row.insertCell().textContent = receipt.payment_method;
            row.insertCell().textContent = receipt.issued_at;

            row.addEventListener('click', () => {
                    showReceipt(receipt.order_id);
                });

        });
    }

    function showReceipt(orderId) {
            fetch(`process_order.php?action=fetch_receipt_details&order_id=${orderId}`)
                .then(response => response.json())
                .then(receiptData => {
                    const offcanvasBody = document.querySelector('#receiptOffcanvas .offcanvas-body');
                    offcanvasBody.innerHTML = ''; // Clear existing content

                    // Construct the receipt content
                    const receiptContent = `
                        <div class="receipt-header">
                            <img src="assets/img/logo.jpeg" alt="Company Logo">
                            <h5>Kedai Makan Teluk Bharu</h5>
                            <p>Kampung Teluk Bharu,06700,<br>Pendang,Kedah</p>
                        </div>
                        <div class="receipt-details">
                            <p>Order ID: ${receiptData.order_id}</p>
                            <p>Cashier: ${receiptData.username}</p>
                            <p>Date: ${receiptData.payment_date}</p>
                            <p>Table No: ${receiptData.table_number === 0 ? 'Takeout' : receiptData.table_number}</p>
                            <p>Payment Method: ${receiptData.payment_method}</p>
                        </div>
                        <div class="receipt-items">
                            <ul>
                                ${receiptData.items.map(item => `
                                    <li>
                                        <span>${item.product_name}</span>
                                        <span>x${item.quantity} RM${(item.price * item.quantity).toFixed(2)}</span>
                                    </li>
                                `).join('')}
                            </ul>
                        </div>
                        <div class="receipt-total">
                            <p>Total: RM${receiptData.total_amount}</p>
                        </div>
                        <div class="receipt-footer">
                            <p>Thank you for your visit!</p>
                        </div>
                    `;
                    offcanvasBody.innerHTML = receiptContent;

                    // Show the offcanvas
                    const receiptOffcanvas = new bootstrap.Offcanvas(document.getElementById('receiptOffcanvas'));
                    receiptOffcanvas.show();
                })
                .catch(error => {
                    console.error('Error fetching receipt details:', error);
                    alert('Failed to fetch receipt details.');
                });
        }

  </script>

  <script>
    const checkboxes = document.querySelectorAll('input[name="card-selection[]"]');

    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', () => {
        console.log("Card value:", checkbox.value, "Checked state:", checkbox.checked);
      });
    });
  </script>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>