
<?php
session_start();
require_once("config.php");

if(isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Create a DB connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, 'cscs_db');

    // Check the connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize email
    $email = $conn->real_escape_string($email);

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, proceed to login
        $_SESSION['email'] = $email;
        header("Location: login.php"); // Redirect to login page or dashboard
        exit();
    } else {
        // No user found
        $error_message = "Email address not found.";
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
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    
    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form action="forgot.php" method="POST">
        <label for="email">Enter your email address:</label><br>
        <input type="email" name="email" id="email" required><br><br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
