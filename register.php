<?php
require_once "user.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Password strength check
  if (strlen($password) < 8) {
    die("Password must be at least 8 characters.");
  }

  $user = new User();

  if ($user->user_exists($username)) {
    die("Username already taken.");
  }

  $hashed = password_hash($password, PASSWORD_DEFAULT);
  $user->create_user($username, $hashed);
  echo "Account created successfully.";
}
?>

<form method="post">
  Username: <input name="username" required><br>
  Password: <input name="password" type="password" required><br>
  <button type="submit">Register</button>
</form>
