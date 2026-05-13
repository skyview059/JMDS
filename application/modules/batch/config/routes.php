<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route[BACKEND_PATH . 'batch']                  = 'batch';
$route[BACKEND_PATH . 'batch/create']           = 'batch/create';
$route[BACKEND_PATH . 'batch/update/(:num)']    = 'batch/update/$1';
$route[BACKEND_PATH . 'batch/read/(:num)']      = 'batch/read/$1';
$route[BACKEND_PATH . 'batch/delete/(:num)']    = 'batch/delete/$1';
$route[BACKEND_PATH . 'batch/create_action']    = 'batch/create_action';
$route[BACKEND_PATH . 'batch/update_action']    = 'batch/update_action';
$route[BACKEND_PATH . 'batch/delete_action/(:num)']    = 'batch/delete_action/$1';
