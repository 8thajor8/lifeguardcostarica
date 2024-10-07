<?php

namespace Controllers;
use MVC\Router;
use Model\Titulo;
use Model\Usuario;


class UsuariosController{

    public static function login(Router $router){
        session_start();
        if(isset($_SESSION['login'])){
            header('Location: /configuracion');
        }

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
                        $_SESSION['admin'] = $usuario->is_admin ?? null;

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

    public static function logout(){

        session_start();
        $_SESSION = [];
        header('Location: /');
        
    }

    public static function listado(Router $router){
        session_start();
        isAuth();
        
        $usuarios = Usuario::all();
        
        foreach($usuarios as $usuario){
             $usuario->user_titulo = Titulo::find($usuario->user_titulo);
        }


        
        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/usuarios/usuariosListado', [
            'usuarios' => $usuarios,
            
            'resultado' => $resultado
        ]);

    }

    public static function crear(Router $router){
        session_start();
        isAuth();
        
        
        $titulos = Titulo::all();
        $usuario = new Usuario();
        
        $errores = Usuario::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            
            $usuario->sincronizar($_POST);
            $usuario->is_admin = isset($_POST['is_admin']) ? 1 : 0;
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
                        header('Location: /usuarios/listado?resultado=1');
                    }
                }
            }

        }

        $router->render('admin/usuarios/usuariosCrear', [
            'usuario'=>$usuario,
            'errores'=>$errores,
            'titulos'=>$titulos
        ]);
        
    }

    public static function actualizar(Router $router){
        session_start();
        isAuth();

        $id = validarORedireccionar('/configuracion');
        
        $titulos = Titulo::all();
        //Consulta datos de propiedad
        $usuario = Usuario::find($id);

        //Declaro Variable de errores de validacion de formulario
        $errores = Usuario::getErrores();

        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST;
            

            $usuario->sincronizar($args);
            
            $usuario->is_admin = isset($_POST['is_admin']) ? 1 : 0;

            if($usuario->password){
                $usuario->hashPassword();
            } 

            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores
            $errores = $usuario->validarActualizarUsuario();
            
            
            if(empty($errores)){
                
                $usuario->guardar();

                header('Location: /usuarios/listado?resultado=2');
                
            }

            
            
        }

        $router->render('admin/usuarios/usuariosActualizar', [
            'usuario' => $usuario,
            'errores' => $errores,
            'titulos' => $titulos
        ]);
    }

}