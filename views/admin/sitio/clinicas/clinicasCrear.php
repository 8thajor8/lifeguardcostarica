<main class="contenedor seccion">

    <h1>Crear Clinica</h1>

    <a href="/clinicas/listado" class="boton boton-azul"> Volver </a>

    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>

    <form class="formulario" method="POST" action="/clinicas/crear" enctype="multipart/form-data">
        
        <?php include __DIR__ .  '/clinicasFormulario.php' ?>

        <input type="submit" value="Crear Clinica" class="boton boton-azul">



    </form>

</main>