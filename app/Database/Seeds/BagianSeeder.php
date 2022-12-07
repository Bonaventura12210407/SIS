<?php

namespace App\Database\Seeds;

use App\Models\BagianModel;
use CodeIgniter\Database\Seeder;

class BagianSeeder extends Seeder
{
    public function run()
    {
        $id=(new BagianModel())->insert([
            'nama'        => 'Guru',
            'fungsi'      => 'Mendidik siswa',
            'tugas_pokok' => 'Mengajar dan mendidik siswa',
        ]);
        echo "hasil id = $id";

        $id=(new BagianModel())->insert([
            'nama'        => 'TU',
            'fungsi'      => 'Mengatur tata usaha sekolah',
            'tugas_pokok' => 'Mengatur TU',
        ]);
        echo "hasil id = $id";

        $id=(new BagianModel())->insert([
            'nama'        => 'Kepala Sekolah',
            'fungsi'      => 'Memimpin kesatuan sekolah',
            'tugas_pokok' => 'Mengatur dan menerapkan kebijakan di sekolah',
        ]);
        echo "hasil id = $id";
        
        $id=(new BagianModel())->insert([
            'nama'        => 'Wakil Kepala Sekolah',
            'fungsi'      => 'Mewakilkan kepala sekolah',
            'tugas_pokok' => 'Menggantikan kepala sekolah jika ada kendala',
        ]);
        echo "hasil id = $id";
    }
}
