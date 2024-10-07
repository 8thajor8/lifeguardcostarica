<?php

namespace Model;

class Paciente extends ActiveRecord{

    protected static $tabla = 'pacientes';
    protected static $columnasBD = ['id', 'patient_name', 'patient_lastname1', 'patient_lastname2', 'dob', 'id_type', 'id_number', 'gender', 'nationality', 'email', 'phone', 'city', 'country'];

public $id;
public $patient_name;
public $patient_lastname1;
public $patient_lastname2;
public $dob;
public $id_type;
public $id_number;
public $gender;
public $nationality;
public $email;
public $phone;
public $city;
public $country;

public function __construct($args = []){

    $this->id = $args['id'] ?? NULL;
    $this->patient_name = $args['patient_name'] ?? '';
    $this->patient_lastname1 = $args['patient_lastname1'] ?? '';
    $this->patient_lastname2 = $args['patient_lastname2'] ?? '';
    $this->dob = $args['dob'] ?? '';
    $this->id_type = $args['id_type'] ?? '';
    $this->id_number = $args['id_number'] ?? '';
    $this->gender = $args['gender'] ?? '';
    $this->nationality = $args['nationality'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->city = $args['city'] ?? '';
    $this->country = $args['country'] ?? '';
    
    }

    public function validar(){

        if(!$this->patient_name){
            self::$errores[] = "El nombre del paciente es obligatorio";
            
        }
        if(!$this->patient_lastname1){
            self::$errores[] = "El apellido del paciente es obligatorio";
            
        }
        
        if(!$this->dob){
            self::$errores[] = "La fecha de nacimiento del paciente es obligatorio";
        }

        if(!$this->id_type){
            self::$errores[] = "El tipo de ID del paciente es obligatorio";
        }

        if(!$this->id_number){
            self::$errores[] = "El numero de ID del paciente es obligatorio";
        }

        if(!$this->gender){
            self::$errores[] = "El genero del paciente es obligatorio";
        }
    }


}