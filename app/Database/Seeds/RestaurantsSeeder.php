<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RestaurantsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('restaurants')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE restaurants AUTO_INCREMENT=1');

        $restaurantsBuilder = $this->db->table('restaurants');

        $restaurants = [
            [
                'name' => 'Socaterra',
                'description' => 'El socaterra es un restaurante alicantino con comida tipica mediterranea',
                'address' => 'Calle Lonja de Caballeros, 03002 Alicante España',
                'latitude' => 38.345929,
                'longitude' => -0.480941,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
            [
                'name' => 'Restaurante Templo',
                'description' => 'El restaurante templo es un restaurante alicantino especializado en carnes',
                'address' => 'Calle Periodista Pirula Arderius, 7, 03001 Alicante España',
                'latitude' => 38.3451004,
                'longitude' => -0.5571646,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],[
                'name' => 'Socaterra',
                'description' => 'El socaterra es un restaurante alicantino con comida tipica mediterranea',
                'address' => 'Calle Lonja de Caballeros, 03002 Alicante España',
                'latitude' => 38.345929,
                'longitude' => -0.480941,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
            [
                'name' => 'Restaurante Templo',
                'description' => 'El restaurante templo es un restaurante alicantino especializado en carnes',
                'address' => 'Calle Periodista Pirula Arderius, 7, 03001 Alicante España',
                'latitude' => 38.3451004,
                'longitude' => -0.5571646,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ]
        ];

        $restaurantsBuilder->insertBatch($restaurants);
    }
}
