<?php

define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');



function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

function validarTipoContenido ($tipo){
    $tipos = ['clinica', 'servicio', 'testimonial'];

    return in_array($tipo, $tipos);

}

function mostrarNotificacion ($codigo){
    
    $mensaje = '';
    $cod = intval($codigo);
    
    switch ($cod){
        case 1:
            $mensaje = "Registro creado exitosamente!";
            break;
        case 2:
            $mensaje = "Registro actualizado exitosamente!";
            break;
        case 3:
            $mensaje = "Registro eliminado exitosamente!";
            break;

        default:
            $mensaje = false;
            break;
    }
    
    return $mensaje;
    
}

function validarORedireccionar(string $url){
        //Validar URL
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header("Location: $url");
        }

        return $id;
}

function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}