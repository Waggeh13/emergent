<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Settings</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link rel="stylesheet" href="../css/user_settings.css"/>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <div class="logo">
      <a href="user_dashboard.php">
        <img src="../assets/emergent logo1.png" alt="Emergent Logo" class="logo-icon"/>
      </a>
    </div>
    <div class="sidebar-menu">
      <a href="user_dashboard.php" class="menu-item"><i class="fas fa-home"></i><span>Dashboard</span></a>
      <a href="user_billing.php" class="menu-item"><i class="fas fa-file-invoice-dollar"></i><span>Bills</span></a>
      <a href="user_history.php" class="menu-item"><i class="fas fa-history"></i><span>Payment History</span></a>
      <a href="user_settings.php" class="menu-item active"><i class="fas fa-cog"></i><span>Settings</span></a>
      <a href="login.php" class="menu-item"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </div>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div class="page-title">Settings</div>
      <div class="user-profile">
        <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
        <span class="admin-name">Alpha</span>
        <i class="fas fa-chevron-down dropdown-arrow"></i>
        <div class="dropdown-menu">
          <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>

    <div class="settings-content">
      <div class="settings-card">
        <div class="settings-header">
          <h2 class="settings-title">Profile Information</h2>
          <button class="edit-btn" id="editProfileBtn">
            <i class="fas fa-edit"></i> Edit Profile
          </button>
        </div>
        
        <div class="profile-info" id="profileInfoView">
          <div class="info-group">
            <span class="info-label">Full Name</span>
            <div class="info-value" id="viewFullName">Alpha Diallo</div>
          </div>
          
          <div class="info-group">
            <span class="info-label">Email</span>
            <div class="info-value" id="viewEmail">Alpha@example.com</div>
          </div>
          
          <div class="info-group">
            <span class="info-label">Phone Number</span>
            <div class="info-value" id="viewPhone">+233 24 123 4567</div>
          </div>
          
          <div class="info-group">
            <span class="info-label">Address</span>
            <div class="info-value" id="viewAddress">24 Airport Residential Area, Accra</div>
          </div>
        </div>
        
        <form id="profileInfoForm" style="display: none;">
          <div class="profile-info">
            <div class="info-group">
              <label for="fullName" class="info-label">Full Name</label>
              <input type="text" id="fullName" class="info-input" value="Fatoumata Diallo">
            </div>
            
            <div class="info-group">
              <label for="email" class="info-label">Email</label>
              <input type="email" id="email" class="info-input" value="fatoumata@example.com">
            </div>
            
            <div class="info-group">
              <label for="phone" class="info-label">Phone Number</label>
              <input type="tel" id="phone" class="info-input" value="+233 24 123 4567">
            </div>
            
            <div class="info-group">
              <label for="address" class="info-label">Address</label>
              <textarea id="address" class="info-input" rows="3">24 Airport Residential Area, Accra</textarea>
            </div>
          </div>
          
          <div class="form-actions">
            <button type="button" class="cancel-btn" id="cancelEditBtn">Cancel</button>
            <button type="submit" class="save-btn">Save Changes</button>
          </div>
        </form>
      </div>
      
      <div class="settings-card">
        <div class="settings-header">
          <h2 class="settings-title">Change Password</h2>
        </div>
        
        <div class="profile-info">
          <div class="info-group">
            <span class="info-label">Password</span>
            <div class="info-value">••••••••••</div>
          </div>
        </div>
        
        <button class="edit-btn" id="changePasswordBtn">
          <i class="fas fa-lock"></i> Change Password
        </button>
        
        <form id="passwordForm" class="password-form">
          <div class="profile-info">
            <div class="info-group">
              <label for="currentPassword" class="info-label">Current Password</label>
              <input type="password" id="currentPassword" class="info-input" placeholder="Enter current password">
            </div>
            
            <div class="info-group">
              <label for="newPassword" class="info-label">New Password</label>
              <input type="password" id="newPassword" class="info-input" placeholder="Enter new password">
            </div>
            
            <div class="info-group">
              <label for="confirmPassword" class="info-label">Confirm New Password</label>
              <input type="password" id="confirmPassword" class="info-input" placeholder="Confirm new password">
            </div>
          </div>
          
          <div class="form-actions">
            <button type="button" class="cancel-btn" id="cancelPasswordBtn">Cancel</button>
            <button type="submit" class="save-btn">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../js/user_settings.js"></script>
</body>
</html>