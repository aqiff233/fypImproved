<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>POS for Siddiqie - Tickets</title>
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
          <a class="nav-link collapsed" href="orders.php">
            <i class="bi bi-list-ul"></i>
            <span>Orders</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapse show" href="tickets.php">
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
          <a class="nav-link collapsed" href="orders.php">
            <i class="bi bi-list-ul"></i>
            <span>Orders</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapse show" href="tickets.php">
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
      <h1>Tickets</h1>
    </div><!-- End Page Title -->

    <section class="section tickets">
      <div class="row" id="ticketContainer">
        <!-- Tickets will be loaded here -->
      </div>
    </section>

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

      fetchTickets();
      setInterval(fetchTickets, 5000); // Refresh every 5 seconds
    });

    function fetchTickets() {
      fetch('process_order.php?action=fetch_tickets')
        .then(response => response.json())
        .then(tickets => displayTickets(tickets))
        .catch(error => console.error('Error fetching tickets:', error));
    }

    function displayTickets(tickets) {
      const ticketContainer = document.getElementById('ticketContainer');
      ticketContainer.innerHTML = ''; // Clear existing tickets

      if (Object.keys(tickets).length === 0) {
        // Display a message when no tickets are found
        const noTicketsMessage = document.createElement('div');
        noTicketsMessage.classList.add('col-12', 'text-center');
        noTicketsMessage.innerHTML = '<p>No tickets available at the moment.</p>';
        ticketContainer.appendChild(noTicketsMessage);
        return; // Exit the function early
      }

      for (const orderId in tickets) {
        const ticket = tickets[orderId];

        const ticketElement = document.createElement('div');
        ticketElement.classList.add('col-lg-4', 'col-md-6', 'mb-3');
        ticketElement.innerHTML = `
        <a href="payment.php?order_id=${ticket.order_id}" class="card-link">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">${ticket.table_number === 0 ? 'Takeout' : 'Table: ' + ticket.table_number}</h5>
              <p class="card-text">Order ID: ${ticket.order_id}</p>
              <p class="card-text">Status: ${ticket.status}</p>
              <p class="card-text">Total: RM${ticket.total_price}</p>
              <p class="card-text">Taken by: ${ticket.username || 'N/A'}</p>
            </div>
          </div>
          </a>
        `;

        ticketContainer.appendChild(ticketElement);
      }
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