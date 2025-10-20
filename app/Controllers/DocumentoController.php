<?php
namespace App\Controllers;
use App\Models\Documento;
use App\Models\Tipo;
use App\Models\Proceso;
class DocumentoController {
  public function index(string $base = ''): void {
  $q = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
  $search = $q;
  $docs = \App\Models\Documento::search($q);
  $BASE = $base;
  require __DIR__ . '/../Views/documentos/index.php';
}
  public function create(string $base = ''): void {
    $tipos = Tipo::all();
    $procesos = Proceso::all();
    $BASE = $base;
    require __DIR__ . '/../Views/documentos/form.php';
  }
  public function store(string $base = ''): void {
    Documento::create(
      trim($_POST['DOC_NOMBRE'] ?? ''),
      trim($_POST['DOC_CONTENIDO'] ?? ''),
      (int)($_POST['DOC_ID_TIPO'] ?? 0),
      (int)($_POST['DOC_ID_PROCESO'] ?? 0),
    );
    header("Location: {$base}/documentos"); exit;
  }
  public function edit(string $base = ''): void {
    $id = (int)($_GET['id'] ?? 0);
    $doc = Documento::find($id);
    $tipos = Tipo::all();
    $procesos = Proceso::all();
    $BASE = $base;
    require __DIR__ . '/../Views/documentos/form.php';
  }
  public function update(string $base = ''): void {
    Documento::updateDoc(
      (int)$_POST['DOC_ID'],
      trim($_POST['DOC_NOMBRE'] ?? ''),
      trim($_POST['DOC_CONTENIDO'] ?? ''),
      (int)($_POST['DOC_ID_TIPO'] ?? 0),
      (int)($_POST['DOC_ID_PROCESO'] ?? 0),
    );
    header("Location: {$base}/documentos"); exit;
  }
  public function delete(string $base = ''): void {
    Documento::delete((int)($_GET['id'] ?? 0));
    header("Location: {$base}/documentos"); exit;
  }
}