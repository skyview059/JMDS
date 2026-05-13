<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route[BACKEND_PATH . 'vehicle']                  = 'vehicle';
$route[BACKEND_PATH . 'vehicle/create']           = 'vehicle/create';
$route[BACKEND_PATH . 'vehicle/update/(:num)']    = 'vehicle/update/$1';
$route[BACKEND_PATH . 'vehicle/read/(:num)']      = 'vehicle/read/$1';
$route[BACKEND_PATH . 'vehicle/delete/(:num)']    = 'vehicle/delete/$1';
$route[BACKEND_PATH . 'vehicle/create_action']    = 'vehicle/create_action';
$route[BACKEND_PATH . 'vehicle/update_action']    = 'vehicle/update_action';
$route[BACKEND_PATH . 'vehicle/delete_action/(:num)']    = 'vehicle/delete_action/$1';
