<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\WeatherModel;
use CodeIgniter\CLI\CLI;

class WeatherController extends BaseController
{
    public function weatherCommand()
    {
        $client = service("curlrequest");
        //Uso la API-KEY de hector porque a mi me daba problemas y me decia que no era valida
        $response = $client->request('GET', 'https://falseapi.openweathermap.org/data/2.5/weather?zip=03001,es&appid=d9f59487133ec8602801f63c12ea676f');
        $response = $response->getBody();
        $weather = json_decode($response);
        $weather = $weather->weather[0];
        CLI::write('Tiempo actual: '.json_encode($weather));
        $weatherM = new WeatherModel();
        $data = array(
            'main' => $weather->main,
            'description' => $weather->description,
            'icon' => $weather->icon
        );
        $weatherM->save($data);
    }
}
