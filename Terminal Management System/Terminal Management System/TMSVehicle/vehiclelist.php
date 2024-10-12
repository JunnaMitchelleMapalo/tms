<!DOCTYPE html>
<html>
<head>
    <title>Vehicle List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        form {
            margin-bottom: 20px; 
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px; 
        }

        input[type="text"] {
            width: 300px; 
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px; 
            display: inline-block;

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 16px; 
            display: inline-block; 
            vertical-align: top; 
        }

        .instructions {
            font-style: italic;
            color: #555;
        }

        .heading {
            text-align: center; 
            font-size: 24px; 
            margin-bottom: 10px;
        }
    </style>
</head>
<body>


<div class="heading">
    TERMINAL MANAGEMENT SYSTEM
</div>


<form id="searchForm" action="vehiclelist.php" method="GET">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" placeholder="Enter keyword...">
    <input type="submit" value="Search">
</form>


<div class="instructions" id="searchInstructions">
    <?php
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        echo "<p>Click the search button again to go back or refresh the content.</p>";
    } else {
        echo "<p>Enter a keyword to search for a specific vehicle. You can search by Vehicle Id, Vehicle Type, Plate Number, Vehicle Color, Vehicle Capacity, Vehicle Destination, or Driver Name.</p>";
    }
    ?>
</div>

<?php
include 'connection.php';


if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $query = "SELECT * FROM vehiclelist WHERE 
               vehicleId LIKE '%$searchTerm%' OR
               vehicleType LIKE '%$searchTerm%' OR
               plateNumber LIKE '%$searchTerm%' OR
               vehicleColor LIKE '%$searchTerm%' OR
               vehiclecapacity LIKE '%$searchTerm%' OR
               vehicleDestination LIKE '%$searchTerm%' OR
               driverName LIKE '%$searchTerm%' OR
               driverlastname LIKE '%$searchTerm%'"; 
} else {
    $query = "SELECT * FROM vehiclelist";
}

$result = sqlsrv_query($conn, $query);

echo "<table>";
echo "<tr>
        <th>Vehicle Id</th>
        <th>Vehicle Type</th>
        <th>Plate Number</th>
        <th>Vehicle Color</th>
        <th>Vehicle Capacity</th>
        <th>Vehicle Destination</th>
        <th>Driver Name</th>
        <th>Driver Last Name</th> 
        <th><a href='addvehicle.html'>Add new Vehicle</a></th>
    </tr>";

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['vehicleId'] . "</td>";
    echo "<td>" . $row['vehicleType'] . "</td>";
    echo "<td>" . $row['plateNumber'] . "</td>";
    echo "<td>" . $row['vehicleColor'] . "</td>";
    echo "<td>" . $row['vehiclecapacity'] . "</td>";
    echo "<td>" . $row['vehicleDestination'] . "</td>";
    echo "<td>" . $row['driverName'] . "</td>";
    echo "<td>" . $row['driverlastname'] . "</td>"; 
    echo "<td><a href='update.php?id=" . $row['vehicleId'] . "'>Update</a> | 
    <a href='delete.php?id=" . $row['vehicleId'] . "'>Delete</a></td>";

    echo "</tr>";
}

echo "</table>";

sqlsrv_close($conn);
?>
<script>
    document.getElementById('searchForm').addEventListener('submit', function() {
        document.getElementById('searchInstructions').innerHTML = "<p>Click the search button again to go back or refresh the content.</p>";
    });
</script>
</body>
</html>
