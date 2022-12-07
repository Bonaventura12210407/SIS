<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bagian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' =>'int','constraint'=>10, 'unsigned'=>true,'auto_increment'=>true,'null'=>false],
            'nama'          => ['type' =>'varchar','constraint'=>60,'null'=>false],
            'fungsi'        => ['type' =>'text','null'=>true],
            'tugas_pokok'   => ['type' =>'text','null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('bagian');
       
        
        
    }

    public function down()
    {
        $this->forge->dropTable('bagian');
    }
}
