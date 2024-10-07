<main class="contenedor seccion">

    <h1>Listado de Usuarios</h1>
    
    <?php if($resultado) { ?> <p class="alerta exito"> <?php echo mostrarNotificacion($resultado); ?></p> <?php } ?>

    <a href="/usuarios/crear" class="boton boton-azul"> Nuevo Usuario </a>
    <a href="/configuracion" class="boton-amarillo"> Volver </a>

    
    <table class="listados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Nombre</th>
                <th>Email:</th>
                <th>Admin</th>
                <th>Acciones</th>
                
            </tr>
        </thead>

        <tbody>
            <?php foreach($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario->id ?></td>
                <td><?php echo $usuario->user_titulo->nombre ?></td>
                <td><?php echo $usuario->nombre ?></td>
                <td><?php echo $usuario->email ?></td>
                <td><?php echo intval($usuario->is_admin) === 1 ? "Si" : "No" ?></td> 
                
                
                
                <td>
                    <form method="POST" class="w-100" action="/usuarios/eliminar">

                        <input type="hidden" name="id" value= <?php echo $usuario->id; ?> >
                        <input type="hidden" name="tipo" value="status" >
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/usuarios/actualizar?id=<?php echo $usuario->id ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>