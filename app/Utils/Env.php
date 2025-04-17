<?php

namespace Utils;

class Env {
    public array $env = [];

    function __construct() {
        $this->load();
    }
    
    function load() {
        if (file_exists(__DIR__ . '/../../.env')) {
            $lines = file(__DIR__ . '/../../.env');
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line && !str_starts_with($line, '#')) {
                    list($key, $value) = explode('=', $line, 2);
                    $this->env[$key] = trim($value);
                }
            }
        }
    }
}