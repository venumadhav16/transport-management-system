<?php
session_start();

// Initialize variables for storing form input
$pickDate = $pickTime = $destination = $amount = $paymentMethod = "";
$errorMessage = "";

// Retrieve the price from the session
if (isset($_SESSION['price'])) {
    $amount = htmlspecialchars($_SESSION['price']);
    unset($_SESSION['price']); // Clear the session variable after retrieving
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pickDate = trim($_POST['pickDate']);
    $pickTime = trim($_POST['pickTime']);
    $destination = trim($_POST['destination']);
    $amount = trim($_POST['amount']);
    $paymentMethod = trim($_POST['paymentMethod']);

    // Basic server-side validation
    if (empty($pickDate) || empty($pickTime) || empty($destination) || empty($amount) || empty($paymentMethod)) {
        $errorMessage = 'All fields are required.';
    } elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $amount)) {
        $errorMessage = 'Invalid amount. Please enter a valid number.';
    } else {
        // Save the data or process it as needed
        // For this example, we'll just reset the variables to simulate a successful submission
        $pickDate = $pickTime = $destination = $amount = $paymentMethod = "";
        $errorMessage = "Booking details submitted successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fffacd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #ffcc00;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ffcc00;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #e6b800;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Booking Form</h1>
        <?php if ($errorMessage): ?>
            <div class="<?= strpos($errorMessage, 'successfully') !== false ? 'success' : 'error' ?>"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>
        <form id="bookingForm" action="" method="post">
            <div class="form-group">
                <label for="pickDate">Pick-up Date:</label>
                <input type="date" id="pickDate" name="pickDate" value="<?= htmlspecialchars($pickDate) ?>" required>
                <small class="error" id="pickDateError"></small>
            </div>
            <div class="form-group">
                <label for="pickTime">Pick-up Time:</label>
                <input type="time" id="pickTime" name="pickTime" value="<?= htmlspecialchars($pickTime) ?>" required>
                <small class="error" id="pickTimeError"></small>
            </div>
            <div class="form-group">
                <label for="destination">Destination Address:</label>
                <input type="text" id="destination" name="destination" value="<?= htmlspecialchars($destination) ?>" required>
                <small class="error" id="destinationError"></small>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($amount) ?>" required>
                <small class="error" id="amountError"></small>
            </div>
            <div class="form-group">
                <label for="paymentMethod">Payment Method:</label>
                <select id="paymentMethod" name="paymentMethod" required>
                    <option value="">Select a payment method</option>
                    <option value="PhonePe" <?= $paymentMethod === 'PhonePe' ? 'selected' : '' ?>>PhonePe</option>
                    <option value="HandCash" <?= $paymentMethod === 'HandCash' ? 'selected' : '' ?>>HandCash</option>
                    <option value="GooglePay" <?= $paymentMethod === 'GooglePay' ? 'selected' : '' ?>>GooglePay</option>
                    <option value="PayTM" <?= $paymentMethod === 'PayTM' ? 'selected' : '' ?>>PayTM</option>
                </select>
                <small class="error" id="paymentMethodError"></small>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
