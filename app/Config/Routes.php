<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/customers', 'Customers::index');
$routes->get('/users', 'Users::index');

$routes->get('customers/new', 'Customers::newCustomer');
$routes->post('customers/new', 'Customers::create');

$routes->get('users', 'Users::index');
$routes->get('users/new', 'Users::newUser');
$routes->post('users/new', 'Users::create');

$routes->get('customers/edit/(:num)', 'Customers::edit/$1');
$routes->post('customers/update/(:num)', 'Customers::update/$1');

$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->post('users/update/(:num)', 'Users::update/$1');