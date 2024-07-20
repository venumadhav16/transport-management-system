<?php
include('db_connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header('Location: index.php');
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with this username";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Transport Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Header styling */
        header {
            text-align: center;
            background-color: #34495e;
            color: #fff;
            padding: 1rem 0;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        /* Form styling */
        .form-container {
            max-width: 400px;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 2rem;

            font-size: 1.5rem;
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
        }

        .form-container form input[type="text"],
        .form-container form input[type="password"] {
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
            width: 100%; /* Adjusted width to be 100% */
            max-width: 100%;
            display: inline-block; /* Ensures the button has the width applied */
        }

        .form-container form button:hover {
            background-color: #e67e22;
        }

        .signup-btn {
            background-color: transparent;
            color: #333;
            border: none;
            font-size: 1rem;
            margin-top: 1rem;
            cursor: pointer;
            text-decoration: underline;
            text-align: center;
            width: 100%; /* Adjusted width to be 100% */
            max-width: 100%;
            display: inline-block; /* Ensures the button has the width applied */
        }

        .signup-btn-container {
            text-align: center;
            padding-top: 1rem;
        }

        .signup-btn-container a {
            background-color: #f39c12;
            color: #fff;
            border: none;
            padding: 0.8rem;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            width: 100%; /* Adjusted width to be 100% */
            max-width: 100%;
            display: inline-block; /* Ensures the button has the width applied */
        }

        .signup-btn-container a:hover {
            background-color: #e67e22;
        }
        
    </style>
    <script>
        function validateLogin() {
            const username = document.forms["loginForm"]["username"].value;
            const password = document.forms["loginForm"]["password"].value;

            if (username == "" || password == "") {
                alert("Both username and password must be filled out");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Transport Management System</h1>
        </div>
    </header>

    <div class="form-container">
        <h2>Login</h2>
        <form name="loginForm" action="login.php" method="POST" onsubmit="return validateLogin()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <div class="signup-btn-container">
            <a href="signup.php" class="signup-btn">Sign Up</a>
        </div>
    </div>
</body>
</html>
