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
    FOREIGN KEY (created_by) REFERENCES superadmin_table(superadmin_id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE (district_name)
);

-- Admin Table
CREATE TABLE admin_table (
    admin_id VARCHAR(50) NOT NULL PRIMARY KEY,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    district_id VARCHAR(50) NOT NULL,
    Status ENUM ('Active', 'Inactive') NOT NULL,
    created_by VARCHAR(50) NOT NULL,
    FOREIGN KEY (district_id) REFERENCES district_table(district_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (created_by) REFERENCES superadmin_table(superadmin_id) ON DELETE CASCADE ON UPDATE CASCADE
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
    FOREIGN KEY (district_id) REFERENCES district_table(district_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (created_by) REFERENCES admin_table(admin_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Users Table
CREATE TABLE users (
    user_number VARCHAR(13) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    UNIQUE (user_number)
);

CREATE TABLE user_properties (
    user_number VARCHAR(13) NOT NULL,
    property_code VARCHAR(8) NOT NULL,
    PRIMARY KEY (user_number, property_code),
    FOREIGN KEY (user_number) REFERENCES users(user_number) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (property_code) REFERENCES properties(property_code) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE INDEX idx_district_name ON district_table(district_name);
CREATE INDEX idx_admin_district_id ON admin_table(district_id);
CREATE INDEX idx_properties_district_id ON properties(district_id);
CREATE INDEX idx_properties_owner_name ON properties(owner_name);
CREATE INDEX idx_properties_property_address ON properties(property_address);
CREATE INDEX idx_properties_created_by ON properties(created_by);
CREATE INDEX idx_properties_owner_phone_number ON properties(owner_phone_number);
CREATE INDEX idx_user_properties_user_number ON user_properties(user_number);
CREATE INDEX idx_user_properties_property_code ON user_properties(property_code);