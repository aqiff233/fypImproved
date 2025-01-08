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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
                <a class="nav-link collapsed" href="receipts.php">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Receipts</span>
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

                <li class="nav-item">
                    <a class="nav-link collapse show" href="users.php">
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
            <h1>Users</h1>
        </div><!-- End Page Title -->

        <?php

        require_once('mysqli.php'); // Connect to the db.
        global $dbc;

        $query = "SELECT username, password, role FROM users";
        $result = @mysqli_query($dbc, $query);

        $counter = 1;

        if (mysqli_affected_rows($dbc) > 0) {
            echo '<table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;"><center>#</center></th>
                            <th scope="col"><center>Userame</center></th>
                            <th scope="col"><center>Role</center></th>
                            </tr>
                    </thead>';
            while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tbody>
                                    <tr>
                                        <th scope="row">' . $counter . '</th>
                                        <td>' . $row['username'] . '</td>
                                        <td>' . $row['role'] . '</td>
                                    </tr>';
                $counter++;
            }
            echo '</tbody>';
            echo '</table>';
        }

        if (isset($_POST['submitted'])) {

            $name = $_POST['name'];
            $pass = $_POST['confirmPassword'];
            $role = $_POST['role'];

            // Sanitize the input
            $name = mysqli_real_escape_string($dbc, $name);
            $pass = mysqli_real_escape_string($dbc, $pass);

            // Check for duplicate username first
            $checkQuery = "SELECT username FROM users WHERE username = '$name'";
            $checkResult = mysqli_query($dbc, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                // Username already exists
                echo '
                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                    Error! The username you entered already exists. Please choose a different username.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {



                if ($role === '1') {
                    $query = "INSERT INTO users (username, password, role) VALUES ('$name', SHA2('$pass', 256), 'staff')";
                    $result = @mysqli_query($dbc, $query);

                    if (mysqli_affected_rows($dbc) > 0) {
                        unset($_POST);

                        echo '
                        <script>
                            window.location.href = window.location.href; // Reload without query string
                        </script>';
                    } else {
                        echo '
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                            System Error! You could not create new user due to system error.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                } else if ($role === '2') {
                    $query = "INSERT INTO users (username, password, role) VALUES ('$name', SHA2('$pass', 256), 'kitchen')";
                    $result = @mysqli_query($dbc, $query);

                    if (mysqli_affected_rows($dbc) > 0) {
                        unset($_POST);

                        echo '
                        <script>
                            window.location.href = window.location.href; // Reload without query string
                        </script>';
                    } else {
                        echo '
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                            System Error! You could not create new user due to system error.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                } else if ($role === '3') {
                    $query = "INSERT INTO users (username, password, role) VALUES ('$name', SHA2('$pass', 256), 'manager')";
                    $result = @mysqli_query($dbc, $query);

                    if (mysqli_affected_rows($dbc) > 0) {
                        unset($_POST);

                        echo '
                        <script>
                            window.location.href = window.location.href; // Reload without query string
                        </script>';
                    } else {
                        echo '
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                            System Error! You could not create new user due to system error.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                } else if ($role === '4') {
                    $query = "INSERT INTO users (username, password, role) VALUES ('$name', SHA2('$pass', 256), 'admin')";
                    $result = @mysqli_query($dbc, $query);

                    if (mysqli_affected_rows($dbc) > 0) {
                        unset($_POST);

                        echo '
                        <script>
                            window.location.href = window.location.href; // Reload without query string
                        </script>';
                    } else {
                        echo '
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                            System Error! You could not create new user due to system error.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                } else {
                    echo "<p>Invalid role selected</p>";
                }
            }
        }

        ?>

        <div class="col-xl-6">
            <div class="card p-4">
                <form action="users.php" method="post">
                    <div class="pagetitle">
                        <h1>Create User</h1> <br>
                    </div>
                    <div class="row gy-4">

                        <div class="col-md-12">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" id="usename" name="name" placeholder="Username" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>

                        <div class="col-md-12">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
                            <span id="passwordError" style="color: red;"></span>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example" required>
                                <option value="" selected disabled>Role</option>
                                <option value="1">staff</option>
                                <option value="2">kitchen</option>
                                <option value="3">manager</option>
                                <option value="4">admin</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-center">

                            <button type="submit" class="btn btn-primary" id="submitButton">Confirm</button>
                            <input type="hidden" name="submitted" value="TRUE" />

                        </div>

                    </div>
                </form>
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
        });
    </script>
    <script>
        const form = document.querySelector('form');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordError = document.getElementById('passwordError'); // Add a span for the error message
        const submitButton = document.getElementById('submitButton');

        function validatePassword() {
            if (password.value === '' || confirmPassword.value === '') {
                passwordError.textContent = "Password fields cannot be empty.";
                submitButton.disabled = true;
            } else if (password.value !== confirmPassword.value) {
                passwordError.textContent = "Passwords do not match.";
                submitButton.disabled = true;
            } else {
                passwordError.textContent = "";
                submitButton.disabled = false;
            }
        }

        password.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword);
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