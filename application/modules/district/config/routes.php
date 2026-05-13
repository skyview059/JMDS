<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route[BACKEND_PATH . 'district']                  = 'district';
$route[BACKEND_PATH . 'district/create']           = 'district/create';
$route[BACKEND_PATH . 'district/update/(:num)']    = 'district/update/$1';
$route[BACKEND_PATH . 'district/read/(:num)']      = 'district/read/$1';
$route[BACKEND_PATH . 'district/delete/(:num)']    = 'district/delete/$1';
$route[BACKEND_PATH . 'district/create_action']    = 'district/create_action';
$route[BACKEND_PATH . 'district/update_action']    = 'district/update_action';
$route[BACKEND_PATH . 'district/delete_action/(:num)']    = 'district/delete_action/$1';
