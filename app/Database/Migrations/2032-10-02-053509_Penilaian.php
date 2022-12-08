<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penilaian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                          => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true],
            'mapel_id'                    => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null'=>false],
            'siswa_id'                    => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null'=>false],
            'total_nilai'                 => ['type'=>'double','null' =>true],          
            'deskripsi_nilai'             => ['type'=>'text','null' =>true],          
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('mapel_id','mapel','id','cascade');
        $this->forge->addForeignKey('siswa_id','siswa','id','cascade');
        $this->forge->createtable('penilaian');
    }

    public function down()
    {
        $this->forge->droptable('penilaian'); 
    }
}
