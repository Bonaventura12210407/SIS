<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type'=>'int','constraint'=>10,'unsigned'=>true, 'auto_increment'=>true,'null'=>false],
            'hari'          => ['type'=>'int','constraint'=>10,'unsigned'=>true, 'null'=>false],
            'kelas_id'      => ['type'=>'int','constraint'=>10,'unsigned'=>true, 'null'=>false],
            'mapel_id'      => ['type'=>'int','constraint'=>10,'unsigned'=>true, 'null'=>false],
            'jam_mulai'     => ['type'=>'time','null'=>true],
            'jam_selesai'   => ['type'=>'time','null'=>true],
            'pegawai_id'    => ['type'=>'int','constraint'=>10,'unsigned'=>true, 'null'=>false],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pegawai_id', 'pegawai', 'id', 'cascade');
        $this->forge->addForeignKey('kelas_id', 'kelas', 'id' , 'cascade');
        $this->forge->addForeignKey('mapel_id', 'mapel', 'id' , 'cascade');
        $this->forge->createTable('jadwal');
    }
    
    public function down()
    {
        $this->forge->dropTable('jadwal');    
    }
}
