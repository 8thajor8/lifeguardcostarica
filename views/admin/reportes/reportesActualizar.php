<main class="contenedor seccion">

    <h1>Actualizar Reporte</h1>

    <a href="/reportes/listado" class="boton boton-azul"> Volver </a>


    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>

    <form class="formulario__appointments__admin" method="POST" >
        
        <?php include __DIR__ .  '/reportesFormulario.php' ?>

        <input type="submit" value="Actualizar Reporte" class="boton boton-azul">



    </form>

</main>