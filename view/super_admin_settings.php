<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/super_admin_settings.css">
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
                    <li><a href="super_admin_login.php"><i class="fas fa-sign-out-alt"></i> <span class="link-text">Logout</span></a></li>
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
        </div>
        <div class="settings-content">
            <h2>Change Password</h2>
            <form id="changePasswordForm">
                <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" id="currentPassword" required>
                </div>
                <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" required>
                </div>
                <div class="form-group">
                <label for="confirmPassword">Confirm New Password</label>
                <input type="password" id="confirmPassword" required>
                </div>
                <div id="passwordError" class="error-message"></div>
                <button type="submit" class="btn-save">Save Changes</button>
            </form>
        </div>
        </div>
    </div>

    <script src="../js/admin_script.js"></script>
</body>
</html>