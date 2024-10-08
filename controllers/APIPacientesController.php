<?php

namespace Controllers;

use Model\Paciente;


class APIPacientesController{

public static function guardar(){
        //Almacena la cita y devuelve el ID
        $paciente = new Paciente($_POST);
        $errores = [];
        //Valido errores
        $errores = $paciente->validar();
        
        //Si no hay errores, ejecuto el query
        if(empty($errores)){

            $resultado = $paciente->guardar();
            
        } else {
            $resultado = false;
        }
        
        echo json_encode([
            'resultado' => $resultado,
            'errores' => $errores,
            'patient_name' => $paciente->patient_name . ' ' . $paciente->patient_lastname1
            ]);

    }
}