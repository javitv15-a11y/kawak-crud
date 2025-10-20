<?php
namespace App\Models;
use App\Config\Database;
use PDO;
class Proceso {
  public static function all(): array {
    $db = Database::conn();
    return $db->query("SELECT * FROM PRO_PROCESO ORDER BY PRO_NOMBRE")->fetchAll();
  }
  public static function getById(int $id): ?array {
    $db = Database::conn();
    $st = $db->prepare("SELECT * FROM PRO_PROCESO WHERE PRO_ID = ?");
    $st->execute([$id]);
    $r = $st->fetch();
    return $r ?: null;
  }
}
