<?php

namespace Utils;
use Utils\Env;

class Config {
    public static array $config = [];

    // function __construct() {
    //     self::$config = [
    //         'db_host' => getenv('DB_HOST'),
    //         'db_name' => getenv('DB_NAME'),
    //         'db_user' => getenv('DB_USER'),
    //         'db_password' => getenv('DB_PASS'),
    //     ];
    // }

    function __construct() {
        $env = new Env();
        self::$config = [
            'db_host' => $env->env['DB_HOST'] ?? 'localhost',
            'db_name' => $env->env['DB_NAME'] ?? 'test',
            'db_user' => $env->env['DB_USER'] ?? 'root',
            'db_password' => $env->env['DB_PASS'] ?? 'root',
        ];
    }
}