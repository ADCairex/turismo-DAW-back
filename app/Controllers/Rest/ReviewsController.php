<?php

namespace App\Controllers\Rest;

use App\Entities\Reviews;
use App\Models\RestaurantsModel;
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
                $idRestaurantExist = $reviewM->findReviewsByIdRestaurant($idRestaurant);
                if ($idRestaurantExist) {
                    $reviews = $reviewM->findReviewsByIdRestaurant_Email($idRestaurant, $email);
                    if ($reviews) {
                        return $this->respond($reviews, 200, 'Reseñas encontradas con exito');
                    } else {
                        return $this->respond('', 404, 'Reseñas no encontradas');
                    }
                } else {
                    return $this->respond('', 404, 'El restaurante no existe');
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
            $restaurantM = new RestaurantsModel();
            $request = $this->request;
            $body = $request->getJSON();
            //Check if the review exit
            if(isset($body->id) && isset($body->restaurant_id) && isset($body->email) && isset($body->description) && isset($body->punctuation)) {
                $review = $reviewM->findReviewByIdReview($body->id);

                if($review) {
                    $reviewM->save($body);

                    //Get the values to update the restaurant info
                    $newAvg = $reviewM->getRestaurantAvg($body->restaurant_id);
                    $newNumReviews = $reviewM->findReviewsByIdRestaurant($body->restaurant_id);
                    //Structure of the restaurant data
                    $updateRestaurant = array(
                        'id' => $body->restaurant_id,
                        'reviewAverage' => $newAvg->reviewAvg,
                        'numReviews' => count($newNumReviews)
                    );
                    //Update the restaurant data
                    $restaurantM->save($updateRestaurant);
                    return $this->respond('', 200, 'Reseña actualizada con exito');
                } else {
                    return $this->respond('', 404, 'Reseña no encontrada');
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

                    //Get the values to update the restaurant info
                    $newAvg = $reviewM->getRestaurantAvg($body->restaurant_id);
                    $newNumReviews = $reviewM->findReviewsByIdRestaurant($body->restaurant_id);
                    //Structure of the restaurant data
                    $updateRestaurant = array(
                        'id' => $body->restaurant_id,
                        'reviewAverage' => $newAvg->reviewAvg,
                        'numReviews' => count($newNumReviews)
                    );
                    //Update the restaurant data
                    $restaurantM->save($updateRestaurant);
                    return $this->respond('', 200, 'Reseña creada con exito');
                } else {
                    return $this->respond('', 400, 'Falta algun dato obligatorio');
                }
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error intero del servidor');
        }
    }

    //Remove a review
    public function deleteReview() {
        try {
            $reviewM = new ReviewsModel();
            $request = $this->request;
            $body = $request->getJSON();
            if(isset($body->review_id)) {
                $review = $reviewM->findReviewByIdReview($body->review_id);
                if($review) {
                    $reviewM->delete(['id' => $body->review_id]);
                    return $this->respond('', 200, 'Review eliminada con exito');
                } else {
                    return $this->respond('', 404, 'La review no se ha podido eliminar con exito');
                }
            } else {
                return $this->respond('', 400, 'No se ha enviado el id');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }
}
