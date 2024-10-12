<?php
session_start();

if (isset($_SESSION['userName'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'connection.php';

    $userName = $_POST['userName'];
    $userPass = $_POST['userPass'];

    $hashedPassword = password_hash($userPass, PASSWORD_DEFAULT);

   
    $sql = "SELECT userPass FROM usertbl WHERE userName = ?";
    $params = array($userName);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($row) {
            
            if (password_verify($userPass, $row['userPass'])) {
                $_SESSION['userName'] = $userName;
                header("Location: ../TMSVehicle/vehiclelist.php");
                exit();
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Error: " . sqlsrv_errors()[0]['message'];
    }
}

sqlsrv_close($conn);
?>
