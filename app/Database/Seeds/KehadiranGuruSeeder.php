<?php

namespace App\Database\Seeds;

use App\Models\KehadiranGuruModel;
use CodeIgniter\Database\Seeder;

class KehadiranGuruSeeder extends Seeder
{
    public function run()
    {
        $id = (new KehadiranGuruModel())->insert([
            'waktu_masuk'   => '10:00:00',
            'waktu_keluar'  => '12:00:00',
            'pertemuan'     => '1',
            'pegawai_id'    => '1',
            'jadwal_id'     => '1',
            'berita_acara'  => 'Mengajar Bahasa Indonesia',
        ]);
        echo "hasil id = $id";
    }
}
