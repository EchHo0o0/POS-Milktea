

<?php
require_once("config.php"); // Ensure this points to the correct database configuration file

if (isset($_POST['submit'])) {
    $username = $_POST['username']; // Fetch the username input
    $code = $_POST['code'];         // Fetch the code input

    // Create a DB connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, 'cscs_db');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize inputs to prevent SQL injection
    $username = $conn->real_escape_string($username);
    $code = $conn->real_escape_string($code);

    // Check if the username and code match a record in the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND code = '$code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username and code match, log the user in (store in session)
        $user = $result->fetch_assoc(); // Fetch user data
        session_start(); // Start session
        $_SESSION['user_id'] = $user['id']; // Store the user ID in session
        $_SESSION['username'] = $username; // Store the username in session

        // Redirect to admin panel
        header("Location: security.php"); // Redirect to admin panel
        exit(); // Exit the script to prevent further execution
    } else {
        // Username or code not found
        $error_message = "Invalid username or code.";
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
    <title>Login with Username and Code</title>
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

        input[type="text"] {
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

        .back-btn {
            background-color: #f44336;
            width: 100%;
            margin-top: 10px;
        }

        .back-btn:hover {
            background-color: #e53935;
        }

        p {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login with Username and Code</h2>

        <?php
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        ?>

        <form action="forgot.php" method="POST">
            <div class="form-group">
                <label for="username">Enter your username:</label><br>
                <input type="text" name="username" id="username" required><br><br>
            </div>
            <div class="form-group">
                <label for="code">Enter your code:</label><br>
                <input type="text" name="code" id="code" required><br><br>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>

        <form action="admin/login.php">
            <button type="submit" class="back-btn">Back to Login</button>
        </form>
    </div>
</body>
</html>
