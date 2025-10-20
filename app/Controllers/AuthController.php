<?php
namespace App\Controllers;
class AuthController {
  private array $cfg;
  public function __construct() {
    $this->cfg = require __DIR__ . '/../Config/app.php';
  }
  public function showLogin(string $base = ''): void {
    if (!empty($_SESSION['auth'])) {
      header("Location: {$base}/documentos");
      exit;
    }
    $BASE = $base; 
    require __DIR__ . '/../Views/auth/login.php';
  }
  public function login(string $base = ''): void {
    if (!empty($_SESSION['auth'])) {
      header("Location: {$base}/documentos");
      exit;
    }
    $u = $_POST['user'] ?? '';
    $p = $_POST['pass'] ?? '';
    if ($u === $this->cfg['login_user'] && $p === $this->cfg['login_pass']) {
      $_SESSION['auth'] = true;
      header("Location: {$base}/documentos");
      exit;
    }
    $_SESSION['error'] = 'Credenciales inválidas';
    header("Location: {$base}/login");
    exit;
  }
  public function logout(string $base = ''): void {
    session_destroy();
    header("Location: {$base}/login");
    exit;
  }
}
