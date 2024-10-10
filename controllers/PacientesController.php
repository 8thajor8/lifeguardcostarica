<?php

namespace Controllers;

use MVC\Router;
use Model\Titulo;
use Model\Reporte;
use Model\Usuario;
use Model\Paciente;

class PacientesController{

    public static function listado(Router $router){

        session_start();
        isAuth();

        $pacientes = Paciente::all();


        $errores = Paciente::getErrores();
        
        $searchname = $_GET['search'] ?? null;
        
        
        
        $resultado = $_GET['resultado'] ?? null;

        if (!empty($searchname)) {
            $searchname = trim($searchname); // Remove whitespace from search term
            $pacientes = Paciente::searchByFields(['patient_name','patient_lastname1'], $searchname);     
        }
    
        $router->render('admin/pacientes/pacientesListado', [
            'pacientes' => $pacientes,
            'resultado' => $resultado,
            'errores' => $errores
        ]);
    }

    public static function crear(Router $router){
        session_start();
        isAuth();

        $paciente = new Paciente();
        
        $errores = Paciente::getErrores();
        
    
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $paciente = new Paciente($_POST);
            
            
            //Valido errores
            $errores = $paciente->validar();
    
            //Si no hay errores, ejecuto el query
            if(empty($errores)){

                $paciente->guardar();
                
                header('Location: /pacientes/listado?resultado=1');
                    
            }
    
        }

        $router->render('admin/pacientes/pacientesCrear', [
            'paciente' => $paciente,
            'errores' => $errores,
            
        ]);
    }

    public static function actualizar(Router $router){

        session_start();
        isAuth();

        $id = validarORedireccionar('/pacientes/listado');

        //Consulta datos de propiedad
        $paciente = Paciente::find($id);
        
        
        //Declaro Variable de errores de validacion de formulario
        $errores = Paciente::getErrores();

        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST;
            

            $paciente->sincronizar($args);
            
            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores

            $errores = $paciente->validar();
            
            

            if(empty($errores)){

                $paciente->guardar();

                header('Location: /pacientes/expediente?id='.$paciente->id.'&resultado=2');
            }

            
            
        }

        $router->render('admin/pacientes/pacientesActualizar', [
            'paciente' => $paciente,
            
            'errores' => $errores]);
    }

    public static function expediente(Router $router){

        session_start();
        isAuth();

        $id = validarORedireccionar('/pacientes/listado');

        $resultado = $_GET['resultado'] ?? null;
        //Consulta datos de propiedad
        $paciente = Paciente::find($id);
        $reportes = Reporte::belongsTo('patient_id', $id);
        
        foreach($reportes as $reporte){
            $reporte->doctor = Usuario::find($reporte->doctor);
            $reporte->patient_id = Paciente::find($reporte->patient_id);
            $reporte->doctor->user_titulo = Titulo::find($reporte->doctor->user_titulo);
        }

        $router->render('admin/pacientes/pacientesExpediente', [
            'paciente' => $paciente,
            'resultado' =>$resultado,
            'reportes' => $reportes
            
        ]);
    }
}