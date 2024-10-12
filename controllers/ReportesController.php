<?php

namespace Controllers;
use MVC\Router;
use Model\Titulo;
use Model\Adjunto;
use Model\Reporte;
use Model\Usuario;
use Model\Addendum;
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
                    $reporte->date_signed = date('Y-m-d H:i:s');
                    $reporte->guardar();
                   
                   if($_POST['from_patient'] ==='1'){
                    
                    header('Location: /pacientes/expediente?id='.$reporte->patient_id.'&resultado=4');
                    exit();
                   }
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
        $return_to_patient = false;
        if(isset($_GET['id'])){
            $reporte->patient_id = $_GET['id'];
            $return_to_patient = true;
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $reporte = new Reporte($_POST);
            
            $timeValues = [];

            // Define an array of time field names
            $timeFields = ['time_1', 'time_2', 'time_3', 'time_4'];

            // Iterate through the time fields and check their values
            foreach ($timeFields as $field) {
                $timeValues[$field] = isset($_POST[$field]) && !empty($_POST[$field]) ? $_POST[$field] : null;
            }
            
            //Array diagnostico handling
            $diagnosticos = $_POST['diagnostico'] ?? [];
            $diagnosticosString = implode('|', $diagnosticos); // Join with a pipe
            $reporte->diagnostico = $diagnosticosString;
            
            //Array plan handling
            $planes = $_POST['plan'] ?? [];
            $planesString = implode('|', $planes); // Join with a pipe
            $reporte->plan = $planesString;
            
            //Valido errores
            $errores = $reporte->validar();
    
            //Si no hay errores, ejecuto el query
            if(empty($errores)){

                $reporte->status = 0;
                $reporte->creado_por = $_SESSION['id'];
                
                
                // Set the current timestamp for the 'created_at' field
                $reporte->date_created = date('Y-m-d H:i:s');
                $resultado = $reporte->guardar();
               
                $datos = [
                    'patient_id' => (int) $reporte->patient_id,
                    'reporte_id' => (int) $resultado['id']
                ];

                
                $reporte_paciente = new PacienteReporte($datos);
                
                $reporte_paciente->guardar();

                if($return_to_patient){
                    header('Location: /pacientes/expediente?id='.$reporte->patient_id.'&resultado=1');
                    exit();
                }
                header('Location: /reportes/listado?resultado=1');
                    
            }
    
        }
        
        $router->render('admin/reportes/reportesCrear', [
            'reporte' => $reporte,
            'errores' => $errores,
            'usuarios'=> $usuarios,
            'pacientes'=> $pacientes,
            'paciente'=> $paciente,
            'return_to_patient'=> $return_to_patient
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
        $return_to_patient = false;
        if(isset($_GET['idpatient'])){
            $reporte->patient_id = $_GET['idpatient'];
            $return_to_patient = true;
        }
        //Capturo los datos al hacer el submit
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //Asignar atributos
        
            $args = $_POST;
            

            $reporte->sincronizar($args);
            
            //Hago la validacion de los campos, si estan vacios, se envia el mensaje al array de errores
                        //Array diagnostico handling
            $diagnosticos = $_POST['diagnostico'] ?? [];
            $diagnosticosString = implode('|', $diagnosticos); // Join with a pipe
            $reporte->diagnostico = $diagnosticosString;
            
            //Array plan handling
            $planes = $_POST['plan'] ?? [];
            $planesString = implode('|', $planes); // Join with a pipe
            $reporte->plan = $planesString;
            $errores = $reporte->validar();
            
            if($reporte->status === '1'){
                $errores[] = "El reporte ya ha sido firmado y no puede ser modificado";
            }

            if(empty($errores)){

                $reporte->guardar();

                if($return_to_patient){
                    header('Location: /reportes/expediente?id='.$reporte->id.'&resultado=2');
                    exit();
                }
                header('Location: /reportes/listado?resultado=2');
            }

            
            
        }

        $router->render('admin/reportes/reportesActualizar', [
            'reporte' => $reporte,
            'usuarios'=> $usuarios,
            'pacientes'=> $pacientes,
            'errores' => $errores,
            'return_to_patient'=> $return_to_patient
        ]);
    }

    public static function expediente(Router $router){

        session_start();
        isAuth();

        $id = validarORedireccionar('/reportes/listado');
        $reporte = Reporte::find($id);
        $addendums = Addendum::belongsTo('reporte_id', $reporte->id);
        $relatedFiles = Adjunto::belongsTo('reporte_id', $reporte->id);

        $resultado = $_GET['resultado'] ?? null;
        $listado = $_GET['listado'] ?? null;
        //Consulta datos de propiedad
        
    
        $reporte->doctor = Usuario::find($reporte->doctor);
        $reporte->patient_id = Paciente::find($reporte->patient_id);
        $reporte->doctor->user_titulo = Titulo::find($reporte->doctor->user_titulo);
        $reporte->diagnostico = explode('|', $reporte->diagnostico);
        
        foreach($addendums as $addendum){
            $addendum->doctor = Usuario::find($addendum->doctor);
            $addendum->doctor->user_titulo = Titulo::find($addendum->doctor->user_titulo);
        }
        
        $router->render('admin/reportes/reportesExpediente', [
            'resultado' =>$resultado,
            'reporte' => $reporte,
            'addendums' => $addendums,
            'relatedFiles' => $relatedFiles,
            'listado' => $listado
            
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
        $reporte->diagnostico_array = explode('|', $reporte->diagnostico);
        $reporte->plan_array = explode('|', $reporte->plan);
        $reporte->addendums = Addendum::belongsTo('reporte_id', $reporte->id);
        $dob = new \DateTime($reporte->patient_id->dob); // Convert dob to DateTime
        $today = new \DateTime(); // Get today's date
        $reporte->age = $today->diff($dob)->y; // Calculate the age difference in years
        foreach($reporte->addendums as $addendum){
            $addendum->doctor = Usuario::find($addendum->doctor);
            $addendum->doctor->user_titulo = Titulo::find($addendum->doctor->user_titulo);
            $addendum->diagnostico_array = explode('|', $addendum->diagnostico);
            $addendum->plan_array = explode('|', $addendum->plan);
        }
        
        if ($reporte) {
        
        $reportPDF = new reportGenerator();
        return $reportPDF->generateReportPDF($reporte);
        }
    }

    public static function adjuntar(){


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assuming you have the database connection set up
            $file['reporte_id'] = (int)$_POST['file_reporte_id'];
            
            $file['description'] = $_POST['description'];
            
            $file = new Adjunto($file);

           
            
            $nombreFile = md5( uniqid( rand(), true) ) . ".pdf" ;
            
            
            if($_FILES['file_id']['tmp_name']){
            
                $file->file_id = $nombreFile;
            }
            $errores = $file->validar();
            
             //Si no hay errores, ejecuto el query
            if(empty($errores)){
                $file->date_created = date('Y-m-d H:i:s');
                
                //Crear carpeta
                if(!is_dir(CARPETA_RELATED_FILES)){
                    mkdir(CARPETA_RELATED_FILES);
                }
    
                if (move_uploaded_file($_FILES['file_id']['tmp_name'], CARPETA_RELATED_FILES . $nombreFile)) {
                    
                    $file->guardar();
                                    
                    header('Location: /reportes/expediente?id=' . $file->reporte_id . '&resultado=5');

                } else {
            // Handle the error for file upload failure
                    $errores[] = "Error subiendo el archivo. Verifique y vuelva a intentarlo";
                }
                    
            }
    
        };
    
    }


}

