<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleType = $_POST['vehicleType'];
    $plateNumber = $_POST['plateNumber'];
    $vehicleColor = $_POST['vehicleColor'];
    $vehiclecapacity = $_POST['vehiclecapacity'];
    $vehicleDestination = $_POST['vehicleDestination'];
    $driverName = $_POST['driverName'];
    $driverlastname = $_POST['driverlastname']; 

    
    $checkQuery = "SELECT * FROM vehiclelist WHERE plateNumber = ?";
    $checkParams = array($plateNumber);
    $checkResult = sqlsrv_query($conn, $checkQuery, $checkParams);

    if (sqlsrv_has_rows($checkResult)) {
        echo '<div style="text-align: center; padding: 20px; background-color: #ffcccc; border: 1px solid #cc0000; color: #cc0000;">';
        echo 'Error: Plate number already registered. Please choose a different plate number.';
        echo '<br><br>';
        echo '<button onclick="goBack()" style="padding: 10px; background-color: #cc0000; color: white; border: none; cursor: pointer;">Go Back</button>';
        echo '</div>';
    } else {
        $insertQuery = "INSERT INTO vehiclelist (vehicleType, plateNumber, vehicleColor, vehiclecapacity, vehicleDestination, driverName, driverLastName)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertParams = array($vehicleType, $plateNumber, $vehicleColor, $vehiclecapacity, $vehicleDestination, $driverName, $driverLastName);

        $insertResult = sqlsrv_query($conn, $insertQuery, $insertParams);

        if ($insertResult) {
            echo '<div style="text-align: center; padding: 20px; background-color: #ccffcc; border: 1px solid #00cc00; color: #00cc00;">';
            echo 'Vehicle added successfully!';
            echo '</div>';
            header("Location: vehiclelist.php");
        } else {
            echo '<div style="text-align: center; padding: 20px; background-color: #ffcccc; border: 1px solid #cc0000; color: #cc0000;">';
            echo 'Error adding vehicle: ' . print_r(sqlsrv_errors(), true);
            echo '<br><br>';
            echo '<button onclick="goBack()" style="padding: 10px; background-color: #cc0000; color: white; border: none; cursor: pointer;">Go Back</button>';
            echo '</div>';
        }
    }

    sqlsrv_close($conn);
}
?>

<script>
    function goBack() {
        window.history.back();
    }
</script>