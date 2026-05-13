<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/donor']                  = 'donor';
$route['admin/donor/dues']             = 'donor/dues';
$route['admin/donor/create']           = 'donor/create';
$route['admin/donor/update/(:num)']    = 'donor/update/$1';
$route['admin/donor/read/(:num)']      = 'donor/read/$1';
$route['admin/donor/delete/(:num)']    = 'donor/delete/$1';
$route['admin/donor/create_action']    = 'donor/create_action';
$route['admin/donor/update_action']    = 'donor/update_action';
$route['admin/donor/delete_action/(:num)']    = 'donor/delete_action/$1';
