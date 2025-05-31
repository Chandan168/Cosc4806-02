<?php
require_once "database.php";

class User {
  public function get_all_users() {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM users;");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create_user($username, $password) {
    $db = db_connect();
    $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $statement->execute([
      ':username' => $username,
      ':password' => $password 
    ]);
    return true;
  }

  public function user_exists($username) {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
    $statement->execute([':username' => $username]);
    return $statement->fetch(PDO::FETCH_ASSOC) !== false;
  }

  public function verify_user($username, $password) {
    $db = db_connect();
    $statement = $db->prepare("SELECT password FROM users WHERE username = :username");
    $statement->execute([':username' => $username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user && password_verify($password, $user['password']);
  }
}
?>




