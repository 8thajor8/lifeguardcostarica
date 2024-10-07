<?php

namespace Controllers;
use MVC\Router;
use Model\Clinica;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class ClinicasController{

    public static function listado(Router $router){
        session_start();
        isAuth();

        $clinicas = Clinica::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/sitio/clinicas/clinicasListado', ['clinicas' => $clinicas, 'resultado' => $resultado]);

    }

    public static function crear(Router $router){
        session_start();
        isAuth();

        $clinica = new Clinica();
        
        $errores = Clinica::getErrores();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            
            $clinica = new Clinica($_POST['clinica']);
            
            $clinica->prescription = isset($_POST['clinica']['prescription']) ? 1 : 0;
            $clinica->xray = isset($_POST['clinica']['xray']) ? 1 : 0;
            $clinica->airevac = isset($_POST['clinica']['airevac']) ? 1 : 0;

            
            //Generar Nombre Unico
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg" ;
    
            //Realizar resize a la imagen con intervention
            if($_FILES['clinica']['tmp_name']['image']){
    
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['clinica']['tmp_name']['image'])->cover(800,600);  
                
                $clinica->setImagen($nombreImagen);
            }
            
            //Valido errores
            $errores = $clinica->validar();
    
            //Si no hay errores, ejecuto el query
            if(empty($errores)){
    
                //Crear carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
    
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                
                $clinica->guardar();
    
                
                header('Location: /clinicas/listado?resultado=1');
                    
            }
    
        }

        $router->render('admin/sitio/clinicas/clinicasCrear', ['clinica' => $clinica, 'errores' => $errores]);
    }

    public static function actualizar(Router $router){
        session_start();
        isAuth();

        $id = validarORedireccionar('/configuracion');

        //Consulta datos de propiedad
        $clinica = Clinica::find($id);

        //Declaro Variable de errores de validacion de formulario
        $errores = Clinica::getErrores();

        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST['clinica'];
            

            $clinica->sincronizar($args);
            
            $clinica->prescription = isset($_POST['clinica']['prescription']) ? 1 : 0;
            $clinica->xray = isset($_POST['clinica']['xray']) ? 1 : 0;
            $clinica->airevac = isset($_POST['clinica']['airevac']) ? 1 : 0;

            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores
            $errores = $clinica->validar();
            
            //Generar Nombre Unico
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg" ;

            //Realizar resize a la imagen con intervention
            if($_FILES['clinica']['tmp_name']['image']){

                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['clinica']['tmp_name']['image'])->cover(800,600);  
            
                $clinica->setImagen($nombreImagen);
            }

            if(empty($errores)){

                // Guarda la imagen en el servidor
                if(isset($image)) {
                    $image ->save(CARPETA_IMAGENES.$nombreImagen);
                }

                
                $clinica->guardar();

                header('Location: /clinicas/listado?resultado=2');
                
            }

            
            
        }

        $router->render('admin/sitio/clinicas/clinicasActualizar', ['clinica' => $clinica, 'errores' => $errores]);
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
                    
                    $clinica = Clinica::find($id);
                    
                    //Eliminar 
                    $clinica->eliminar();

                   
                    header('Location: /clinicas/listado?resultado=3');
                    
            
                        
                }
                
                
    
                
            }
        }
    }

}