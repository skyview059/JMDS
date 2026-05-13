<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'dashboard';
$route['admin']                 = 'dashboard';
$route['login']                 = 'auth/login';
$route['stmt/(:num)']           = 'stmt/index/$1';
$route['logout']                = 'auth/logout';
$route['404_override']          = 'tool/not_found';

$route['translate_uri_dashes'] 	= FALSE;