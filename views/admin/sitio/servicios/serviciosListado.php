<main class="contenedor seccion">

    <h1>Servicios</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>

    <a href="/servicios/crear" class="boton boton-azul"> Nuevo Servicio </a>
    <a href="/configuracion" class="boton boton-amarillo"> Volver </a>

    
    <table class="listados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Disponibilidad</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($servicios as $servicio): ?>
            <tr>
                <td><?php echo $servicio->id ?></td>
                <td><?php echo $servicio->name ?></td>
                <td><?php echo $servicio->description ?></td>
                <td><?php echo ($servicio->availability) === "todas" ? "Todas las Clinicas" : "Clinic Based" ?></td></td>
                
                <td><img src="/imagenes/<?php echo $servicio->image ?>" class="imagen-tabla"></td>
                
                <td>
                    <form method="POST" class="w-100" action="/servicios/eliminar">

                        <input type="hidden" name="id" value= <?php echo $servicio->id; ?> >
                        <input type="hidden" name="tipo" value= "servicio" >
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/servicios/actualizar?id=<?php echo $servicio->id ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>