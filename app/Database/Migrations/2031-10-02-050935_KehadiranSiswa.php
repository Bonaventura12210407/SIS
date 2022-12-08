<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KehadiranSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                          => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true],
            'kehadiran_guru_id'           => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null'=>false],
            'siswa_id'                    => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null'=>false],
            'status_hadir'                => ['type'=>'enum("Y", "T")','default' =>'Y'],          
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kehadiran_guru_id', 'kehadiran_guru', 'id', 'cascade');
        $this->forge->addForeignKey('siswa_id', 'siswa', 'id', 'cascade');
        $this->forge->createtable('kehadiran_siswa');
    }

    public function down()
    {
        $this->forge->droptable('kehadiran_siswa'); 
    }
}
