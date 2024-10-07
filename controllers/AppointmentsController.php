<?php

namespace Controllers;
use MVC\Router;
use Model\Appointment;
use Model\AppointmentStatus;


class AppointmentsController{

    public static function listado(Router $router){
        session_start();
        isAuth();
        $appointments = Appointment::all();
        
        $appointmentStatuses = AppointmentStatus::all();

        $statusMap = [];
        foreach ($appointmentStatuses as $status) {
            $statusMap[$status->id] = $status->name; // Assuming the status table has 'id' and 'name' columns
            

        }
        
        $statusClassMap = [
            1 => 'status-open',
            3 => 'status-cancelled',
            4 => 'status-finished',
            // Add more mappings as needed
        ];


        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/appointments/appointmentsListado', [
            'appointments' => $appointments,
            'statusMap' => $statusMap,
            'statusClassMap' => $statusClassMap,
            'resultado' => $resultado
        ]);

    }

    public static function actualizar(Router $router){
        session_start();
        isAuth();
        
        $id = validarORedireccionar('/appointments/listado');

        //Consulta datos de propiedad
        $appointment = Appointment::find($id);
        
        //Consulta de vendedores a la base
        $statuses = AppointmentStatus::All();

        //Declaro Variable de errores de validacion de formulario
        $errores = Appointment::getErrores();

        //Capturo los datos al hacer el submit
    if($_SERVER['REQUEST_METHOD']==='POST'){
        
        //Asignar atributos
       
        $args = $_POST;
        

        $appointment->sincronizar($args);
        
        //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores
        $appointment->latitud = !empty($appointment->latitud) ? $appointment->latitud : NULL;
        $appointment->longitud = !empty($appointment->longitud) ? $appointment->longitud : NULL;
        $appointment->date_symptoms = !empty($appointment->date_symptoms) ? $appointment->date_symptoms : NULL;
        $appointment->housecall = isset($_POST['housecall']) ? 1 : 0;
        $appointment->have_symptoms = isset($_POST['have_symptoms']) ? 1 : 0;
        $appointment->proximity = isset($_POST['proximity']) ? 1 : 0;
        $appointment->quarantined = isset($_POST['quarantined']) ? 1 : 0;
        $errores = $appointment->validar();
        
        

        if(empty($errores)){

            $appointment->guardar();

            
        }

        
        
    }

        $router->render('admin/appointments/appointmentsActualizar', [
            'appointment' => $appointment,
            'statuses' => $statuses, 
            'errores' => $errores]);
    }

}