<?php
include 'connection.php';

// Check if ID is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get ID from the URL
    $vehicleId = $_GET['id'];

    // Delete record from the database
    $query = "DELETE FROM vehiclelist WHERE vehicleId = ?";
    $params = array($vehicleId);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_close($conn);

    // Redirect to vehiclelist.php after successful deletion
    header("Location: vehiclelist.php");
    exit();
} else {
    // If ID is not valid, redirect to vehiclelist.php
    header("Location: vehiclelist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Vehicle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }

        h2 {
            color: #4CAF50;
        }

        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h2>Vehicle Deleted Successfully</h2>
    <p>The vehicle that you selected has been deleted.</p>
    <a href="vehiclelist.php">Back to Vehicle List</a>

</body>
</html>
