<main class="listado_appointments seccion">

    <h1 class="heading_admin">Pacientes</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>

    <div class="list_header">
        <div class="list_botones">
            <a href="/pacientes/crear" class=" boton-azul"> Nuevo Paciente</a>
            <a href="/configuracion" class=" boton-amarillo"> Volver </a>
        </div>
        
                <!-- Filter Section -->
            <form method="GET"  >
                <div class="list_filtros">
                    <input type="text" name="search" placeholder="Buscar por nombre o apellido" value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES); ?>">
                                                            
                    <button type="submit" class=" boton-azul">Filtrar</button>
                </div>
            </form>
        
    </div>
    
    <table class="listados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Fecha Nac.</th>
                <th>ID</th>
                <th>Acciones</th>
                
            </tr>
        </thead>

        <tbody>
            <?php foreach($pacientes as $paciente): ?>
            <tr>
                <td><?php echo $paciente->id ?></td>
                <td><?php echo $paciente->patient_name . " " . $paciente->patient_lastname1 ?></td>
                <td><?php 
                    $date = new DateTime($paciente->dob);
                    $meses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    $dia = $date->format('d');
                    $mes = $meses[(int)$date->format('m') - 1];
                    $anio = $date->format('Y');
                    echo ($dia . ' de ' . $mes . ' de ' . $anio); ?></td> 
                <td><?php echo $paciente->id_number ?></td>
                                
                <td>
                    <a href="/pacientes/expediente?id=<?php echo $paciente->id ?>" class="boton-verde-flex">Ver Expediente</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

  

</main>