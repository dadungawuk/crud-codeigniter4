<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'  => 'andi',
            'nama'      => 'Andi Santoso',
            'email'     => 'andi@user.com',
            'role'      => 'user',
            'password'  => password_hash('andi123', PASSWORD_DEFAULT),
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
