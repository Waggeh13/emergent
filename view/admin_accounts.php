<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <li><a href="#"><i class="fas fa-chart-line"></i> Reports & Analytics</a></li>
                <li><a href="#"><i class="fas fa-clipboard-list"></i> Activity Logs</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">

            <div class="topbar">
                <h1>Admin Accounts</h1>
                <nav class="topbar-nav">
                    <ul>
                        <li><a href="#">Districts</a></li>
                        <li><a href="#">Admins</a></li>
                        <li><a href="#">Reports</a></li>
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
                            <th>Name</th>
                            <th>Billed Amount</th>
                            <th>Collected Amount</th>
                            <th>Collection %</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!--populates here-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>

    <div class="modal" id="districtModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="modalTitle">Add New District</h3>
            <form id="districtForm">
                <div class="form-group">
                    <label for="districtName">District Name</label>
                    <input type="text" name="districtName" id="districtName" required>
                </div>
                <div class="form-group">
                    <label for="billedAmount">Billed Amount (₵)</label>
                    <input type="number" name="billedAmount" id="billedAmount" required>
                </div>
                <div class="form-group">
                    <label for="collectedAmount">Collected Amount (₵)</label>
                    <input type="number" name="collectedAmount" id="collectedAmount" required>
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