<?php
require_once 'backend/DAO/config.php';

try {
    // Attempt to connect to the database
    $db = Database::connect();
    echo "Successfully connected to the database!";
} catch (PDOException $e) {
    // Display error message if connection fails
    echo "Failed to connect to the database: " . $e->getMessage();
}
?>