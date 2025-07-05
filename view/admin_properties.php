<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Properties</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_properties.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <style>
        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <img src="../assets/emergent logo1.png" alt="Emergent Logo" class="logo-img">
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> <span class="link-text">Dashboard</span></a></li>
                    <li><a href="admin_properties.php"><i class="fas fa-building"></i> <span class="link-text">Property Management</span></a></li>
                    <li><a href="admin_billing.php"><i class="fas fa-file-invoice-dollar"></i> <span class="link-text">Billing Management</span></a></li>
                    <li><a href="admin_reports_analytics.php"><i class="fas fa-chart-bar"></i> <span class="link-text">Reports & Analytics</span></a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> <span class="link-text">Settings</span></a></li>
                    <li><a href="admin_login.php"><i class="fas fa-sign-out-alt"></i> <span class="link-text">Logout</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="main-content">
            <div class="topbar">
                <div class="topbar-left">
                    <img src="../assets/emergent logo2.jpg" alt="Emergent Logo" class="topbar-logo">
                </div>
                <h1>Property Management</h1>
                <nav class="topbar-nav">
                    <ul>
                        <li><a href="admin_properties.php">Property Management</a></li>
                        <li><a href="admin_billing.php">Billing Management</a></li>
                        <li><a href="admin_reports_analytics.php">Reports & Analytics</a></li>
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
                    <i class="fas fa-plus"></i>Add Property Manually
                </button>
            </div>

            <div class="upload-container">
                <div class="upload-instructions">
                    <h2>Upload Property Data</h2>
                    <h3>Instruction:</h3>
                    <p>Please upload a CSV file with the following columns: </p>
                    <ul class="column-list">
                        <li><strong>Property Code (Unique)</strong></li>
                        <li><strong>Owner Name</strong></li>
                        <li><strong>Phone Number</strong></li>
                        <li><strong>Email</strong></li>
                        <li><strong>Address</strong></li>
                        <li><strong>Type</strong></li>
                        <li><strong>Category</strong></li>
                        <li><strong>Asset Value</strong></li>
                        <li><strong>Rate</strong></li>
                        <li><strong>Status</strong></li>
                        <li><strong>Billing Cycle</strong></li>
                    </ul>
                </div>

                <div class="upload-section">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <a href="../assets/property_template.csv" class="btn-template">
                            <i class="fas fa-file-download"></i> Download CSV Template
                        </a>
                        <div class="upload-section">
                            <label class="custom-file-upload">
                                <input type="file" id="propertyFile" accept=".csv" />
                                <span id="fileName">No file chosen</span>
                            </label>

                            <button type="submit" class="upload-btn">
                                <i class="fas fa-upload"></i> Upload CSV (Bulk Import)
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="property-table-container">
            <table class="property-table" id="propertyTable">
                <thead>
                    <tr>
                        <th>Property Code</th>
                        <th>Owner Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Asset Value</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div id="addPropertyModal" class="modal">
        <div class="modal-content">
            <button class="close-modal">×</button>
            <h2>Add New Property</h2>
            <form id="propertyForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Property Code</label>
                        <input type="text" name="propertyCode" id="propertyCode" required />
                    </div>

                    <div class="form-group">
                        <label>Owner Name</label>
                        <input type="text" name="OwnerName" id="OwnerName" required />
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" name="phone" id="phone" required />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" />
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" id="address" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select name="propertyType" id="propertyType" required>
                            <option value="">Select Type</option>
                            <option>Residential</option>
                            <option>Commercial</option>
                            <option>Industrial</option>
                            <option>Agricultural</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" id="category" required>
                            <option value="">Select Category</option>
                            <option>Single Unit</option>
                            <option>Multi-Unit</option>
                            <option>Apartment</option>
                            <option>Land</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asset Value</label>
                        <input type="number" name="assetValue" id="assetValue" required />
                    </div>

                    <div class="form-group">
                        <label>Rate</label>
                        <input type="number" name="rate" id="rate" step="0.01" required />
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" required>
                            <option value="">Select Status</option>
                            <option>Paid</option>
                            <option>Unpaid</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Billing Cycle</label>
                        <select name="billingCycle" id="billingCycle" required>
                            <option value="">Select Billing Cycle</option>
                            <option>Quarterly</option>
                            <option>Annually</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-btn">Cancel</button>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="editPropertyModal">
        <div class="modal-content">
            <button class="close-edit-modal">×</button>
            <h2>Edit Property</h2>
            <form id="editPropertyForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Property Code</label>
                        <input type="text" name="editPropertyCode" id="editPropertyCode" required />
                    </div>

                    <div class="form-group">
                        <label>Owner Name</label>
                        <input type="text" name="editOwnerName" id="editOwnerName" required />
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" name="editPhone" id="editPhone" required />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="editEmail" id="editEmail" />
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="editAddress" id="editAddress" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select name="editPropertyType" id="editPropertyType" required>
                            <option value="">Select Type</option>
                            <option>Residential</option>
                            <option>Commercial</option>
                            <option>Industrial</option>
                            <option>Agricultural</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="editCategory" id="editCategory" required>
                            <option value="">Select Category</option>
                            <option>Single Unit</option>
                            <option>Multi-Unit</option>
                            <option>Apartment</option>
                            <option>Land</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Asset Value</label>
                        <input type="number" name="editAssetValue" id="editAssetValue" required />
                    </div>

                    <div class="form-group">
                        <label>Rate</label>
                        <input type="number" name="editRate" id="editRate" step="0.01" required />
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="editStatus" id="editStatus" required>
                            <option value="">Select Status</option>
                            <option>Paid</option>
                            <option>Unpaid</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Billing Cycle</label>
                        <select name="editBillingCycle" id="editBillingCycle" required>
                            <option value="">Select Billing Cycle</option>
                            <option>Quarterly</option>
                            <option>Annually</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-edit-btn">Cancel</button>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="deleteConfirmModal">
        <div class="modal-content">
            <h3>Are you sure?</h3>
            <p>This will permanently delete the property.</p>
            <div class="confirm-actions">
                <button class="btn-cancel" id="cancelDeleteBtn">Cancel</button>
                <button class="btn-confirm" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>

    <script src="../js/property_form_modal.js"></script>
    <script src="../js/admin_script.js"></script>
</body>
</html>