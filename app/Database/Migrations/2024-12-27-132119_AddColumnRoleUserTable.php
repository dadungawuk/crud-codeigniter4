<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnRoleUserTable extends Migration
{
    public function up()
    {
        $field = [
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'user'],
                'default' => 'user',
                'null' => false,
                'after' => 'email',
            ],
        ];

        $this->forge->addColumn('users', $field);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'role');
    }
}
