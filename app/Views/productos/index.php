<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos</title>

  <style>
    body { font-family: Arial, sans-serif; margin: 24px; }
    table { border-collapse: collapse; width: 100%; margin-top: 12px; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { text-align: left; background: #f5f5f5; }
    .actions a, .actions form { display: inline-block; margin-right: 8px; }
    .msg { padding: 10px; background: #e7f7e7; border: 1px solid #b7e1b7; margin: 12px 0; }
    .error { padding: 10px; background: #fde8e8; border: 1px solid #f5b5b5; margin: 12px 0; }
    .btn { display:inline-block; padding:8px 12px; border:1px solid #333; text-decoration:none; }
  </style>
</head>

<body>

  <h1>Productos</h1>

  <?php if (!empty($msg)): ?>
    <div class="msg"><?= esc($msg) ?></div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="error"><?= esc($error) ?></div>
  <?php endif; ?>

  <a class="btn" href="<?= site_url('productos/new') ?>">+ Nuevo producto</a>
  <a class="btn" href="<?= site_url('productos/papelera') ?>">Papelera</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
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
          <td class="actions">
            <a href="<?= site_url('productos/'.$p['id']) ?>">Ver</a>
            <a href="<?= site_url('productos/'.$p['id'].'/edit') ?>">Editar</a>

            <form action="<?= site_url('productos/'.$p['id']) ?>" method="post"
                  onsubmit="return confirm('¿Eliminar este producto? Va a la papelera y se puede restaurar.')">
              <?= csrf_field() ?>
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>
</html>