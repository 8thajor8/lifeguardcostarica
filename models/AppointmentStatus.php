<?php

namespace Model;

class AppointmentStatus extends ActiveRecord{

    protected static $tabla = 'appointmentstatus';
    protected static $columnasBD = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = []){

        $this->id = $args['id'] ?? NULL;
        $this->name = $args['name'] ?? '';
    
    }

    public function validar(){

        if(!$this->name){
            self::$errores[] = "El campo de nombre es obligatorio";
            
        }
    }
}