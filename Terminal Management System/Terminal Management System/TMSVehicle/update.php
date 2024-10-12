<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="update.css">
    <title>Edit Vehicle</title> 
</head>
<body>
    <div class="container">
        <h1>Edit Vehicle</h1>

        <?php
        include 'connection.php';
        $row = []; 
        $vehicleId = isset($_GET['id']) ? $_GET['id'] : '';

        // Retrieve the current values from the database
        $query = "SELECT * FROM vehiclelist WHERE vehicleId = ?";
        $params = array($vehicleId);
        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if (isset($_POST['update_data'])) {
            // If the form is submitted, update the data
            $vehicleType = $_POST['vehicleType'];
            $plateNumber = $_POST['plateNumber'];
            $vehicleColor =  $_POST['vehicleColor'];
            $vehiclecapacity = $_POST['vehiclecapacity'];
            $vehicleDestination = $_POST['vehicleDestination'];
            $driverName = $_POST['driverName'];
            $driverlastname = $_POST['driverlastname']; // Corrected variable name

            $query = "UPDATE vehiclelist SET 
                        vehicleType = ?,
                        plateNumber = ?,
                        vehicleColor = ?,
                        vehiclecapacity = ?,
                        vehicleDestination = ?,
                        driverName = ?,
                        driverlastname = ?  -- Corrected variable name
                    WHERE vehicleId = ?";
            $params = array($vehicleType, $plateNumber, $vehicleColor, $vehiclecapacity, $vehicleDestination, $driverName, $driverlastname, $vehicleId);

            $stmt = sqlsrv_query($conn, $query, $params);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            header('Location:vehiclelist.php');
        }
        // Display the form with pre-filled values
        ?>

        <form method="post" action="update.php?id=<?php echo $vehicleId; ?>">
            <input type="hidden" name="vehicleId" value="<?php echo $row['vehicleId']; ?>">

            <label for="vehicleType">Vehicle Type:</label>
            <input type="text" id="vehicleType" name="vehicleType" value="<?php echo $row['vehicleType']; ?>" required>

            <label for="plateNumber">Plate Number:</label>
            <input type="text" id="plateNumber" name="plateNumber" value="<?php echo $row['plateNumber']; ?>" required>

            <label for="vehicleColor">Vehicle Color:</label>
            <input type="text" id="vehicleColor" name="vehicleColor" value="<?php echo $row['vehicleColor']; ?>" required>

            <label for="vehiclecapacity">Vehicle Capacity:</label>
            <input type="text" id="vehiclecapacity" name="vehiclecapacity" value="<?php echo $row['vehiclecapacity']; ?>" required>

            <label for="vehicleDestination">Vehicle Destination:</label>
            <input type="text" id="vehicleDestination" name="vehicleDestination" value="<?php echo $row['vehicleDestination']; ?>" required>

            <label for="driverName">Driver Name:</label>
            <input type="text" id="driverName" name="driverName" value="<?php echo $row['driverName']; ?>" required>

            <label for="driverlastname">Driver Last Name:</label> <!-- Added input for driverLastName -->
            <input type="text" id="driverlastname" name="driverlastname" value="<?php echo $row['driverlastname']; ?>" required>

            <input type="submit" name="update_data" value="Update Vehicle">
            <a href="vehiclelist.php">Cancel</a>

        </form>
    </div>
</body>
</html>
