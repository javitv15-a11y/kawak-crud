<?php require __DIR__ . '/../layout/header.php'; ?>
<h2>Documentos</h2>
<form method="get" action="<?= $BASE ?>/documentos" style="margin-bottom:10px">
  <input
    type="text"
    name="q"
    placeholder="Buscar por nombre, código, tipo o proceso"
    value="<?= htmlspecialchars($search ?? ($_GET['q'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
  <button>Buscar</button>
  <a href="<?= $BASE ?>/documentos/crear">Crear</a>
</form>
<table border="1" cellpadding="6">
  <tr>
    <th>ID</th><th>Código</th><th>Nombre</th>
    <th>Tipo</th><th>Proceso</th><th>Acciones</th>
  </tr>
  <?php foreach ($docs as $d): ?>
    <tr>
      <td><?= (int)$d['DOC_ID'] ?></td>
      <td><?= htmlspecialchars($d['DOC_CODIGO']) ?></td>
      <td><?= htmlspecialchars($d['DOC_NOMBRE']) ?></td>
      <td><?= htmlspecialchars($d['TIP_NOMBRE'] ?? $d['DOC_ID_TIPO']) ?> (<?= htmlspecialchars($d['TIP_PREFIJO'] ?? '') ?>)</td>
      <td><?= htmlspecialchars($d['PRO_NOMBRE'] ?? $d['DOC_ID_PROCESO']) ?> (<?= htmlspecialchars($d['PRO_PREFIJO'] ?? '') ?>)</td>
      <td>
        <a href="<?= $BASE ?>/documentos/editar/<?= (int)$d['DOC_ID'] ?>">Editar</a> |
        <a href="<?= $BASE ?>/documentos/eliminar/<?= (int)$d['DOC_ID'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/../layout/footer.php'; ?>
