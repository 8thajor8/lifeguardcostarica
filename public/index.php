<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PaginasController;
use Controllers\ClinicasController;
use Controllers\ServiciosController;
use Controllers\TestimonialsController;



$router = new Router();

//Pagina
$router->get('/', [PaginasController::class, 'index']);
$router->get('/clinicas', [PaginasController::class, 'clinicas']);

//Admin
$router->get('/configuracion', [PaginasController::class, 'configuracion']);

//Clinicas
$router->get('/clinicas/listado', [ClinicasController::class, 'listado']);
$router->get('/clinicas/crear', [ClinicasController::class, 'crear']);
$router->post('/clinicas/crear', [ClinicasController::class, 'crear']);
$router->get('/clinicas/actualizar', [ClinicasController::class, 'actualizar']);
$router->post('/clinicas/actualizar', [ClinicasController::class, 'actualizar']);
$router->post('/clinicas/eliminar', [ClinicasController::class, 'eliminar']);

//Servicios
$router->get('/servicios/listado', [ServiciosController::class, 'listado']);
$router->get('/servicios/crear', [ServiciosController::class, 'crear']);
$router->post('/servicios/crear', [ServiciosController::class, 'crear']);
$router->get('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServiciosController::class, 'eliminar']);

//Testimonials
$router->get('/testimoniales/listado', [TestimonialsController::class, 'listado']);
$router->get('/testimoniales/crear', [TestimonialsController::class, 'crear']);
$router->post('/testimoniales/crear', [TestimonialsController::class, 'crear']);
$router->get('/testimoniales/actualizar', [TestimonialsController::class, 'actualizar']);
$router->post('/testimoniales/actualizar', [TestimonialsController::class, 'actualizar']);
$router->post('/testimoniales/eliminar', [TestimonialsController::class, 'eliminar']);


$router->comprobarRutas();

