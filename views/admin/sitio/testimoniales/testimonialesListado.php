<main class="contenedor seccion">

    <h1>Testimoniales</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>

    <a href="/testimoniales/crear" class="boton boton-azul"> Nuevo Review </a>
    <a href="/configuracion" class="boton boton-amarillo"> Volver </a>

    
    <table class="listados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Review</th>
                <th>Acciones</th>
                
            </tr>
        </thead>

        <tbody>
            <?php foreach($testimonials as $testimonial): ?>
            <tr>
                <td><?php echo $testimonial->id ?></td>
                <td><?php echo $testimonial->name ?></td>
                <td><?php echo $testimonial->review ?></td>
                
                
                <td>
                    <form method="POST" class="w-100" action="/testimoniales/eliminar">

                        <input type="hidden" name="id" value= <?php echo $testimonial->id; ?> >
                        <input type="hidden" name="tipo" value= "testimonial" >
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/testimoniales/actualizar?id=<?php echo $testimonial->id ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>