<main class="contenedor seccion">

    <h1>Clinicas</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>

    <a href="/clinicas/crear" class="boton boton-azul"> Nueva Clinica </a>
    <a href="/configuracion" class="boton boton-amarillo"> Volver </a>

    
    <table class="listados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Region</th>
                <th>Prescripciones</th>
                <th>X-Ray</th>
                <th>Air Evac</th>
                <th>Link</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($clinicas as $clinica): ?>
            <tr>
                <td><?php echo $clinica->id ?></td>
                <td><?php echo $clinica->name ?></td>
                <td><?php echo $clinica->description ?></td>
                <td><?php echo $clinica->region ?></td>
                <td><?php echo intval($clinica->prescription) === 1 ? "Si" : "No" ?></td>
                <td><?php echo intval($clinica->xray)  === 1 ? "Si" : "No" ?></td>
                <td><?php echo intval($clinica->airevac) === 1 ? "Si" : "No"  ?></td>
                <td><?php echo $clinica->link ?></td>
                
                <td><img src="/imagenes/<?php echo $clinica->image ?>" class="imagen-tabla"></td>
                
                <td>
                    <form method="POST" class="w-100" action="/clinicas/eliminar">

                        <input type="hidden" name="id" value= <?php echo $clinica->id; ?> >
                        <input type="hidden" name="tipo" value= "clinica" >
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/clinicas/actualizar?id=<?php echo $clinica->id ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>