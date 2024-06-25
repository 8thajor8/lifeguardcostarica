<?php

namespace Model;

class Testimonial extends ActiveRecord{

    protected static $tabla = 'testimonials';
    protected static $columnasBD = ['id','name','review'];

    public $id;
    public $name;
    public $review;
    
    

    public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->review = $args['review'] ?? '';
        
        

    }

    public function validar(){

        if(!$this->name){
            self::$errores[] = "Debes añadir un nombre";
            
        }
        

        if(!$this->review){
            self::$errores[] = "Debes añadir una reseña";
            
        }

       
        

        
        return self::$errores;
    }

}