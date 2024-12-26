<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'nama_pegawai' => $faker->name,
                'jabatan_id' => $faker->randomElement(['2, 8, 15, 28, 30, 30, 30, 30']),
                'alamat' => $faker->address,
                'telepon' => $faker->phoneNumber,
                'foto_pegawai' => 'default.png',
            ];
        }

        //simpan massal
        $this->db->table('pegawai')->insertBatch($data);
    }
}
