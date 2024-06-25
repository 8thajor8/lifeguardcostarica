<main class="contenedor seccion">

    <h1>Actualizar Testimonial</h1>

    <a href="/testimoniales/listado" class="boton boton-azul"> Volver </a>


    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>

    <form class="formulario" method="POST"  enctype="multipart/form-data">
        
    <?php include __DIR__ .  '/testimonialesFormulario.php' ?>

        <input type="submit" value="Actualizar Testimonial" class="boton boton-azul">



    </form>

</main>