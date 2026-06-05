<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Dashboard + history
$route[BACKEND_PATH . 'driving']                            = 'driving/dashboard';
$route[BACKEND_PATH . 'driving/dashboard']                  = 'driving/dashboard';
$route[BACKEND_PATH . 'driving/history']                    = 'driving/history';
$route[BACKEND_PATH . 'driving/learner/(:num)']             = 'driving/learner_history/$1';

// Queue actions
$route[BACKEND_PATH . 'driving/assign_action']              = 'driving/assign_action';
$route[BACKEND_PATH . 'driving/transition/(:num)']          = 'driving/transition_action/$1';
$route[BACKEND_PATH . 'driving/reset_action/(:num)']        = 'driving/reset_action/$1';
$route[BACKEND_PATH . 'driving/reset_row']                  = 'driving/reset_row';

// Legacy CRUD (raw rows)
$route[BACKEND_PATH . 'driving/listing']                    = 'driving/listing';
$route[BACKEND_PATH . 'driving/details/(:num)']             = 'driving/details/$1';
$route[BACKEND_PATH . 'driving/create']                     = 'driving/create';
$route[BACKEND_PATH . 'driving/create_action']              = 'driving/create_action';
$route[BACKEND_PATH . 'driving/update/(:num)']              = 'driving/update/$1';
$route[BACKEND_PATH . 'driving/update_action']              = 'driving/update_action';
$route[BACKEND_PATH . 'driving/delete/(:num)']              = 'driving/delete/$1';
$route[BACKEND_PATH . 'driving/delete_action/(:num)']       = 'driving/delete_action/$1';
