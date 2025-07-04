<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/admin_dashboard.css" />
  <link rel="stylesheet" href="../css/admin_reports.css" />
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
        <h1>Reports & Analytics</h1>
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

      <div class="admin-report-container">

        <div class="summary-cards">
          <div class="card">
            <i class="fas fa-building"></i>
            <p>Total Properties Billed</p>
            <h3>1,200</h3>
          </div>
          <div class="card">
            <i class="fas fa-coins"></i>
            <p>Total Payments</p>
            <h3>₵150,000</h3>
          </div>
          <div class="card">
            <i class="fas fa-check-circle"></i>
            <p>Paid Properties</p>
            <h3>900 <span>(75%)</span></h3>
          </div>
          <div class="card">
            <i class="fas fa-times-circle"></i>
            <p>Unpaid Properties</p>
            <h3>300 <span>(25%)</span></h3>
          </div>
        </div>

        <div class="chart-section">
          <h3>Payment Status Visualization</h3>
          <canvas id="adminPaymentChart"></canvas>
        </div>

        <div class="district-breakdown">
          <h3>District-Level Breakdown</h3>
          <table>
            <thead>
              <tr>
                <th>District</th>
                <th>Total Billed</th>
                <th>Paid</th>
                <th>Unpaid</th>
                <th>% Paid</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Tamale North</td>
                <td>1,200</td>
                <td>900</td>
                <td>300</td>
                <td>75%</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/admin_script.js"></script>
  <script src="../js/admin_reports.js"></script>
</body>
</html>
