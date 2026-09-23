<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Papelera de productos</title>

  <style>
    body { font-family: Arial, sans-serif; margin: 24px; }
    table { border-collapse: collapse; width: 100%; margin-top: 12px; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { text-align: left; background: #f5f5f5; }
    .actions a, .actions form { display: inline-block; margin-right: 8px; }
    .msg { padding: 10px; background: #e7f7e7; border: 1px solid #b7e1b7; margin: 12px 0; }
    .error { padding: 10px; background: #fde8e8; border: 1px solid #f5b5b5; margin: 12px 0; }
    .btn { display:inline-block; padding:8px 12px; border:1px solid #333; text-decoration:none; }
    .aviso { padding: 10px; background: #fff8e1; border: 1px solid #f0d98c; margin: 12px 0; }
  </style>
</head>

<body>

  <h1>Papelera de productos</h1>

  <?php if (!empty($msg)): ?>
    <div class="msg"><?= esc($msg) ?></div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="error"><?= esc($error) ?></div>
  <?php endif; ?>

  <div class="aviso">
    Estos productos <strong>siguen existiendo</strong> en la tabla: lo que tienen es
    <code>deleted_at</code> con fecha. Por eso no aparecen en el listado normal.
  </div>

  <a class="btn" href="<?= site_url('productos') ?>">Volver al listado</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Borrado el</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($productos as $p): ?>
        <tr>
          <td><?= esc($p['id']) ?></td>
          <td><?= esc($p['nombre']) ?></td>
          <td><?= esc($p['precio']) ?></td>
          <td><?= esc($p['stock']) ?></td>
          <td><?= esc($p['deleted_at']) ?></td>
          <td class="actions">
            <!-- Restaurar: pone deleted_at = NULL (borrado lógico al revés) -->
            <a href="<?= site_url('productos/'.$p['id'].'/restaurar') ?>">Restaurar</a>

            <!-- Purgar: DELETE real, no se puede deshacer -->
            <form action="<?= site_url('productos/'.$p['id'].'/purgar') ?>" method="post"
                  onsubmit="return confirm('¿Eliminar DEFINITIVAMENTE? Esta acción no se puede deshacer.')">
              <?= csrf_field() ?>
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit">Eliminar definitivamente</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>

      <?php if (empty($productos)): ?>
        <tr>
          <td colspan="6">La papelera está vacía.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
