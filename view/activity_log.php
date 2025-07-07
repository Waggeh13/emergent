<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/activity_log_styles.css">
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
                    <li><a href="activity_log.php" class="menu-item active"><i class="fas fa-clipboard-list"></i> <span class="link-text">Activity Logs</span></a></li>
                    <li><a href="super_admin_settings.php"><i class="fas fa-cog"></i> <span class="link-text">Settings</span></a></li>
                    <li><a href="super_admin_login.php"><i class="fas fa-sign-out-alt"></i> <span class="link-text">Logout</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">

            <div class="topbar">
                <div class="topbar-left">
                    <img src="../assets/emergent logo2.jpg" alt="Top Logo" class="topbar-logo">
                </div>
                <h1>Activity Log</h1>
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

            <table>
                <thead>
                    <tr>
                        <th>Admin ID</th>
                        <th>Activity</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="id">6000</td>
                        <td>Upload bulk property data from Lands Commission</td>
                        <td class="timestamp">Apr 23, 7453 apm. ET</td>
                    </tr>
                    <tr>
                        <td class="id">6000</td>
                        <td>Upload bulk property data from Lands Commission</td>
                        <td class="timestamp">Apr 23, 7453 apm. ET</td>
                    </tr>
                    <tr>
                        <td class="id">6000</td>
                        <td>Upload bulk property data from Lands Commission</td>
                        <td class="timestamp">Apr 23, 7453 apm. ET</td>
                    </tr>
                    <tr>
                        <td class="id">6000</td>
                        <td>Upload bulk property data from Lands Commission</td>
                        <td class="timestamp">Apr 23, 7453 apm. ET</td>
                    </tr>
                    <tr>
                        <td class="id">6000</td>
                        <td>Upload bulk property data from Lands Commission</td>
                        <td class="timestamp">Apr 23, 7453 apm. ET</td>
                    </tr>
                    <tr>
                        <td class="id">6000</td>
                        <td>Upload bulk property data from Lands Commission</td>
                        <td class="timestamp">Apr 23, 7453 apm. ET</td>
                    </tr>
                    <tr>
                        <td class="id">6000</td>
                        <td>Upload bulk property data from Lands Commission</td>
                        <td class="timestamp">Apr 23, 7453 apm. ET</td>
                    </tr>
                </tbody>
            </table>
            
        </div> 
    </div>
    <script src="../js/script.js"></script>
</body>
</html>