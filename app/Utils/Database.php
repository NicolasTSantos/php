<?php

namespace Utils;

use PDO;
use PDOException;
use Utils\Config;

class Database {
    private static ?PDO $db = null;

    function __construct() {
        
    }

    public static function connectDb(): PDO {
        if (self::$db === null) {
            try {
                $config = Config::$config;
                self::$db = new PDO(
                    "mysql:host={$config['db_host']};dbname={$config['db_name']}",
                    $config['db_user'],
                    $config['db_password']
                );
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$db;
    }
}