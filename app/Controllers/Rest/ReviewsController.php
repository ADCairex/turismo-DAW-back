<?php

namespace App\Controllers\Rest;

use App\Models\ReviewsModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ReviewsController extends ResourceController
{
    public function getReviews($id=null) 
    {
        try {
            $reviewM = new ReviewsModel();
            if($id) {
                $reviews = $reviewM->findReviewsRestaurants($id);
                if ($reviews) {
                    return $this->respond($reviews, 200, 'Reseñas encontradas con exito');
                } else {
                    return $this->respond('', 404, 'Reseñas no encontradas');
                }
            } else {
                return $this->respond('', 400, 'Id del restaruante no enviado');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }
}
