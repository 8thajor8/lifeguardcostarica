<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

use Controllers\PaginasController;
use Controllers\ClinicasController;
use Controllers\ReportesController;
use Controllers\UsuariosController;
use Controllers\AddendumsController;
use Controllers\PacientesController;
use Controllers\ServiciosController;
use Controllers\APIPacientesController;
use Controllers\AppointmentsController;
use Controllers\TestimonialsController;
use Controllers\AppointmentStatusController;




$router = new Router();

//Pagina
$router->get('/', [PaginasController::class, 'index']);
$router->get('/clinicas', [PaginasController::class, 'clinicas']);
$router->get('/appointments', [PaginasController::class, 'appointments']);
$router->post('/appointments', [PaginasController::class, 'appointments']);

//Admin

$router->get('/configuracion', [PaginasController::class, 'configuracion']);

//Usuarios
$router->get('/login', [UsuariosController::class, 'login']);
$router->post('/login', [UsuariosController::class, 'login']);
$router->get('/logout', [UsuariosController::class, 'logout']);
$router->get('/usuarios/listado', [UsuariosController::class, 'listado']);
$router->get('/usuarios/crear', [UsuariosController::class, 'crear']);
$router->post('/usuarios/crear', [UsuariosController::class, 'crear']);
$router->get('/usuarios/actualizar', [UsuariosController::class, 'actualizar']);
$router->post('/usuarios/actualizar', [UsuariosController::class, 'actualizar']);

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

//Pacientes
$router->get('/pacientes/listado', [PacientesController::class, 'listado']);
$router->post('/pacientes/listado', [PacientesController::class, 'listado']);
$router->get('/pacientes/crear', [PacientesController::class, 'crear']);
$router->post('/pacientes/crear', [PacientesController::class, 'crear']);
$router->get('/pacientes/actualizar', [PacientesController::class, 'actualizar']);
$router->get('/pacientes/expediente', [PacientesController::class, 'expediente']);
$router->post('/pacientes/actualizar', [PacientesController::class, 'actualizar']);
$router->post('/api/pacientes', [APIPacientesController::class, 'guardar']);

//Reportes
$router->get('/reportes/listado', [ReportesController::class, 'listado']);
$router->post('/reportes/listado', [ReportesController::class, 'listado']);
$router->get('/reportes/crear', [ReportesController::class, 'crear']);
$router->post('/reportes/crear', [ReportesController::class, 'crear']);
$router->get('/reportes/actualizar', [ReportesController::class, 'actualizar']);
$router->post('/reportes/actualizar', [ReportesController::class, 'actualizar']);
$router->get('/reportes/expediente', [ReportesController::class, 'expediente']);
$router->get('/reportes/descargar', [ReportesController::class, 'descargar']);
$router->post('/reportes/expediente/adjuntar', [ReportesController::class, 'adjuntar']);

//Addendums
$router->get('/addendum/crear', [AddendumsController::class, 'crear']);
$router->post('/addendum/crear', [AddendumsController::class, 'crear']);

//Appointments
$router->get('/appointments/listado', [AppointmentsController::class, 'listado']);
$router->get('/appointments/details', [AppointmentsController::class, 'actualizar']);
$router->post('/appointments/details', [AppointmentsController::class, 'actualizar']);

//Appointments Status
$router->get('/appointments/status/listado', [AppointmentStatusController::class, 'listado']);
$router->get('/appointments/status/crear', [AppointmentStatusController::class, 'crear']);
$router->post('/appointments/status/crear', [AppointmentStatusController::class, 'crear']);
$router->get('/appointments/status/actualizar', [AppointmentStatusController::class, 'actualizar']);
$router->post('/appointments/status/actualizar', [AppointmentStatusController::class, 'actualizar']);
$router->post('/appointments/status/eliminar', [AppointmentStatusController::class, 'eliminar']);

$router->comprobarRutas();

