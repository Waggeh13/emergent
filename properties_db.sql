CREATE DATABASE properties_db;
USE properties_db;

-- Super Admin Table
CREATE TABLE superadmin_table (
    superadmin_id VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

-- District Table
CREATE TABLE district_table (
    district_id VARCHAR(50) NOT NULL PRIMARY KEY,
    district_name VARCHAR(50) NOT NULL,
    created_by VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edited_by VARCHAR(50),
    edited_at TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES superadmin_table(superadmin_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (edited_by) REFERENCES superadmin_table(superadmin_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Admin Table
CREATE TABLE admin_table (
    admin_id VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    district_id VARCHAR(50) NOT NULL,
    created_by VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edited_by VARCHAR(50),
    edited_at TIMESTAMP,
    FOREIGN KEY (district_id) REFERENCES district_table(district_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by) REFERENCES superadmin_table(superadmin_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (edited_by) REFERENCES superadmin_table(superadmin_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Properties Table
CREATE TABLE properties (
    property_code VARCHAR(8) NOT NULL PRIMARY KEY,
    owner_name VARCHAR(50) NOT NULL,
    owner_phone_number VARCHAR(13) NOT NULL,
    email VARCHAR(30),
    property_address VARCHAR(50) NOT NULL,
    property_type VARCHAR(20) NOT NULL,
    property_category ENUM ('Single Unit', 'Multi-Unit') NOT NULL,
    assessment INT,
    rate FLOAT,
    amount_owed FLOAT NOT NULL,
    amount_paid FLOAT,
    payment_status ENUM ('Paid', 'Unpaid') NOT NULL DEFAULT 'Unpaid',
    billing_cycle ENUM ('Annual', 'Quarterly') NOT NULL,
    district_id VARCHAR(50) NOT NULL,
    created_by VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edited_by VARCHAR(50),
    edited_at TIMESTAMP,
    FOREIGN KEY (district_id) REFERENCES district_table(district_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by) REFERENCES admin_table(admin_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (edited_by) REFERENCES admin_table(admin_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Users Table 
CREATE TABLE users (
    user_number INT NOT NULL PRIMARY KEY,
    property_code VARCHAR(8) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_by VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edited_by VARCHAR(50),
    edited_at TIMESTAMP,
    FOREIGN KEY (property_code) REFERENCES properties(property_code) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (created_by) REFERENCES admin_table(admin_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (edited_by) REFERENCES admin_table(admin_id) ON DELETE SET NULL ON UPDATE CASCADE
);