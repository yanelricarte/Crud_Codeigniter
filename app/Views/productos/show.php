<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 24px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 16px;
            max-width: 700px;
        }

        .row {
            margin: 8px 0;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #333;
            text-decoration: none;
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <h1>Detalle del Producto</h1>

    <div class="card">
        <div class="row"><strong>ID:</strong> <?= esc($producto['id']) ?></div>
        <div class="row"><strong>Nombre:</strong> <?= esc($producto['nombre']) ?></div>
        <div class="row"><strong>Precio:</strong> <?= esc($producto['precio']) ?></div>
        <div class="row"><strong>Stock:</strong> <?= esc($producto['stock']) ?></div>
        <div class="row"><strong>Descripción:</strong> <?= esc($producto['descripcion']) ?></div>
        <div class="row"><strong>Categoría:</strong> <?= esc($producto['categoria']) ?></div>
    </div>
<p>

    <a class="btn" href="<?= site_url('productos') ?>">Volver al listado</a>    
    <a class="btn" href="<?= site_url('productos/'.$producto['id'].'/edit') ?>">Editar</a>
</p>
</body>

</html>