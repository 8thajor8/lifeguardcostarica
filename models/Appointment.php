<?php

namespace Model;

class Appointment extends ActiveRecord{

    protected static $tabla = 'appintment';
    protected static $columnasBD = ['id', 'name', 'lastname1', 'lastname2', 'dob', 'id_type', 'id_number', 'gender', 'nationality', 'email', 'phone', 'address', 'province', 'canton', 'district', 'housecall', 'latitud', 'longitud', 'google_location', 'doses', 'have_symptoms', 'current_symptoms', 'date_symptoms', 'proximity', 'quarantined', 'conditions', 'date_appointment', 'location_appointment', 'time_appointment'];

    public $id;
    public $name;
    public $lastname1;
    public $lastname2;
    public $dob;
    public $id_type;
    public $id_number;
    public $gender;
    public $nationality;
    public $email;
    public $phone;
    public $address;
    public $province;
    public $canton;
    public $district;
    public $housecall;
    public $latitud;
    public $longitud;
    public $google_location;
    public $doses;
    public $have_symptoms;
    public $current_symptoms;
    public $date_symptoms;
    public $proximity;
    public $quarantined;
    public $conditions;
    public $date_appointment;
    public $location_appointment;
    public $time_appointment;
    

    public function __construct($args = []){

        $this->id = $args['id'] ?? NULL;
        $this->name = $args['name'] ?? '';
        $this->lastname1 = $args['lastname1'] ?? '';
        $this->lastname2 = $args['lastname2'] ?? '';
        $this->dob = $args['dob'] ?? '';
        $this->id_type = $args['id_type'] ?? '';
        $this->id_number = $args['id_number'] ?? '';
        $this->gender = $args['gender'] ?? '';
        $this->nationality = $args['nationality'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->province = $args['province'] ?? '';
        $this->canton = $args['canton'] ?? '';
        $this->district = $args['district'] ?? '';
        $this->housecall = $args['housecall'] ?? '';
        $this->latitud = $args['latitud'] ?? '';
        $this->longitud = $args['longitud'] ?? '';
        $this->google_location = $args['google_location'] ?? '';
        $this->doses = $args['doses'] ?? '';
        $this->have_symptoms = $args['have_symptoms'] ?? '';
        $this->current_symptoms = $args['current_symptoms'] ?? '';
        $this->date_symptoms = $args['date_symptoms'] ?? '';
        $this->proximity = $args['proximity'] ?? '';
        $this->quarantined = $args['quarantined'] ?? '';
        $this->conditions = $args['conditions'] ?? '';
        $this->date_appointment = $args['date_appointment'] ?? '';
        $this->location_appointment = $args['location_appointment'] ?? '';
        $this->time_appointment = $args['time_appointment'] ?? '';
        

    }
}