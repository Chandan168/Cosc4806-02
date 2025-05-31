<?php
require_once "database.php";

class User {
    public function get_all_users() {
        global $pdo; // Use the PDO connection from database.php
        $statement = $pdo->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC); // fetch ALL users
        return $rows;
    }
}
?>
