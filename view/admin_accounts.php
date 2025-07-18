<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Accounts</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/admin_accounts_styles.css">
  <link rel="stylesheet" href="../css/district_Style.css">
  <link rel="stylesheet" href="../css/styles.css" />
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
                    <li><a href="admin_accounts.php" class="menu-item active"><i class="fas fa-user-shield"></i> <span class="link-text">Admin Accounts</span></a></li>
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
                <h1>Admin Accounts</h1>
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
      <div class="btn-add" id="addAdminBtn">
        <div class="add-icon"><i class="fas fa-plus"></i></div>
        <span>Add Admin</span>
      </div>

      <div class="atable-container">
        <table class="districts-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>District</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!--populate here -->
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

 
  <div class="modal" id="adminModal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3 id="modalTitle">Add New Admin</h3>
      <form id="adminForm">
        <div class="form-group">
          <label for="adminID">ID</label>
          <input type="text" name="adminID" id="adminID" required />
        </div>
        <div class="form-group">
          <label for="adminName">Full Name</label>
          <input type="text" name="adminName" id="adminName" required />
        </div>
        <div class="form-group">
          <label for="adminEmail">Email</label>
          <input type="email" name="adminEmail" id="adminEmail" required />
        </div>
        <div class="form-group">
          <label for="adminDistrict">Assign District</label>
          <select id="adminDistrict" name="adminDistrict" required>
            <option value="">Select District</option>
            <option value="District A">District A</option>
            <option value="District B">District B</option>
            <!-- populate here-->
          </select>
        </div>
        <div class="form-group">
          <label for="adminStatus">Status</label>
          <select id="adminStatus" name="adminStatus" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>
        <button type="submit" class="btn-submit">Save Admin</button>
      </form>
    </div>
  </div>

  <div class="modal" id="deleteConfirmModal">
    <div class="modal-content">
      <h3>Are you sure?</h3>
      <p>This will permanently delete the admin account.</p>
      <div class="confirm-actions">
        <button class="btn-cancel" id="cancelDeleteBtn">Cancel</button>
        <button class="btn-confirm" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>

  <script src="../js/admin_accounts.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>
