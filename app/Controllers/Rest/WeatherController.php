<?php

namespace App\Controllers\Rest;

use App\Models\WeatherModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class WeatherController extends ResourceController
{
    public function getActualWeather()
    {
        try {
            $weatherM = new WeatherModel();
            $actualWeather = $weatherM->getActualWeather();
            if ($actualWeather) {
                return $this->respond($actualWeather, 200, 'Tiempo actual encontrado');
            } else {
                return $this->respond('', 404, 'Registro no encontrado');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error interno del servidor');
        }
    }
}
