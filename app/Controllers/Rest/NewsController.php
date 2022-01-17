<?php

namespace App\Controllers\Rest;

use App\Models\NewsModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class NewsController extends ResourceController
{
    public function getNew($id=null) 
    {
        try {
            $newM = new NewsModel();
            if($id) {
                $new = $newM->findNews($id);
                if ($new) {
                    return $this->respond($new, 200, 'Noticia encontrada con exito');
                } else {
                    return $this->respond('', 404, 'Noticia no encontrada');
                }
            } else {
                $news = $newM->findNews();
                if ($news) {
                    return $this->respond($news, 200, 'Noticias encontradas con exito');
                } else {
                    return $this->respond('', 404, 'Noticias no encontradas');
                }
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }
}
