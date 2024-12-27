<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/401', function () {
  return view('401');
});

// Route untuk Auth
$routes->match(['get', 'post'], '/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

// Route untuk CRUD Jabatan
$routes->group('', ['filter' => 'auth', 'filter' => 'role:admin'], static function ($routes) {
  $routes->get('/jabatan', 'JabatanController::index');
  $routes->get('/jabatan/show/(:num)', 'JabatanController::show/$1');
  $routes->get('/jabatan/create', 'JabatanController::create');
  $routes->post('/jabatan/store', 'JabatanController::store');
  $routes->get('/jabatan/edit/(:num)', 'JabatanController::edit/$1');
  $routes->post('/jabatan/update/(:num)', 'JabatanController::update/$1');
  $routes->post('/jabatan/delete/(:num)', 'JabatanController::delete/$1');
});


// Route untuk CRUD Pegawai
$routes->group('', ['filter' => 'auth'], static function ($routes) {
  $routes->get('/pegawai', 'PegawaiController::index');
  $routes->get('/pegawai/show/(:num)', 'PegawaiController::show/$1');
  $routes->get('/pegawai/create', 'PegawaiController::create');
  $routes->post('/pegawai/store', 'PegawaiController::store');
  $routes->get('/pegawai/edit/(:num)', 'PegawaiController::edit/$1');
  $routes->post('/pegawai/update/(:num)', 'PegawaiController::update/$1');
  $routes->post('/pegawai/delete/(:num)', 'PegawaiController::delete/$1', ['filter' => 'role:admin']);
});
