<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    /**
     * Borrado lógico (soft delete).
     * Con true, $model->delete($id) deja de hacer DELETE y pasa a hacer
     * UPDATE productos SET deleted_at = <ahora> WHERE id = ...
     * Además find()/findAll() agregan solos "WHERE deleted_at IS NULL",
     * así que los borrados desaparecen de las consultas sin tocar el resto del código.
     *
     * Para borrar de verdad: delete($id, true)  -> "purga".
     * Para ver los borrados:  onlyDeleted()     -> solo papelera.
     * Para ver todo:          withDeleted()     -> activos + borrados.
     */
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'precio', 'stock', 'descripcion', 'categoria'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // Columna que marca el borrado lógico

    // Validation
    protected $validationRules      = [
        'nombre' => 'required|min_length[2]|max_length[100]',
        'precio' => 'required|decimal',
        'stock'  => 'required|integer',
        'descripcion' => 'required',
        'categoria' => 'required'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
