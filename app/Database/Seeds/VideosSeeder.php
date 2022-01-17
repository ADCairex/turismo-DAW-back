<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class VideosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('videos')->where('id > ', 0)->delete();
        $this->db->query('ALTER TABLE videos AUTO_INCREMENT=1');

        $videosBuilder = $this->db->table('videos');

        $videos = [
            [
                'title' => 'video title example',
                'description' => 'video description example',
                'pubDate' => new Time('now', 'Europe/Madrid', 'es_ES'),
                'url' => 'video url example',
                'guid' => 'video guid example',
                'created_at' => new Time('now', 'Europe/Madrid', 'es_ES'),
            ],
        ];

        $videosBuilder->insertBatch($videos);
    }
}
