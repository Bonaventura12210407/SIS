<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KehadiranGuru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type'=>'int','constraint'=>10,'unsigned'=>true, 'auto_increment'=>true,'null'=>false],
            'waktu_masuk'   => ['type'=>'time','null'=>true],
            'waktu_keluar'  => ['type'=>'time','null'=>true],
            'pertemuan'     => ['type'=>'tinyint','constraint'=>3,'unsigned'=>true,'null'=>true],
            'pegawai_id'    => ['type'=>'int','constraint'=>10,'unsigned'=>true,'null'=>false],
            'jadwal_id'     => ['type'=>'int','constraint'=>10,'unsigned'=>true,'null'=>false],
            'berita_acara'  => ['type'=>'text','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pegawai_id', 'pegawai','id','cascade');
        $this->forge->addForeignKey('jadwal_id','jadwal','id','cascade');
        $this->forge->createTable('kehadiran_guru');
    }
    
    public function down()
    {
        $this->forge->dropTable('kehadiran_guru');
    }
}
