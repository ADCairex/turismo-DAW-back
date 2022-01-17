<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('news')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE news AUTO_INCREMENT=1');

        $newsBuilder = $this->db->table('news');

        $news = [
            [
                'title'       => 'example title',
                'description' => 'example description',
                'pubDate' => new Time('now', 'Europe/Madrid', 'es_ES'),
                'url' => 'example url',
                'guid' => 'example guid',
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
        ];

        $newsBuilder->insertBatch($news);
    }
}
