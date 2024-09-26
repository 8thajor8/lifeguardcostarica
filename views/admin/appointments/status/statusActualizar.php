<main class="contenedor seccion">

    <h1>Actualizar Estado</h1>

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

    <form class="formulario" method="POST" >
        
    <?php include __DIR__ .  '/statusFormulario.php' ?>

        <input type="submit" value="Actualizar Status" class="boton boton-azul">



    </form>

</main>