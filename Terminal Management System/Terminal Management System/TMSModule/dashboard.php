<?php
session_start();

if (!isset($_SESSION['userName'])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['userName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Terminal Management System</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="container">
        <h3>Welcome, <?php echo $userName; ?>!</h3>
        <p>You have successfully logged in.</p>
    </div>
</body>
</html>
