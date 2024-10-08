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
        $query = "INSERT INTO " . static::$tabla . " ("; //el "static:: se utiliza para usar la variable $tabla de la clase que estoy usando
        $query .= join(', ', array_keys($atributos)); //utilizo el metodo join y array keys para poder transformar todos los keys del array atributos y separarlos con una coma y espacio
        $query .= ") VALUES (";

        $values = [];
        foreach ($atributos as $value) {
            // Add the value directly if it's NULL, otherwise wrap it in quotes
            $values[] = is_null($value) || $value == ''? "NULL" : "'$value'";
        }

        $query .= join(', ', $values);
        $query .= ")";
        
        $resultado = self::$db->query($query);

        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
         ];

        
        
    }

    public function actualizar() {
        // Sanitize the data
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {

            if ($key === 'password' && empty($value)) {
                continue; // Skip updating password if it's empty
            }
            // Handle NULL values and empty strings
            if (is_null($value) || $value === '') {
                $valores[] = "$key = NULL"; // Set the field to NULL
            } else {
                $valores[] = "$key = '$value'"; // Use quotes for non-null values
            }
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = " . self::$db->escape_string($this->id);
       
        // Execute the query and return the result
        $resultado = self::$db->query($query);

        return [
            'resultado' => $resultado,
            'affected_rows' => self::$db->affected_rows // Optional: Return affected rows
        ];
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

            $sanitizado[$key] = is_null($value) ? NULL : self::$db->escape_string($value);
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

    // Obtener todos los Registros
    public static function all($orden = 'DESC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id ${orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
    // Obtener todos los Registros segun algun orden
    public static function allOrder($columna, $orden = 'DESC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY ${columna} ${orden}";
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

    public static function belongsTo($columna, $valor) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
    $resultado = self::consultarSQL($query);
    return $resultado ;
    }

    public static function searchByFields($columns, $value) {
        // Sanitize input to prevent SQL injection
        $value = htmlspecialchars($value, ENT_QUOTES);

        // Build the query for multiple fields
        $conditions = [];
        foreach ($columns as $column) {
            $conditions[] = "$column LIKE '%$value%'";
        }

        // Add condition for full name search (concatenation of first and last name)
        $conditions[] = "CONCAT(patient_name, ' ', patient_lastname1) LIKE '%$value%'";

        // Create the full query
        $query = "SELECT * FROM " . static::$tabla . " WHERE (" . implode(' OR ', $conditions) . ")";
        
        
        // Execute the query
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function searchByFieldsReference($columns, $foreignTable, $foreignColumn, $foreignId, $value) {
        // Sanitize input to prevent SQL injection
        $value = htmlspecialchars($value, ENT_QUOTES);

        // Build the query for multiple fields
        $conditions = [];
        foreach ($columns as $column) {
            $conditions[] = "$foreignTable.$column LIKE '%$value%'";
        }

        // Add condition for full name search (concatenation of first and last name)
        $conditions[] = "CONCAT($foreignTable.patient_name, ' ', $foreignTable.patient_lastname1) LIKE '%$value%'";

    // Create the full query
        $query = "SELECT " . static::$tabla . ".* FROM " . static::$tabla 
            . " JOIN $foreignTable ON " . static::$tabla . ".$foreignColumn = $foreignTable.$foreignId"
            . " WHERE (" . implode(' OR ', $conditions) . ")";
        
        
        // Execute the query
        $resultado = self::consultarSQL($query);
        
        return $resultado;
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