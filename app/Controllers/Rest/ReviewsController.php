<?php

namespace App\Controllers\Rest;

use App\Entities\Reviews;
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
                $reviews = $reviewM->findReviewByIdReview($id);
                if ($reviews) {
                    return $this->respond($reviews, 200, 'Reseña encontrada con exito');
                } else {
                    return $this->respond('', 404, 'Reseña no encontrada');
                }
            } else {
                return $this->respond('', 400, 'Id de la reseña no enviado');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }

    //Get reviews by the IdRestaurant and email
    public function getReviewsByIdRestaurant_Email($idRestaurant=null, $email=null)
    {
        try {
            $reviewM = new ReviewsModel();
            if($idRestaurant && $email) {
                $reviews = $reviewM->findReviewsByIdRestaurant_Email($idRestaurant, $email);
                if ($reviews) {
                    return $this->respond($reviews, 200, 'Reseñas encontradas con exito');
                } else {
                    return $this->respond('', 404, 'Reseñas no encntradas');
                }
            } else {
                return $this->respond('', 400, 'Id del restaurante o email no enviados');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }

    //Create or update a review
    public function saveReview()
    {
        try {
            $reviewM = new ReviewsModel();
            $request = $this->request;
            $body = $request->getJSON();
            //Check if the review exit
                if(isset($body->id)) {
                    $review = $reviewM->findReviewByIdReview($body->id);

                    if($review) {
                        $reviewM->save($body);
                        return $this->respond('', 200, 'Reseña actualizada con exito');
                    } else {
                        return $this->respond('', 404, 'Resña no encontrada');
                    }
                } else {
                    if(isset($body->restaurant_id) && isset($body->email) && isset($body->description) && isset($body->punctuation)) {
                        $data = array(
                            'description' => $body->description,
                            'email' => $body->email,
                            'restaurant_id' => $body->restaurant_id,
                            'punctuation' => $body->punctuation,
                        );
                        $newReview = new Reviews($data);
                        $reviewM->save($newReview);
                        $this->respond('', 200, 'Reseña actualizada con exito');
                    } else {
                        return $this->respond('', 400, 'Falta algun dato obligatorio');
                    }
                }
            
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error intero del servidor');
        }
    }
}
