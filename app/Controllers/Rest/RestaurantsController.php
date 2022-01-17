<?php

namespace App\Controllers\Rest;

use App\Models\RestaurantsModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class RestaurantsController extends ResourceController
{
    public function getRestaurant($id=null) 
    {
        try {
            $restM = new RestaurantsModel();
            if($id) {
                $restaurant = $restM->findRestaurants($id);
                if ($restaurant) {
                    return $this->respond($restaurant, 200, 'Restaurante encontrado con exito');
                } else {
                    return $this->respond('', 404, 'Restaurante no encontrado');
                }
            } else {
                $restaurants = $restM->findRestaurants();
                if ($restaurants) {
                    return $this->respond($restaurants, 200, 'Restaurantes encontrados con exito');
                } else {
                    return $this->respond('', 404, 'Restaurantes no encontrados');
                }
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }
}
