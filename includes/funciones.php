<?php

define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
define('CARPETA_REPORTES', $_SERVER['DOCUMENT_ROOT'] . '/report_files/');
define('CARPETA_RELATED_FILES', $_SERVER['DOCUMENT_ROOT'] . '/related_files/');



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
    $tipos = ['clinica', 'servicio', 'testimonial', 'status'];

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
        case 4:
            $mensaje = "Reporte subido exitosamente!";
            break;
        case 5:
            $mensaje = "Adjunto subido exitosamente!";
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

function is_admin(): bool{
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);

}