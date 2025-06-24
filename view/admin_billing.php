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
            <div class="logo">LOGO</div>
            <nav class="main-nav">
                <ul>
                <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin_properties.php"><i class="fas fa-building"></i> Property Management</a></li>
                <li><a href="admin_billing.php"><i class="fas fa-file-invoice-dollar"></i> Billing Management</a></li>
                <li><a href="admin_reports_analytics.php"><i class="fas fa-chart-bar"></i> Reports & Analytics</a></li>
                <li><a href="admin_settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">

            <div class="topbar">
                <h1>Dashboard</h1>
                <nav class="topbar-nav">
                    <ul>
                        <li><a href="admin_properties.php">Property Management</a></li>
                        <li><a href="admin_billing.php">Billing Management</a></li>
                        <li><a href="admin_report_analytics.php">Reports & Analytics</a></li>
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

    

        </div>
    </div>
    <script src="../js/admin_script.js"></script>
</body>
</html>