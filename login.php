<?php
session_start();
include_once("db_config.php"); // Ensure this path is correct

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if $mysqli is defined and connected
    if ($mysqli) {
        // Prepare the SQL statement (assuming passwords are stored as hashed values)
        $stmt = $mysqli->prepare("SELECT email, password FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Verify the password using password_verify (assuming password was hashed during registration)
            if (password_verify($password, $row['password'])) {
                $_SESSION["email"] = $email;
                header("Location: page-1.php");
                exit(); // Stop further script execution
            } else {
                echo "Incorrect email or password. <br><br>"; 
            }
        } else {
            echo "No user found with the provided email. <br><br>";
        }

        $stmt->close(); // Close the prepared statement
    } else {
        echo "Database connection failed.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post" name="form1">
        <table width="25%">
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
                <td><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
    </form>
    <a href="register.php">Register</a>
</body>
</html>
