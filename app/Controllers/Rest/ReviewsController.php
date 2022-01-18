<?php

namespace App\Controllers\Rest;

use App\Models\ReviewsModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ReviewsController extends ResourceController
{
    //Get a reviews by the IdRestaurant
    public function getReviewsByIdRestaurant($idRestaurant=null) 
    {
        try {
            $reviewM = new ReviewsModel();
            if($idRestaurant) {
                $reviews = $reviewM->findReviewsByIdRestaurant($idRestaurant);
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

    //Get reviews by the IdReview
    public function getReviewsByIdReview($id=null)
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

    //Get reviews by the IdRestaurant and email
    public function getReviewsByIdRestaurant_Email($idRestaurant=null, $email)
    {

    }
}
