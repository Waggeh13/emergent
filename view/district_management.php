<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>District Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/district_Style.css">
</head>
<style>
</style>
<body>
<div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <img src="../assets/emergent logo1.png" alt="Logo" class="logo-img">
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="super_admin_dashboard.php" class="menu-item"><i class="fas fa-tachometer-alt"></i> <span class="link-text">Overview</span></a></li>
                    <li><a href="district_management.php" class="menu-item active"><i class="fas fa-map-marked-alt"></i> <span class="link-text">District Management</span></a></li>
                    <li><a href="admin_accounts.php" class="menu-item"><i class="fas fa-user-shield"></i> <span class="link-text">Admin Accounts</span></a></li>
                    <li><a href="report_analytics.php" class="menu-item"><i class="fas fa-chart-line"></i> <span class="link-text">Reports & Analytics</span></a></li>
                    <li><a href="activity_log.php" class="menu-item"><i class="fas fa-clipboard-list"></i> <span class="link-text">Activity Logs</span></a></li>
                    <li><a href="super_admin_settings.php" class="menu-item"><i class="fas fa-cog"></i> <span class="link-text">Settings</span></a></li>
                    <li><a href="super_admin_login.php" class="menu-item"><i class="fas fa-sign-out-alt"></i> <span class="link-text">Logout</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">
            <div class="topbar">
                <div class="topbar-left">
                    <img src="../assets/emergent logo2.jpg" alt="Top Logo" class="topbar-logo">
                </div>
                <h1>District Management</h1>
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
            <div class="btn-add" id="addDistrictBtn">
                <div class="add-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <span>Add District</span>
            </div>

            <div class="table-container">
                <table class="districts-table">
                    <thead>
                        <tr>
                            <th>District ID</th>
                            <th>Name</th>
                            <th>Total Paid</th>
                            <th>Total Owed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>

    <div class="modal" id="districtModal">
        <div class="modal-content">
            <span class="close">×</span>
            <h3 id="modalTitle">Add New District</h3>
            <form id="districtForm">
                <div class="form-group">
                    <label for="districtId">District ID</label>
                    <input type="text" name="districtId" id="districtId" required>
                </div>
                <div class="form-group">
                    <label for="districtName">District Name</label>
                    <input type="text" name="districtName" id="districtName" required>
                </div>
                <button type="submit" class="btn-submit">Save District</button>
            </form>
        </div>
    </div>

    <div class="modal" id="deleteConfirmModal">
        <div class="modal-content">
            <h3>Are you sure?</h3>
            <p>This will permanently delete the district.</p>
            <div class="confirm-actions">
                <button class="btn-cancel" id="cancelDeleteBtn">Cancel</button>
                <button class="btn-confirm" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
    
    <script src="../js/add_district_modal.js"></script>
    <script src="../js/script.js"></script>
    
</body>
</html>