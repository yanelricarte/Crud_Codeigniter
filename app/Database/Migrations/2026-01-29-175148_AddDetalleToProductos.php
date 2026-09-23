<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetalleToProductos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('productos', [
            'descripcion' => ['type' => 'TEXT', 'null' => true],
            'categoria' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('productos', ['descripcion', 'categoria']);
    }
}
