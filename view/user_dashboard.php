<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/user_dashboard.css">
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div class="logo">
      <a href="user_dashboard.php">
        <img src="../assets/emergent logo1.png" alt="Emergent Logo" class="logo-icon"/>
      </a>
    </div>
    <div class="sidebar-menu">
      <a href="user_dashboard.php" class="menu-item">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
      </a>
      <a href="user_billing.php" class="menu-item">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Bills</span>
      </a>
      <a href="user_history.php" class="menu-item active">
        <i class="fas fa-history"></i>
        <span>Payment History</span>
      </a>
      <a href="user_settings.php" class="menu-item">
        <i class="fas fa-cog"></i>
        <span>Settings</span>
      </a>
      <a href="login.php" class="menu-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="page-title">Dashboard</div>
            <div class="user-profile">
                <div class="profile-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <span class="admin-name">user Name</span>
                <i class="fas fa-chevron-down dropdown-arrow"></i>
                <div class="dropdown-menu">
                    <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="horizontal-cards">
                <div class="h-card h-unpaid">
                    <h3>Unpaid Property Bills</h3>
                    <p>8</p>
                </div>
                <div class="h-card">
                    <h3>Total Properties</h3>
                    <p>12</p>
                </div>
                <div class="h-card h-paid">
                    <h3>Total Paid</h3>
                    <p>₵450,000</p>
                </div>
                <div class="h-card">
                    <h3>Outstanding Balance</h3>
                    <p>₵150,000</p>
                </div>
            </div>
            
            <div class="pay-now-section">
                <button class="pay-now-btn" id="payNowBtn">Pay Property Bills Now</button>
            </div>
            
            <div class="payment-history">
                <h2 class="section-title">Payment History</h2>
                <div id="historyList"></div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="paymentModal">
        <div class="modal">
            <span class="close-button" id="closeModal">&times;</span>
            <h2>Make a Payment</h2>

            <form id="paymentForm">
            <label for="propertySelect">Property to Pay For:</label>
            <select id="propertySelect" name="propertySelect" required>
                <option value="">Select a property</option>
                <select id="propertySelect" name="propertySelect" required>
            </select>

            <label for="amount">Amount to Pay (₵):</label>
            <input type="number" id="amount" name="amount" min="1" required>

            <label for="method">Payment Method:</label>
            <select id="method" name="method" required>
                <option value="">Select a method</option>
                <option value="momo">Mobile Money</option>
                <option value="card">Visa / MasterCard</option>
            </select>

            <div id="mobileMoneyFields" class="hidden">
                <label for="momoNumber">Mobile Money Number:</label>
                <input type="tel" id="momoNumber" name="momoNumber" placeholder="e.g., 0551234567">
            </div>

            <div id="cardFields" class="hidden">
                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx">

                <label for="expiry">Expiry Date:</label>
                <input type="text" id="expiry" name="expiry" placeholder="MM/YY">

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="123">
            </div>

            <button type="submit" class="submit-btn">Submit Payment</button>
            </form>
        </div>
    </div>


 
    <script src="../js/user_script.js"></script>
</body>
</html>