<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class WeatherSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('weather')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE weather AUTO_INCREMENT=1');

        $weatherBuilder = $this->db->table('weather');

        $weather = [
            [
                'main' => 'test',
                'description' => 'description test',
                'icon' => 'an url test',
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
        ];

        $weatherBuilder->insertBatch($weather);
    }
}
