<?php

namespace Model;

class Reporte extends ActiveRecord{

    protected static $tabla = 'reportes';
    protected static $columnasBD = ['id', 'patient_name', 'patient_lastname1', 'patient_lastname2', 'dob', 'id_type', 'id_number', 'gender', 'nationality', 'email', 'phone', 'city', 'country',
    
    'date_report', 'time_report', 'location', 
    
    'time_1', 'lpm_1', 'mmhg_1', 'rpm_1', 'temperature_1', 'saturation_1', 'mgdl_1', 'glasgow_1',
    
    'time_2', 'lpm_2', 'mmhg_2', 'rpm_2', 'temperature_2', 'saturation_2', 'mgdl_2', 'glasgow_2',
    
    'time_3', 'lpm_3', 'mmhg_3', 'rpm_3', 'temperature_3', 'saturation_3', 'mgdl_3', 'glasgow_3',
    
    'time_4', 'lpm_4', 'mmhg_4', 'rpm_4', 'temperature_4', 'saturation_4', 'mgdl_4', 'glasgow_4',
    
    'antecedentes', 'motivo', 'padecimiento', 'objetivo', 'analisis', 'diagnostico', 'plan', 'doctor', 'status',
    
    'firmado_id'];
    

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
    
    public $date_report;
    public $time_report;
    public $location;
    
    public $time_1;
    public $lpm_1;
    public $mmhg_1;
    public $rpm_1;
    public $temperature_1;
    public $saturation_1;
    public $mgdl_1;
    public $glasgow_1;
    
    public $time_2;
    public $lpm_2;
    public $mmhg_2;
    public $rpm_2;
    public $temperature_2;
    public $saturation_2;
    public $mgdl_2;
    public $glasgow_2;
    
    public $time_3;
    public $lpm_3;
    public $mmhg_3;
    public $rpm_3;
    public $temperature_3;
    public $saturation_3;
    public $mgdl_3;
    public $glasgow_3;
    
    public $time_4;
    public $lpm_4;
    public $mmhg_4;
    public $rpm_4;
    public $temperature_4;
    public $saturation_4;
    public $mgdl_4;
    public $glasgow_4;
    
    public $antecedentes;
    public $motivo;
    public $padecimiento;
    public $objetivo;
    public $analisis;
    public $diagnostico;
    public $plan;
    public $doctor;
    public $status;

    public $firmado_id;
    
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

        $this->date_report = $args['date_report'] ?? '';
        $this->time_report = $args['time_report'] ?? '';
        $this->location = $args['location'] ?? '';

        $this->time_1 = $args['time_1'] ?? '';
        $this->lpm_1 = $args['lpm_1'] ?? '';
        $this->mmhg_1 = $args['mmhg_1'] ?? '';
        $this->rpm_1 = $args['rpm_1'] ?? '';
        $this->temperature_1 = $args['temperature_1'] ?? '';
        $this->saturation_1 = $args['saturation_1'] ?? '';
        $this->mgdl_1 = $args['mgdl_1'] ?? '';
        $this->glasgow_1 = $args['glasgow_1'] ?? '';

        $this->time_2 = $args['time_2'] ?? '';
        $this->lpm_2 = $args['lpm_2'] ?? '';
        $this->mmhg_2 = $args['mmhg_2'] ?? '';
        $this->rpm_2 = $args['rpm_2'] ?? '';
        $this->temperature_2 = $args['temperature_2'] ?? '';
        $this->saturation_2 = $args['saturation_2'] ?? '';
        $this->mgdl_2 = $args['mgdl_2'] ?? '';
        $this->glasgow_2 = $args['glasgow_2'] ?? '';

        $this->time_3 = $args['time_3'] ?? '';
        $this->lpm_3 = $args['lpm_3'] ?? '';
        $this->mmhg_3 = $args['mmhg_3'] ?? '';
        $this->rpm_3 = $args['rpm_3'] ?? '';
        $this->temperature_3 = $args['temperature_3'] ?? '';
        $this->saturation_3 = $args['saturation_3'] ?? '';
        $this->mgdl_3 = $args['mgdl_3'] ?? '';
        $this->glasgow_3 = $args['glasgow_3'] ?? '';

        $this->time_4 = $args['time_4'] ?? '';
        $this->lpm_4 = $args['lpm_4'] ?? '';
        $this->mmhg_4 = $args['mmhg_4'] ?? '';
        $this->rpm_4 = $args['rpm_4'] ?? '';
        $this->temperature_4 = $args['temperature_4'] ?? '';
        $this->saturation_4 = $args['saturation_4'] ?? '';
        $this->mgdl_4 = $args['mgdl_4'] ?? '';
        $this->glasgow_4 = $args['glasgow_4'] ?? '';
        
        $this->antecedentes = $args['antecedentes'] ?? '';
        $this->motivo = $args['motivo'] ?? '';
        $this->padecimiento = $args['padecimiento'] ?? '';
        $this->objetivo = $args['objetivo'] ?? '';
        $this->analisis = $args['analisis'] ?? '';
        $this->diagnostico = $args['diagnostico'] ?? '';
        $this->plan = $args['plan'] ?? '';
        $this->doctor = $args['doctor'] ?? '';
        
        $this->status = $args['status'] ?? '';
        $this->firmado_id = $args['firmado_id'] ?? '';
        
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

        if(!$this->date_report){
            self::$errores[] = "La fecha es obligatoria";
        }

        if(!$this->time_report){
            self::$errores[] = "La hora es obligatoria";
        }

        if(!$this->location){
            self::$errores[] = "La ubicacion es obligatoria";
        }

        if(!$this->motivo){
            self::$errores[] = "El motivo de consulta es obligatorio";
        }

        if(!$this->diagnostico){
            self::$errores[] = "El diagnostico de consulta es obligatorio";
        }

        if(!$this->plan){
            self::$errores[] = "El plan de consulta es obligatorio";
        }

        if(!$this->doctor){
            self::$errores[] = "El doctor de consulta es obligatorio";
        }

        

       
        return self::$errores;
    }

    public function validarFirma(){

         if(!$this->firmado_id){
            self::$errores[] = "El archivo firmado es obligatorio";
        }

        return self::$errores;
    }
}