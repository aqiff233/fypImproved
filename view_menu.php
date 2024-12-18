<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Menu</title>
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

            <?php if ($role == 'admin' || $role == 'manager'): ?>
                <li class="nav-heading">Catalogs</li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-box-seam"></i><span>Menus</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="view_menu.php" class="active">
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
            <h1>Items</h1>
        </div><!-- End Page Title -->
        <div class="col-xl-12">
            <form action="view_menu.php" method="post">
                <div class="row gy-4">
                    <div class="card p-4">
                        <div class="col-md-3 mb-3 d-flex align-items-center gap-2">

                            <?php
                            require_once('mysqli.php'); // Connect to the db.
                            global $dbc;

                            $query2 = "select category_id, name from categories";
                            $result2 = @mysqli_query($dbc, $query2); // Run the query.
                            $num2 = @mysqli_num_rows($result2);

                            //$all = '';
                            //$all = 1;

                            if ($num2 > 0) {
                                echo '<select class="form-select" name="category_id" aria-label="Default select example" id="fieldA" required>
                                        <option value="" selected disabled>Category</option>';

                                while ($row2 = @mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                                    echo '<option value=' . $row2['category_id'] . '>' . $row2['name'] . '</option>';
                                }
                                echo '<option value="all">All Categories</option>';
                                echo '</select>';
                            } else {
                                echo '<p>No categories available.</p>';
                            }

                            ?>
                            <button type="submit" class="btn btn-primary" id="buttonA">Filter</button>
                            <input type="hidden" name="submitted" value="TRUE" />
                        </div>
            </form>

            <?php
            require_once('mysqli.php'); // Connect to the db.
            global $dbc;

            $counter = 1;

            $yes = 1;
            $no = 0;

            if (isset($_POST['submitted'])) {

                $cat = $_POST['category_id'];
                $selected = $cat;

                if ($selected == 'all') {
                    $query = "SELECT
                                menus.menus_id,
                                menus.name,
                                menus.price,
                                categories.name AS category_name,  
                                menus.availability,
                                menus.created_at,
                                menus.updated_at
                                FROM menus
                                JOIN
                                categories
                                ON
                                menus.category_id = categories.category_id;";
                    $result = @mysqli_query($dbc, $query); // Run the query.
                    $num = @mysqli_num_rows($result);

                    $counter = 1;

                    if (mysqli_affected_rows($dbc) > 0) {
                        echo '
                                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                                        Success!
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                    }

                    echo '<div class="col-lg-12">';

                    if ($num > 0) {

                        //echo '<div class="col-lg-12">';
                        echo '<table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col"><center>#</center></th>
                                                <th scope="col"><center>Name</center></th>
                                                <th scope="col"><center>Price</center></th>
                                                <th scope="col"><center>Category name</center></th>
                                                <th scope="col"><center>Availability</center></th>
                                                <th scope="col"><center>Created at</center></th>
                                                <th scope="col"><center>Updated at</center></th>
                                                </tr>
                                        </thead>';

                        while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo '<tbody>
                                            <tr>
                                                <th scope="row">' . $counter . '</th>
                                                <td>' . $row['name'] . '</td>
                                                <td>' . $row['price'] . '</td>
                                                <td>' . $row['category_name'] . '</td>
                                                <td>' . $row['availability'] . '</td>
                                                <td>' . $row['created_at'] . '</td>
                                                <td>' . $row['updated_at'] . '</td>
                                            </tr>';
                            $counter++;
                        }
                        echo '</tbody>';
                        echo '</table>';
                        //echo '</div>';

                    } else {
                    }
                    echo '</div>';
                } else {
                    $cat = $_POST['category_id'];
                    $selected = $cat;

                    $query3 = "SELECT
                                menus.menus_id,
                                menus.name,
                                menus.price,
                                categories.name AS category_name,  
                                menus.availability,
                                menus.created_at,
                                menus.updated_at
                                FROM menus
                                JOIN
                                categories
                                ON
                                menus.category_id = categories.category_id
                                WHERE menus.category_id = $cat";
                    $result3 = @mysqli_query($dbc, $query3); // Run the query.
                    $num3 = @mysqli_num_rows($result3);

                    if (mysqli_affected_rows($dbc) > 0) {
                        echo '
                                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                                        Success!
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                    }

                    if ($num3 > 0) {

                        echo '<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><center>#</center></th>
                                                    <th scope="col"><center>Name</center></th>
                                                    <th scope="col"><center>Price</center></th>
                                                    <th scope="col"><center>Category name</center></th>
                                                    <th scope="col"><center>Availability</center></th>
                                                    <th scope="col"><center>Created at</center></th>
                                                    <th scope="col"><center>Updated at</center></th>
                                                    </tr>
                                            </thead>';

                        while ($row3 = @mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                            echo '<tbody>
                                                <tr>
                                                    <th scope="row">' . $counter . '</th>
                                                    <td>' . $row3['name'] . '</td>
                                                    <td>' . $row3['price'] . '</td>
                                                    <td>' . $row3['category_name'] . '</td>
                                                    <td>' . $row3['availability'] . '</td>
                                                    <td>' . $row3['created_at'] . '</td>
                                                    <td>' . $row3['updated_at'] . '</td>
                                                </tr>';
                            $counter++;
                        }
                        echo '</tbody>';
                        echo '</table>';

                        /*echo '<div class="col-xl-4">
                                            <form action="view_menu.php" method="post">
                                                <div class="card p-4">
                                                        <div class="row gy-4">
                                                                <div class="pagetitle">
                                                                    <h1>Set Availability</h1>
                                                                </div>';*/

                        echo '<div class="row">';

                        $query4 = "SELECT 
                            menus.menus_id, 
                            menus.name
                            FROM 
                            menus
                            JOIN 
                            categories
                            ON 
                            menus.category_id = categories.category_id
                            WHERE 
                            menus.category_id = $cat";
                        $result4 = @mysqli_query($dbc, $query4); // Run the query.
                        $num4 = @mysqli_num_rows($result4);

                        if ($num4 > 0) {
                            // Store results in an array
                            $items = [];
                            while ($row4 = @mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                                $items[] = $row4;
                            }

                            echo '<div class="col-xl-6">
                                        <form action="view_menu.php" method="post">
                                        <div class="card p-4">
                                            <div class="row gy-4">
                                                <div class="pagetitle">
                                                    <h1>Set Availability</h1>
                                                </div>';
                            echo '<div class="col-md-12">
                                    <select class="form-select" name="menus_id" aria-label="Default select example" id="fieldB" required>
                                    <option value="" selected disabled>Items</option>';

                            // Use the stored results
                            foreach ($items as $item) {
                                echo '<option value="' . htmlspecialchars($item['menus_id']) . '">' . htmlspecialchars($item['name']) . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';

                            echo '<div class="col-md-12">
                                        <select class="form-select" name="availability" aria-label="Default select example" id="fieldB" required>
                                                <option value="" selected disabled>Availability</option>
                                                <option value="' . htmlspecialchars($yes) . '">Yes</option>
                                                <option value="' . htmlspecialchars($no) . '">No</option>
                                        </select>
                                </div>';

                            echo '<div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary" id="buttonB">Confirm</button>
                                    <input type="hidden" name="stock" value="TRUE" />
                                </div>';

                            echo '</div>';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';

                            echo '<div class="col-xl-6">
                                                                        <form action="view_menu.php" method="post">
                                                                            <div class="card p-4">
                                                                                <div class="row gy-4">
                                                                                    <div class="pagetitle">
                                                                                        <h1>Delete item</h1>
                                                                                    </div>';
                            echo '<div class="col-md-12">
                                                                            <select class="form-select" name="menus_id" aria-label="Default select example" id="fieldC" required>
                                                                            <option value="" selected disabled>Items</option>';

                            // Use the stored results again
                            foreach ($items as $item) {
                                echo '<option value="' . htmlspecialchars($item['menus_id']) . '">' . htmlspecialchars($item['name']) . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';

                            echo '<div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-danger" id="delete">Confirm</button>
                                    <input type="hidden" name="deleted" value="TRUE" />
                                </div>';

                            echo '</div>';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';
                        } else {
                            echo '<p>No items available.</p>';
                        }

                        echo '</div>';

                        /*echo '<div class="col-md-12">
                                                <select class="form-select" name="availability" aria-label="Default select example" id="fieldB" required>
                                                    <option value="" selected disabled>Availability</option>
                                                    <option value="' . $yes . '">Yes</option>
                                                    <option value="' . $no . '">No</option>
                                                </select>
                                            </div>';
                                            
                                    echo '<div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary" id="buttonB">Confirm</button>
                                                <input type="hidden" name="stock" value="TRUE" />
                                            </div>';

                                    echo '</div>';
                                    echo '</div>';
                                    echo '</form>';
                                    echo '</div>';*/
                    } else {
                        echo 'none';
                    }
                }
            } else {

                $query = "SELECT
                            menus.menus_id,
                            menus.name,
                            menus.price,
                            categories.name AS category_name,  
                            menus.availability,
                            menus.created_at,
                            menus.updated_at
                            FROM menus
                            JOIN
                            categories
                            ON
                            menus.category_id = categories.category_id;";
                $result = @mysqli_query($dbc, $query); // Run the query.
                $num = @mysqli_num_rows($result);

                $counter = 1;

                echo '<div class="col-lg-12">';
                if ($num > 0) {

                    echo '<table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"><center>#</center></th>
                                    <th scope="col"><center>Name</center></th>
                                    <th scope="col"><center>Price</center></th>
                                    <th scope="col"><center>Category name</center></th>
                                    <th scope="col"><center>Availability</center></th>
                                    <th scope="col"><center>Created at</center></th>
                                    <th scope="col"><center>Updated at</center></th>
                                </tr>
                            </thead>';

                    while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo '<tbody>
                                    <tr>
                                        <th scope="row">' . $counter . '</th>
                                        <td>' . $row['name'] . '</td>
                                        <td>' . $row['price'] . '</td>
                                        <td>' . $row['category_name'] . '</td>
                                        <td>' . $row['availability'] . '</td>
                                        <td>' . $row['created_at'] . '</td>
                                        <td>' . $row['updated_at'] . '</td>
                                    </tr>';
                        $counter++;
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                }
                echo '</div>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stock'], $_POST['menus_id'], $_POST['availability'])) {
                $id = $_POST['menus_id'];
                $availability = (int) $_POST['availability'];
                $availabilityValue = ($availability === $yes) ? 'TRUE' : 'FALSE';

                $query5 = " UPDATE menus
                    SET availability =  $availabilityValue
                    WHERE menus_id = $id";
                $result5 = @mysqli_query($dbc, $query5); // Run the query.
                //$num5 = @mysqli_num_rows($result5);

                if (mysqli_affected_rows($dbc) > 0) {
                    echo '
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                            Success! New category has been created.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                                    
                        <script type="text/javascript">
                            window.location.reload();
                        </script>';
                }
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleted'], $_POST['menus_id'])) {
                $id = $_POST['menus_id'];
                //$availability = (int) $_POST['availability'];
                //$availabilityValue = ($availability === $yes) ? 'TRUE' : 'FALSE';

                $query5 = " DELETE FROM menus
                    WHERE menus_id = $id";
                $result5 = @mysqli_query($dbc, $query5); // Run the query.
                //$num5 = @mysqli_num_rows($result5);

                if (mysqli_affected_rows($dbc) > 0) {
                    echo '
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                            Success! An item has been deleted.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                                    
                        <script type="text/javascript">
                            window.location.reload();
                        </script>';
                }
            }

            ?>
        </div>
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
    <!--<script>
        // Set the alert to fade out after 3 seconds
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            alert.classList.remove('show');
            alert.classList.add('fade');
        }, 2000); // 3000 milliseconds = 3 seconds
    </script>-->
    <script>
        // Attach event listeners to both buttons
        document.getElementById('buttonA').addEventListener('click', function(event) {
            const fieldA = document.getElementById('fieldA');
            const fieldB = document.getElementById('fieldB');

            // Ensure only Field A is required
            fieldA.required = true;
            fieldB.required = false;
        });

        document.getElementById('buttonB').addEventListener('click', function(event) {
            const fieldA = document.getElementById('fieldA');
            const fieldB = document.getElementById('fieldB');

            // Ensure only Field B is required
            fieldA.required = false;
            fieldB.required = true;
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