<?php

namespace Utils;

class Config {
    public static array $config = [];

    function __construct() {
        self::$config = [
            'db_host' => getenv('DB_HOST'),
            'db_name' => getenv('DB_NAME'),
            'db_user' => getenv('DB_USER'),
            'db_password' => getenv('DB_PASS'),
        ];
    }
}