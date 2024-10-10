<main class="contenedor seccion">

    <h1 class="heading_admin">Crear Reporte Medico</h1>

    <a href="<?php echo $return_to_patient ? '/pacientes/expediente?id='. $reporte->patient_id : '/reportes/listado' ?>" class="boton boton-azul"> Volver </a>

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
        
        <fieldset>
            <legend>Informacion del Paciente</legend>

            <div class="two-col">
                    <div class="campo_appointments">
                    
                        <select name="patient_id" id="patient_id">
                            <option value="" <?php echo ($reporte->patient_id == '') ? 'selected' : ''; ?>>-- Seleccione un Paciente --</option>
                            <?php foreach($pacientes as $pacienteSelect)  : ?>
                            
                                <option <?php echo $reporte->patient_id === $pacienteSelect->id ? 'selected' : '' ?> value="<?php echo s($pacienteSelect->id); ?>"><?php echo s($pacienteSelect->patient_name) . ' ' . s($pacienteSelect->patient_lastname1 . ' ' .s($pacienteSelect->patient_lastname2)) ; ?></option>
                                
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button 
                        type="button"
                        class="boton-verde-flex"
                        onclick="(()=> mostrarModalPaciente())();"
                    > &#43; Nuevo Paciente </button>

                </div>

        </fieldset>
        
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