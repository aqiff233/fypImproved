<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>POS for Siddiqie - Receipts</title>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        /* Modern Table Styling */
        .modern-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Example font */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
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
            cursor: pointer;
            /* Indicate clickable rows */
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
            <span>
                <?php echo $username; ?>
            </span>
        </div>

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <?php if ($role == 'kitchen'): ?>
                <!-- Kitchen Role -->
                <li class="nav-item">
                    <a class="nav-link collapse show" href="dashboard.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="kds.php">
                        <i class="fa-solid fa-utensils"></i>
                        <span>KDS</span>
                    </a>
                </li>

            <?php elseif ($role == 'admin' || $role == 'manager'): ?>
                <!-- Admin Role -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="dashboard.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="take_order.php">
                        <i class="bi bi-bell-fill"></i>
                        <span>Take Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="orders.php">
                        <i class="bi bi-list-ul"></i>
                        <span>Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="tickets.php">
                        <i class="bi bi-card-heading"></i>
                        <span>Tickets</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="kds.php">
                        <i class="fa-solid fa-utensils"></i>
                        <span>KDS</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapse show" href="receipts.php">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Receipts</span>
                    </a>
                </li>

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
                </li>

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
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="users.php">
                        <i class="bi bi-person-circle"></i>
                        <span>User Management</span>
                    </a>
                </li>

                <li class="nav-heading">Report</li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="report.php">
                        <i class="bi bi-folder"></i>
                        <span>Sales</span>
                    </a>
                </li>

            <?php else: ?>
                <!-- Staff Role (Default) -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="dashboard.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="take_order.php">
                        <i class="bi bi-bell-fill"></i>
                        <span>Take Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="orders.php">
                        <i class="bi bi-list-ul"></i>
                        <span>Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="tickets.php">
                        <i class="bi bi-card-heading"></i>
                        <span>Tickets</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapse show" href="receipts.php">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Receipts</span>
                    </a>
                </li>

            <?php endif; ?>

            <!-- Logout (Common to all roles) -->
            <li class="nav-heading">Users</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li>

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
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Receipt List</h5>
                                <input type="date" id="receiptSearchDate" class="form-control" style="width: auto;">
                                <select id="receiptSearchTime" class="form-select" style="width: auto;">
                                    <option value="">Time</option>
                                </select>
                            </div>
                            <table class="table modern-table" id="receiptsTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Receipt ID</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Charged At</th>
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
        <div class="offcanvas offcanvas-end" tabindex="-1" id="receiptOffcanvas"
            aria-labelledby="receiptOffcanvasLabel">
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

    </footer><!-- End Footer -->

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const now = new Date();
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(now);
            document.getElementById("datetime").textContent = formattedDate;

            fetchReceipts();

            // Add event listeners for date and time input fields
            document.getElementById('receiptSearchDate').addEventListener('change', filterReceipts);
            document.getElementById('receiptSearchTime').addEventListener('input', filterReceipts);
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

                    // Format date and time in 24-hour format
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    };
                    const formattedDate = new Date(receiptData.payment_date).toLocaleDateString('en-US', options);

                    // Construct the receipt content
                    const receiptContent = `
                <div class="receipt-header">
                    <img src="assets/img/logo2-removebg.png" alt="Company Logo" style="width:100px; height:auto;">
                    <h5>RESTORAN SUDUT SELERA SIDDIQIE </h5>
                    <p>38, Jalan Pesona 2, taman pesona, 86000,<br>Kluang, Johor</p>
                </div>
                <div class="receipt-details">
                    <p>Order ID: ${receiptData.order_id}</p>
                    <p>Cashier: ${receiptData.username}</p>
                    <p>Date: ${formattedDate}</p>
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

        function filterReceipts() {
            const selectedDate = document.getElementById('receiptSearchDate').value;
            const selectedTimeBlock = document.getElementById('receiptSearchTime').value;

            fetch('process_order.php?action=fetch_all_receipts')
                .then(response => response.json())
                .then(receipts => {
                    const filteredReceipts = receipts.filter(receipt => {
                        const receiptDate = receipt.issued_at.substring(0, 10);
                        const receiptTime = receipt.issued_at.substring(11, 16);

                        const dateMatch = !selectedDate || receiptDate === selectedDate;

                        // Time block filtering
                        let timeMatch = !selectedTimeBlock; // Default to true if no time block is selected
                        if (selectedTimeBlock) {
                            const blockStart = selectedTimeBlock;
                            const blockEnd = selectedTimeBlock === '23:30' ? '00:00' :
                                String(parseInt(selectedTimeBlock.substring(0, 2)) + (selectedTimeBlock.substring(3, 5) === '30' ? 1 : 0)).padStart(2, '0') + ':' +
                                (selectedTimeBlock.substring(3, 5) === '30' ? '00' : '30');

                            if (blockEnd === '00:00') {
                                // Special handling for the 23:30 - 00:00 block
                                timeMatch = receiptTime >= blockStart || receiptTime < blockEnd;
                            } else {
                                timeMatch = receiptTime >= blockStart && receiptTime < blockEnd;
                            }
                        }
                        return dateMatch && timeMatch;
                    });
                    displayReceipts(filteredReceipts);
                })
                .catch(error => console.error('Error filtering receipts:', error));
        }

        function generateTimeOptions() {
            const timeSelect = document.getElementById('receiptSearchTime');
            for (let hour = 0; hour < 24; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    // Format time in HH:mm format (24-hour)
                    const timeStr = String(hour).padStart(2, '0') + ":" + String(minute).padStart(2, '0');
                    const nextMinute = minute + 30;
                    const nextHour = (nextMinute >= 60) ? (hour + 1) % 24 : hour;
                    const nextMinuteStr = (nextMinute % 60).toString().padStart(2, '0');

                    const endTimeStr = (nextHour < 10 ? '0' : '') + nextHour + ":" + nextMinuteStr;

                    const option = document.createElement('option');
                    option.value = timeStr;
                    option.text = `${timeStr} - ${endTimeStr}`;
                    timeSelect.appendChild(option);
                }
            }
        }

        // Call the function to generate options when the page loads
        document.addEventListener("DOMContentLoaded", () => {
            // ... other code ...
            generateTimeOptions();
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