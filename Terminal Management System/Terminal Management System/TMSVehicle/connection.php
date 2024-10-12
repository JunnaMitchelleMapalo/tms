<?php
$serverName = "LAPTOP-NC9PD81V";
$connectionOptions = array(
    "Database" => "tms",
    
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Connection failed: " . sqlsrv_errors());
}
?>
