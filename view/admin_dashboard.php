<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
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
                <li><a href="admin_settings.php"><i class="fas fa-cog"></i> <span class="link-text">Settings</span></a></li>
                <li><a href="admin_login.php"><i class="fas fa-sign-out-alt"></i> <span class="link-text">Logout</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">

            <div class="topbar">
                <div class="topbar-left">
                    <img src="../assets/emergent logo2.jpg" alt="Emergent Logo" class="topbar-logo">
                </div>
                <h1 class="dashboard-title">Dashboard</h1>
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
                        <a href="admin_login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>

            <div class="stats-cards">
                <div class="card">
                    <div class="title-row">
                        <i class="fas fa-home icon"></i>
                        <h3>Total Properties Managed</h3>
                    </div>
                    <div class="value">10,000</div>
                </div>
                <div class="card">
                    <div class="title-row">
                        <i class="fas fa-file-invoice-dollar icon"></i>
                        <h3>Total Amount Billed</h3>
                    </div>
                    <div class="value">₵500,000</div>
                </div>
                <div class="card">
                    <div class="title-row">
                        <i class="fas fa-hand-holding-usd icon"></i>
                        <h3>Total Amount Collected</h3>
                    </div>
                    <div class="value">₵375,000</div>
                </div>
                <div class="card">
                    <div class="title-row">
                        <i class="fas fa-users-slash icon"></i>
                        <h3>Number of Unpaid Users</h3>
                    </div>
                    <div class="value">2,800</div>
                </div>
            </div>


            <div class="chart-container">
                <div class="chart-title">Billed vs Collected</div>
                <canvas id="billedCollectedChart" height="300"></canvas>
            </div>

            <div class="quick-actions-container">
                <h2 class="action-title">Quick Actions</h2>
                <div class="quick-actions">
                    <button class="quick-action" id="uploadCsvBtn">
                        <i class="fas fa-file-upload"></i> Upload CSV
                    </button>
                    <button class="quick-action" id="addPropertyBtn">
                        <i class="fas fa-plus-circle"></i> Add Property
                    </button>
                    <button class="quick-action" id="viewReportsBtn">
                        <i class="fas fa-chart-bar"></i> View Reports
                    </button>
                </div>
                <input type="file" id="csvUploadInput" accept=".csv" style="display: none;">
            </div>

        </div>
    </div>
    <script src="../js/action_buttons.js"></script>
    <script src="../js/admin_script.js"></script>
</body>
</html>