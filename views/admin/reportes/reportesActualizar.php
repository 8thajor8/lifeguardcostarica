<main class="contenedor seccion">

    <h1 class="heading_admin">Actualizar Reporte</h1>

   <a href="<?php echo $return_to_patient ? '/reportes/expediente?id='. $reporte->id : '/reportes/listado' ?>" class="boton-amarillo"> Volver </a>


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
                
                    <select disabled name="patient_id" id="patient_id">
                        <option value="" <?php echo ($reporte->patient_id == '') ? 'selected' : ''; ?>>-- Seleccione un Paciente --</option>
                        <?php foreach($pacientes as $pacienteSelect)  : ?>
                        
                            <option <?php echo $reporte->patient_id === $pacienteSelect->id ? 'selected' : '' ?> value="<?php echo s($pacienteSelect->id); ?>"><?php echo s($pacienteSelect->patient_name) . ' ' . s($pacienteSelect->patient_lastname1 . ' ' .s($pacienteSelect->patient_lastname2)) ; ?></option>
                            
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </fieldset>       
        <?php include __DIR__ .  '/reportesFormulario.php' ?>

        <input type="submit" value="Actualizar Reporte" class="boton boton-azul">



    </form>

</main>