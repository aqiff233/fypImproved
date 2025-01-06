<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>POS for Siddiqie - Report</title>
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

        /* Report Container */
        .report-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1050;
            /* Ensure it's above other elements */
            display: none;
            /* Hidden by default */
            width: 80%;
            /* Adjust width as needed */
            max-width: 800px;
            /* Maximum width */
        }

        .report-header {
            display: flex;
        }

        .receipt-body {
            color: black;
        }

        .receipt-header img {
            width: 15%;
        }

        .receipt-header,
        .receipt-footer {
            text-align: center;
        }

        .report-content {
            padding: 20px;
        }

        .report-content .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            z-index: 10;
        }

        .report-content .download-button {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 10;
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
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

            <li class="nav-item">
                <a class="nav-link collapse show" href="report.php">
                    <i class="bi bi-folder"></i>
                    <span>Sales</span>
                </a>
            </li>


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
            <h1>Sales Report</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Report List</h5>
                                <input type="date" id="reportSearchDate" class="form-control" style="width: auto;">
                                <button class="btn btn-primary" id="generateReportBtn">Generate Report</button>
                            </div>
                            <table class="table modern-table" id="reportsTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Report ID</th>
                                        <th scope="col">Report Date</th>
                                        <th scope="col">Total Sales</th>
                                        <th scope="col">Total Orders</th>
                                        <th scope="col">Popular Item</th>
                                        <th scope="col">Total Payment</th>
                                        <th scope="col">Payment Cash</th>
                                        <th scope="col">Payment Card</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Reports will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Report Content -->
        <div id="overlay"></div>
        <div class="report-container">
            <div class="report-content">
                <button class="back-button" onclick="hideReport()"><i class="bi bi-arrow-left"></i></button>
                <div id="reportData" class="receipt-body">
                    <!-- Report data will be loaded here -->
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            © Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
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

            fetchReports();

            document.getElementById('generateReportBtn').addEventListener('click', generateReport);

            // Add an event listener for the search input
            document.getElementById('reportSearchDate').addEventListener('change', function() {
                const selectedDate = this.value;
                if (selectedDate) {
                    searchReportsByDate(selectedDate);
                } else {
                    fetchReports(); // Fetch all reports if the date is cleared
                }
            });
        });

        function fetchReports() {
            fetch('process_report.php?action=fetch_all_reports')
                .then(response => response.json())
                .then(reports => displayReports(reports))
                .catch(error => console.error('Error fetching reports:', error));
        }

        function displayReports(reports) {
            const tableBody = document.getElementById('reportsTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = ''; // Clear existing rows

            reports.forEach(report => {
                const row = tableBody.insertRow();
                row.insertCell().textContent = report.report_id;
                row.insertCell().textContent = report.report_date;
                row.insertCell().textContent = 'RM' + parseFloat(report.total_sales).toFixed(2);
                row.insertCell().textContent = report.total_orders;
                row.insertCell().textContent = report.popular_item_name || 'N/A';
                row.insertCell().textContent = 'RM' + parseFloat(report.total_payment_received).toFixed(2);
                row.insertCell().textContent = report.payment_cash ? 'RM' + parseFloat(report.payment_cash).toFixed(2) : 'RM0.00';
                row.insertCell().textContent = report.payment_card ? 'RM' + parseFloat(report.payment_card).toFixed(2) : 'RM0.00';

                // Make the row clickable
                row.addEventListener('click', () => showReport(report.report_id));
            });
        }

        function showReport(reportId) {
            fetch(`process_report.php?action=fetch_report&report_id=${reportId}`)
                .then(response => response.json())
                .then(reportData => {
                    const reportContainer = document.getElementById('reportData');
                    reportContainer.innerHTML = ''; // Clear existing content

                    // Construct the report content
                    const reportContent = `
                        <div class="receipt-header">
    <img src="assets/img/logo2-removebg.png" alt="Company Logo" style="width:100px; height:auto;">
    <h5>RESTORAN SUDUT SELERA SIDDIQIE </h5>
    <p>38, Jalan Pesona 2, taman pesona, 86000,<br>Kluang, Johor</p>
    <p>Report ID: ${reportData.report_id}</p>
    <p>Date: ${reportData.report_date}</p>
    <p>Generated on: ${new Date().toLocaleString()}</p>
</div>

<br> <br> <!-- Increased space between header and body -->
<hr> <!-- Divider -->

<div class="receipt-details">
    <p>Total Orders: ${reportData.total_orders}</p>
    <p>Popular Item: ${reportData.popular_item_name || 'N/A'}</p>
    
    <hr> <!-- Divider between Popular Item and Total Sales -->
    
    <p>Total Sales: RM${reportData.total_sales}</p>
    <p>Payment (Cash): RM${reportData.payment_cash || '0.00'}</p>
    <p>Payment (Card): RM${reportData.payment_card || '0.00'}</p>
    
    <hr> <!-- Final divider for Total Payment Received -->
    
    <p>Total Payment Received: RM${reportData.total_payment_received}</p>
</div>
                    `;
                    reportContainer.innerHTML = reportContent;

                    // Show the report container
                    document.getElementById('overlay').style.display = 'block';
                    document.querySelector('.report-container').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching report details:', error);
                    alert('Failed to fetch report details.');
                });
        }

        function hideReport() {
            document.getElementById('overlay').style.display = 'none';
            document.querySelector('.report-container').style.display = 'none';
        }

        function generateReport() {
            fetch('process_report.php?action=generate_report', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Report generated successfully!');
                        fetchReports(); // Refresh the reports list
                    } else {
                        alert('Failed to generate report: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to generate report.');
                });
        }

        function searchReportsByDate(date) {
            fetch(`process_report.php?action=fetch_reports_by_date&date=${date}`)
                .then(response => response.json())
                .then(reports => {
                    displayReports(reports);
                })
                .catch(error => {
                    console.error('Error fetching reports by date:', error);
                    alert('Failed to fetch reports.');
                });
        }
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