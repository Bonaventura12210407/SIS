<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('/siswa/login',['filter'=>'authSiswa'],  function(RouteCollection $routes){
    $routes->get('lupa', 'SiswaController:viewLupaPasswordsiswa');
    $routes->get('/', 'SiswaController::viewLoginsiswa');;
    $routes->post('/', 'SiswaController::loginsiswa');
    $routes->patch('/', 'SiswaController::lupaPasswordsiswa');
    
});
$routes->delete('/siswa/login', 'SiswaController::logoutsiswa');

$routes->group('siswa',['filter'=>'masukSIS'],function(RouteCollection $routes){
    $routes->get('/', 'SiswaController::index');
    $routes->post('/', 'SiswaController::store');
    $routes->patch('/', 'SiswaController::update');
    $routes->delete('/', 'SiswaController::delete');
    $routes->get('(:num)', 'SiswaController::show/$1');
    $routes->get('all', 'SiswaController::all');
});

$routes->group('kelassiswa',['filter'=>'masukSIS'], function(RouteCollection $routes){
    $routes->get('/', 'KelasSiswaController::index');
    $routes->post('/', 'KelasSiswaController::store');
    $routes->patch('/', 'KelasSiswaController::update');
    $routes->delete('/', 'KelasSiswaController::delete');
    $routes->get('(:num)', 'KelasSiswaController::show/$1');
    $routes->get('all', 'KelasSiswaController::all');
});

/*
 * --------------------------------------------------------------------
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
