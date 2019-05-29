<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'index/users';
$route['home'] = 'admin/users';
$route['index'] = 'admin/dashboard';
$route['logout'] = 'index/logout';


$route['admin/users'] = 'index/users';
$route['admin/form/add-user'] = 'contact_form/add_user';
$route['admin/add-user'] = 'index/add_user';
$route['admin/form/add-report'] = 'contact_form/add__report';
$route['admin/diagnose/(:any)'] = 'index/diagnose';

//API
$route['api/v1/results'] = 'api/results';
$route['api/v1/zones/zone/(:any)'] = 'api/zone_detail';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
