<?php
require_once 'db.php';

$categories = [];
$categoryResult = $conn->query('SELECT category_id, category_name FROM categories ORDER BY category_name ASC');

if ($categoryResult && $categoryResult->num_rows > 0) {
    while ($row = $categoryResult->fetch_assoc()) {
        $categories[] = $row;
    }
}

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="hero">
            <div>
                <p class="eyebrow">PHP + MySQL Expense Tracker</p>
                <h1>Manage daily expenses with a simple dashboard</h1>
                <p class="hero-text">Add a new expense, view all records, and check your totals by category in one place.</p>
            </div>
            <div class="hero-badge">Ready for XAMPP</div>
        </header>

        <?php if ($status === 'success'): ?>
            <div class="alert success">Expense added successfully.</div>
        <?php elseif ($status === 'error'): ?>
            <div class="alert error">Unable to add expense. Check the form and try again.</div>
        <?php endif; ?>

        <section class="panel form-panel">
            <div class="section-header">
                <h2>Add Expense</h2>
                <p>Fill in the details below.</p>
            </div>

            <form action="add_expense.php" method="POST" class="expense-form">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" step="0.01" min="0.01" placeholder="Enter amount" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Select category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo (int) $category['category_id']; ?>">
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="expense_date">Date</label>
                    <input type="date" id="expense_date" name="expense_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <button type="submit" class="btn-primary">Add Expense</button>
            </form>
        </section>

        <?php include 'view_expense.php'; ?>

        <section class="panel setup-panel">
            <div class="section-header">
                <h2>Database Setup</h2>
                <p>Run the following SQL in phpMyAdmin before using the app.</p>
            </div>

            <pre class="sql-block">CREATE DATABASE expense_tracker;
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
('Other');</pre>
        </section>
    </div>
</body>
</html>
