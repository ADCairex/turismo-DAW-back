<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE roles AUTO_INCREMENT=1');

        $rolesBuilder = $this->db->table('users');

        $faker = Factory::create();

        $roles = [
            [
                'username'   => $faker->username,
                'email'      => 'admin@test.com',
                'password'   => password_hash('1234', 1),
                'name'       => $faker->name,
                'surname'    => $faker->name,
                'role_id'    => 1,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ]
        ];

        $rolesBuilder->insertBatch($roles);
    }
}
