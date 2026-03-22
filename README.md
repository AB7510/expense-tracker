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
- Deployment: Docker-ready for Render and Railway

## Project Files

- `index.php`
- `add_expense.php`
- `view_expense.php`
- `db.php`
- `style.css`
- `database.sql`
- `Dockerfile`

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

## Deploy on Render + Railway

This repo is ready for deployment using Docker.

### 1. Create a MySQL database on Railway

Railway's official MySQL docs say the database service provides these variables:

- `MYSQLHOST`
- `MYSQLPORT`
- `MYSQLUSER`
- `MYSQLPASSWORD`
- `MYSQLDATABASE`

Import `database.sql` into that Railway MySQL database.

### 2. Create a Web Service on Render

Render's official Docker docs support deploying a web service directly from the `Dockerfile` in this repo.

- Connect this GitHub repo to Render
- Create a new `Web Service`
- Set `Language` to `Docker`
- Deploy the `main` branch

### 3. Add environment variables in Render

Copy the Railway MySQL values into your Render service environment variables:

- `MYSQLHOST`
- `MYSQLPORT`
- `MYSQLUSER`
- `MYSQLPASSWORD`
- `MYSQLDATABASE`

The Docker container already starts PHP on `0.0.0.0:$PORT`, which matches Render and Railway public networking requirements.

## Official Docs

- Render Web Services: https://render.com/docs/web-services
- Render Docker Deploys: https://render.com/docs/docker
- Railway MySQL: https://docs.railway.com/guides/mysql
- Railway Variables: https://docs.railway.com/develop/variables
