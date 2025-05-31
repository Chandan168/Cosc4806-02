<?php
require_once "user.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user = new User();
  if ($user->verify_user($username, $password)) {
    echo "Login successful!";
  } else {
    echo "Invalid username or password.";
  }
}
?>

<form method="post">
  Username: <input name="username" required><br>
  Password: <input name="password" type="password" required><br>
  <button type="submit">Login</button>
</form>
