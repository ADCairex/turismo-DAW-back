<?php

namespace App\Controllers\Rest;

use App\Models\VideosModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class VideosController extends ResourceController
{
    public function getVideo($id=null)
    {
        try {
            $videosM = new VideosModel();
            if($id) {
                $video = $videosM->findVideos($id);
                if ($video) {
                    return $this->respond($video, 200, 'Video encontrado con exito');
                } else {
                    return $this->respond('', 404, 'Video no encontrado');
                }
            } else {
                $videos = $videosM->findVideos();
                if ($videos) {
                    return $this->respond($videos, 200, 'Videos encontrados con exito');
                } else {
                    return $this->respond('', 404, 'Videos no encontrados');
                }
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }
}
