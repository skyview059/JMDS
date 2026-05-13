<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route[BACKEND_PATH . 'learner']                  = 'learner';
$route[BACKEND_PATH . 'learner/create']           = 'learner/create';
$route[BACKEND_PATH . 'learner/update/(:num)']    = 'learner/update/$1';
$route[BACKEND_PATH . 'learner/read/(:num)']      = 'learner/read/$1';
$route[BACKEND_PATH . 'learner/delete/(:num)']    = 'learner/delete/$1';
$route[BACKEND_PATH . 'learner/create_action']    = 'learner/create_action';
$route[BACKEND_PATH . 'learner/update_action']    = 'learner/update_action';
$route[BACKEND_PATH . 'learner/delete_action/(:num)']    = 'learner/delete_action/$1';
