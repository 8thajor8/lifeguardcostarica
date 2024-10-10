<main class="contenedor seccion">

    <h1 class="heading_admin">Detalles Reporte# <strong><?php echo $reporte->id ?></strong></h1>
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>
    <div class="list_header">
        <div class="list_botones">
            <a href="<?php echo $listado ? '/reportes/listado' : '/pacientes/expediente?id='.$reporte->patient_id->id ?>" class="boton boton-azul"> Volver </a>
            <?php if($reporte->status === '0'){ ?>
                <a href="/reportes/actualizar?id=<?php echo $reporte->id ?>&idpatient=<?php echo $reporte->patient_id->id ?>" class="boton-amarillo">Editar</a>
            <?php } ?>
            <a href="/reportes/descargar?id=<?php echo $reporte->id ?>" target="_blank" class="boton-verde">Descargar</a>
        </div>


    <fieldset class="expediente_fieldset">
        <legend>Informacion del Reporte</legend>

        <div class="two-col">
            <div class="campo_appointments">
                <label for="patient_name">Paciente:</label>
                <p><?php echo s($reporte->patient_id->patient_name) . ' ' . s($reporte->patient_id->patient_lastname1); ?>" </p>
            </div>
            
            <div class="campo_appointments">
                <label for="id_number">#Pasaporte o ID:</label>
                <p><?php echo s($reporte->patient_id->id_number); ?></p>
            </div>
            
            <div class="campo_appointments">
                <label for="doctor">Doctor:</label>
                <p><?php echo $reporte->doctor->user_titulo->nombre . ' ' . $reporte->doctor->nombre ?></p>
            </div>
            

        </div>
        
        <div class="two-col">
            <div class="campo_appointments">
                <label for="diagnostico">Diagnostico:</label>
                <?php foreach($reporte->diagnostico as $index => $diagnostico){ ?>
                    <p><?php echo ($index + 1 . '. '. $diagnostico); ?></p>
                <?php } ?>
            </div>

             <div class="campo_appointments"> 
                <label for="status">Estado:</label>
                    <div class="boton_container" style="justify-content:flex-start"><p class=" status <?php echo intval($reporte->status) === 1 ? 'status-finished' : 'status-cancelled status_label' ?>"
                        data-id="<?php echo $reporte->id; ?>" 
                        <?php if($reporte->status === '0'){ ?>
                        onclick="(()=> mostrarModal(<?php echo $reporte->id; ?>))();"
                        <?php } ?>
                    >
                        <?php echo intval($reporte->status) === 1 ? 'FIRMADO' : 'NO FIRMADO' ?>
                                    
                    </p>
                    </div>
                            
                            
            
        </div>
            
      
    </fieldset>

    <div class="contenedor_listado_expediente">
        <fieldset class="expediente_fieldset">
            <legend>Historial de Modificaciones</legend>
            <?php if($addendums) { ?>
            
                <table class="listado_expediente">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Creado</th>
                            
                            
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($addendums as $addendum): ?>
                        <tr>
                            <td><?php echo $addendum->doctor->user_titulo->nombre . ' ' . $addendum->doctor->nombre ?></td>
                            
                            <td><?php 
                            $date = new DateTime($addendum->date_addendum);
                            $meses = [
                                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                            ];
                            $dia = $date->format('d');
                            $mes = $meses[(int)$date->format('m') - 1];
                            $anio = $date->format('Y');
                            echo ($dia . ' de ' . $mes . ' de ' . $anio . ' - ' .  date("H:i", strtotime($addendum->time_addendum))); ?></td> 
                            
                            <td><?php echo $addendum->date_created ?></td>
                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            
            <?php }else{ ?>

                <p>No hay notas de evolucion medica para mostrar.</p>

            <?php } 

            if($reporte->status === '0'){ ?>
            <div class="boton_container">
                <a href="/addendum/crear?id=<?php echo $reporte->id ?>" class="boton-azul-flex">Nuevo Addendum</a>
            </div>
            <?php } ?>
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

                    <p>Usted esta subiendo el reporte firmado para:  <span class="paciente_notas"> <?php echo $reporte->patient_id->patient_name . ' ' . $reporte->patient_id->patient_lastname1 ?></span></p>

                    <input type="file" name="verified_report" id="verified_report" accept="application/pdf">

                    
                </div>
                <div class="contenedor_button_modal">
                    <button type="submit">Subir Archivo</button>
                </div>
            </form>

        </div>
    </div>

</main>