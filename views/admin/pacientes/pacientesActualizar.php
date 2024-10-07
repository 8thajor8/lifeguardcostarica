<main class="contenedor seccion">

    <h1>Actualizar Paciente</h1>

    <a href="/pacientes/listado" class="boton boton-azul"> Volver </a>


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
        
        <?php include __DIR__ .  '/pacientesFormulario.php' ?>

        <input type="submit" value="Actualizar Paciente" class="boton boton-azul">



    </form>

</main>