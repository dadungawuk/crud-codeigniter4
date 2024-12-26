<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnPegawaiTable extends Migration
{
    public function up()
    {
        $kolom = [
            'foto_pegawai' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'telepon',
            ],
        ];
        $this->forge->addColumn('pegawai', $kolom);
    }

    public function down()
    {
        $this->forge->dropColumn('pegawai', 'foto_pegawai');
    }
}
