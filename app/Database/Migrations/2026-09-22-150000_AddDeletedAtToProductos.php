<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToProductos extends Migration
{
    public function up()
    {
        // Borrado lógico: la fila NO se borra de la tabla, solo se "marca".
        //   deleted_at = NULL  -> producto activo
        //   deleted_at = fecha -> producto dado de baja (queda en la papelera)
        $this->forge->addColumn('productos', [
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('productos', 'deleted_at');
    }
}
