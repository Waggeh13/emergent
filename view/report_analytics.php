<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/reports_styles.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h1 class="logo">LOGO</h1>
            <nav class="main-nav">
                <ul>
                <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Overview</a></li>
                <li><a href="district_management.php"><i class="fas fa-map-marked-alt"></i> District Management</a></li>
                <li><a href="admin_accounts.php"><i class="fas fa-user-shield"></i> Admin Accounts</a></li>
                <li><a href="report_analytics.php"><i class="fas fa-chart-line"></i> Reports & Analytics</a></li>
                <li><a href="#"><i class="fas fa-clipboard-list"></i> Activity Logs</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">

            <div class="topbar">
                <h1 style="font-size: 24px;">Reports & Analytics</h1>
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
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>

            <div class="metrics-grid">
                <div class="metrics-card">
                    <h3>Total Properties Billed</h3>
                    <div class="metric-value">10,000</div>
                </div>
                <div class="metrics-card">
                    <h3>Total Payments</h3>
                    <div class="metric-value">500,000</div>
                </div>
                <div class="metrics-card">
                    <h3>Paid Properties</h3>
                    <div class="metric-value">7,200 <span class="percentage">(72%)</span></div>
                </div>
                <div class="metrics-card">
                    <h3>Unpaid Properties</h3>
                    <div class="metric-value">2,800 <span class="percentage">(28%)</div>
                </div>
            </div>

            <div class="section>">
                <h2>Payment Status Visualization</h2>
                <div class="chart">
                    <canvas id="districtBarChart" width="900" height="300"></canvas>
                </div>
            </div>

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
                        <!--populated here-->
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    <script src="../js/reports.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>