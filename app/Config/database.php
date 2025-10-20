<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
  public static function conn(): PDO {
    $host = '127.0.0.1';
    $db   = 'kawak_docs';
    $user = 'root';   
    $pass = '';       
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];
    return new PDO($dsn, $user, $pass, $options);
  }
}
