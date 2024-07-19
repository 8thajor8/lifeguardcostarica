<main class="contenedor seccion">

    <h1>Crear Usuario</h1>

    <a href="/configuracion" class="boton boton-azul"> Volver </a>

    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>

    <form class="formulario" method="POST" action="/usuarios/crear" enctype="multipart/form-data">
        
        <?php include __DIR__ .  '/usuariosFormulario.php' ?>

        <input type="submit" value="Crear Usuario" class="boton boton-azul">



    </form>

</main>