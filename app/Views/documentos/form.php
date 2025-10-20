<?php require __DIR__ . '/../layout/header.php'; $isEdit = isset($doc); ?>
<h2><?= $isEdit ? 'Editar' : 'Crear' ?> Documento</h2>
<form method="post" action="<?= $BASE . ($isEdit ? '/documentos/actualizar' : '/documentos/guardar') ?>">
  <?php if ($isEdit): ?>
    <input type="hidden" name="DOC_ID" value="<?= (int)$doc['DOC_ID'] ?>">
  <?php endif; ?>
  <label>Nombre:
    <input name="DOC_NOMBRE" required value="<?= htmlspecialchars($doc['DOC_NOMBRE'] ?? '') ?>">
  </label><br>
  <label>Contenido:<br>
    <textarea name="DOC_CONTENIDO" rows="6"><?= htmlspecialchars($doc['DOC_CONTENIDO'] ?? '') ?></textarea>
  </label><br>
  <label>Tipo:
    <select name="DOC_ID_TIPO" required>
      <?php foreach ($tipos as $t): ?>
        <option value="<?= (int)$t['TIP_ID'] ?>" <?= isset($doc) && (int)$doc['DOC_ID_TIPO'] === (int)$t['TIP_ID'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($t['TIP_NOMBRE']) ?> (<?= htmlspecialchars($t['TIP_PREFIJO']) ?>)
        </option>
      <?php endforeach; ?>
    </select>
  </label><br>
  <label>Proceso:
    <select name="DOC_ID_PROCESO" required>
      <?php foreach ($procesos as $p): ?>
        <option value="<?= (int)$p['PRO_ID'] ?>" <?= isset($doc) && (int)$doc['DOC_ID_PROCESO'] === (int)$p['PRO_ID'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($p['PRO_NOMBRE']) ?> (<?= htmlspecialchars($p['PRO_PREFIJO']) ?>)
        </option>
      <?php endforeach; ?>
    </select>
  </label><br>
  <button><?= $isEdit ? 'Actualizar' : 'Crear' ?></button>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>
