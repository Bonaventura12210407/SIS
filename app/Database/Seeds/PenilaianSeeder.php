<?php

namespace App\Database\Seeds;

use App\Models\PenilaianModel;
use CodeIgniter\Database\Seeder;

class PenilaianSeeder extends Seeder
{
    public function run()
    {
        $id = (new PenilaianModel())->insert([
            'mapel_id'         => '1',
            'siswa_id'         => '1',
            'total_nilai'      => '80',
            'deskripsi_nilai'  => 'Nilai Bahasa Indonesia',
        ]);

        echo "hasil id= $id";
    }
}
