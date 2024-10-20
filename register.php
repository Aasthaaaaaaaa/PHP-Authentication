<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<br>
<form action="register.php" method="post" name="form1">
    <table width="35%">
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="register" value="Register"></td>
        </tr>
    </table>
</form>
<a href="login.php">Login</a>

<?php
include_once("db_config.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists using a prepared statement
    $stmt = $mysqli->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_matched = $result->num_rows;

    if ($user_matched > 0) {
        echo "<br><br><strong>Error:</strong> User already exists with email id '$email'";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new user using a prepared statement
        $stmt = $mysqli->prepare("INSERT INTO user(name, email, password) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            echo "<br><br>User registered successfully.";
        } else {
            echo "Registration error: " . $stmt->error;
        }
    }

    $stmt->close(); // Close the prepared statement
}
?>
</body>
</html>
