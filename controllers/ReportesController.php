<?php

namespace Controllers;
use MVC\Router;
use Model\Titulo;
use Model\Reporte;
use Model\Usuario;
use Model\Paciente;
use Model\PacienteReporte;
use Helper\reportGenerator;



class ReportesController{

    public static function listado(Router $router){

        session_start();
        isAuth();

        $reportes = Reporte::all();
        


        $errores = Reporte::getErrores();
        
        $searchname = $_GET['search'] ?? null;
        $status = $_GET['status'] ?? null;
        
        
        $resultado = $_GET['resultado'] ?? null;

        if (!empty($searchname)) {
            $searchname = trim($searchname); // Remove whitespace from search term
            $reportes = Reporte::searchByFieldsReference(['patient_name','patient_lastname1'], 'pacientes', 'patient_id', 'id', $searchname);     
            
        }

            // Apply status filter if provided
        if ($status !== null && $status !== '') {
            $reportes = array_filter($reportes, function($reporte) use ($status) {
                return $reporte->status === $status;
            });
            
        }

        foreach($reportes as $reporte){
            $reporte->doctor = Usuario::find($reporte->doctor);
            $reporte->patient_id = Paciente::find($reporte->patient_id);
            $reporte->creado_por = Usuario::find($reporte->creado_por);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assuming you have the database connection set up
            $id = $_POST['reporte_id'];
            $reporte = Reporte::find($id);
            
            $nombreReporte = md5( uniqid( rand(), true) ) . ".pdf" ;
            
            
            if($_FILES['verified_report']['tmp_name']){
            
                $reporte->firmado_id = $nombreReporte;
            }
            $errores = $reporte->validarFirma();

             //Si no hay errores, ejecuto el query
            if(empty($errores)){
    
                //Crear carpeta
                if(!is_dir(CARPETA_REPORTES)){
                    mkdir(CARPETA_REPORTES);
                }
    
                if (move_uploaded_file($_FILES['verified_report']['tmp_name'], CARPETA_REPORTES . $nombreReporte)) {
                    
                    $reporte->status = 1;
                    $reporte->guardar();
                   
                    header('Location: /reportes/listado?resultado=4');

                } else {
            // Handle the error for file upload failure
                    $errores[] = "Error subiendo el archivo. Verifique y vuelva a intentarlo";
                }
                    
            }
    
        };
    
        $router->render('admin/reportes/reportesListado', [
            'reportes' => $reportes,
            'resultado' => $resultado,
            'errores' => $errores
        ]);
    }

    public static function crear(Router $router){
        session_start();
        
        isAuth();

        $reporte = new Reporte();
        
        $errores = Reporte::getErrores();
        $pacientes = Paciente::allOrder('patient_name', 'ASC');
        $usuarios = Usuario::all();
        $paciente = new Paciente();
    
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $reporte = new Reporte($_POST);
            
            $timeValues = [];

            // Define an array of time field names
            $timeFields = ['time_1', 'time_2', 'time_3', 'time_4'];

            // Iterate through the time fields and check their values
            foreach ($timeFields as $field) {
                $timeValues[$field] = isset($_POST[$field]) && !empty($_POST[$field]) ? $_POST[$field] : null;
            }
            //Valido errores
            $errores = $reporte->validar();
    
            //Si no hay errores, ejecuto el query
            if(empty($errores)){

                $reporte->status = 0;
                $reporte->creado_por = $_SESSION['id'];
                
                $resultado = $reporte->guardar();
               
                $datos = [
                    'patient_id' => (int) $reporte->patient_id,
                    'reporte_id' => (int) $resultado['id']
                ];

                
                $reporte_paciente = new PacienteReporte($datos);
                
                $reporte_paciente->guardar();

                header('Location: /reportes/listado?resultado=1');
                    
            }
    
        }

        $router->render('admin/reportes/reportesCrear', [
            'reporte' => $reporte,
            'errores' => $errores,
            'usuarios'=> $usuarios,
            'pacientes'=> $pacientes,
            'paciente'=> $paciente
        ]);
    }

    public static function actualizar(Router $router){

        session_start();
        isAuth();

        $id = validarORedireccionar('/reportes/listado');

        //Consulta datos de propiedad
        $reporte = Reporte::find($id);
        $errores = Reporte::getErrores();
        $pacientes = Paciente::all();
        $usuarios = Usuario::all();

        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST;
            

            $reporte->sincronizar($args);
            
            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores

            $errores = $reporte->validar();
            
            

            if(empty($errores)){

                $reporte->guardar();

                
                header('Location: /reportes/listado?resultado=2');
            }

            
            
        }

        $router->render('admin/reportes/reportesActualizar', [
            'reporte' => $reporte,
            'usuarios'=> $usuarios,
            'pacientes'=> $pacientes,
            'errores' => $errores
        ]);
    }

    public static function descargar(Router $router) {
        session_start();
        isAuth();

        $id = validarORedireccionar('/reportes/listado');

        //Consulta datos de propiedad
        $reporte = Reporte::find($id);
        $reporte->doctor = Usuario::find($reporte->doctor);
        $reporte->patient_id = Paciente::find($reporte->patient_id);
        $reporte->doctor->user_titulo = Titulo::find($reporte->doctor->user_titulo);
        if ($reporte) {
        
        $reportPDF = new reportGenerator();
        return $reportPDF->generateReportPDF($reporte);
        }
    }

}