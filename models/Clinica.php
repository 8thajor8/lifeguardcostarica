<?php

namespace Model;

class Clinica extends ActiveRecord{

    protected static $tabla = 'clinicas';
    protected static $columnasBD = ['id','name','description','region','prescription','xray','airevac','link','image'];

    public $id;
    public $name;
    public $description;
    public $region;
    public $prescription;
    public $xray;
    public $airevac;
    public $link;
    public $image;
    

    public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->region = $args['region'] ?? '';
        $this->prescription = $args['prescription'] ?? '';
        $this->xray = $args['xray'] ?? '';
        $this->airevac = $args['airevac'] ?? '';
        $this->link = $args['link'] ?? '';
        $this->image = $args['image'] ?? '';
        

    }

    public function validar(){

        if(!$this->name){
            self::$errores[] = "Debes añadir un nombre";
            
        }
        

        if(!$this->description){
            self::$errores[] = "Debes añadir una descripcion";
            
        }
        

        if(!$this->region){
            self::$errores[] = "Debes añadir una region";
          
        }

        if(!$this->link){
            self::$errores[] = "Debes añadir un link";
          
        }

        if(!$this->image){
            self::$errores[] = "Debes añadir una imagen";
          
        }
        

        
        return self::$errores;
    }
    
}
