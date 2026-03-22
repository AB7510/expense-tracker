<?php
function env_or_default($key, $default)
{
    $value = getenv($key);
    return $value !== false && $value !== '' ? $value : $default;
}

$host = env_or_default('MYSQLHOST', env_or_default('DB_HOST', 'localhost'));
$port = (int) env_or_default('MYSQLPORT', env_or_default('DB_PORT', '3306'));
$username = env_or_default('MYSQLUSER', env_or_default('DB_USER', 'root'));
$password = env_or_default('MYSQLPASSWORD', env_or_default('DB_PASSWORD', ''));
$database = env_or_default('MYSQLDATABASE', env_or_default('DB_NAME', 'expense_tracker'));

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $username, $password, $database, $port);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    die('Database connection failed: ' . $exception->getMessage());
}

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
