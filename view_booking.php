<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$booking_id = $_GET['id'];
$sql = "SELECT bookings.*, vehicles.name AS vehicle_name, vehicles.type AS vehicle_type
        FROM bookings
        JOIN vehicles ON bookings.vehicle_id = vehicles.id
        WHERE bookings.id = $booking_id";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Transport Management System</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Reset and General Styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f2f2f2;
    padding: 20px;
}

/* Header */
header {
    background-color: #34495e;
    color: #fff;
    padding: 1rem 0;
    text-align: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

header h1 {
    margin: 0;
    font-size: 1.8rem;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

nav ul {
    list-style-type: none;
    display: flex;
}

nav ul li {
    margin-right: 1rem;
}

nav ul li a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    padding: 0.5rem 1rem;
    transition: background-color 0.3s;
}

nav ul li a:hover {
    background-color: #2c3e50;
    border-radius: 5px;
}

.logout-btn {
    background-color: #e74c3c;
}

.logout-btn:hover {
    background-color: #c0392b;
}

/* Form Container */
.form-container {
    max-width: 600px;
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    margin: 2rem auto;
}

.form-container h2 {
    margin-bottom: 2rem;
    font-size: 1.5rem;
    color: #333;
    text-align: center;
}

.form-container p {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.form-container strong {
    font-weight: bold;
}


        </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Transport Management System</h1>
            </div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="book_vehicle.php">Book Vehicle</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>Booking Details</h2>
        <p><strong>Vehicle:</strong> <?php echo $booking['vehicle_name'] . " (" . $booking['vehicle_type'] . ")"; ?></p>
        <p><strong>Date:</strong> <?php echo $booking['date']; ?></p>
        <p><strong>Start Location:</strong> <?php echo $booking['start_location']; ?></p>
        <p><strong>End Location:</strong> <?php echo $booking['end_location']; ?></p>
        <p><strong>Distance (km):</strong> <?php echo $booking['distance_km']; ?></p>
        <p><strong>Total Cost:</strong> ₹<?php echo $booking['total_cost']; ?></p>
    </div>
</body>
</html>
