<?php

namespace Controllers;
use MVC\Router;
use Model\Testimonial;


class TestimonialsController{

    public static function listado(Router $router){

        $testimonials = Testimonial::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/sitio/testimoniales/testimonialesListado', ['testimonials' => $testimonials, 'resultado' => $resultado]);

    }

    public static function crear(Router $router){

        $testimonial = new Testimonial();
        
        $errores = Testimonial::getErrores();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            
            $testimonial = new Testimonial($_POST['testimonial']);
            
            
            
            //Valido errores
            $errores = $testimonial->validar();
            
            //Si no hay errores, ejecuto el query
            if(empty($errores)){
    
                $testimonial->guardar();
    
                header('Location: /testimoniales/listado?resultado=1');
                    
            }
    
        }

        $router->render('admin/sitio/testimoniales/testimonialesCrear', ['testimonial' => $testimonial, 'errores' => $errores]);
    }

    public static function actualizar(Router $router){

        $id = validarORedireccionar('/configuracion');

        //Consulta datos de propiedad
        $testimonial = Testimonial::find($id);

        //Declaro Variable de errores de validacion de formulario
        $errores = Testimonial::getErrores();

        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST['testimonial'];
            

            $testimonial->sincronizar($args);
            
            

            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores
            $errores = $testimonial->validar();
            
            
            if(empty($errores)){

                $testimonial->guardar();

                header('Location: /testimoniales/listado?resultado=2');
                
            }

            
            
        }

        $router->render('admin/sitio/testimoniales/testimonialesActualizar', ['testimonial' => $testimonial, 'errores' => $errores]);
    }

    public static function eliminar(Router $router){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' ){
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    
                    $testimonial = Testimonial::find($id);
                    
                    //Eliminar 
                    $testimonial->eliminar();

                   
                    header('Location: /testimoniales/listado?resultado=3');
                    
            
                        
                }
                
                
    
                
            }
        }
    }

}