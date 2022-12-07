<?php

namespace App\Database\Seeds;

use App\Models\MapelModel;
use CodeIgniter\Database\Seeder;

class MapelSeeder extends Seeder
{
    public function run()
    {
        $id = (new MapelModel())->insert([
            'mapel'      => 'Bahasa Indonesia',
            'kelompok'   => 'a',
            'keterangan' => 'Pelajaran Bahasa Indonesia',
            'tingkat'    => '3',
            'kkm'        => '65',
        ]);

        echo "hasil id = $id";
        $id = (new MapelModel())->insert([
            'mapel'      => 'Bahasa Melayu',
            'kelompok'   => 'B',
            'keterangan' => 'Pelajaran Bahasa Daerah',
            'tingkat'    => '1',
            'kkm'        => '65',
        ]);
        echo "hasil id = $id";
        
    }
}
