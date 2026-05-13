<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/expense']                  = 'expense';
$route['admin/expense/create']           = 'expense/create';
$route['admin/expense/update/(:num)']    = 'expense/update/$1';
$route['admin/expense/read/(:num)']      = 'expense/read/$1';
$route['admin/expense/delete/(:num)']    = 'expense/delete/$1';
$route['admin/expense/create_action']    = 'expense/create_action';
$route['admin/expense/update_action']    = 'expense/update_action';
$route['admin/expense/delete_action/(:num)']    = 'expense/delete_action/$1';
