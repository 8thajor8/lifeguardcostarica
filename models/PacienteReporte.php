<?php

namespace Model;

class PacienteReporte extends ActiveRecord {
    protected static $tabla = 'pacientes_reportes';
    protected static $columnasBD = ['id', 'patient_id','reporte_id'];

    public $id;
    public $patient_id;
    public $reporte_id;
        
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->patient_id = $args['patient_id'] ?? '';
        $this->reporte_id = $args['reporte_id'] ?? '';
        
    }

   
}