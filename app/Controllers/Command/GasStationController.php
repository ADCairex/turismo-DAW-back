<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\GasStationModel;
use CodeIgniter\CLI\CLI;

class GasStationController extends BaseController
{
    public function gasStationCommand()
    {
        $client = service('curlrequest');
        $response = $client->request('GET', 'https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/');
        $response = $response->getBody();
        $gasArray = json_decode($response, true);
        $gasArrayAlicante = array();
        CLI::write('---- INICIO obtener gasolineras ----');
        foreach ($gasArray['ListaEESSPrecio'] as $i) {
            if ($i['Localidad'] == 'ALICANTE/ALACANT') {
                $line = [
                    'label' => $i['Rótulo'],
                    'address' => $i['Dirección'],
                    'latitude' => str_replace(',', '.', $i['Latitud']),
                    'longitude' => str_replace(',', '.', $i['Longitud (WGS84)']),
                    'ideess' => $i['IDEESS']
                ];
                array_push($gasArrayAlicante, $line);
            }
        }
        CLI::write('---- FIN obtener gasolineras ----');
        foreach ($gasArrayAlicante as $i) {
            $gasStationM = new GasStationModel();
            $gasStation = $gasStationM->findGasStationByIDEESS($i['ideess']);
            if ($gasStation) {
                array_push($i, $gasStation->id);
                $gasStationM->save($i);
            } else {
                $gasStationM->save($i);
            }
        }
        CLI::write(json_encode($gasArrayAlicante));
    }
}
