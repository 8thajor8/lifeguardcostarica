<?php

namespace Controllers;
use MVC\Router;
use Model\AppointmentStatus;


class AppointmentStatusController{

    public static function listado(Router $router){
        session_start();
        isAuth();

        $statuses = AppointmentStatus::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/appointments/status/statusListado', [
            'statuses' => $statuses, 
            'resultado' => $resultado
    ]);

    }

    public static function crear(Router $router){
        session_start();
        isAuth();

        $status = new AppointmentStatus();
        
        $errores = AppointmentStatus::getErrores();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            
            $status = new AppointmentStatus($_POST);
            
            
            
            //Valido errores
            $errores = $status->validar();
            
            //Si no hay errores, ejecuto el query
            if(empty($errores)){
    
                $status->guardar();
    
                header('Location: /appointments/status/listado?resultado=1');
                    
            }
    
        }

        $router->render('admin/appointments/status/statusCrear', [
            'status' => $status, 
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        session_start();
        isAuth();
        
        $id = validarORedireccionar('/configuracion');

        //Consulta datos de propiedad
        $status = AppointmentStatus::find($id);

        //Declaro Variable de errores de validacion de formulario
        $errores = AppointmentStatus::getErrores();

        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST;
            

            $status->sincronizar($args);
            
            

            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores
            $errores = $status->validar();
            
            
            if(empty($errores)){

                $status->guardar();

                header('Location: /appointments/status/listado?resultado=2');
                
            }

            
            
        }

        $router->render('admin/appointments/status/statusActualizar', [
            'status' => $status, 
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router){
        session_start();
        isAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST' ){
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    
                    $status = AppointmentStatus::find($id);
                    
                    //Eliminar 
                    $status->eliminar();

                   
                    header('Location: /appointments/status/listado?resultado=3');
                    
            
                        
                }
                
                
    
                
            }
        }
    }

}