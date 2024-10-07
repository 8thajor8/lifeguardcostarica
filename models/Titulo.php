<?php

namespace Model;

class Titulo extends ActiveRecord {
    
    protected static $tabla = 'titulos';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;

    

}