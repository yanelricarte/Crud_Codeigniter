<form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>

    <?php if (($method ?? 'POST') !== 'POST'): ?>
        <input type="hidden" name="_method" value="<?= esc($method) ?>">
    <?php endif; ?>

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre"
           value="<?= old('nombre', $producto['nombre'] ?? '') ?>">

    <label for="precio">Precio</label>
    <input type="text" name="precio" id="precio"
           value="<?= old('precio', $producto['precio'] ?? '') ?>">

    <label for="stock">Stock</label>
    <input type="text" name="stock" id="stock"
           value="<?= old('stock', $producto['stock'] ?? '') ?>">

    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" id="descripcion"
           value="<?= old('descripcion', $producto['descripcion'] ?? '') ?>">

    <label for="categoria">Categoría</label>
    <input type="text" name="categoria" id="categoria"
           value="<?= old('categoria', $producto['categoria'] ?? '') ?>">

    <button type="submit">Guardar</button>
</form>
