<main class="seccion listado_appointments">

    <h1>Appointments</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>

    
    <a href="/configuracion" class="boton boton-amarillo"> Volver </a>

    
    <table class="listados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>HouseCall?</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Clinica</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($appointments as $appointment): ?>
            <tr>
                <td><?php echo $appointment->id ?></td>
                <td><?php echo $appointment->name . " " . $appointment->lastname1  ?></td>
                <td><?php echo $appointment->phone ?></td>
                <td><?php echo $appointment->email ?></td>
                <td><?php echo intval($appointment->housecall) === 1 ? "Si" : "No" ?></td>
                <td><?php echo $appointment->date_appointment ?></td>
                <td><?php echo $appointment->time_appointment ?></td>
                <td><?php echo $appointment->location_appointment ?></td>
                <td ><span class="status <?php echo $statusClassMap[$appointment->status] ?? 'status-default' ?>"><?php echo $statusMap[$appointment->status] ?? 'Unknown' ?></span></td>
                
                <td>
                    <form method="POST" class="w-100" action="/appointments/eliminar">

                        <input type="hidden" name="id" value= <?php echo $appointment->id; ?> >
                        <input type="hidden" name="tipo" value= "appointment" >
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/appointments/details?id=<?php echo $appointment->id ?>" class="boton-azul-block">Ver Detalles</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>