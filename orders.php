<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Orders</title>
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

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

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
          <a class="nav-link collapse show" href="orders.php">
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
          <a class="nav-link collapsed" href="take_order.php">
            <i class="bi bi-bell-fill"></i>
            <span>Take Order</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapse show" href="orders.php">
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

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Today's Orders</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Orders</h5>
              <table class="table table-striped table-bordered" id="ordersTable">
                <thead>
                  <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Table Number</th>
                    <th scope="col">Items</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Orders will be loaded here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmationModalLabel">Confirm Order Update</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to update the order status?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="confirmUpdateBtn">Update</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="errorModalLabel">Error</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            An error occurred.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
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

      // Fetch and display orders
      fetchOrders();
      setInterval(fetchOrders, 5000); // Refresh every 5 seconds
    });

    function fetchOrders() {
      fetch('process_order.php?action=fetch_orders')
        .then(response => response.json())
        .then(orders => {
          displayOrders(orders);
        })
        .catch(error => console.error('Error fetching orders:', error));
    }

    function displayOrders(orders) {
      const tableBody = document.getElementById('ordersTable').getElementsByTagName('tbody')[0];
      tableBody.innerHTML = ''; // Clear existing rows

      for (const orderId in orders) {
        const order = orders[orderId];
        const row = tableBody.insertRow();

        // Order ID
        const cellOrderId = row.insertCell();
        cellOrderId.textContent = order.order_id;

        // User ID
        const cellUserId = row.insertCell();
        cellUserId.textContent = order.user_id || '';

        // Table Number
        const cellTableNumber = row.insertCell();
        cellTableNumber.textContent = order.table_number === 0 ? 'Takeout' : order.table_number;

        // Items
        const cellItems = row.insertCell();
        const itemsList = document.createElement('ul');
        order.items.forEach(item => {
          const listItem = document.createElement('li');
          listItem.textContent = `${item.product_name} (Qty: ${item.quantity})`;
          itemsList.appendChild(listItem);
        });
        cellItems.appendChild(itemsList);

        // Total Price
        const cellTotalPrice = row.insertCell();
        cellTotalPrice.textContent = order.total_price;

        // Status
        const cellStatus = row.insertCell();
        const statusDropdown = document.createElement('select');
        statusDropdown.classList.add('form-select');
        statusDropdown.innerHTML = `
            <option value="In Progress" ${order.status === 'In Progress' ? 'selected' : ''}>In Progress</option>
            <option value="Paid" ${order.status === 'Paid' ? 'selected' : ''}>Paid</option>
            <option value="Cancelled" ${order.status === 'Cancelled' ? 'selected' : ''}>Cancelled</option>
            <option value="Ready" ${order.status === 'Ready' ? 'selected' : ''}>Ready</option>
            <option value="Served" ${order.status === 'Served' ? 'selected' : ''}>Served</option>

          `;
        updateStatusDropdownStyle(statusDropdown);
        statusDropdown.addEventListener('change', () => {
          const newStatus = statusDropdown.value;


          if (newStatus === 'Paid') {
            // Check payment status
            fetch(`check_payment.php?order_id=${order.order_id}`)
              .then(response => response.json())
              .then(data => {
                if (data.payment_status === 'Completed') {
                  // Payment completed, show confirmation modal
                  const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                  document.getElementById('confirmationModalLabel').textContent = 'Confirm Order Update';
                  document.querySelector('#confirmationModal .modal-body').textContent = `Are you sure you want to update the status of order ${order.order_id} to ${newStatus}?`;

                  // Handle confirmation
                  document.getElementById('confirmUpdateBtn').onclick = () => {
                    updateOrderStatus(order.order_id, newStatus);
                  };

                  confirmationModal.show();
                } else {
                  // Payment not completed, show error modal
                  const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                  document.getElementById('errorModalLabel').textContent = 'Payment Incomplete';
                  document.querySelector('#errorModal .modal-body').textContent = 'Payment has not been completed for this order.';
                  errorModal.show();
                  statusDropdown.value = order.status; // Reset status
                  updateStatusDropdownStyle(statusDropdown);
                }
              })
              .catch(error => {
                console.error('Error checking payment status:', error);
                // Show error modal for payment check error
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                document.getElementById('errorModalLabel').textContent = 'Error';
                document.querySelector('#errorModal .modal-body').textContent = 'An error occurred while checking payment status.';
                errorModal.show();
                statusDropdown.value = order.status; // Reset status
                updateStatusDropdownStyle(statusDropdown);
              });
          } else {
            // For other statuses, show confirmation modal
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            document.getElementById('confirmationModalLabel').textContent = 'Confirm Order Update';
            document.querySelector('#confirmationModal .modal-body').textContent = `Are you sure you want to update the status of order ${order.order_id} to ${newStatus}?`;

            // Handle confirmation
            document.getElementById('confirmUpdateBtn').onclick = () => {
              updateOrderStatus(order.order_id, newStatus); // Use order.order_id directly
              confirmationModal.hide();
            };

            confirmationModal.show();
          }
        });


        cellStatus.appendChild(statusDropdown);

      }
    }

    function updateOrderStatus(orderId, newStatus) {
      const formData = new FormData();
      formData.append('order_id', orderId);
      formData.append('new_status', newStatus);

      fetch('process_order.php?action=update_status', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.message) {
            console.log(data.message);
            fetchOrders(); // Refresh the orders list
          } else if (data.error) {
            console.error(data.error);
            alert(data.error);
          }
        })
        .catch(error => {
          console.error('Error updating order status:', error);
          alert('Failed to update order status.');
        });
    }

    function updateStatusDropdownStyle(selectElement) {
      selectElement.classList.remove(
        "bg-warning",
        "bg-success",
        "bg-danger",
        "bg-info",
        "bg-primary",
        "bg-opacity-50"
      );

      switch (selectElement.value) {
        case "In Progress":
          selectElement.classList.add("bg-warning", "bg-opacity-50"); // Yellow
          break;
        case "Ready":
          selectElement.classList.add("bg-primary", "bg-opacity-50"); // Blue
          break;
        case "Served":
          selectElement.classList.add("bg-info", "bg-opacity-50"); // Light Blue/Cyan
          break;
        case "Paid":
          selectElement.classList.add("bg-success", "bg-opacity-50"); // Green
          break;
        case "Cancelled":
          selectElement.classList.add("bg-danger", "bg-opacity-50"); // Red
          break;
      }
    }
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