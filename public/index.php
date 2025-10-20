<?php
declare(strict_types=1);
ini_set('display_errors', '1');            
ini_set('display_startup_errors', '1');    
error_reporting(E_ALL);                    
header('Content-Type: text/html; charset=utf-8');
require __DIR__ . '/../vendor/autoload.php';
use App\Controllers\AuthController;
use App\Controllers\DocumentoController;
session_start();
$BASE = '/kawak-crud/public';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$uri = preg_replace('#^' . preg_quote($BASE, '#') . '#', '', $uri);
$uri = trim($uri, '/');
$auth = new AuthController();
if ($uri === '' || $uri === 'login') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth->login($BASE);
  } else {
    $auth->showLogin($BASE);
  }
  exit;
}
if ($uri === 'logout') {
  $auth->logout($BASE);
  exit;
}
if (empty($_SESSION['auth'])) {
  header("Location: {$BASE}/login");
  exit;
}
$doc = new DocumentoController();
switch (true) {
  case ($uri === 'documentos'):
    $doc->index($BASE);
    break;
  case ($uri === 'documentos/crear'):
    $doc->create($BASE);
    break;
  case ($uri === 'documentos/guardar' && $_SERVER['REQUEST_METHOD'] === 'POST'):
    $doc->store($BASE);
    exit;
  case (preg_match('#^documentos/editar/(\d+)$#', $uri, $m)):
    $_GET['id'] = (int)$m[1];
    $doc->edit($BASE);
    break;
  case ($uri === 'documentos/actualizar' && $_SERVER['REQUEST_METHOD'] === 'POST'):
    $doc->update($BASE);
    exit;
  case (preg_match('#^documentos/eliminar/(\d+)$#', $uri, $m)):
    $_GET['id'] = (int)$m[1];
    $doc->delete($BASE);
    exit;
  default:
    http_response_code(404);
    echo "<h1>404 - Página no encontrada</h1>";
}