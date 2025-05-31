<?php
function db_connect() {
    $db_host = "dpblo.h.filess.io";        
    $db_port = "61000";                
    $db_name = "Cosc4806_modelbirth";      
    $db_user = "Cosc4806_modelbirth";
    $db_pass = getenv('DB_PASS'); 
    try {
        $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4";
        $pdo = new PDO($dsn, $db_user, $db_pass);
        // Set error mode to exception to catch errors
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
        exit;
    }
}
?>
