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
            <h1>Categories</h1>
        </div><!-- End Page Title -->

        <?php

        require_once('mysqli.php'); // Connect to the db.
        global $dbc;

        $query = "SELECT category_id AS id,  name AS name,  description AS description,  created_at AS created_at FROM categories";
        $result = @mysqli_query($dbc, $query); // Run the query.
        $num = @mysqli_num_rows($result);

        $counter = 1;

        echo '<div class="col-lg-8">';
        if ($num > 0) {

            echo '<table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"><center>#</center></th>
                            <th scope="col"><center>Name</center></th>
                            <th scope="col"><center>Description</center></th>
                        </tr>
                    </thead>';

            while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tbody>
                        <tr>
                            <td><b>' . $counter . '</b></td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['description'] . '</td>
                        </tr>';
                $counter++;
            }
            echo '</tbody>';
            echo '</table>';
        } else {
        }
        echo '</div>';

        $query2 = "select category_id, name from categories";
        $result2 = @mysqli_query($dbc, $query2); // Run the query.
        $num2 = @mysqli_num_rows($result2);

        if (isset($_POST['submitted'])) {
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $cat = $_POST['category_id'];

            $query = "UPDATE categories
                        SET name = '$name', description = '$desc'
                        WHERE category_id = '$cat'";
            $result = @mysqli_query($dbc, $query);

            if (mysqli_affected_rows($dbc) > 0) {
                echo '
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    Success! New category has been created.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <script type="text/javascript">
                        window.location.reload();
                    </script>';

                /*
                // Use JavaScript to reload the page
                echo '<script type="text/javascript">
                        window.location.reload();
                        </script>';
                        */
            }
        }
        /*
        else if (isset($_POST['deleted'])) {
            $cat = $_POST['category_id'];

            $query = "DELETE FROM categories
                    WHERE category_id = '$cat'";
            $result = @mysqli_query($dbc, $query); // Run the query.
            $num = @mysqli_num_rows($result);

            if (mysqli_affected_rows($dbc) > 0) {
                echo '
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    Success! A category has been deleteted.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <script type="text/javascript">
                        window.location.reload();
                    </script>';
            } else {
                echo '
                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                    System Error! You could not add due to system error.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }*/

        ?>

        <div class="col-xl-6">
            <div class="card p-4">

                <div class="pagetitle">
                    <h5>Edit</h5>
                </div>
                <form action="view_category.php" method="post">
                    <div class="row gy-4">

                        <div class="col-md-12">
                            <?php

                            if ($num2 > 0) {
                                echo '<select class="form-select" name="category_id" aria-label="Default select example" required>
                                    <option value="" selected>Category</option>';

                                while ($row2 = @mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                                    echo '<option value=' . $row2['category_id'] . '>' . $row2['name'] . '</option>';
                                }
                            } else {
                                echo '<p>No categories available.</p>';
                            }
                            echo '</select>';

                            ?>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name" placeholder="Category name" required>
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="desc" rows="6" placeholder="Description" required></textarea>
                        </div>

                        <div class="col-md-12 text-center">

                            <button type="submit" class="btn btn-primary">Confirm</button>
                            <input type="hidden" name="submitted" value="TRUE" />
                            <!--<button type="submit" class="btn btn-danger">Delete</button>
                            <input type="hidden" name="deleted" value="TRUE" />-->

                        </div>

                    </div>
                </form>
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