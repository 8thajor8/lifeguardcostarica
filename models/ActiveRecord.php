<?php

namespace Model;

class ActiveRecord{

    //base de datos
    protected static $db;
    protected static $columnasBD = [];
    protected static $tabla = '';
    //Validacion de errores
    protected static $errores = [];


    

    public function guardar(){
        
        
        if(isset($this->id)){ //si hay ID, es decir, estoy actualizando

            $resultado = $this->actualizar();

        } else{ //sino, estoy creando uno nuevo

            $resultado = $this->crear();

        }

        return $resultado;

    }

    public function crear(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        //Insertar en base de datos
        $query = " INSERT INTO " . static::$tabla . " ( "; //el "static:: se utiliza para usar la variable $tabla de la clase que estoy usando
        $query .= join(', ', array_keys($atributos)); //utilizo el metodo join y array keys para poder transformar todos los keys del array atributos y separarlos con una coma y espacio
        $query .= ") VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ' )";
        
        $resultado = self::$db->query($query);

        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
         ];

        
        
    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value){
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE " .  static::$tabla . " SET ";
        $query .= join (', ', $valores);
        $query .= " WHERE id = " . self::$db->escape_string($this->id);

        $resultado = self::$db->query($query);

        

    }

    //Definir conexion
    public static function setDB($database){

        self::$db = $database;

    }

    //Identificar y unir atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasBD as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        
        return $atributos;
    }

    //Sanitizar datos
    public function sanitizarAtributos(){

        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value){

            $sanitizado[$key] = self::$db->escape_string($value);
        }
        
        return $sanitizado;

    }

    //Subida de Archivos
    public function setImagen($imagen){

        //Elimina imagen previa
        if($this->id){ //si existe un ID, es decir, si estamos editando y no creando
            
            $this->borrarImagen();
            
        }
        if($imagen){
            //Asignar al atributo el nombre de la imagen
            $this->image = $imagen;
        }

    }

    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->image); //verifica que exista el archivo en la carpeta de imagenes
            
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->image);
        }
    }

    //Validar Datos
    public static function getErrores(){
        
        return static::$errores;
    }

    public function validar(){

        static::$errores = [];
        return self::$errores;
    }

    //Busca todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla . " ";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca el registro por ID
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id ";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); //uso array shift para hacer un return del primer resultado del arreglo de resultados
    }

     // Busqueda Where con Columna 
     public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);

        }

        //Liberar memoria
        $resultado->free();

        //Retornar resultados
        return $array;

    }

    public static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key=> $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public function sincronizar($args = []){

        foreach($args as $key => $value){

            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    public function eliminar(){

        $query = "DELETE FROM " . static::$tabla . " WHERE id = $this->id";
        $this->borrarImagen();
        $resultado = self::$db->query($query);
        
        
    }

    public static function setAlerta($mensaje) {
        static::$errores[] = $mensaje;
    }
   

    
}