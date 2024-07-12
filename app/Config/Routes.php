<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('siswa', 'SiswaController::index');
$routes->post('siswa/simpan', 'SiswaController::simpan');
$routes->get('siswa/hapus/(:segment)', 'SiswaController::hapus/$1');
$routes->get('siswa/edit/(:segment)', 'SiswaController::edit/$1');
