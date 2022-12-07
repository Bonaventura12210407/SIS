<?php

namespace App\Database\Seeds;

use App\Models\KelassiswaModel;
use App\Models\SiswaModel;
use CodeIgniter\Database\Seeder;

class KelasSiswaSeeder extends Seeder
{
    public function run()
    {
        $id = (new KelassiswaModel())->insert([
            'siswa_id'  => '1',
            'kelas_id'  => '1',
        ]);
        echo "hasil id = $id";
    }
}
