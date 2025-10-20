<!doctype html>
<html lang="es"><head>
  <meta charset="utf-8"><title>KAWAK CRUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head><body>
<?php
  if (!isset($BASE)) { $BASE = '/kawak-crud/public'; }
?>
<nav>
  <?php if (!empty($_SESSION['auth'])): ?>
    <a href="<?= $BASE ?>/documentos">Documentos</a> |
    <a href="<?= $BASE ?>/logout">Salir</a>
  <?php else: ?>
    <a href="<?= $BASE ?>/login">Login</a>
  <?php endif; ?>
</nav><hr>
