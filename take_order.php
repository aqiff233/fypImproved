<?php
// Database connection
require_once('mysqli.php');
global $dbc;

// Fetch categories
$categoriesSql = "SELECT category_id, name FROM categories";
$categoriesResult = @mysqli_query($dbc, $categoriesSql);

// Fetch all menu items (initially)
$menuItemsSql = "SELECT m.menus_id, m.name, m.price, m.category_id, m.availability, c.name AS category_name FROM menus m INNER JOIN categories c ON m.category_id = c.category_id";
$menuItemsResult = @mysqli_query($dbc, $menuItemsSql);

$menuItems = [];
if ($menuItemsResult->num_rows > 0) {
    while ($row = $menuItemsResult->fetch_assoc()) {
        $menuItems[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Take Order</title>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .offcanvas-end {
            max-width: 300px;
            width: 30%;
        }

        .offcanvas-body {
            max-height: 80vh;
            /* Add max-height for vertical scrolling if needed */
            overflow-y: auto;
        }

        .offcanvas-body ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .offcanvas-body ul li {
            margin-bottom: 10px;
        }

        .menu-card.disabled {
            opacity: 0.5;
            /* Make them semi-transparent */
            pointer-events: none;
            /* Disable click events */
            background-color: #e9ecef;
        }

        body.offcanvas-open {
            overflow-x: hidden;
            /* Prevent horizontal scrollbar when offcanvas is open */
        }

        body.offcanvas-open #main-content {
            width: 70%;
            /* Adjust width to make space for offcanvas */
            transition: width 0.3s ease-in-out;
            /* Smooth transition */
        }

        #main-content {
            width: 100%;
            transition: width 0.3s ease-in-out;
            /* Smooth transition */
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

            <?php if ($role == 'kitchen'): ?>
                <!-- Kitchen Role -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="dashboard.php">
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
                    <a class="nav-link collapse show" href="take_order.php">
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
                    <a class="nav-link collapse show" href="take_order.php">
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
                    <a class="nav-link collapsed" href="receipts.php">
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

    <div id="main-content">
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Take Order</h1>
            </div><!-- End Page Title -->

            <!--Categories NAVBAR-->
            <ul class="nav nav-underline mb-4">
                <?php
                if ($categoriesResult->num_rows > 0) {
                    $firstItem = true;
                    while ($row = $categoriesResult->fetch_assoc()) {
                        $categoryId = $row["category_id"];
                        $categoryName = $row["name"];
                        $activeClass = $firstItem ? 'active' : '';
                        $ariaCurrent = $firstItem ? 'aria-current="page"' : '';
                ?>
                        <li class="nav-item">
                            <a class="filter-link nav-link <?php echo $activeClass; ?>" <?php echo $ariaCurrent; ?> href="#category-<?php echo $categoryId; ?>" data-category-id="<?php echo $categoryId; ?>"><?php echo $categoryName; ?></a>
                        </li>
                <?php
                        $firstItem = false;
                    }
                } else {
                    echo "<li class=\"nav-item\">No categories found.</li>";
                }
                ?>
            </ul>

            <!--Menu card-->
            <section class="section">
                <div class="row">
                    <?php
                    $cardCount = 0;
                    foreach ($menuItems as $item):
                        if ($cardCount % 4 == 0) {
                            echo '<div class="row">';
                        }
                        $cardCount++;
                        $availability = $item["availability"];
                        $disabledClass = ($availability == 0) ? 'disabled' : '';
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-3 menu-card <?php echo $disabledClass; ?>" data-category-id="<?php echo $item["category_id"]; ?>" data-item-id="<?php echo $item["menus_id"]; ?>" data-item-name="<?php echo $item["name"]; ?>" data-item-price="<?php echo $item["price"]; ?>">
                            <div class="card rounded-4 " style="background-color: #f5f5f5;">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?php echo $item["name"]; ?></h5>
                                    <p class="card-text text-center">RM<?php echo number_format($item["price"], 2); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                        if ($cardCount % 4 == 0) {
                            echo '</div>';
                        }
                    endforeach;
                    if ($cardCount % 4 != 0) {
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>

        </main><!-- End #main -->
    </div>

    <!--Offcanvas-->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Your Cart</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Table Number Dropdown -->
            <div class="mb-3">
                <label for="tableNumber" class="form-label">Table Number:</label>
                <select class="form-select" id="tableNumber">
                    <!-- Options will be loaded here by JavaScript -->
                </select>
            </div>


            <!-- Cart Items List -->
            <ul id="cartItems"></ul>

            <!-- Total -->
            <div class="mt-3">
                Total: RM<span id="cartTotal">0.00</span>
            </div>

            <!-- Cancel and Confirm Buttons -->
            <div class="d-flex justify-content-between mt-3" style="margin-bottom: 20px;">
                <button class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                <button class="btn btn-primary" id="confirmOrder">Confirm Order</button>
            </div>
        </div>
    </div>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

    </footer><!-- End Footer -->

    //previous php code is the same
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Get the current date and format it
            updateTableDropdown();
            const now = new Date();
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(now);
            document.getElementById("datetime").textContent = formattedDate;

            // Offcanvas and Menu Filtering Script
            const navLinks = document.querySelectorAll('.filter-link'); // Select only filter links
            const menuCards = document.querySelectorAll('.menu-card');
            const cartItemsList = document.getElementById('cartItems');
            const cartTotalElement = document.getElementById('cartTotal');
            let cartTotal = 0;
            let cartItems = {}; // Object to track items in the cart
            const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));

            // Get the "Cancel" button element
            const cancelButton = document.querySelector('.offcanvas .btn-secondary');

            // --- Main Content Resizing ---
            const body = document.body;
            const mainContent = document.getElementById('main-content'); // Get the main content wrapper

            // Add a 'shown.bs.offcanvas' event listener to the offcanvas
            cartOffcanvas._element.addEventListener('shown.bs.offcanvas', () => {
                body.classList.add('offcanvas-open');
            });

            // Add a 'hidden.bs.offcanvas' event listener to the offcanvas
            cartOffcanvas._element.addEventListener('hidden.bs.offcanvas', () => {
                body.classList.remove('offcanvas-open');
            });
            // --- End of Main Content Resizing ---

            function filterMenuItems(categoryId) {
                menuCards.forEach(card => {
                    const cardCategoryId = card.dataset.categoryId;
                    if (categoryId === 'all' || categoryId === cardCategoryId) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // --- Initial Filtering Fix ---
            // Get the active category link (the first one)
            const activeNavLink = document.querySelector('.filter-link.active'); // Use .filter-link here too
            const initialCategoryId = activeNavLink ? activeNavLink.dataset.categoryId : 'all';

            // Filter menu items based on the active category
            filterMenuItems(initialCategoryId);
            // --- End of Initial Filtering Fix ---

            navLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Only prevents default for filter links
                    const categoryId = this.dataset.categoryId;

                    navLinks.forEach(navLink => navLink.classList.remove('active'));
                    this.classList.add('active');

                    filterMenuItems(categoryId);
                });
            });

            // Function to check for menu item availability updates
            let lastUpdate = 0; // Timestamp of the last update check

            function checkForUpdates() {
                fetch(`check_updates.php?last_update=${lastUpdate}`)
                    .then(response => response.json())
                    .then(data => {
                        lastUpdate = data.current_timestamp; // Update the lastUpdate timestamp

                        if (data.updates.length > 0) {
                            data.updates.forEach(update => {
                                const itemId = update.menus_id;
                                const isAvailable = update.availability == 1;

                                // Find the corresponding menu card
                                const card = document.querySelector(`.menu-card[data-item-id="${itemId}"]`);
                                if (card) {
                                    if (isAvailable) {
                                        card.classList.remove("disabled");
                                        //card.style.backgroundColor = "#f5f5f5";
                                    } else {
                                        card.classList.add("disabled");
                                        //card.style.backgroundColor = "#e9ecef";
                                    }
                                }
                            });
                        }
                    })
                    .catch(error => console.error("Error checking for updates:", error));
            }

            // Initial check for updates and then poll every 1 seconds (adjust as needed)

            checkForUpdates();
            setInterval(checkForUpdates, 1000);

            // Handle adding items to the cart
            menuCards.forEach(card => {
                card.addEventListener('click', () => {
                    if (!card.classList.contains('disabled')) {
                        const itemId = card.dataset.itemId;
                        const itemName = card.dataset.itemName;
                        const itemPrice = parseFloat(card.dataset.itemPrice);

                        // Check if the item is already in the cart
                        if (cartItems[itemId]) {
                            // Increment quantity and update total price
                            cartItems[itemId].quantity++;
                            cartItems[itemId].totalPrice += itemPrice;
                        } else {
                            // Add new item to cart
                            cartItems[itemId] = {
                                name: itemName,
                                price: itemPrice,
                                quantity: 1,
                                totalPrice: itemPrice
                            };
                        }

                        // Update cart items list in the offcanvas
                        updateCartDisplay();

                        // Show the offcanvas
                        cartOffcanvas.show();
                    }
                });
            });

            function updateCartDisplay() {
                cartItemsList.innerHTML = ''; // Clear the list
                cartTotal = 0; // Reset total

                for (const itemId in cartItems) {
                    const item = cartItems[itemId];
                    const itemTotalPrice = item.price * item.quantity;
                    cartTotal += itemTotalPrice;

                    // Create list item with quantity and delete button
                    const cartItem = document.createElement('li');
                    cartItem.innerHTML = `
                    <span>${item.name} (RM${item.price.toFixed(2)}) x ${item.quantity}</span>
                    <button class="btn btn-sm btn-outline-danger delete-item-btn" data-item-id="${itemId}">
                        <i class="bi bi-dash"></i>
                    </button>
                `;
                    cartItemsList.appendChild(cartItem);
                }

                // Update total
                cartTotalElement.textContent = cartTotal.toFixed(2);
            }

            // Event delegation for delete buttons
            cartItemsList.addEventListener('click', (event) => {
                if (event.target.classList.contains('delete-item-btn')) {
                    const itemId = event.target.dataset.itemId;
                    if (cartItems[itemId].quantity > 1) {
                        cartItems[itemId].quantity--;
                        cartItems[itemId].totalPrice -= cartItems[itemId].price;
                    } else {
                        delete cartItems[itemId];
                    }
                    updateCartDisplay();
                }
            });

            function updateTableDropdown() {
                fetch('process_order.php?action=get_unavailable_tables')
                    .then(response => response.json())
                    .then(availableTables => {
                        const tableDropdown = document.getElementById('tableNumber');
                        tableDropdown.innerHTML = ''; // Clear existing options

                        // Add "Takeout" option
                        const takeoutOption = document.createElement('option');
                        takeoutOption.value = '0';
                        takeoutOption.text = 'Takeout';
                        tableDropdown.add(takeoutOption);

                        // Add available table numbers
                        for (let i = 1; i <= 20; i++) {
                            if (!availableTables.includes(i)) {
                                const option = document.createElement('option');
                                option.value = i;
                                option.text = i;
                                tableDropdown.add(option);
                            }
                        }
                    })
                    .catch(error => console.error('Error fetching available tables:', error));
            }

            document.getElementById('confirmOrder').addEventListener('click', () => {
                const tableNumber = document.getElementById('tableNumber').value;
                const userId = <?php echo json_encode($user_id); ?>;

                // Check if the cart is empty
                if (Object.keys(cartItems).length === 0) {
                    // Create an error message element
                    const errorMessage = document.createElement('div');
                    errorMessage.classList.add('alert', 'alert-danger'); // Add Bootstrap alert classes
                    errorMessage.textContent = "Your cart is empty. Please add items before confirming.";

                    errorMessage.style.paddingTop = "10px";

                    // Add the error message to the offcanvas body
                    const offcanvasBody = document.querySelector('.offcanvas-body');
                    offcanvasBody.appendChild(errorMessage);

                    // Optional: Remove the message after a few seconds
                    setTimeout(() => {
                        offcanvasBody.removeChild(errorMessage);
                    }, 5000); // Remove after 5 seconds (adjust as needed)

                    return; // Don't proceed with the order
                }

                const orderData = {
                    user_id: userId,
                    tableNumber: tableNumber,
                    items: cartItems,
                    total: cartTotal
                };
                console.log('Order Data:', orderData);
                // Convert the order data to a JSON string
                const orderDataJson = JSON.stringify(orderData);

                // Send the order data to the server via a POST request
                fetch('process_order.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: orderDataJson
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json(); // Parse the JSON response from the server
                    })
                    .then(data => {
                        // Handle the response from the server (e.g., show a success message)
                        console.log('Order processed successfully:', data);
                        updateTableDropdown();

                        // Optionally reset the cart and close the offcanvas
                        cartItems = {};
                        cartTotal = 0;
                        updateCartDisplay();
                        cartOffcanvas.hide();
                    })
                    .catch(error => {
                        console.error('Error processing order:', error);
                        // Handle errors (e.g., show an error message to the user)
                    });

            });

            // Add an event listener to the "Cancel" button
            cancelButton.addEventListener('click', () => {
                cartItems = {}; // Reset the cart items
                cartTotal = 0; // Reset the total
                updateCartDisplay(); // Update the cart display to clear the items
                cartOffcanvas.hide(); // Close the offcanvas
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