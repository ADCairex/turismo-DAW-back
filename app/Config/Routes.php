<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// NAMESPACES
if (!defined('API_REST_NAMESPACE')) {
    define('API_REST_NAMESPACE', 'App\Controllers\Rest');
}
if (!defined('COMMAND_NAMESPACE')) {
    define('COMMAND_NAMESPACE', 'App\Controllers\Command');
}
if (!defined('OAUTH_NAMESPACE')) {
    define('OAUTH_NAMESPACE', 'App\Controllers\OAuth');
}
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

//----------------- API REST Routes -----------------------------------
$routes->group('rest', function ($routes) {
    //---------- RESTAURANTS --------------
    $routes->get('restaurant/(:any)', 'RestaurantsController::getRestaurant/$1', ['namespace' => API_REST_NAMESPACE]);
    $routes->get('restaurant', 'RestaurantsController::getRestaurant', ['filter' => 'oauth2_private', 'namespace' => API_REST_NAMESPACE]);

    //---------- GAS STATION --------------
    $routes->get('gas-station/(:any)', 'GasStationController::getGasStation/$1', ['namespace' => API_REST_NAMESPACE]);
    $routes->get('gas-station', 'GasStationController::getGasStation', ['namespace' => API_REST_NAMESPACE]);

    //------------ WEATHER ----------------
    $routes->get('weather', 'WeatherController::getActualWeather', ['namespace' => API_REST_NAMESPACE]);

    //-------------- NEWS -----------------
    $routes->get('new/(:any)', 'NewsController::getNew/$1', ['namespace' => API_REST_NAMESPACE]);
    $routes->get('new', 'NewsController::getNew', ['namespace' => API_REST_NAMESPACE]);

    //------------- VIDEOS ----------------
    $routes->get('video/(:any)', 'VideosController::getVideo/$1', ['namespace' => API_REST_NAMESPACE]);
    $routes->get('video', 'VideosController::getVideo', ['namespace' => API_REST_NAMESPACE]);

    //------------- REVIEWS ------------------
    $routes->get('reviewByIdRestaurant/(:any)', 'ReviewsController::getReviewsByIdRestaurant/$1', ['namespace' => API_REST_NAMESPACE]);
    $routes->get('reviewByIdReview/(:any)', 'ReviewsController::getReviewsByIdReview/$1', ['namespace' => API_REST_NAMESPACE]);
    $routes->get('reviewByIdRestaurantEmail/(:any)/(:any)', 'ReviewsController::getReviewsByIdRestaurant_Email/$1/$2', ['namespace' => API_REST_NAMESPACE]);
    $routes->post('saveReview', 'ReviewsController::saveReview', ['namespace' => API_REST_NAMESPACE]);
    $routes->delete('deleteReview', 'ReviewsController::deleteReview', ['namespace' => API_REST_NAMESPACE]);
});
//---------------------------------------------------------------------
//-------------------- COMMAND Routes ---------------------------------
$routes->group('command', function ($routes) {
    //------------ GAS STATION ---------------
    $routes->cli('gasStationCommand', 'GasStationController::gasStationCommand', ['namespace' => COMMAND_NAMESPACE]);
    //-------------- WEATHER -----------------
    $routes->cli('weatherCommand', 'WeatherController::weatherCommand', ['namespace' => COMMAND_NAMESPACE]);
    //--------------- NEWS -------------------
    $routes->cli('newsCommand', 'NewsController::newsCommand', ['namespace' => COMMAND_NAMESPACE]);
});
//---------------------------------------------------------------------
//------------------- OAuth Routes ------------------------------------
$routes->group('oauth', function ($routes) {
    $routes->post('oauth_login', 'OAuthController::login', ['namespace' => OAUTH_NAMESPACE]);
});
//---------------------------------------------------------------------
// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*
 * --------------------------------------------------------------------
// We get a performance increase by specifying the default
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
