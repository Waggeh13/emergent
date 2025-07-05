<?php
session_start();
require_once("../controllers/properties_controller.php");
require_once("../controllers/district_amount_controller.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics</title>
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
                    <li><a href="super_admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="admin_properties.php"><i class="fas fa-building"></i> Property Management</a></li>
                    <li><a href="admin_billing.php"><i class="fas fa-file-invoice-dollar"></i> Billing Management</a></li>
                    <li><a href="admin_report_analytics.php"><i class="fas fa-chart-bar"></i> Reports & Analytics</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">
            <div class="topbar">
                <h1>Reports & Analytics</h1>
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
                    <span class="admin-name"><?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin Name'); ?></span>
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                    <div class="dropdown-menu">
                        <a href="admin_login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>

            <section class="chart-section">
                <h2>District Billing Status</h2>
                <div class="chart-container" style="height: 400px;">
                    <canvas id="billedCollectedChart"></canvas>
                </div>
            </section>
        </div>
    </div>
    <script src="../js/admin_report_script.js"></script>
</body>
</html>