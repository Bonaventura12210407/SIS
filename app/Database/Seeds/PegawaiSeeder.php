<?php

namespace App\Database\Seeds;

use App\Models\PegawaiModel;
use CodeIgniter\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $id = (new PegawaiModel())->insert([
            'nip'               => '564543575',
            'nama_depan'        => 'kolas',
            'nama_belakang'     => 'Ganteng Sekali',
            'gelar_depan'       => 'S.Kom',
            'gelar_belakang'    => 'M.p',
            'gender'            => 'L',
            'no_telp'           => '086512124214',
            'no_wa'             => '086545624933',
            'email'             => 'kolas@gmail.com',
            'bagian_id'         => '3',
            'alamat'            => 'Jalan Tebu',
            'kota'              => 'Pontianak',
            'tgl_lahir'         => '1975-02-03',
            'tempat_lahir'      => 'Pontianak', 
            'sandi'             => password_hash('123456', PASSWORD_BCRYPT), 
            'token_reset'      => '1234566', 
        ]);
            echo "hasil id = $id";

    }
}

