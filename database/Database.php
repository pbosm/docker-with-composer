<?php

namespace app\Database;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    protected static $db;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
        $dotenv->load();

        $db_host = $_ENV['DB_HOST'];
        $db_user = $_ENV['DB_USER'];;
        $db_password = $_ENV['DB_PASS'];
        $db_name = $_ENV['DB_NAME'];
        $db_driver = $_ENV['DB_DRIVE'];
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_name", $db_user, $db_password, $options);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->exec('SET NAMES utf8mb4');
        } catch (PDOException $e) {
            die("Connection Error: " . $e->getMessage());
        }
    }

    public static function connectionPDO()
    {
        if (!self::$db) {
            new Database();
        }
        return self::$db;
    }
}
