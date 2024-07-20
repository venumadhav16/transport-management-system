<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_id = $_POST['vehicle_id'];
    $date = $_POST['date'];
    $start_location = $_POST['start_location'];
    $end_location = $_POST['end_location'];
    $distance_km = $_POST['distance_km'];

    $sql = "SELECT rate_per_km FROM vehicles WHERE id = $vehicle_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $rate_per_km = $row['rate_per_km'];

    $total_cost = $rate_per_km * $distance_km;
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO bookings (user_id, vehicle_id, date, start_location, end_location, distance_km, total_cost)
            VALUES ('$user_id', '$vehicle_id', '$date', '$start_location', '$end_location', '$distance_km', '$total_cost')";

    if ($conn->query($sql) === TRUE) {
        header('Location: view_booking.php?id=' . $conn->insert_id);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Vehicle - Transport Management System</title>
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

.form-container form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-container label {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
    text-align: left;
    width: 100%;
    color: #333;
}

.form-container input[type="text"],
.form-container input[type="date"],
.form-container input[type="number"],
.form-container select {
    padding: 0.8rem;
    font-size: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: calc(100% - 1.6rem);
}

.form-container button {
    background-color: #f39c12;
    color: #fff;
    border: none;
    padding: 0.8rem;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
    width: 100%;
    max-width: 100%;
}

.form-container button:hover {
    background-color: #e67e22;
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
        <h2>Book Your Vehicle</h2>
        <form action="book_vehicle.php" method="POST">
            <label for="vehicle_id">Vehicle Type:</label>
            <select id="vehicle_id" name="vehicle_id" required>
                <?php
                $sql = "SELECT id, name, type FROM vehicles";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']} ({$row['type']})</option>";
                }
                ?>
            </select>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="start_location">Start Location:</label>
            <input type="text" id="start_location" name="start_location" required>
            
            <label for="end_location">End Location:</label>
            <input type="text" id="end_location" name="end_location" required>
            
            <label for="distance_km">Distance (km):</label>
            <input type="number" id="distance_km" name="distance_km" step="0.1" required>

            <button type="submit">Book Vehicle</button>
        </form>
    </div>
</body>
</html>
