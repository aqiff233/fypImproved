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
        <a class="nav-link collapsed" href="take_order.php">
          <i class="bi bi-bell-fill"></i>
          <span>Take Order</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="orders.php">
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
        cellTableNumber.textContent = order.table_number;

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
          `;
        updateStatusDropdownStyle(statusDropdown);
        statusDropdown.addEventListener('change', () => {
          const newStatus = statusDropdown.value;
          if (newStatus === 'Paid') {
            //check if payment is completed for the order id
            //if not completed then dont allow user to change status and alert user that payment has not been made
            fetch(`check_payment.php?order_id=${order.order_id}`)
              .then(response => response.json())
              .then(data => {
                if (data.payment_status === 'Completed') {
                  //prompt user to confirm the order
                  if (confirm(`Are you sure you want to update the status of order ${order.order_id} to ${newStatus}?`)) {
                    updateOrderStatus(order.order_id, newStatus);
                  } else {
                    statusDropdown.value = order.status; // Reset to original status
                    updateStatusDropdownStyle(statusDropdown);
                  }
                } else {
                  alert('Payment has not been completed for this order.');
                  statusDropdown.value = order.status; // Reset to original status
                  updateStatusDropdownStyle(statusDropdown);
                }
              })
              .catch(error => {
                console.error('Error checking payment status:', error);
                alert('An error occurred while checking payment status.');
                statusDropdown.value = order.status; // Reset to original status
                updateStatusDropdownStyle(statusDropdown);
              });
          } else {
            // For other statuses, directly prompt for confirmation
            if (confirm(`Are you sure you want to update the status of order ${order.order_id} to ${newStatus}?`)) {
              updateOrderStatus(order.order_id, newStatus);
            } else {
              statusDropdown.value = order.status; // Reset to original status
              updateStatusDropdownStyle(statusDropdown);
            }
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
      selectElement.classList.remove('bg-warning', 'bg-success', 'bg-danger', 'bg-opacity-50');

      switch (selectElement.value) {
        case 'In Progress':
          selectElement.classList.add('bg-warning', 'bg-opacity-50');
          break;
        case 'Paid':
          selectElement.classList.add('bg-success', 'bg-opacity-50');
          break;
        case 'Cancelled':
          selectElement.classList.add('bg-danger', 'bg-opacity-50');
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