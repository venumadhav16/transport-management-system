<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "transport_management";

$conn = new mysqli($servername, $username, $password, $dbname,4306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
