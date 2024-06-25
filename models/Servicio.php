<?php

namespace Model;

class Servicio extends ActiveRecord{

    protected static $tabla = 'servicios';
    protected static $columnasBD = ['id','name','description', 'availability','image'];

    public $id;
    public $name;
    public $description;
    public $availability;   
    public $image;
    

    public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->availability = $args['availability'] ?? '';
        $this->image = $args['image'] ?? '';
        

    }

    public function validar(){

        if(!$this->name){
            self::$errores[] = "Debes añadir un nombre";
            
        }
        

        if(!$this->description){
            self::$errores[] = "Debes añadir una descripcion";
            
        }

        if(!$this->availability){
            self::$errores[] = "Debes añadir el tipo de disponibilidad";
            
        }
        

        
        if(!$this->image){
            self::$errores[] = "Debes añadir una imagen";
          
        }
        

        
        return self::$errores;
    }

}