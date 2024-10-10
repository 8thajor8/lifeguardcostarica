<?php

namespace Controllers;
use MVC\Router;
use Model\Titulo;
use Model\Reporte;
use Model\Usuario;
use Model\Addendum;
use Model\Paciente;

class AddendumsController{

    public static function crear(Router $router){
        session_start();
        
        isAuth();

        $addendum = new Addendum();
        $usuarios = Usuario::all();
        $errores = Addendum::getErrores();
        $reporte = Reporte::find($_GET['id']);
        $reporte->doctor = Usuario::find($reporte->doctor);
        $reporte->doctor->user_titulo = Titulo::find($reporte->doctor->user_titulo);
        $reporte->patient_id = Paciente::find($reporte->patient_id);
        $reporte->creado_por = Usuario::find($reporte->creado_por);

        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $addendum = new Addendum($_POST);
            $addendum->patient_id = (int)$addendum->patient_id;
            $addendum->reporte_id = (int)$addendum->reporte_id;
            
            $timeValues = [];

            // Define an array of time field names
            $timeFields = ['time_1', 'time_2', 'time_3', 'time_4'];

            // Iterate through the time fields and check their values
            foreach ($timeFields as $field) {
                $timeValues[$field] = isset($_POST[$field]) && !empty($_POST[$field]) ? $_POST[$field] : null;
            }
            
            //Array diagnostico handling
            $diagnosticos = $_POST['diagnostico'] ?? [];
            $diagnosticosString = implode('|', $diagnosticos); // Join with a pipe
            $addendum->diagnostico = $diagnosticosString;
            
            //Array plan handling
            $planes = $_POST['plan'] ?? [];
            $planesString = implode('|', $planes); // Join with a pipe
            $addendum->plan = $planesString;
            
            //Valido errores
            $errores = $addendum->validar();
            
            //Si no hay errores, ejecuto el query
            if(empty($errores)){             
                
                $addendum->creado_por = $_SESSION['id'];
                
                // Set the current timestamp for the 'created_at' field
                $addendum->date_created = date('Y-m-d H:i:s');
                $resultado = $addendum->guardar();

                if($return_to_patient){
                    header('Location: /pacientes/expediente?id='.$reporte->patient_id.'&resultado=1');
                    exit();
                }
                header('Location: /reportes/expediente?id='.$reporte->id.'&resultado=1');
                    
            }
    
        }

        $router->render('admin/addendums/addendumsCrear', [
            'addendum' => $addendum,
            'errores' => $errores,
            'reporte' => $reporte,
            'usuarios' => $usuarios,
        ]);
    
    }

}