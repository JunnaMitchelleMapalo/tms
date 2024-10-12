<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $userPass = $_POST['userPass'];
    $userLastname = $_POST['userLastname'];
    $userFirstname = $_POST['userFirstname'];
    $userAddress = $_POST['userAddress'];
    $userPhoneNumber = $_POST['userPhoneNumber'];

    $hashedPassword = password_hash($userPass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usertbl (userName, userPass, userLastname, userFirstName, userAddress, userPhoneNumber) VALUES (?, ?, ?, ?, ?, ?)";
    $params = array($userName, $hashedPassword, $userLastname, $userFirstname, $userAddress, $userPhoneNumber);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    session_start();
    $_SESSION['userName'] = $userName;
    header("Location: dashboard.php");
    exit();
}

sqlsrv_close($conn);
?>
