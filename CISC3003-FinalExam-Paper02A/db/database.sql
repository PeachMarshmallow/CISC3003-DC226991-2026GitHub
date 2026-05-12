-- Scenario A Database Schema
CREATE DATABASE IF NOT EXISTS cisc3003_exam;
USE cisc3003_exam;

CREATE TABLE IF NOT EXISTS users_a (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    gender ENUM('male', 'female', 'other') NOT NULL,
    interests TEXT,
    country VARCHAR(50),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- A.10: SQL Insert INTO statement example
INSERT INTO users_a (name, email, gender, interests, country, message) 
VALUES ('Test User', 'test@example.com', 'male', 'Coding', 'Macau', 'Hello World');
