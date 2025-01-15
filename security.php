<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cscs_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission (Add new record)
if (isset($_POST['add'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    // Insert user into database
    $sql = "INSERT INTO secure (username, password, role) VALUES ('$user', '$pass', '$role')";

    if ($conn->query($sql) === TRUE) {
        $message = "Record added successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle update request
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    $sql = "UPDATE secure SET username='$user', password='$pass', role='$role' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Record updated successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM secure WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Record deleted successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve all records
$sql = "SELECT id, username, password, role FROM secure";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milk Tea Theme - Manage Credentials</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #f9e5d9, #f3d6c8);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #5e3c23;
        }

        form {
            margin-bottom: 20px;
        }

        input, button {
            font-family: 'Poppins', sans-serif;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #d1c3b2;
            border-radius: 8px;
            width: calc(100% - 22px);
        }

        button {
            background: #d1a78f;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #a97a63;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #d1c3b2;
            padding: 8px;
            text-align: center;
        }

        table th {
            background: #f3d6c8;
        }

        .actions button, .actions a {
            background: #d1a78f;
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions button:hover, .actions a:hover {
            background: #a97a63;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Milk Tea Security for Admin</h1>
        <p>Don't forget your codes! 🌟</p>

        <!-- Registration Form -->
        <form action="security.php" method="POST">
            <input type="hidden" name="id" id="id">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="text" id="role" name="role" placeholder="Role" required>

            <button type="submit" name="add">Add</button>
            <button type="submit" name="update">Update</button>
            <button type="button" onclick="window.location.href='admin/login.php';">Back</button>
        </form>

        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

        <h2>Saved Credentials</h2>
        <!-- Display Records -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td class='actions'>
                            <button onclick=\"editRecord(" . $row['id'] . ", '" . $row['username'] . "', '" . $row['password'] . "', '" . $row['role'] . "')\">Edit</button>
                            <a href='security.php?delete=" . $row['id'] . "' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No credentials found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editRecord(id, username, password, role) {
            document.getElementById('id').value = id;
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            document.getElementById('role').value = role;
        }
    </script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
