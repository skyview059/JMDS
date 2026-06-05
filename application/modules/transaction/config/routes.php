<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route[BACKEND_PATH . 'transaction']                  = 'transaction';
$route[BACKEND_PATH . 'transaction/create']           = 'transaction/create';
$route[BACKEND_PATH . 'transaction/update/(:num)']    = 'transaction/update/$1';
$route[BACKEND_PATH . 'transaction/read/(:num)']      = 'transaction/read/$1';
$route[BACKEND_PATH . 'transaction/delete/(:num)']    = 'transaction/delete/$1';
$route[BACKEND_PATH . 'transaction/create_action']    = 'transaction/create_action';
$route[BACKEND_PATH . 'transaction/update_action']    = 'transaction/update_action';
$route[BACKEND_PATH . 'transaction/void_action/(:num)']        = 'transaction/void_action/$1';
