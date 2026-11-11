CREATE DATABASE IF NOT EXISTS blood_donation;
USE blood_donation;

-- ADMINS TABLE
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- USERS TABLE
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','donor') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- DONORS TABLE
CREATE TABLE IF NOT EXISTS donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    phone VARCHAR(20),
    location VARCHAR(100),
    availability ENUM('available','not_available') DEFAULT 'available',
    status ENUM('approved','pending') DEFAULT 'approved',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- REQUESTS TABLE
CREATE TABLE IF NOT EXISTS requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    location VARCHAR(100),
    message TEXT,
    status ENUM('pending','approved','completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username,password,role)
VALUES ('admin',
'$2y$10$wH8K7GQ9e1mZQK5b7Qz6CuQn5cT3J0zY9pXJrJ9o7n2zJt0XyY5qG',
'admin');

INSERT INTO users (username,password,role)
VALUES ('donor1',
'$2y$10$wH8K7GQ9e1mZQK5b7Qz6CuQn5cT3J0zY9pXJrJ9o7n2zJt0XyY5qG',
'donor');