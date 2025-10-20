<?php
namespace App\Models;
use App\Config\Database;
class Tipo {
  public static function all(): array {
    $db = Database::conn();
    return $db->query("SELECT * FROM TIP_TIPO_DOC ORDER BY TIP_NOMBRE")->fetchAll();
  }
  public static function getById(int $id): ?array {
    $db = Database::conn();
    $st = $db->prepare("SELECT * FROM TIP_TIPO_DOC WHERE TIP_ID = ?");
    $st->execute([$id]);
    $r = $st->fetch();
    return $r ?: null;
  }
}
