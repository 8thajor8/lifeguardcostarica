<?php

namespace Model;

class Usuario extends ActiveRecord{

    protected static $tabla = 'usuarios';
    protected static $columnasBD = ['id', 'nombre', 'email', 'password','user_titulo','user_especialidad','user_codigo','is_admin'];

    public $id;
    public $nombre;
    public $email;
    public $password;   
    public $user_titulo;   
    public $user_especialidad;   
    public $user_codigo;   
    public $is_admin;   
    

    public function __construct( $args = []){
        
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->user_titulo = $args['user_titulo'] ?? '';
        $this->user_especialidad = $args['user_especialidad'] ?? '';
        $this->user_codigo = $args['user_codigo'] ?? '';
        $this->is_admin = $args['is_admin'] ?? '';
        
        
    }

    public function validarLogin(){
        
        if(!$this->email){
            self::$errores[] = 'El email es obligatiorio';
        }else{
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
           
                self::$errores[] = 'Email no valido';  
            }
        }
       
        if(!$this->password){
            self::$errores[] = 'El password del Usuario es obligatorio';
        }

        return self::$errores;
    }

    public function validarNuevaCuenta(){

        if(!$this->nombre){
            self::$errores[] = 'El nombre del Usuario es obligatorio';
        }

        if(!$this->user_titulo){
            self::$errores[] = 'El titulo del Usuario es obligatorio';
        }

        if(!$this->email){
            self::$errores[] = 'El email del Usuario es obligatorio';
        }

        if(!$this->password){
            self::$errores[] = 'El password del Usuario es obligatorio';
        } elseif(strlen($this->password) < 6){

            self::$errores[] = 'El password debe contener al menos 6 caracteres';

        } 

        return self::$errores;
    }
    public function validarActualizarUsuario(){

        if(!$this->nombre){
            self::$errores[] = 'El nombre del Usuario es obligatorio';
        }

        if(!$this->user_titulo){
            self::$errores[] = 'El titulo del Usuario es obligatorio';
        }

        if(!empty($this->password) && strlen($this->password) < 6){
        
            self::$errores[] = 'El password debe contener al menos 6 caracteres';
        } 

        return self::$errores;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
}