<?php
namespace App\Models;
use App\Config\Database;
class Documento {
  private static function buildCodigo(int $tipoId, int $proId): string {
    $db = Database::conn();
    $st = $db->prepare("SELECT TIP_PREFIJO FROM TIP_TIPO_DOC WHERE TIP_ID = ?");
    $st->execute([$tipoId]);
    $tip = $st->fetchColumn();
    $st = $db->prepare("SELECT PRO_PREFIJO FROM PRO_PROCESO WHERE PRO_ID = ?");
    $st->execute([$proId]);
    $pro = $st->fetchColumn();
    $st = $db->prepare("
      SELECT MAX(CAST(SUBSTRING_INDEX(DOC_CODIGO, '-', -1) AS UNSIGNED))
      FROM DOC_DOCUMENTO
      WHERE DOC_ID_TIPO = ? AND DOC_ID_PROCESO = ?
    ");
    $st->execute([$tipoId, $proId]);
    $max = (int)$st->fetchColumn();
    $next = $max + 1;
    return "{$tip}-{$pro}-{$next}";
  }
public static function search(string $q = ''): array {
  $db = Database::conn();
  $sqlBase = "SELECT d.*, 
                     t.TIP_PREFIJO, t.TIP_NOMBRE, 
                     p.PRO_PREFIJO, p.PRO_NOMBRE
              FROM DOC_DOCUMENTO d
              JOIN TIP_TIPO_DOC t ON d.DOC_ID_TIPO = t.TIP_ID
              JOIN PRO_PROCESO p ON d.DOC_ID_PROCESO = p.PRO_ID";

  if ($q === '') {
    $stmt = $db->query($sqlBase . " ORDER BY d.DOC_ID DESC");
    return $stmt->fetchAll();
  }
  $like = '%' . $q . '%';
  $sql = $sqlBase . "
         WHERE d.DOC_NOMBRE   LIKE ?
            OR d.DOC_CODIGO   LIKE ?
            OR t.TIP_PREFIJO  LIKE ?
            OR t.TIP_NOMBRE   LIKE ?
            OR p.PRO_PREFIJO  LIKE ?
            OR p.PRO_NOMBRE   LIKE ?
         ORDER BY d.DOC_ID DESC";

  $st = $db->prepare($sql);
  $st->execute([$like, $like, $like, $like, $like, $like]);
  return $st->fetchAll();
}
  public static function find(int $id): ?array {
    $db = Database::conn();
    $st = $db->prepare("SELECT * FROM DOC_DOCUMENTO WHERE DOC_ID = ?");
    $st->execute([$id]);
    $r = $st->fetch();
    return $r ?: null;
  }
  public static function create(string $nombre, string $contenido, int $tipoId, int $proId): void {
    $db = Database::conn();
    $codigo = self::buildCodigo($tipoId, $proId);

    $st = $db->prepare("INSERT INTO DOC_DOCUMENTO
      (DOC_NOMBRE, DOC_CODIGO, DOC_CONTENIDO, DOC_ID_TIPO, DOC_ID_PROCESO)
      VALUES (?, ?, ?, ?, ?)");
    $st->execute([$nombre, $codigo, $contenido, $tipoId, $proId]);
  }
  public static function updateDoc(int $id, string $nombre, string $contenido, int $tipoId, int $proId): void {
    $db = Database::conn();
    $cur = self::find($id);
    $codigo = $cur['DOC_CODIGO'];
    if ((int)$cur['DOC_ID_TIPO'] !== $tipoId || (int)$cur['DOC_ID_PROCESO'] !== $proId) {
      $codigo = self::buildCodigo($tipoId, $proId);
    }
    $st = $db->prepare("UPDATE DOC_DOCUMENTO
                  SET DOC_NOMBRE=?, DOC_CODIGO=?, DOC_CONTENIDO=?, DOC_ID_TIPO=?, DOC_ID_PROCESO=?
                        WHERE DOC_ID=?");
    $st->execute([$nombre, $codigo, $contenido, $tipoId, $proId, $id]);
  }
  public static function delete(int $id): void {
    $db = Database::conn();
    $st = $db->prepare("DELETE FROM DOC_DOCUMENTO WHERE DOC_ID = ?");
    $st->execute([$id]);
  }
}