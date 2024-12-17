<!-- payment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>POS for Siddiqie - Payment</title>
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
    .payment-container {
      display: flex;
      height: 85vh;
      /* Adjust as needed */
    }

    .order-details {
      flex: 0 0 33.3333%;
      /* 1/3 of the width */
      padding: 20px;
      border-right: 1px solid #ccc;
      position: relative;
    }

    .payment-options {
      flex: 0 0 66.6667%;
      /* 2/3 of the width */
      padding: 20px;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 24px;
      cursor: pointer;
      background: none;
      border: none;
      z-index: 10;
    }

    .total-cost {
      font-size: 2.5rem;
      text-align: center;
      margin-bottom: 20px;
    }

    .payment-method-buttons .btn {
      margin-right: 10px;
    }

    .payment-method-content {
      margin-top: 20px;
      /* border: 1px solid #ccc; */
      /* padding: 20px; */
    }

    .cash-input-group {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .cash-input-group i {
      margin-right: 10px;
    }

    .cash-input-group .btn {
      margin-left: auto;
    }

    .quick-select-buttons .btn {
      margin-right: 5px;
    }

    .payment-method-buttons .btn.active {
      background-color: #0d6efd;
      /* Primary color - adjust to your theme */
      border-color: #0d6efd;
      color: #fff;
    }

    .order-details-content {
      margin-top: 60px;
      /* Adjust this value to move content down */
    }

    .error-message {
      color: #dc3545;
      /* Bootstrap danger/error color */
      margin-top: 5px;
    }

    .change-amount {
      margin-top: 10px;
      font-weight: bold;
    }

    .payment-options {
      flex: 0 0 66.6667%;
      padding: 20px;
      overflow-y: auto;
    }

    /* Offcanvas styling */
    #receiptOffcanvas {
      width: 400px;
      /* Adjust as needed */
    }

    .receipt-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .receipt-header h5 {
      font-weight: bold;
      font-size: 1.5rem;
    }

    .receipt-details p {
      margin-bottom: 5px;
    }

    .receipt-items {
      margin-top: 20px;
      border-top: 1px dashed #000;
      border-bottom: 1px dashed #000;
      padding: 10px 0;
    }

    .receipt-items ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .receipt-items li {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
    }

    .receipt-total {
      margin-top: 20px;
      font-weight: bold;
      text-align: right;
    }

    .receipt-footer {
      text-align: center;
      margin-top: 20px;
    }

    .receipt-body {
      color: black;
    }

    .receipt-header img {
      width: 50%;
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
        <a class="nav-link " href="pages-blank.html">
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
      <h1>Payment</h1>
    </div><!-- End Page Title -->

    <section class="section payment">
      <div class="payment-container">


        <div class="order-details card">
          <button class="back-button" onclick="window.location.href='tickets.php'"><i
              class="bi bi-arrow-left"></i></button>

          <div class="order-details-content">

            <!-- Order details will be loaded here -->
            <h5 id="tableNumber"></h5>
            <ul id="orderItems"></ul>
            <p>Total: RM<span id="totalCost"></span></p>

          </div>

        </div>

        <div class="payment-options card">
          <!-- Payment options and content -->
          <div class="total-cost">RM<span id="paymentTotalCost"></span></div>
          <div class="payment-method-buttons btn-group" role="group" aria-label="Payment Methods">
            <button type="button" class="btn btn-outline-primary active" data-method="cash">Cash</button>
            <button type="button" class="btn btn-outline-primary" data-method="card">Card</button>
            <button type="button" class="btn btn-outline-primary" data-method="qr">QR</button>
            <button type="button" class="btn btn-outline-primary" data-method="online">Online</button>
          </div>
          <div class="payment-method-content">
            <!-- Content will be loaded here based on selected method -->
          </div>
        </div>
      </div>
    </section>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="receiptOffcanvas" aria-labelledby="receiptOffcanvasLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="receiptOffcanvasLabel">Receipt</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body receipt-body">
        <!-- Receipt content will be loaded here -->
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

      //console.log("DOMContentLoaded event fired");

      const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(now);
      document.getElementById("datetime").textContent = formattedDate;

      // Get orderId from URL
      const urlParams = new URLSearchParams(window.location.search);
      const orderId = urlParams.get('order_id');

      if (orderId) {
        fetchOrderDetails(orderId);

        // Add event listeners to payment method buttons
        const paymentMethodButtons = document.querySelectorAll('.payment-method-buttons .btn');
        paymentMethodButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                paymentMethodButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');
                // Load content based on selected method
                const method = button.dataset.method;
                loadPaymentMethodContent(method, orderId);
            });
        });

        // Load default content (Cash)
        loadPaymentMethodContent('cash', orderId);
    } else {
        // Handle case where no order_id is provided
        console.error("No order ID provided.");
        alert("No order ID provided.");
    }
    });

    function fetchOrderDetails(orderId) {
      fetch(`process_order.php?action=fetch_order_details&order_id=${orderId}`)
        .then(response => response.json())
        .then(order => {
          displayOrderDetails(order);
        })
        .catch(error => console.error('Error fetching order details:', error));
    }

    function displayOrderDetails(order) {
      document.getElementById('tableNumber').textContent = order.table_number === 0 ? 'Takeout' : `Table: ${order.table_number}`;
      const orderItemsList = document.getElementById('orderItems');
      orderItemsList.innerHTML = ''; // Clear existing items
      order.items.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.product_name} x ${item.quantity}`;
        orderItemsList.appendChild(listItem);
      });
      document.getElementById('totalCost').textContent = order.total_price;
      document.getElementById('paymentTotalCost').textContent = order.total_price;
    }

    function loadPaymentMethodContent(method,orderId) {
            const contentContainer = document.querySelector('.payment-method-content');
            const totalCost = document.getElementById('totalCost').textContent;
            switch (method) {
              case 'cash':
            contentContainer.innerHTML = `
                <div class="total-cost">RM${totalCost}</div>
                <div class="cash-input-group">
                    <i class="bi bi-cash-coin"></i>
                    <input type="number" id="cashReceived" class="form-control" placeholder="Cash Received">
                    <button class="btn btn-primary" id="chargeButton">Charge</button>
                </div>
                <div class="quick-select-buttons">
                    <button class="btn btn-secondary" onclick="setCashReceived(5)">RM5</button>
                    <button class="btn btn-secondary" onclick="setCashReceived(10)">RM10</button>
                    <button class="btn btn-secondary" onclick="setCashReceived(20)">RM20</button>
                    <button class="btn btn-secondary" onclick="setCashReceived(50)">RM50</button>
                </div>
                <div id="paymentMessage" class="mt-3"></div>
                <div id="changeAmount" class="mt-3 change-amount"></div>
            `;

            // Add event listener to the charge button dynamically
            document.getElementById('chargeButton').addEventListener('click', () => {
                handleCashPayment(orderId);
            });
            break;
        case 'card':
          contentContainer.innerHTML = `
            <p>Please use the card reader to complete the payment.</p>
            <!-- Add more content/integration with card reader here -->
          `;
          break;
        case 'qr':
          contentContainer.innerHTML = `
            <p>Please scan the QR code below to complete the payment.</p>
            <!-- Add QR code image or generator here -->
          `;
          break;
        case 'online':
          contentContainer.innerHTML = `
            <p>Please follow the instructions on your device to complete the online payment.</p>
            <!-- Add more content/integration with online payment gateway here -->
          `;
          break;
        default:
          contentContainer.innerHTML = '<p>Select a payment method above.</p>';
      }
    }

    function setCashReceived(amount) {
      document.getElementById('cashReceived').value = amount;
    }

    /*function calculateChange() {
      const totalCost = parseFloat(document.getElementById('totalCost').textContent);
      const cashReceived = parseFloat(document.getElementById('cashReceived').value);
      const change = cashReceived - totalCost;

      if (change >= 0) {
        document.getElementById('changeAmount').textContent = `Change: RM${change.toFixed(2)}`;
      } else {
        document.getElementById('changeAmount').textContent = 'Insufficient cash received.';
      }
    }*/

    

        function handleCashPayment(orderId) {
          console.log("handleCashPayment called with orderId:", orderId); // Check if orderId is correct
            const totalCost = parseFloat(document.getElementById('totalCost').textContent);
            const cashReceived = parseFloat(document.getElementById('cashReceived').value);
            const paymentMessageContainer = document.getElementById('paymentMessage');
            const changeAmountContainer = document.getElementById('changeAmount');
            paymentMessageContainer.innerHTML = ''; // Clear previous messages
            changeAmountContainer.innerHTML = ''; // Clear previous change amount
            if (cashReceived < totalCost) {
                paymentMessageContainer.innerHTML = '<p class="error-message">Insufficient cash received.</p>';
                return;
            }
            const change = cashReceived - totalCost;
            if (change >= 0) {
                changeAmountContainer.innerHTML = `Change: RM${change.toFixed(2)}`;
                // Proceed with payment and status update
                updatePaymentAndOrderStatus(orderId, totalCost, 'Cash', change);
            }
        }

        function updatePaymentAndOrderStatus(orderId, totalCost, paymentMethod, change) {
            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('payment_amount', totalCost);
            formData.append('payment_method', paymentMethod);
            formData.append('payment_status', 'Completed'); // Assuming immediate completion for cash
            console.log("Order ID being used in updatePaymentAndOrderStatus :", orderId);
            // First, update the payment status
            fetch('process_order.php?action=update_payment', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(paymentResult => {
                if (paymentResult.success) {
                    // Then, update the order status
                    const orderFormData = new FormData();
                    orderFormData.append('order_id', orderId);
                    orderFormData.append('new_status', 'Paid');
                    
                    fetch('process_order.php?action=update_status', {
                        method: 'POST',
                        body: orderFormData
                    })
                    .then(response => response.json())
                    .then(orderResult => {
                        if (orderResult.message) {
                            console.log('Order status updated successfully');
                            // Optionally, refresh the order details or redirect
                            generateReceipt(orderId, paymentMethod, change);
                        } else {
                            throw new Error(orderResult.error || 'Failed to update order status');
                        }
                    });
                } else {
                    throw new Error(paymentResult.error || 'Failed to update payment in payments');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error);
            });
        }
        function generateReceipt(orderId, paymentMethod, change) {
            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('payment_method', paymentMethod);
            formData.append('change', change.toFixed(2));

            fetch('process_order.php?action=generate_receipt', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display the receipt in the offcanvas
                    showReceipt(orderId, paymentMethod, change);
                } else {
                    console.error('Error generating receipt:', data.error);
                    alert('Failed to generate receipt.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to generate receipt.');
            });
        }

        function showReceipt(orderId, paymentMethod, change) {
            fetch(`process_order.php?action=fetch_receipt_details&order_id=${orderId}`)
                .then(response => response.json())
                .then(receiptData => {
                const offcanvasBody = document.querySelector('#receiptOffcanvas .offcanvas-body');
                offcanvasBody.innerHTML = ''; // Clear existing content
                // Construct the receipt content
                const receiptContent = `
                    <div class="receipt-header">
                        <img src="assets/img/logo.jpeg" alt="Company Logo">
                        <h5>Kedai Makan Teluk Bharu</h5>
                        <p>Kampung Teluk Bharu,06700,<br>Pendang,Kedah</p>
                    </div>
                    <div class="receipt-details">
                        <p>Order ID: ${receiptData.order_id}</p>
                        <p>Cashier: ${receiptData.username}</p>
                        <p>Date: ${receiptData.payment_date}</p>
                        <p>Table No: ${receiptData.table_number === 0 ? 'Takeout' : receiptData.table_number}</p>
                        <p>Payment Method: ${paymentMethod}</p>
                        <!-- Add more receipt details here -->
                    </div>
                    <div class="receipt-items">
                        <ul>
                        ${receiptData.items.map(item => `
                        <li>
                            <span>${item.product_name}</span>
                            <span>x${item.quantity} RM${(item.price * item.quantity).toFixed(2)}</span>
                        </li>
                        `).join('')}
                        <!-- Add more items here -->
                        </ul>
                    </div>
                    <div class="receipt-total">
                        <p>Total: RM${receiptData.total_amount}</p>
                        <p>Cash Recieved: RM${(parseFloat(receiptData.total_amount) + parseFloat(change)).toFixed(2)}</p>
                        <p>Change: RM${change}</p>
                    </div>
                    <div class="receipt-footer">
                        <p>Thank you for your visit!</p>
                    </div>
                `;
                offcanvasBody.innerHTML = receiptContent;
                // Show the offcanvas
                const receiptOffcanvas = new bootstrap.Offcanvas(document.getElementById('receiptOffcanvas'));
                receiptOffcanvas.show();
                })
                .catch(error => {
                console.error('Error fetching receipt details:', error);
                alert('Failed to fetch receipt details.');
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