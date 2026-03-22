# Expense Tracker

A simple web-based Expense Tracker built with HTML, CSS, PHP, and MySQL.

## Features

- Add expense with amount, category, and date
- View all expenses in a table
- Show category-wise total
- Show total expense

## Tech Stack

- Frontend: HTML, CSS
- Backend: PHP
- Database: MySQL

## Project Files

- `index.php`
- `add_expense.php`
- `view_expense.php`
- `db.php`
- `style.css`

## Database Setup

Run the SQL below in phpMyAdmin or MySQL:

```sql
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
```

## Run on XAMPP

1. Copy the project folder into `C:\xampp\htdocs\expense-tracker`
2. Start Apache and MySQL from XAMPP
3. Import the database SQL
4. Open `http://localhost/expense-tracker/`
