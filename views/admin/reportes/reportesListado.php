<main class="listado_appointments seccion">

    <h1>Reportes Medicos</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>
    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>
    <div class="list_header">
        <div class="list_botones">
            <a href="/reportes/crear" class="boton boton-azul"> Nuevo Reporte</a>
            <a href="/configuracion" class="boton boton-amarillo"> Volver </a>
        </div>
        
                <!-- Filter Section -->
        <form method="GET"  >
            <div class="list_filtros">
                <input type="text" name="search" placeholder="Buscar por nombre o apellido" value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES); ?>">
                
                <select name="status">
                    <option value="" <?php echo (!isset($_GET['status']) || $_GET['status'] === '') ? 'selected' : ''; ?>>Todos</option>
                    <option value="1" <?php echo (isset($_GET['status']) && $_GET['status'] == '1') ? 'selected' : ''; ?>>Firmado</option>
                    <option value="0" <?php echo (isset($_GET['status']) && $_GET['status'] == '0') ? 'selected' : ''; ?>>No Firmado</option>
                </select>
                
                <button type="submit" class=" boton-azul">Filtrar</button>
            </div>
        </form>
        
    </div>
    
    <div class="contenedor_listados">
        <table class="listados">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Doctor</th>
                    <th>Status</th>
                    <th>Creado Por</th>
                    <th>Acciones</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php foreach($reportes as $reporte): ?>
                <tr>
                    <td><?php echo $reporte->id ?></td>
                    <td><?php echo $reporte->patient_id->patient_name . " " . $reporte->patient_id->patient_lastname1 ?></td>
                    <td><?php 
                    $date = new DateTime($reporte->date_report);
                    $meses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    $dia = $date->format('d');
                    $mes = $meses[(int)$date->format('m') - 1];
                    $anio = $date->format('Y');
                    echo ($dia . ' de ' . $mes . ' de ' . $anio); ?></td> 
                    <td><?php echo date("H:i", strtotime($reporte->time_report)) ?></td>
                    
                    <td><?php echo $reporte->doctor->nombre ?></td>
                    <td ><span 
                            class=" status <?php echo intval($reporte->status) === 1 ? 'status-finished' : 'status-cancelled status_label' ?>"
                            data-id="<?php echo $reporte->id; ?>" 
                            <?php if($reporte->status === '0'){ ?>
                            onclick="(()=> mostrarModal(<?php echo $reporte->id; ?>))();"
                            <?php } ?>
                        >
                            <?php echo intval($reporte->status) === 1 ? 'FIRMADO' : 'NO FIRMADO' ?>
                            
                        </span></td>
                    <td><?php echo $reporte->creado_por->nombre ?></td>
                    <td>
                        <?php if (intval($reporte->status) === 0){ ?>
                            <a href="/reportes/actualizar?id=<?php echo $reporte->id ?>" class="boton-amarillo-flex">Actualizar</a>
                        
                        <a href="/reportes/descargar?id=<?php echo $reporte->id ?>" target="_blank" class="boton-verde-flex">Descargar</a>

                        <?php }else{ ?>
                            <a href="/report_files/<?php echo $reporte->firmado_id; ?>" target="_blank" class="boton-verde-flex">Descargar Firmado</a>
                        <?php }; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

        <!-- Modal Structure -->
    <div id="uploadModal" class="modal">
        <div class="modal-content-admin modal-content-admin-upload">
            <span class="close">&times;</span>
            <h2>Firmar Reporte medico</h2>
                
            <form  class="formulario_modal" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="reporte_id" id="reporte_id" value="">
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