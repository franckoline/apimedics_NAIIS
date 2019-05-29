<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'index/users';
$route['home'] = 'admin/users';
$route['index'] = 'admin/dashboard';
$route['logout'] = 'index/logout';


$route['admin/users'] = 'index/users';
$route['admin/symptoms'] = 'index/symptoms_manager';
$route['admin/form/add-user'] = 'forms/add_user';
$route['admin/add-user'] = 'index/add_user';
$route['admin/form/add-report'] = 'forms/add_report';
$route['admin/form/addreport'] = 'forms/addreport';

$route['admin/diagnose/(:any)'] = 'index/diagnose';

//API
$route['api/v1/results'] = 'api/results';
$route['api/v1/results/valid'] = 'api/valid_results';
$route['api/v1/results/invalid'] = 'api/invalid_results';
$route['api/v1/zones/zone/(:any)'] = 'api/zone_detail';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
