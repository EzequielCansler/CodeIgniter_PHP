<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Creando la api rest 
$routes->group('api', ['namespace' => 'App\Controllers\API'],function($routes){
$routes->get('clientes', 'Clientes::index'); // Clientes
$routes->get('clientes/show/(:num)', 'Clientes::show/$1'); // Cliente por Id
$routes->post('clientes/create', 'Clientes::create'); // Crear Cliente
$routes->put('clientes/update/(:num)', 'Clientes::update/$1'); // actualizar Cliente
$routes->put('clientes/delete/(:num)', 'Clientes::delete/$1'); // Eliminar Cliente


// la ruta la podria haber creado con resource q hereda todas los metodos

$routes->get('testconexion', 'TestConexion::index');

});

