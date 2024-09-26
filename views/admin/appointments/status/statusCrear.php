<main class="contenedor seccion">

    <h1>Crear Estado</h1>

    <a href="/appointments/status/listado" class="boton boton-azul"> Volver </a>

    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>

    <form class="formulario" method="POST" action="/appointments/status/crear">
        
        <?php include __DIR__ .  '/statusFormulario.php' ?>

        <input type="submit" value="Crear Status" class="boton boton-azul">



    </form>

</main>