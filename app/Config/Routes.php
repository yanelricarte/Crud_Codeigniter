<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('productos', 'Productos::index'); //Listar 
$routes->get('productos/new', 'Productos::new'); //Formulario de creación
$routes->post('productos', 'Productos::create');
$routes->get('productos/papelera', 'Productos::papelera'); //Listado de borrados lógicamente

$routes->get('productos/(:num)', 'Productos::show/$1');   // Ver detalle
$routes->get('productos/(:num)/edit', 'Productos::edit/$1'); //Formulario de edición
$routes->put('productos/(:num)', 'Productos::update/$1');
$routes->delete('productos/(:num)', 'Productos::delete/$1'); //Borrado lógico (va a la papelera)
$routes->get('productos/(:num)/restaurar', 'Productos::restaurar/$1'); //Deshacer el borrado lógico
$routes->delete('productos/(:num)/purgar', 'Productos::purgar/$1'); //Borrado físico (definitivo)