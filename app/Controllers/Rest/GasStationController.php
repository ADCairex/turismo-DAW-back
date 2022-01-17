<?php

namespace App\Controllers\Rest;

use App\Models\GasStationModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class GasStationController extends ResourceController
{
    public function getGasStation($id=null)
    {
        try {
            $gasM = new GasStationModel();
            if($id) {
                $gasStation = $gasM->findGasStations($id);
                if ($gasStation) {
                    return $this->respond($gasStation, 200, 'Exit on found restaurant');
                } else {
                    return $this->respond('', 404, 'Restaurant not found');
                }
            } else {
                $gasStations = $gasM->findGasStations();
                if ($gasStations) {
                    return $this->respond($gasStations, 200, 'Exit on found restaurants');
                } else {
                    return $this->respond('', 404, 'Restaurants not found');
                }
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }
}
