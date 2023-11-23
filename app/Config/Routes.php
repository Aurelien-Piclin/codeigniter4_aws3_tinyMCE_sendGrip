<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['get', 'post'] , '/contact', 'SendingController::contact');
$routes->get('/thank_you', 'SendingController::thanks');

