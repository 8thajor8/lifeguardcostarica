<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;


class UsuariosController{

    public static function login(Router $router){
        
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario = new Usuario($_POST);

            $errores = $usuario->validarLogin();

            if(empty($errores)){

                $usuario = Usuario::where('email', $usuario->email);

                if(!$usuario){
                    Usuario::setAlerta('El usuario no existe');
                    
                } else{
                    //el usuario existe
                    if(password_verify($_POST['password'], $usuario->password)){
                        
                        //Inicio Sesion
                        session_start();
                        $_SESSION['id'] = $usuario->id; 
                        $_SESSION['nombre'] = $usuario->nombre; 
                        $_SESSION['email'] = $usuario->email; 
                        $_SESSION['login'] = true; 

                        //Redireccionar
                        header('Location: /configuracion');

                    } else{
                        Usuario::setAlerta('El password es incorrecto');
                    }
                }
            }
        }
        
        $errores= Usuario::getErrores();
        $router->render('admin/login', ['errores' => $errores]);

    }

    public static function crear(Router $router){

        $usuario = new Usuario();
        
        $errores = Usuario::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            
            $usuario->sincronizar($_POST);
            
            $errores = $usuario->validarNuevaCuenta();
            
            if(empty($errores)){
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario){
                    Usuario::setAlerta('El usuario ya esta registrado');
                    $errores = Usuario::getErrores();
                }else{
                    //Hashear el password
                    $usuario->hashPassword();
                    
                    //Crear nuevo usuario
                    $resultado = $usuario->guardar();

                    
                    if($resultado){
                        header('Location: /configuracion');
                    }
                }
            }

        }

        $router->render('admin/usuarios/usuariosCrear', ['usuario'=>$usuario, 'errores'=>$errores]);
        
    }

}