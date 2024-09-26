<?php

namespace Controllers;
use MVC\Router;
use Model\Appointment;
use Model\AppointmentStatus;


class AppointmentsController{

    public static function listado(Router $router){

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

}