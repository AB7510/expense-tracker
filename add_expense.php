<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$categoryId = isset($_POST['category_id']) ? (int) $_POST['category_id'] : 0;
$expenseDate = isset($_POST['expense_date']) ? trim($_POST['expense_date']) : '';

if ($amount === '' || !is_numeric($amount) || (float) $amount <= 0 || $categoryId <= 0 || $expenseDate === '') {
    header('Location: index.php?status=error');
    exit;
}

$stmt = $conn->prepare('INSERT INTO expenses (category_id, amount, expense_date) VALUES (?, ?, ?)');
$numericAmount = (float) $amount;
$stmt->bind_param('ids', $categoryId, $numericAmount, $expenseDate);

if ($stmt->execute()) {
    header('Location: index.php?status=success');
    exit;
}

header('Location: index.php?status=error');
exit;
?>
