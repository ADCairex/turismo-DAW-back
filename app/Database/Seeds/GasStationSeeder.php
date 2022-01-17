<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GasStationSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('gas_station')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE gas_station AUTO_INCREMENT=1');

        $gasStationBuilder = $this->db->table('gas_station');

        $gasStation = [
            [
                'label' => 'Estacion de Servicio Repsol',
                'address' => 'Avenida de Jijona, 88, 03012 Alicante',
                'latitude' => 38.35842,
                'longitude' => -0.48401,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
            [
                'label' => 'Estacion de Servicio El Carpio',
                'address' => 'Plaza San Antonio, 0, 03004 Alicante',
                'latitude' => 38.35133,
                'longitude' => -0.48741,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ]
        ];

        $gasStationBuilder->insertBatch($gasStation); 
    }
}
