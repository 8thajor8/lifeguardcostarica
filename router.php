<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];
    
    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }


    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION['login'] ?? NULL ;

        $rutas_protegidas = [];

        if (isset($_SERVER['PATH_INFO'])) {
            $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        } else {
            $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }
         
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        } else{
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        if(in_array($urlActual, $rutas_protegidas) && !$auth){

            header( 'Location: /');
        }

        if($fn){
            //La URL existe
            
            call_user_func($fn,$this);

        } else{
            echo "La pagina no existe";
        }
       

    }

    public function render($view, $datos = []){
        
        foreach( $datos as $key=>$value){
            $$key = $value;
        }

        
        ob_start(); //inicia almacenamiento en memoria

        include __DIR__ . "/views/$view" . ".php";

        $contenido = ob_get_clean(); //limpia memoria
        
        include __DIR__ . "/views/layout.php";
    
    }


}