<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas_Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'int', 'constraint' => 10, 'null' => false, 'unsigned' => true, 'auto_increment' => true],
            'kelas_id'  => ['type' => 'int', 'constraint' => 10, 'null' => false, 'unsigned' => true],
            'siswa_id'  => ['type' => 'int', 'constraint' => 10, 'null' => false, 'unsigned' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kelas_id', 'kelas', 'id', 'cascade');
        $this->forge->addForeignKey('siswa_id', 'siswa', 'id', 'cascade');
        $this->forge->createTable('Kelas_Siswa');
    }

    public function down()
    {
        $this->forge->dropTable('Kelas_Siswa');
    }
}
