<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ReviewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('reviews')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE reviews AUTO_INCREMENT=1');

        $reviewsBuilder = $this->db->table('reviews');

        $reviews = [
            [
                'description' => 'El socaterra es un restaurante alicantino con comida tipica mediterranea',
                'punctuation' => 30,
                'email' => 'email example',
                'restaurant_id' => 1,
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
        ];

        $reviewsBuilder->insertBatch($reviews);
    }
}
