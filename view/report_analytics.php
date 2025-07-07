<?php
require_once("../controllers/district_controller.php");
require_once("../controllers/properties_controller.php");
require_once("../controllers/district_amount_controller.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/reports_styles.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <img src="../assets/emergent logo1.png" alt="Logo" class="logo-img">
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="super_admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> <span class="link-text">Overview</span></a></li>
                    <li><a href="district_management.php"><i class="fas fa-map-marked-alt"></i> <span class="link-text">District Management</span></a></li>
                    <li><a href="admin_accounts.php"><i class="fas fa-user-shield"></i> <span class="link-text">Admin Accounts</span></a></li>
                    <li><a href="report_analytics.php"><i class="fas fa-chart-line"></i> <span class="link-text">Reports & Analytics</span></a></li>
                    <li><a href="activity_log.php"><i class="fas fa-clipboard-list"></i> <span class="link-text">Activity Logs</span></a></li>
                    <li><a href="super_admin_settings.php"><i class="fas fa-cog"></i> <span class="link-text">Settings</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">
            <div class="topbar">
                <div class="topbar-left">
                    <img src="../assets/emergent logo2.jpg" alt="Top Logo" class="topbar-logo">
                </div>
                <h1>Dashboard</h1>
                <nav class="topbar-nav">
                    <ul>
                        <li><a href="district_management.php">Districts</a></li>
                        <li><a href="admin_accounts.php">Admins</a></li>
                        <li><a href="report_analytics.php">Reports</a></li>
                    </ul>
                </nav>
                <div class="user-profile">
                    <div class="profile-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="admin-name">Admin Name</span>
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                    <div class="dropdown-menu">
                        <a href="super_admin_login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>

            <div class="metrics-grid">
                <div class="metrics-card">
                    <h3><i class="fas fa-file-invoice-dollar"></i> Total Properties Billed</h3>
                    <div class="metric-value" id="total-properties">0</div>
                </div>
                <div class="metrics-card">
                    <h3><i class="fas fa-hand-holding-usd"></i> Total Payments</h3>
                    <div class="metric-value" id="total-payments">₵0.00</div>
                </div>
                <div class="metrics-card">
                    <h3><i class="fas fa-check-circle"></i> Paid Properties</h3>
                    <div class="metric-value" id="paid-properties">0 <span class="percentage">(0%)</span></div>
                </div>
                <div class="metrics-card">
                    <h3><i class="fas fa-times-circle"></i> Unpaid Properties</h3>
                    <div class="metric-value" id="unpaid-properties">0 <span class="percentage">(0%)</span></div>
                </div>
            </div>

            <section class="chart-section">
                <h2>Payment Status Visualization</h2>
                <div class="chart-container">
                    <canvas id="districtBarChart" width="900" height="300"></canvas>
                </div>
            </section>

            <div class="section">
                <h2>District-Level Breakdown</h2>
                <table id="district-table">
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
                        <!-- Populated dynamically by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    <script src="../js/reports.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>