<?php
require_once('user.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new User();

    if ($user->user_exists($username)) {
        $message = "Username already exists!";
    } else {
        $result = $user->create_user($username, $password);
        $message = $result ? "Account created successfully!" : "Error creating account.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>

    <p><?php echo $message; ?></p>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>

