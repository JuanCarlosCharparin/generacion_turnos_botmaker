<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['mantenimiento/estudios/buscar'] = 'mantenimiento/estudios/buscar';
$route['estudios'] = 'mantenimiento/estudios/index';
$route['empleados'] = 'Empleados';
$route['pacientes'] = 'Pacientes';
$route['exito'] = 'Pacientes/exito';
$route['crearEstudio'] = 'crearEstudio';
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Ajax

$route['mantenimiento/biopsia/getEditModalContent/(:any)'] = 'biopsia/getEditModalContent/$1';



