<?php
session_start();
require_once 'config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validate required fields
    if (empty($name) || empty($email)) {
        $_SESSION['error_message'] = "Please fill in all required fields (Name and Email).";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Please enter a valid email address.";
    } else {
        try {
            $sql = "INSERT INTO contacts (name, email, message, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $email, $message]);
            $_SESSION['success_message'] = "Data inserted successfully!";
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error inserting data: " . $e->getMessage();
        }
    }
    
    // Redirect to prevent form resubmission on reload
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Get messages from session and clear them
$success_message = $_SESSION['success_message'] ?? null;
$error_message = $_SESSION['error_message'] ?? null;
unset($_SESSION['success_message'], $_SESSION['error_message']);

// Fetch data from database
try {
    $sql = "SELECT id, name, email, message, created_at FROM contacts ORDER BY created_at DESC";
    $stmt = $conn->query($sql);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Error fetching data: " . $e->getMessage();
    $records = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Database Management System</h1>
            <p>View and manage your database records</p>
        </header>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <section class="form-section">
            <h2>Add New Record</h2>
            <form method="POST" action="index.php" class="data-form">
                <div class="form-group">
                    <label for="name">Name <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required placeholder="Enter your name">
                </div>
                
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">
                </div>
                
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" placeholder="Enter your message"></textarea>
                </div>
                
                <button type="submit" name="submit" class="btn-submit">Submit</button>
            </form>
        </section>

        <section class="data-section">
            <h2>Database Records</h2>
            <?php if (empty($records)): ?>
                <div class="no-data">
                    <p>No records found in the database.</p>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $record): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($record['id']); ?></td>
                                    <td><?php echo htmlspecialchars($record['name']); ?></td>
                                    <td><?php echo htmlspecialchars($record['email']); ?></td>
                                    <td><?php echo htmlspecialchars($record['message'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($record['created_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>

