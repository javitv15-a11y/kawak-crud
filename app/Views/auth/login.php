<?php require __DIR__ . '/../layout/header.php'; ?>
<h2>Login</h2>
<?php if (!empty($_SESSION['error'])): ?>
  <p style="color:red"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
<?php endif; ?>
<form method="post" action="<?= $BASE ?>/login">
  <label>Usuario: <input name="user" required></label><br>
  <label>Contraseña: <input name="pass" type="password" required></label><br>
  <button>Entrar</button>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>
