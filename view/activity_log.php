<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/activity_log_styles.css">
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
                <li><a href="activity_log.php"><i class="fas fa-clipboard-list"></i> Activity Logs</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">

            <div class="topbar">
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
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
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