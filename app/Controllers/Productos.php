<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductoModel;

class Productos extends BaseController
{
    private ProductoModel $productoModel;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
    }

    // GET /productos -> Listado
    public function index()
    {
        return view('productos/index', [
            'productos' => $this->productoModel->orderBy('id', 'DESC')->findAll(),
            'msg'       => session()->getFlashdata('msg'),
            'error'     => session()->getFlashdata('error'),
        ]);
    }

    // GET /productos/new -> Formulario alta
    public function new()
    {
        return view('productos/form', [
            'action'   => site_url('productos'),
            'method'   => 'POST',
            'producto' => [
                'nombre'      => '',
                'precio'      => '',
                'stock'       => '',
                'descripcion' => '',
                'categoria'   => '',
            ],
            'errors' => session('errors') ?? [],
        ]);
    }

    // POST /productos -> Insertar
    public function create()
    {
        // 1) Tomar datos esperados del POST
        $data = $this->request->getPost([
            'nombre',
            'precio',
            'stock',
            'descripcion',
            'categoria',
        ]);

        /**
         * 2) Insertar usando el Model
         * - Usa $allowedFields para seguridad
         * - Usa $validationRules del modelo si skipValidation = false
         */
        if (! $this->productoModel->insert($data)) {
            // Si falla validación del Model, CI guarda errores en $model->errors()
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->productoModel->errors());
        }

        // 3) Redirigir al listado para ver lo cargado
        return redirect()
            ->to(site_url('productos'))
            ->with('msg', 'Producto creado correctamente.');
    }

    // GET /productos/{id} -> Ver detalle
    public function show(int $id)
    {
        $producto = $this->productoModel->find($id);

        if (! $producto) {
            return redirect()
                ->to(site_url('productos'))
                ->with('error', 'Producto no encontrado');
        }

        return view('productos/show', [
            'producto' => $producto,
        ]);
    }
    // GET /productos/{id}/edit -> Formulario edición
    public function edit(int $id)
    {
        $producto = $this->productoModel->find($id);

        if (! $producto) {
            return redirect()
                ->to(site_url('productos'))
                ->with('error', 'Producto no encontrado');
        }

        return view('productos/form', [
            'action'   => site_url('productos/' . $id),
            'method'   => 'PUT',
            'producto' => $producto,
            'errors'   => session('errors') ?? [],
        ]);
    }

    // PUT /productos/{id} -> Actualizar
    public function update(int $id)
    {
        $data = $this->request->getPost([
            'nombre',
            'precio',
            'stock',
            'descripcion',
            'categoria',
        ]);

        if (! $this->productoModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->productoModel->errors());
        }

        return redirect()
            ->to(site_url('productos'))
            ->with('msg', 'Producto actualizado correctamente.');
    }

    // DELETE /productos/{id} -> Eliminar (BORRADO LÓGICO)
    public function delete(int $id)
    {
        /**
         * Con $useSoftDeletes = true en el modelo, esto YA NO ejecuta:
         *     DELETE FROM productos WHERE id = ?
         * sino:
         *     UPDATE productos SET deleted_at = <ahora> WHERE id = ? AND deleted_at IS NULL
         *
         * La fila sigue en la tabla: se puede recuperar desde la papelera.
         */
        $this->productoModel->delete($id);

        return redirect()
            ->to(site_url('productos'))
            ->with('msg', 'Producto eliminado correctamente (podés restaurarlo desde la papelera).');
    }

    // GET /productos/papelera -> Solo los borrados lógicamente
    public function papelera()
    {
        return view('productos/papelera', [
            // onlyDeleted() invierte el filtro del modelo: en lugar de
            // "WHERE deleted_at IS NULL", trae solo los que SÍ tienen fecha de baja.
            'productos' => $this->productoModel->onlyDeleted()->orderBy('deleted_at', 'DESC')->findAll(),
            'msg'       => session()->getFlashdata('msg'),
            'error'     => session()->getFlashdata('error'),
        ]);
    }

    // GET /productos/{id}/restaurar -> Deshacer el borrado lógico
    public function restaurar(int $id)
    {
        // find() no ve los borrados: hay que pedirlos con withDeleted()
        // para poder verificar que el producto exista aunque esté en la papelera.
        if (! $this->productoModel->withDeleted()->find($id)) {
            return redirect()
                ->to(site_url('productos/papelera'))
                ->with('error', 'Producto no encontrado');
        }

        /**
         * Para restaurar hay que poner deleted_at = NULL.
         * No sirve $this->productoModel->update($id, ['deleted_at' => null]) porque
         * $protectFields = true descarta todo lo que no esté en $allowedFields,
         * y deleted_at no está ahí (a propósito, para que no se pueda mandar por POST).
         * Por eso se escribe directo con el Query Builder.
         */
        db_connect()
            ->table('productos')
            ->where('id', $id)
            ->update(['deleted_at' => null]);

        return redirect()
            ->to(site_url('productos'))
            ->with('msg', 'Producto restaurado correctamente.');
    }

    // DELETE /productos/{id}/purgar -> BORRADO FÍSICO (definitivo, no se puede deshacer)
    public function purgar(int $id)
    {
        // El segundo parámetro (true = purge) ignora el borrado lógico
        // y ejecuta el DELETE real sobre la tabla.
        $this->productoModel->delete($id, true);

        return redirect()
            ->to(site_url('productos/papelera'))
            ->with('msg', 'Producto eliminado definitivamente.');
    }
}
