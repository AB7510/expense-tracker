<?php
$expenseRows = [];
$categoryTotals = [];
$totalExpense = 0;

$expenseQuery = "
    SELECT e.expense_id, e.amount, e.expense_date, c.category_name
    FROM expenses e
    INNER JOIN categories c ON e.category_id = c.category_id
    ORDER BY e.expense_date DESC, e.expense_id DESC
";
$expenseResult = $conn->query($expenseQuery);

if ($expenseResult && $expenseResult->num_rows > 0) {
    while ($row = $expenseResult->fetch_assoc()) {
        $expenseRows[] = $row;
    }
}

$categoryTotalQuery = "
    SELECT c.category_name, COALESCE(SUM(e.amount), 0) AS total_amount
    FROM categories c
    LEFT JOIN expenses e ON c.category_id = e.category_id
    GROUP BY c.category_id, c.category_name
    ORDER BY c.category_name ASC
";
$categoryTotalResult = $conn->query($categoryTotalQuery);

if ($categoryTotalResult && $categoryTotalResult->num_rows > 0) {
    while ($row = $categoryTotalResult->fetch_assoc()) {
        $categoryTotals[] = $row;
    }
}

$overallTotalQuery = "SELECT COALESCE(SUM(amount), 0) AS total_expense FROM expenses";
$overallTotalResult = $conn->query($overallTotalQuery);

if ($overallTotalResult && $overallTotalResult->num_rows === 1) {
    $totalExpense = (float) $overallTotalResult->fetch_assoc()['total_expense'];
}
?>

<section class="panel">
    <div class="section-header">
        <h2>All Expenses</h2>
        <p>Track every entry in one place.</p>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($expenseRows)): ?>
                    <?php foreach ($expenseRows as $expense): ?>
                        <tr>
                            <td><?php echo (int) $expense['expense_id']; ?></td>
                            <td><?php echo htmlspecialchars($expense['category_name']); ?></td>
                            <td>Rs. <?php echo number_format((float) $expense['amount'], 2); ?></td>
                            <td><?php echo htmlspecialchars($expense['expense_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty-state">No expenses added yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="summary-grid">
    <div class="panel">
        <div class="section-header">
            <h2>Category-wise Total</h2>
            <p>Quick breakdown by spending type.</p>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categoryTotals as $total): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($total['category_name']); ?></td>
                            <td>Rs. <?php echo number_format((float) $total['total_amount'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel total-card">
        <div class="section-header">
            <h2>Total Expense</h2>
            <p>Overall money spent so far.</p>
        </div>

        <div class="total-amount">Rs. <?php echo number_format($totalExpense, 2); ?></div>
    </div>
</section>
