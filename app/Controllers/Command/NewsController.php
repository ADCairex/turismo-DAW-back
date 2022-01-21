<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Entities\News;
use App\Models\NewsModel;
use CodeIgniter\CLI\CLI;
use SimpleXMLElement;

class NewsController extends BaseController
{
    public function newsCommand()
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            )
        );

        $response = file_get_contents("https://www.elperiodic.com/feed/rss_alicante.xml", false, stream_context_create($arrContextOptions));
        $data = new SimpleXMLElement($response);
        $newsM = new NewsModel();
        $newsE = new News();
        $news = $data->channel->item;
        
        foreach($news as $i) {
            $data = array(
                "title" => $i->title,
                "description" => $i->description,
                "pubDate" => strftime("%Y-%m-%d %H:%M:%S", strtotime($i->pubDate)),
                "url" => $i->link,
                "guid" => $i->link
            );
            $new = $newsM->findWeatherByGuid($i->link);
            if ($new) {
                $data['id'] = $new->id;
                $newsM->save($data);
            } else {
                $newsM->save($data);
            }
        }
    }
}
