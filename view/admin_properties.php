<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_properties.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">LOGO</div>
            <nav class="main-nav">
                <ul>
                <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin_properties.php"><i class="fas fa-building"></i> Property Management</a></li>
                <li><a href="admin_billing.php"><i class="fas fa-file-invoice-dollar"></i> Billing Management</a></li>
                <li><a href="admin_reports_analytics.php"><i class="fas fa-chart-bar"></i> Reports & Analytics</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">

            <div class="topbar">
                <h1>Dashboard</h1>
                <nav class="topbar-nav">
                    <ul>
                        <li><a href="admin_properties.php">Property Management</a></li>
                        <li><a href="admin_billing.php">Billing Management</a></li>
                        <li><a href="admin_report_analytics.php">Reports & Analytics</a></li>
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

            <div class="section-header">
                <button class="add-property-btn">
                    <i class="fas fa-plus"></i>Add Property
                </button>
            </div>
            
            <div class="upload-container">
                <div class="upload-instructions">
                    <h2>Upload Property Data</h2>
                    <h3>Instruction:</h3>
                    <p>Please upload a CSV or Excel file with the following columns: </p>

                    <ul class="column-list">
                        <li><strong>Property Code (Unique)</strong></li>
                        <li><strong>Owner Name</strong></li>
                        <li><strong>POwner Phone Number</strong></li>
                        <li><strong>Email</strong></li>
                        <li><strong>Assessment Value</strong></li>
                        <li><strong>Rate Amount</strong></li>
                        <li><strong>Billing Cycle (Annual, Quarterly)</strong></li>
                    </ul>
                </div>

                <div class="upload-section">
                    <form id="uploadForm">
                        <div class="file-upload-wrapper">
                            <input type="file" id="propertyFile" accept=".csv,.xlsx,.xls" required>
                            <label for="propertyFile" class="upload-btn">
                                <i class="fas fa-file-upload"></i>Upload File
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        
            <div class="property-table-container">
                <table class="propert-table">
                    <thead>
                        <tr>
                            <th>Property Code</th>
                            <th>Owner Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>P1001</td>
                            <td>James Smith</td>
                            <td>123-456.78</td>
                            <td>smaith</td>
                            <td>smsith.anae</td>
                            <td>Residential</td>
                            <td>Single Unit</td>
                            <td><span class="status-badge unpaid">Unpaid</span></td>
                            <td><i class="fas fa-check action-icon"></i></td>
                        </tr>
                        <tr>
                            <td>P1002</td>
                            <td>Jane Doe</td>
                            <td>123-456.78</td>
                            <td>johne</td>
                            <td>jane.cone</td>
                            <td>Inhn-in-lest</td>
                            <td>Quarterly</td>
                            <td><span class="status-badge unpaid">Unpaid</span></td>
                            <td><i class="fas fa-check action-icon"></i></td>
                        </tr>
                        <tr>
                            <td>P1003</td>
                            <td>John Brown</td>
                            <td>123-456.789</td>
                            <td>emily</td>
                            <td>john@d.com</td>
                            <td>Family whit</td>
                            <td>Annual</td>
                            <td><span class="status-badge paid">Paid</span></td>
                            <td><i class="fas fa-check action-icon"></i></td>
                        </tr>
                        <tr>
                            <td>P1005</td>
                            <td>Emily White</td>
                            <td>123-456.789</td>
                            <td>michael</td>
                            <td>michael.com</td>
                            <td>Multiuint</td>
                            <td>Quarterly</td>
                            <td><span class="status-badge paid">Paid</span></td>
                            <td><i class="fas fa-check action-icon"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
        <div id="addPropertyModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <h2>Add New Property</h2>
                    <form id="propertyForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="propertyCode">Property Code*</label>
                                <input type="text" name="propertyCode" id="propertyCode" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="ownerName">Owner Name*</label>
                                <input type="text" name="OwnerName" id="ownerName" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone*</label>
                                <input type="tel" name="phone" id="phone" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" rows="2"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="propertyType">Type*</label>
                                <select id="propertyType" name="propertyType" required>
                                    <option value="">Select Type</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Industrial">Industrial</option>
                                    <option value="Agricultural">Agricultural</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="category">Category*</label>
                                <select id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="Single Unit">Single Unit</option>
                                    <option value="Multi-unit">Multi-unit</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="Condo">Condo</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="assessmentValue">Assessment Value</label>
                                <input type="number" id="assessmentValue" name="assessmentValue" min="0">
                            </div>
                            
                            <div class="form-group">
                                <label for="rateAmount">Rate Amount</label>
                                <input type="number" id="rateAmount" name="rateAmount" min="0">
                            </div>
                            
                            <div class="form-group">
                                <label for="billingCycle">Billing Cycle</label>
                                <select id="billingCycle" name="billingCycle">
                                    <option value="Annual">Annual</option>
                                    <option value="Quarterly">Quarterly</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="cancel-btn">Cancel</button>
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-save"></i> Save Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/property_form_modal.js"></script>
    <script src="../js/admin_script.js"></script>
</body>
</html>