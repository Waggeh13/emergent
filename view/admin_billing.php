<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billing Management</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/admin_dashboard.css">
  <link rel="stylesheet" href="../css/billing_management.css">
</head>
<body>
  <div class="dashboard-container">
    <div class="sidebar">
      <div class="logo">
        <img src="../assets/emergent logo1.png" alt="Emergent Logo" class="logo-img">
      </div>
      <nav class="main-nav">
        <ul>
          <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> <span class="link-text">Dashboard</span></a></li>
          <li><a href="admin_properties.php"><i class="fas fa-building"></i> <span class="link-text">Property Management</span></a></li>
          <li><a href="admin_billing.php"><i class="fas fa-file-invoice-dollar"></i> <span class="link-text">Billing Management</span></a></li>
          <li><a href="admin_reports_analytics.php"><i class="fas fa-chart-bar"></i> <span class="link-text">Reports & Analytics</span></a></li>
          <li><a href="#"><i class="fas fa-cog"></i> <span class="link-text">Settings</span></a></li>
          <li><a href="admin_login.php"><i class="fas fa-sign-out-alt"></i> <span class="link-text">Logout</span></a></li>
        </ul>
      </nav>
    </div>

    <div class="main-content">
      <div class="topbar">
        <div class="topbar-left">
          <img src="../assets/emergent logo2.jpg" alt="Emergent Logo" class="topbar-logo">
        </div>
        <h1>Billing Management</h1>
        <nav class="topbar-nav">
          <ul>
            <li><a href="admin_properties.php">Property Management</a></li>
            <li><a href="admin_billing.php">Billing Management</a></li>
            <li><a href="admin_reports_analytics.php">Reports & Analytics</a></li>
          </ul>    
        </nav>
        <div class="user-profile">
          <div class="profile-icon">
            <i class="fas fa-user-circle"></i>
          </div>
          <span class="admin-name">Admin Name</span>
          <i class="fas fa-chevron-down dropdown-arrow"></i>
          <div class="dropdown-menu">
            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </div>

      <div id="linkSent" class="alert success hidden">Success! Payment link has been sent to the user.</div>
      <div id="reminderSent" class="alert success hidden">Success! Reminder sent via email and SMS.</div>

      <div class="property-table-container">
        <h2>Bill Generation</h2>
        <table class="property-table" id="billingTable">
          <thead>
            <tr>
              <th>Property Code</th>
              <th>Owner Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Address</th>
              <th>Type</th>
              <th>Category</th>
              <th>Amount Owed (₵)</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="no-data-row">
              <td colspan="9" style="text-align: center;">Loading bills...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="../js/billing_management.js"></script>
  <script src="../js/admin_script.js"></script>
</body>
</html>