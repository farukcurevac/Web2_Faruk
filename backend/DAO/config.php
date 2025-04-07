<?php
class Config {
    public static function DB_NAME() {
        return "faruk_travel";
    }

    public static function DB_PORT() {
        return 3306;
    }

    public static function DB_USER() {
        return "root";
    }

    public static function DB_PASSWORD() {
        return "11235813";
    }

    public static function DB_HOST() {
        return "127.0.0.1";
    }
}

class Database {
    private static $connection = null;

    public static function connect() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . Config::DB_HOST() . ";port=" . Config::DB_PORT() . ";dbname=" . Config::DB_NAME() . ";charset=utf8mb4",
                    Config::DB_USER(),
                    Config::DB_PASSWORD(),
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                // Log the error instead of displaying it directly
                error_log("Database connection failed: " . $e->getMessage());
                die("Database connection failed. Please try again later.");
            }
        }
        return self::$connection;
    }

    public static function disconnect() {
        self::$connection = null;
    }
}
?>