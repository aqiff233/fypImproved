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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            <div class="row gy-4">
                <div class="card p-4">
                    <!-- Filter Form -->
                    <form action="view_menu.php" method="post">
                        <div class="col-md-12 d-flex align-items-center gap-2 mb-3">
                            <div class="col-md-3">
                                <?php
                                require_once('mysqli.php'); // Connect to the db.
                                global $dbc;

                                $query2 = "select category_id, name from categories";
                                $result2 = @mysqli_query($dbc, $query2); // Run the query.
                                $num2 = @mysqli_num_rows($result2);

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
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" id="buttonA">Filter</button>
                                <input type="hidden" name="submitted" value="TRUE" />
                            </div>
                        </div>
                    </form>

                    <!-- Search Form -->
                    <form action="view_menu.php" method="post">
                        <div class="col-md-12 d-flex align-items-center gap-2">
                            <div class="col-md-9 d-flex align-items-center gap-2">
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control" name="search" placeholder="Search..." required>
                                </div>
                                <button type="submit" class="btn btn-primary" id="buttonB">Search</button>
                                <input type="hidden" name="searched" value="TRUE" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
                                    CASE 
                                        WHEN menus.availability = 1 THEN 'Yes'
                                        ELSE 'No'
                                    END AS availability,
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

                            //echo '<div class="col-lg-12">';
                            echo '<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><center>#</center></th>
                                                    <th scope="col"><center>Name</center></th>
                                                    <th scope="col"><center>Price</center></th>
                                                    <th scope="col"><center>Category name</center></th>
                                                    <th scope="col"><center>Availability</center></th>
                                                    </tr>
                                            </thead>';

                            while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo '<tbody>
                                                <tr>
                                                    <th scope="row">' . $counter . '</th>
                                                    <td>' . $row['name'] . '</td>
                                                    <td>' . $row['price'] . '</td>
                                                    <td>' . $row['category_name'] . '</td>'; ?>
                                                    <td>
                                                        <select class="form-select availability-select text-white" name="availability" data-id="<?= $row['menus_id'] ?>" data-original-value="<?= $row['availability'] == 'Yes' ? 1 : 0 ?>">
                                                            <option value="1" <?= $row['availability'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                                                            <option value="0" <?= $row['availability'] == 'No' ? 'selected' : '' ?>>No</option>
                                                        </select>
                                                    </td><?php
                                        echo '</tr>';
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
                                    CASE 
                                        WHEN menus.availability = 1 THEN 'Yes'
                                        ELSE 'No'
                                    END AS availability,
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

                        if ($num3 > 0) {

                            echo '<table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><center>#</center></th>
                                                        <th scope="col"><center>Name</center></th>
                                                        <th scope="col"><center>Price</center></th>
                                                        <th scope="col"><center>Category name</center></th>
                                                        <th scope="col"><center>Availability</center></th>
                                                        </tr>
                                                </thead>';

                            while ($row3 = @mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                echo '<tbody>
                                                    <tr>
                                                        <th scope="row">' . $counter . '</th>
                                                        <td>' . $row3['name'] . '</td>
                                                        <td>' . $row3['price'] . '</td>
                                                        <td>' . $row3['category_name'] . '</td>'; ?>
                                                        <td>
                                                            <select class="form-select availability-select text-white" name="availability" data-id="<?= $row3['menus_id'] ?>" data-original-value="<?= $row3['availability'] == 'Yes' ? 1 : 0 ?>">
                                                                <option value="1" <?= $row3['availability'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                                                                <option value="0" <?= $row3['availability'] == 'No' ? 'selected' : '' ?>>No</option>
                                                            </select>
                                                        </td><?php
                                            echo '</tr>';
                                $counter++;
                            }
                            echo '</tbody>';
                            echo '</table>';

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

                                // set price
                                echo '<div class="col-xl-6">
                                            <form action="view_menu.php" method="post">
                                            <div class="card p-4">
                                                <div class="row gy-4">
                                                    <div class="pagetitle">
                                                        <h1>Set Price</h1>
                                                    </div>';

                                echo '<div class="col-md-12">
                                        <select class="form-select js-example-basic-single" name="menus_id" aria-label="Default select example" id="fieldB" required>
                                        <option value="" selected disabled>Items</option>';

                                // Use the stored results
                                foreach ($items as $item) {
                                    echo '<option value="' . htmlspecialchars($item['menus_id']) . '">' . htmlspecialchars($item['name']) . '</option>';
                                }
                                echo '</select>';
                                echo '</div>';

                                echo '<div class="col-md-3">
                                        <input type="number" class="form-control" name="price1" placeholder="Price" required step="0.1">
                                    </div>';

                                echo '<div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary" id="buttonB">Confirm</button>
                                        <input type="hidden" name="price" value="TRUE" />
                                    </div>';

                                echo '</div>';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';

                                // delete item
                                echo '<div class="col-xl-6">
                                            <form action="view_menu.php" method="post">
                                                <div class="card p-4">
                                                    <div class="row gy-4">
                                                        <div class="pagetitle">
                                                            <h1>Delete item</h1>
                                                        </div>';
                                echo '<div class="col-md-12">
                                        <select class="form-select js-example-basic-single" name="menus_id" aria-label="Default select example" id="fieldC" required>
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
                        } else {
                            echo 'none';
                        }
                    }
                } else {

                    /*$query = "SELECT
                                menus.menus_id,
                                menus.name,
                                menus.price,
                                categories.name AS category_name,  
                                CASE 
                                    WHEN menus.availability = 1 THEN 'Yes'
                                    ELSE 'No'
                                END AS availability,
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

                        echo '<div class="col-lg-12" id="searchresult">';

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
                        echo '</div>';*/
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['menus_id']) && isset($_POST['availability'])) {
                    $menus_id = $_POST['menus_id'];
                    $availability = $_POST['availability'];

                    // Validate availability (optional but recommended)
                    if ($availability != 0 && $availability != 1) {
                        http_response_code(400); // Bad request
                        echo "Invalid availability value.";
                        exit;
                    }

                    // Prepared statement (for security)
                    $update_query = "UPDATE menus SET availability = ? WHERE menus_id = ?";
                    $stmt = mysqli_prepare($dbc, $update_query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ii", $availability, $menus_id);
                        $update_result = mysqli_stmt_execute($stmt);

                        if ($update_result) {
                            echo "Menu updated successfully!";
                        } else {
                            http_response_code(500); // Internal server error
                            echo "Failed to update menu.";
                            // Log the error: error_log(mysqli_stmt_error($stmt));
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        http_response_code(500);
                        echo "Error preparing statement.";
                        // Log the error: error_log(mysqli_error($dbc));
                    }
                    exit; // Stop further execution after AJAX response
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
                            </div>';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price'], $_POST['menus_id'], $_POST['price'])) {
                    $id = $_POST['menus_id'];
                    $price = $_POST['price1'];

                    $query5 = " UPDATE menus
                        SET price =  $price
                        WHERE menus_id = $id";
                    $result5 = @mysqli_query($dbc, $query5); // Run the query.
                    //$num5 = @mysqli_num_rows($result5);

                    if (mysqli_affected_rows($dbc) > 0) {
                        echo '
                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                                Success! Price has been edited.
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }

                if (isset($_POST['search'])) {
                    $search = $_POST['search'];
                    $query = "SELECT
                                menus.menus_id,
                                menus.name,
                                menus.price,
                                categories.name AS category_name,
                                CASE 
                                    WHEN menus.availability = 1 THEN 'Yes'
                                    ELSE 'No'
                                END AS availability,
                                menus.created_at,
                                menus.updated_at
                                FROM
                                menus
                                JOIN
                                categories
                                ON
                                menus.category_id = categories.category_id
                                WHERE
                                menus.name LIKE '{$search}%' OR menus.price LIKE '{$search}%' OR categories.name LIKE '{$search}%'";
                
                    $result = @mysqli_query($dbc, $query); // Run the query.
                    $num = @mysqli_num_rows($result);
                
                    if ($num > 0) {
                        echo '<table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col"><center>#</center></th>
                                        <th scope="col"><center>Name</center></th>
                                        <th scope="col"><center>Price</center></th>
                                        <th scope="col"><center>Category name</center></th>
                                        <th scope="col"><center>Availability</center></th>
                                    </tr>
                                </thead>';

                        $items = []; // Initialize the $items array here
                        $counter = 1; // Initialize $counter here
                        while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $items[] = $row; // Store each row in the $items array
                            echo '<tbody>
                                    <tr>
                                        <th scope="row">' . $counter . '</th>
                                        <td>' . $row['name'] . '</td>
                                        <td>' . $row['price'] . '</td>
                                        <td>' . $row['category_name'] . '</td>'; ?>
                                        <td>
                                            <select class="form-select availability-select text-white" name="availability" data-id="<?= $row['menus_id'] ?>" data-original-value="<?= $row['availability'] == 'Yes' ? 1 : 0 ?>">
                                                <option value="1" <?= $row['availability'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                                                <option value="0" <?= $row['availability'] == 'No' ? 'selected' : '' ?>>No</option>
                                            </select>
                                        </td>
                            <?php
                            echo '</tr>';
                            $counter++;
                        }
                        echo '</tbody>';
                        echo '</table>';
                
                        echo '<div class="row">';
                        // set price
                        echo '<div class="col-xl-6">
                                    <form action="view_menu.php" method="post">
                                    <div class="card p-4">
                                        <div class="row gy-4">
                                            <div class="pagetitle">
                                                <h1>Set Price</h1>
                                            </div>';
                
                        echo '<div class="col-md-12">
                                <select class="form-select js-example-basic-single" name="menus_id" aria-label="Default select example" id="fieldB" required>
                                <option value="" selected disabled>Items</option>';
                
                        // Use the stored results
                        foreach ($items as $item) {
                            echo '<option value="' . htmlspecialchars($item['menus_id']) . '">' . htmlspecialchars($item['name']) . '</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                
                        echo '<div class="col-md-3">
                                <input type="number" class="form-control" name="price1" placeholder="Price" required step="0.1">
                            </div>';
                
                        echo '<div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="buttonB">Confirm</button>
                                <input type="hidden" name="price" value="TRUE" />
                            </div>';
                
                        echo '</div>';
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
                
                        // delete item
                        echo '<div class="col-xl-6">
                                    <form action="view_menu.php" method="post">
                                        <div class="card p-4">
                                            <div class="row gy-4">
                                                <div class="pagetitle">
                                                    <h1>Delete item</h1>
                                                </div>';
                        echo '<div class="col-md-12">
                                <select class="form-select js-example-basic-single" name="menus_id" aria-label="Default select example" id="fieldC" required>
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

                        echo '</div>';
                    } else {
                        echo "no data found";
                    }
                }
            ?>
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
        <!-- update availability -->
        <script>
        const selects = document.querySelectorAll('select[name="availability"]');

        function updateSelectClass(select) {
            if (select.value === "1") {
                select.classList.remove('bg-secondary');
                select.classList.add('bg-success');
            } else {
                select.classList.remove('bg-success');
                select.classList.add('bg-secondary');
            }
        }

        // Set initial classes on page load
        selects.forEach(select => {
            updateSelectClass(select);
        });

        selects.forEach(select => {
            select.addEventListener('change', function() {
                const menusId = this.dataset.id;
                const originalValue = parseInt(this.dataset.originalValue);
                const newValue = parseInt(this.value);

                if (newValue !== originalValue) {
                    if (confirm('Are you sure you want to change the availability?')) {
                        updateAvailability(menusId, newValue, this); // Pass 'this' (the select element)
                    } else {
                        this.value = originalValue;
                        updateSelectClass(this); // Revert class if canceled
                    }
                } else {
                    updateSelectClass(this); // Update class if value is the same
                }
            });
        });

        function updateAvailability(menusId, availability, selectElement) { // Add selectElement parameter
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Menu updated successfully!');
                    selectElement.dataset.originalValue = availability; // Update original value
                    updateSelectClass(selectElement); // Update the class after successful update
                } else {
                    alert('Failed to update menu.');
                }
            };
            xhr.send(`menus_id=${menusId}&availability=${availability}`);
        }
    </script>


    <!-- jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Select2 Initialization -->
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>

</body>

</html>