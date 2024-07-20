<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $aadhaar = $_POST['aadhaar'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (username, password, email, phone, aadhaar, gender) VALUES ('$username', '$password', '$email', '$phone', '$aadhaar', '$gender')";

    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
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
    <title>Signup - Transport Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General styling */
/* General styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically */
    height: 100vh;
}

/* Header styling */
header {
    text-align: center;
    background-color: #34495e;
    color: #fff;
    padding: 1rem 0;
    width: 100%;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    position: absolute;
    top: 0;
    left: 0;
}

header h1 {
    margin: 0;
    font-size: 1.8rem;
}

/* Form container styling */
.form-container {
    max-width: 400px;
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin: auto; /* Center the container horizontally */
    margin-top: 4rem; /* Adjust vertical spacing from the header */
}

.form-container h2 {
    margin-bottom: 2rem;
    font-size: 1.5rem;
    color: #333;
}

.form-container form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-container form label {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
    text-align: left;
    width: 100%;
    color: #333;
}

.form-container form input[type="text"],
.form-container form input[type="password"],
.form-container form input[type="email"],
.form-container form select {
    padding: 0.8rem;
    font-size: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: calc(100% - 1.6rem);
}

.form-container form button {
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

.form-container form button:hover {
    background-color: #e67e22;
}

        </style>
    <script>
        function validateSignup() {
            const username = document.forms["signupForm"]["username"].value;
            const password = document.forms["signupForm"]["password"].value;
            const email = document.forms["signupForm"]["email"].value;
            const phone = document.forms["signupForm"]["phone"].value;
            const aadhaar = document.forms["signupForm"]["aadhaar"].value;
            const gender = document.forms["signupForm"]["gender"].value;

            if (username == "" || password == "" || email == "" || phone == "" || aadhaar == "" || gender == "") {
                alert("All fields must be filled out");
                return false;
            }

            if (aadhaar.length != 12 || isNaN(aadhaar)) {
                alert("Aadhaar must be a 12-digit number");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Transport Management System</h1>
            </div>
        </nav>
    </header>

    <div class="form-container">
        <h2>Signup</h2>
        <form name="signupForm" action="signup.php" method="POST" onsubmit="return validateSignup()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
            
            <label for="aadhaar">Aadhaar:</label>
            <input type="text" id="aadhaar" name="aadhaar" required>
            
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <button type="submit">Signup</button>
        </form>
    </div>
</body>
</html>
