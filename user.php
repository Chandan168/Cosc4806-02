<?php
require_once('database.php');

class User {

    // Fetch all users (for testing or admin use)
    public function get_all_users() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    // Create a new user with hashed password
    public function create_user($username, $password) {
        $db = db_connect();

        // Hash the password securely before saving
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashed_password);

        return $statement->execute();
    }

    // Verify user credentials at login
    public function verify_user($username, $password) {
        $db = db_connect();
        $statement = $db->prepare("SELECT password FROM users WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;  // Valid credentials
        } else {
            return false; // Invalid username or password
        }
    }
}
?>







