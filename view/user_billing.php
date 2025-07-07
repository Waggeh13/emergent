<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Property Bills</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link rel="stylesheet" href="../css/user_dashboard.css"/>
  <link rel="stylesheet" href="../css/user_billing.css"/>
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
      <a href="user_billing.php" class="menu-item active"><i class="fas fa-file-invoice-dollar"></i><span>Bills</span></a>
      <a href="user_history.php" class="menu-item"><i class="fas fa-history"></i><span>Payment History</span></a>
      <a href="user_settings.php" class="menu-item"><i class="fas fa-cog"></i><span>Settings</span></a>
      <a href="login.php" class="menu-item"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </div>
  </div>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div class="page-title">Dashboard</div>
      <div class="user-profile">
        <div class="profile-icon">
          <i class="fas fa-user-circle"></i>
        </div>
        <span class="admin-name">User Name</span>
        <i class="fas fa-chevron-down dropdown-arrow"></i>
        <div class="dropdown-menu">
          <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>

    <!-- Bills Content -->
    <div class="bills-content">
      <div class="bills-table">
        <table>
          <thead>
            <tr>
              <th>Property</th>
              <th>Amount</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <!-- Bill Summary -->
      <div class="bill-summary">
        <div class="summary-row">
          <span>Total Paid:</span>
          <span id="totalPaid">€0</span>
        </div>
        <div class="summary-row">
          <span>Pending Payments:</span>
          <span id="totalPending">€0</span>
        </div>
        <div class="summary-row">
          <span>Outstanding Balance:</span>
          <span id="totalOutstanding">€0</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Payment Modal -->
  <div class="modal-overlay" id="paymentModal" style="display:none;">
    <div class="modal">
      <span class="close-button" id="closeModal">&times;</span>
      <h2>Make a Payment</h2>

      <form id="paymentForm">
        <label for="propertySelect">Property to Pay For:</label>
        <input type="text" id="propertySelect" name="propertySelect" readonly />

        <label for="amount">Amount to Pay (₵):</label>
        <input type="number" id="amount" name="amount" min="1" required readonly />

        <label for="method">Payment Method:</label>
        <select id="method" name="method" required>
          <option value="">Select a method</option>
          <option value="momo">Mobile Money</option>
          <option value="card">Visa / MasterCard</option>
        </select>

        <div id="mobileMoneyFields" class="hidden">
          <label for="momoNumber">Mobile Money Number:</label>
          <input type="tel" id="momoNumber" name="momoNumber" placeholder="e.g., 0551234567">
        </div>

        <div id="cardFields" class="hidden">
          <label for="cardNumber">Card Number:</label>
          <input type="text" id="cardNumber" name="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx">

          <label for="expiry">Expiry Date:</label>
          <input type="text" id="expiry" name="expiry" placeholder="MM/YY">

          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" placeholder="123">
        </div>

        <button type="submit" class="submit-btn">Submit Payment</button>
      </form>
    </div>
  </div>

  <!-- Receipt Modal -->
  <div class="modal-overlay" id="receiptModal" style="display:none;">
    <div class="modal">
      <span class="close-button" id="closeReceiptModal">&times;</span>
      <h2>Payment Receipt</h2>
      <div class="receipt-content" id="receiptContent">
        <!-- Receipt details will be inserted here -->
      </div>
      <button class="submit-btn" id="downloadReceiptBtn">Download PDF</button>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="../js/user_billing.js"></script>
  <script src="../js/user_script.js"></script>

</body>
</html>
