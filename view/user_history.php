<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment History</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link rel="stylesheet" href="../css/payment_history.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <div class="logo">
      <a href="user_dashboard.php">
        <img src="../assets/emergent logo1.png" alt="Emergent Logo" class="logo-icon"/>
      </a>
    </div>
    <div class="sidebar-menu">
      <a href="user_dashboard.php" class="menu-item"><i class="fas fa-home"></i><span>Dashboard</span></a>
      <a href="user_billing.php" class="menu-item"><i class="fas fa-file-invoice-dollar"></i><span>Bills</span></a>
      <a href="user_history.php" class="menu-item active"><i class="fas fa-history"></i><span>Payment History</span></a>
      <a href="user_settings.php" class="menu-item"><i class="fas fa-cog"></i><span>Settings</span></a>
      <a href="login.php" class="menu-item"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </div>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div class="page-title">Payment History</div>
      <div class="user-profile">
        <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
        <span class="admin-name" style="text-decoration: none;"><U>user name</U></span>
        <i class="fas fa-chevron-down dropdown-arrow"></i>
        <div class="dropdown-menu">
          <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>

    <div class="payment-history-content">
      <div class="history-filters">
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Search payments...">
        </div>
        <div class="filter-options">
          <select id="timeFilter">
            <option value="all">All Time</option>
            <option value="month">This Month</option>
            <option value="year">This Year</option>
          </select>
          <select id="statusFilter">
            <option value="all">All Statuses</option>
            <option value="paid">Successful</option>
            <option value="failed">Failed</option>
          </select>
        </div>
      </div>

      <div class="payments-table">
        <table>
          <thead>
            <tr>
              <th>Property</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Payment Method</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="paymentsTableBody"></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal" id="receiptModal">
    <div class="modal-content">
      <span class="close-modal" id="closeReceiptModal">&times;</span>
      <div class="modal-header"><h2>Payment Receipt</h2></div>
      <div class="receipt-details" id="receiptContent"></div>
      <div class="modal-footer">
        <button class="btn btn-primary download-receipt-btn" id="downloadReceiptBtn"><i class="fas fa-download"></i> Download PDF</button>
      </div>
    </div>
  </div>

  <script src="../js/payment_history.js"></script>
  <script src="../js/user_script.js"></script>
</body>
</html>
