<?php
require_once('../controllers/admin_controller.php');
require_once('../controllers/district_controller.php');
require_once('../controllers/properties_controller.php');
require_once('../controllers/district_amount_controller.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Superadmin Dashboard</title>
=======
    <title>Dashboard</title>
>>>>>>> 54a47445d08f466bbdcf790f39dbc8c7e6bfe413
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <button class="menu-toggle"><i class="fas fa-bars"></i></button>
    <div class="menu-overlay"></div>

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

            <section class="stats-cards">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-map-marker-alt icon"></i>
                        <h3>Total Districts</h3>
                    </div>
                    <p>
                        <?php
                        $districts = viewdistrictsController();
                        echo count($districts);
                        ?>
                    </p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-shield icon"></i>
                        <h3>Total Admins</h3>
                    </div>
                    <p>
                        <?php
                        $admins = viewadminsController();
                        echo count($admins);
                        ?>
                    </p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-building icon"></i>
                        <h3>Total Properties</h3>
                    </div>
                    <p>
                        <?php
                        $properties = viewpropertiesController();
                        echo count($properties);
                        ?>
                    </p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-coins icon"></i>
                        <h3>Total Collected</h3>
                    </div>
<<<<<<< HEAD
                    <p>GH₵678900</p>
=======
                    <p>
                        <?php
                        $total_paid = 0;
                        foreach ($districts as $district) {
                            $amounts = calculateDistrictAmountsController($district['district_id']);
                            if ($amounts !== false) {
                                $total_paid += $amounts['total_paid'];
                            }
                        }
                        echo '₵' . number_format($total_paid, 2);
                        ?>
                    </p>
>>>>>>> 54a47445d08f466bbdcf790f39dbc8c7e6bfe413
                </div>
            </section>

            <section class="chart-section">
                <h2>Top 10 Districts by Total Paid</h2>
                <div class="chart-container">
<<<<<<< HEAD
                    <canvas id="trendChart"></canvas>
                </div>
            </section>
        </div>
    </div>

    <script src="../js/script.js"></script>
=======
                    <canvas id="districtChart"></canvas>
                </div>
            </section>

            <section class="activity-section">
                <h2>Recent Activity</h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-id">100</div>
                        <div class="activity-content">
                            <p>Added a new admin in District A</p>
                            <span class="activity-time">Today, 10:45 AM</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-id">926</div>
                        <div class="activity-content">
                            <p>Generated report for nationwide collection</p>
                            <span class="activity-time">Today, 9:30 AM</span>
                        </div>
                    </div> 
                    <div class="activity-item">
                        <div class="activity-id">926</div>
                        <div class="activity-content">
                            <p>Generated report for nationwide collection</p>
                            <span class="activity-time">Today, 9:30 AM</span>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
    </div>
    <script src="../js/dashboard.js"></script>
>>>>>>> 54a47445d08f466bbdcf790f39dbc8c7e6bfe413
</body>
</html>