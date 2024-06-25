<?php

namespace Controllers;
use MVC\Router;
use Model\Servicio;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class ServiciosController{

    public static function listado(Router $router){

        $servicios = Servicio::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/sitio/servicios/serviciosListado', ['servicios' => $servicios, 'resultado' => $resultado]);

    }

    public static function crear(Router $router){

        $servicio = new Servicio();
        
        $errores = Servicio::getErrores();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            
            $servicio = new Servicio($_POST['servicio']);
            
            //Generar Nombre Unico
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg" ;
            
            //Realizar resize a la imagen con intervention
            if($_FILES['servicio']['tmp_name']['image']){
    
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['servicio']['tmp_name']['image'])->cover(800,600);  
                
                $servicio->setImagen($nombreImagen);
                
            }
            
            //Valido errores
            $errores = $servicio->validar();
            
            //Si no hay errores, ejecuto el query
            if(empty($errores)){
    
                //Crear carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
    
                // Guarda la imagen en el servidor
                
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                   
                $servicio->guardar();
    
                
                header('Location: /servicios/listado?resultado=1');
                    
            }
    
        }

        $router->render('admin/sitio/servicios/serviciosCrear', ['servicio' => $servicio, 'errores' => $errores]);
    }

    public static function actualizar(Router $router){

        $id = validarORedireccionar('/configuracion');

        //Consulta datos de propiedad
        $servicio = Servicio::find($id);

        //Declaro Variable de errores de validacion de formulario
        $errores = Servicio::getErrores();

        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST['servicio'];
            

            $servicio->sincronizar($args);
            
            

            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores
            $errores = $servicio->validar();
            
            //Generar Nombre Unico
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg" ;

            //Realizar resize a la imagen con intervention
            if($_FILES['servicio']['tmp_name']['image']){

                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['servicio']['tmp_name']['image'])->cover(800,600);  
            
                $servicio->setImagen($nombreImagen);
            }

            if(empty($errores)){

                // Guarda la imagen en el servidor
                if(isset($image)) {
                    $image ->save(CARPETA_IMAGENES.$nombreImagen);
                }

                
                $servicio->guardar();

                header('Location: /servicios/listado?resultado=2');
                
            }

            
            
        }

        $router->render('admin/sitio/servicios/serviciosActualizar', ['servicio' => $servicio, 'errores' => $errores]);
    }

    public static function eliminar(Router $router){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' ){
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    
                    $servicio = Servicio::find($id);
                    
                    //Eliminar 
                    $servicio->eliminar();

                   
                    header('Location: /servicios/listado?resultado=3');
                    
            
                        
                }
                
                
    
                
            }
        }
    }

}