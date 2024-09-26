<main class="contenedor seccion">

    <h1>Estados Appointments</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>

    <a href="/appointments/status/crear" class="boton boton-azul"> Nuevo Status </a>
    <a href="/configuracion" class="boton-amarillo"> Volver </a>

    
    <table class="listados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
                
            </tr>
        </thead>

        <tbody>
            <?php foreach($statuses as $status): ?>
            <tr>
                <td><?php echo $status->id ?></td>
                <td><?php echo $status->name ?></td>
                
                
                
                <td>
                    <form method="POST" class="w-100" action="/appointments/status/eliminar">

                        <input type="hidden" name="id" value= <?php echo $status->id; ?> >
                        <input type="hidden" name="tipo" value="status" >
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/appointments/status/actualizar?id=<?php echo $status->id ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>