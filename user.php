<?php
require_once('database.php');

class User {
    public function get_all_users() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function create_user($username, $password) {
        $db = db_connect();
        // Check if user exists
        $check = $db->prepare("SELECT * FROM users WHERE username = ?");
        $check->execute([$username]);
        if ($check->fetch()) return false; // user exists

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $statement->execute([$username, $hashed_password]);
    }

    public function verify_user($username, $password) {
        $db = db_connect();
        $statement = $db->prepare("SELECT password FROM users WHERE username = ?");
        $statement->execute([$username]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            return true;
        }
        return false;
    }
}
?>





