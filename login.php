<?php
require_once('user.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $user = new User();
    $isValid = $user->verify_user($username, $password);

    if ($isValid) {
        echo "Login successful! Welcome, " . htmlspecialchars($username);
        // You can start a session here or redirect
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!-- Simple HTML form -->
<form method="POST" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
