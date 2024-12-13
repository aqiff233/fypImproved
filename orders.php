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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
        .card-label {
            display: block;
            cursor: pointer;
        }

        .card-label input[type="checkbox"]:checked+.card {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block mx-auto">SIDDIQIE</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div><!-- End Logo -->

        <div class="main mt-3 ms-3">
            <p id="datetime"></p>
        </div>



    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.html">
                    <i class="bi bi-bell-fill"></i>
                    <span>Take Order</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.html">
                    <i class="bi bi-list-ul"></i>
                    <span>Orders</span>
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
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-list"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="view_category.php" class="active">
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

            <li class="nav-heading">Users</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-login.html">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Login Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Blank</span>
                </a>
            </li><!-- End Blank Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="category.php">
                    <i class="bi bi-book"></i>
                    <span>Category</span>
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Orders</h1>
        </div><!-- End Page Title -->

        <!--<nav>
            <div class="nav nav-underline" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-masakan-panas" data-bs-toggle="tab" data-bs-target="#nav-masakan-panas" type="button" role="tab" aria-controls="nav-masakan-panas" aria-selected="true">Masakan Panas</button>
                <button class="nav-link" id="nav-naan-tadoori" data-bs-toggle="tab" data-bs-target="#nav-naan-tadoori" type="button" role="tab" aria-controls="nav-naan-tadoori" aria-selected="false">Naan Tandoori</button>
                <button class="nav-link" id="nav-roti-puri" data-bs-toggle="tab" data-bs-target="#nav-roti-puri" type="button" role="tab" aria-controls="nav-roti-puri" aria-selected="false">Roti Puri</button>
                <button class="nav-link" id="nav-minuman-panas" data-bs-toggle="tab" data-bs-target="#nav-minuman-panas" type="button" role="tab" aria-controls="nav-minuman-panas" aria-selected="false">Minuman Panas</button>
                <button class="nav-link" id="nav-minuman-sejuk" data-bs-toggle="tab" data-bs-target="#nav-minuman-sejuk" type="button" role="tab" aria-controls="nav-minuman-sejuk" aria-selected="false">Minuman Sejuk</button>
                <button class="nav-link" id="nav-air-buah" data-bs-toggle="tab" data-bs-target="#nav-air-buah" type="button" role="tab" aria-controls="nav-air-buah" aria-selected="false">Air Buah</button>

            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-masakan-panas" role="tabpanel" aria-labelledby="nav-masakan-panas" tabindex="0">masakan panas</div>
            <div class="tab-pane fade" id="nav-naan-tadoori" role="tabpanel" aria-labelledby="nav-naan-tadoori" tabindex="0">nan</div>
            <div class="tab-pane fade" id="nav-roti-puri" role="tabpanel" aria-labelledby="nav-roti-puri" tabindex="0">puri</div>
            <div class="tab-pane fade" id="nav-minuman-panas" role="tabpanel" aria-labelledby="nav-minuman-panas" tabindex="0">air panas</div>
            <div class="tab-pane fade" id="nav-minuman-sejuk" role="tabpanel" aria-labelledby="nav-minuman-sejuk" tabindex="0">air sejuk</div>
            <div class="tab-pane fade" id="nav-air-buah" role="tabpanel" aria-labelledby="nav-air-buah" tabindex="0">buah</div>
        </div>-->
        <?php
        require_once('mysqli.php'); // Connect to the db.
        global $dbc;

        //$query = "";
       // $result = @mysqli_query($dbc, $query); // Run the query.
        //$num = @mysqli_num_rows($result);
        ?>



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
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(now);
            document.getElementById("datetime").textContent = formattedDate;
        });
    </script>
    <script>
        const checkboxes = document.querySelectorAll('input[name="card-selection[]"]');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                console.log("Card value:", checkbox.value, "Checked state:", checkbox.checked);
            });
        });
    </script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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