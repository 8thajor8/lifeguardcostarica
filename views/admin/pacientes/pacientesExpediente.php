<main class="contenedor seccion">

    <h1 class="heading_admin">Expediente Paciente</h1>
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>
    <div class="list_header">
        <div class="list_botones">
            <a href="/pacientes/listado" class="boton boton-azul"> Volver </a>
            <a href="/pacientes/actualizar?id=<?php echo $paciente->id ?>" class="boton-amarillo">Editar</a>
        </div>
    </div>


    <fieldset class="expediente_fieldset">
        <legend>Informacion del Paciente</legend>

        <div class="two-col">
            <div class="campo_appointments">
                <label for="patient_name">Nombre:</label>
                <p><?php echo s($paciente->patient_name); ?> </p>
            </div>
            
            <div class="campo_appointments">
                <label for="patient_lastname1">Apellido 1:</label>
                <p><?php echo s($paciente->patient_lastname1); ?></p>
            </div>
            
            <div class="campo_appointments">
                <label for="patient_lastname2">Apellido 2:</label>
                <p><?php echo s($paciente->patient_lastname2); ?></p>
            </div>
            
            <div class="campo_appointments">
                <label for="dob">Fecha Nac.:</label>
                <p>
                    <?php 
                        $date = new DateTime($paciente->dob);
                        $meses = [
                            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ];
                        $dia = $date->format('d');
                        $mes = $meses[(int)$date->format('m') - 1];
                        $anio = $date->format('Y');
                        echo ($dia . ' de ' . $mes . ' de ' . $anio); ?>
                </p>
            </div>

            <div class="campo_appointments">
                <label >Edad:</label>
                <p>
                     <?php 
                    // Get the patient's birth date and calculate the age
                    $dob = new DateTime($paciente->dob); // Convert dob to DateTime
                    $today = new DateTime(); // Get today's date
                    $age = $today->diff($dob)->y; // Calculate the age difference in years

                    echo s($age); // Safely output the calculated age
                    ?> años
                </p>
            </div>
        </div>
        
        <div class="two-col">
            <div class="campo_appointments">
                <label for="id_type">Tipo ID:</label>
                <?php if($paciente->id_type == 'passport'){ ?>
                    <p>Passport</p>
                <?php }elseif($paciente->id_type == 'costarica'){ ?>
                    <p>Costa Rica</p>
                <?php }else{ ?>
                    <p>DIMEX (Resident)</p>
                <?php } ?>
            </div>
            
            <div class="campo_appointments">
                <label for="id_number">#Pasaporte o ID:</label>
                <p><?php echo s($paciente->id_number); ?></p>
            </div>
            
            <div class="campo_appointments">
            <label for="gender">Genero:</label>
                <?php if($paciente->gender == 'male'){ ?>
                    <p>Masculino</p>
            
                <?php }else{ ?>
                    <p>Femenino</p>
                <?php } ?>
            </div>
            
            <div class="campo_appointments">
                <label for="nationality">Nacionalidad:</label>
                <p><?php echo s($paciente->nationality); ?></p>
            </div>
        </div>
            
        <div class="two-col">
            <div class="campo_appointments">
                <label for="email">Email:</label>
                <p><?php echo s($paciente->email); ?><p>
            </div>
            
            <div class="campo_appointments">
                <label for="phone">Telefono:</label>
                <p><?php echo s($paciente->phone); ?><p>
            </div>

            <div class="campo_appointments">
                <label for="city">Ciudad de Origen:</label>
                <p><?php echo s($paciente->city); ?><p>
            </div>
            
            <div class="campo_appointments">
                <label for="country">Pais de Origen:</label>
                <p><?php echo s($paciente->country); ?><p>
            </div>
        </div>
    </fieldset>

    <div class="contenedor_listado_expediente">
        <fieldset class="expediente_fieldset">
            <legend>Historial de Reportes</legend>
            <?php if($reportes) { ?>
            
                <table class="listado_expediente">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Status</th>
                            <th>Fecha Creacion</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($reportes as $reporte): ?>
                        <tr>
                            <td><?php echo $reporte->doctor->user_titulo->nombre . ' ' . $reporte->doctor->nombre ?></td>
                            
                            <td><?php 
                            $date = new DateTime($reporte->date_report);
                            $meses = [
                                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                            ];
                            $dia = $date->format('d');
                            $mes = $meses[(int)$date->format('m') - 1];
                            $anio = $date->format('Y');
                            echo ($dia . ' de ' . $mes . ' de ' . $anio . ' - ' .  date("H:i", strtotime($reporte->time_report))); ?></td> 
                            
                            <td ><span 
                                    class=" status <?php echo intval($reporte->status) === 1 ? 'status-finished' : 'status-cancelled status_label' ?>"
                                    data-id="<?php echo $reporte->id; ?>" 
                                    <?php if($reporte->status === '0'){ ?>
                                    onclick="(()=>mostrarModal(<?php echo $reporte->id; ?>, '<?php echo $reporte->patient_id->patient_name . ' '  . $reporte->patient_id->patient_lastname1 ?>'))();"
                                    <?php } ?>
                                >
                                    <?php echo intval($reporte->status) === 1 ? 'FIRMADO' : 'NO FIRMADO' ?>
                                    
                                </span></td>
                            
                            <td><?php echo $reporte->date_created ?></td>
                            
                            <td>
                                <a href="/reportes/expediente?id=<?php echo $reporte->id ?>" class="boton-amarillo-flex">Detalles</a>
                                <?php if (intval($reporte->status) === 0){ ?>                             
                                    <a href="/reportes/descargar?id=<?php echo $reporte->id ?>" target="_blank" class="boton-verde-flex">Descargar</a>

                                <?php }else{ ?>
                                    <a href="/report_files/<?php echo $reporte->firmado_id; ?>" target="_blank" class="boton-verde-flex">Descargar Firmado</a>
                                <?php }; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            
            <?php }else{ ?>

                <p>Aun no hay reportes para mostrar</p>

            <?php } ?>
            <div class="boton_container">
                <a href="/reportes/crear?id=<?php echo $paciente->id ?>"  class="boton-verde-flex">Nuevo Reporte</a>
            </div>
            
        </fieldset>
    </div>

    <div id="uploadModal" class="modal">
        <div class="modal-content-admin modal-content-admin-upload">
            <span class="close">&times;</span>
            <h2>Firmar Reporte medico</h2>
                
            <form  class="formulario_modal" method="POST" action='/reportes/listado' enctype="multipart/form-data">
                
                <input type="hidden" name="reporte_id" id="reporte_id" value="">
                <input type="hidden" name="from_patient" id="from_patient" value="1">
                <div class=" campo_modal">
                    <p><span class="titulo_notas">Notas importantes:</span></p>
                    <p>Este sistema no efectua la firma digital del reporte medico. El mismo debe descargarse una vez creado, firmarse digitalmente con las credenciales y PIN asignado, y luego utilizar esta pantalla para subir el archivo <strong>YA FIRMADO</strong>.</p>
                    <p>Verificar correctamente que se este subiendo el archivo correspondiente y que los datos en el reporte sean correctos ya que, una vez subido, el reporte medico no admitira mas modificaciones.</p>

                    <p>Usted esta subiendo el reporte firmado para:  <span class="paciente_notas"> </span></p>

                    <input type="file" name="verified_report" id="verified_report" accept="application/pdf">

                    
                </div>
                <div class="contenedor_button_modal">
                    <button type="submit">Subir Archivo</button>
                </div>
            </form>

        </div>
    </div>

</main>