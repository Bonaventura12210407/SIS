<?php

namespace App\Database\Seeds;

use App\Models\RincianPenilaianModel;
use CodeIgniter\Database\Seeder;

class RincianPenilaianSeeder extends Seeder
{
    public function run()
    {
            $id = (new RincianPenilaianModel())->insert([
                'penilaian_id'          => '1',
                'nama_nilai'            => 'delapan_puluh',
                'nilai_angka'           => '80',
                'nilai_deskripsi'       => 'teruskan',
            ]);
    
            echo "hasil id= $id";
        }
    }
    