<?php
require_once("config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    // Create a database connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize inputs to prevent SQL injection
    $username = $conn->real_escape_string($username);
    $new_password = $conn->real_escape_string($new_password);

    // Hash the new password for security
    

    // Update the password for the user
	$sql = "UPDATE users SET password = '$new_password' WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to login.php after successful update
        header("Location:short/login.php");
        exit();
    } else {
        $error_message = "Failed to update password: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>

        <?php
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        ?>

        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="username">Enter your username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="new_password">Enter your new password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
