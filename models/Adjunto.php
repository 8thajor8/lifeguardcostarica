<?php

namespace Model;

class Adjunto extends ActiveRecord{

    protected static $tabla = 'adjuntos';
    protected static $columnasBD = ['id', 'file_id', 'description', 'reporte_id', 'date_created'];
    

    public $id;
    public $file_id;
    public $description;
    public $reporte_id;
    public $date_created;
        
    public function __construct($args = []){

        $this->id = $args['id'] ?? NULL;
        $this->file_id = $args['file_id'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->reporte_id = $args['reporte_id'] ?? '';
        $this->date_created = $args['date_created'] ?? '';
        
    }

    public function validar(){

        if(!$this->file_id){
            self::$errores[] = "El archivo adjunto es obligatorio";
            
        }
        
        if(!$this->description){
            self::$errores[] = "La descripcion es obligatoria";
        }

        
        return self::$errores;
    }
}
