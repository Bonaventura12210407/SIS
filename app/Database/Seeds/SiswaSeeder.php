<?php

namespace App\Database\Seeds;

use App\Models\SiswaModel;
use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $id = (new SiswaModel())->insert([
            'nisn'          => '1207354928',
            'nis'           => '27359',
            'status_masuk'  => 'A',
            'thn_masuk'     => '2016',
            'nama_depan'    => 'Ricko',
            'nama_belakang' => 'Marba',
            'nik'           => '6171058538100001',
            'no_kk'         => '6171058374123007',
            'gender'        => 'L',
            'tgl_lahir'     => '1998-09-11',
            'tempat_lahir'  => 'Jakarta Selatan',
            'alamat'        => 'Jl. PSY Gg. NamStyle',
            'kota'          => 'Jakarta Selatan',
            'kelas_id'      => '1',
            'no_telp_rumah' => '082132131231',
            'no_hp_ibu'     => '089364817243',
            'no_hp_ayah'    => '081284759120',
            'nm_ayah'       => 'Johanes',
            'nm_ibu'        => 'Siska',
            'nm_wali'       => 'Rusdi',
            'email'         => 'ricko@gmail.com',
            'sandi'         => password_hash('123456', PASSWORD_BCRYPT), 
        ]);
        echo "hasil id = $id";
    }
}
