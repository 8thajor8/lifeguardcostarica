<main class="contenedor seccion">

    <h1>Crear Reporte Medico</h1>

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

        <input type="submit" value="Crear Reporte" class="boton boton-azul">



    </form>

    <div id="pacienteModal" class="modal">
        <div class="modal-content-admin" id="modal-paciente-api">
            <span class="close">&times;</span>
            <h2>Crear Paciente</h2>
            <div id="error-container"></div>
            <form class="formulario__appointments__admin formulario_modal" id="crear_paciente_modal" method="POST" >
        
                <?php include __DIR__ .  '/../pacientes/pacientesFormulario.php' ?>

               <div class="contenedor_button_modal">
                    <button type="button" onclick="crearPaciente()">Crear Paciente</button>
                </div>

            </form>
            
        </div>
    </div>

</main>