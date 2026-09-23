<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('productos')->insertBatch([
        ['nombre'=>'Café','precio'=>1500,'stock'=>20],
        ['nombre'=>'Té Verde','precio'=>1200,'stock'=>35],
        ['nombre'=>'Chocolate','precio'=>2100,'stock'=>15],
    ]);
    }
}
