-- Scenario C Database Schema
CREATE DATABASE IF NOT EXISTS cisc3003_exam_c;
USE cisc3003_exam_c;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    account_active TINYINT(1) DEFAULT 0,
    activation_token_hash CHAR(64) NULL UNIQUE,
    reset_token_hash CHAR(64) NULL UNIQUE,
    reset_token_expires_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
