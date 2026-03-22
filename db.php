<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'expense_tracker';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

/*
Run these SQL queries in phpMyAdmin or MySQL to set up the project:

CREATE DATABASE expense_tracker;
USE expense_tracker;

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE expenses (
    expense_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    expense_date DATE NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

INSERT INTO categories (category_name) VALUES
('Food'),
('Transport'),
('Shopping'),
('Bills'),
('Health'),
('Entertainment'),
('Other');
*/
?>
