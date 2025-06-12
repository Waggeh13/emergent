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
                <h1>Dashboard</h1>
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
            </div>

            <section class="stats-cards">

                <div class="card">
                    <h3>Total Districts</h3>
                    <p>12</p>
                </div>

                <div class="card">
                    <h3>Total Admins</h3>
                    <p>34</p>
                </div>

                <div class="card">
                    <h3>Total Properties</h3>
                    <p>8542</p>
                </div>

                <div class="card">
                    <h3>Total collected</h3>
                    <p>₵678900</p>
                </div>

            </section>

            <section class="chart-section">
                <h2>National Collection Trend</h2>
                <div class="chart-container">
            
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
    <script src="../js/script.js"></script>
</body>
</html>