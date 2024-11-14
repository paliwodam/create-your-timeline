<?php

namespace CreateYourTimeline;

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $host = getenv('DB_HOST');
            $username = getenv('DB_USERNAME');
            $password = getenv('DB_PASSWORD');
            $this->pdo = new \PDO("mysql:host=$host;dbname=timeline", $username, password: $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
