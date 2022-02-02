<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('roles')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE roles AUTO_INCREMENT=1');

        $rolesBuilder = $this->db->table('roles');

        $roles = [
            [
                'name'       => 'admin',
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
            [
                'name'       => 'client',
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
        ];

        $rolesBuilder->insertBatch($roles);
    }
}
