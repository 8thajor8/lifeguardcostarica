<main class="contenedor seccion ">

    <h1>Detalles Appointment</h1>
    <div class="form-buttons">
        <a href="/appointments/listado" class="boton-azul"> Volver </a>
        <button type="button" id="editButton" class="boton-amarillo">Edit</button>
    </div>

    <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>

    <form id="formulario__appointments__admin" class="formulario__appointments__admin" method="POST" >
        
    <?php include __DIR__ .  '/../../pagina/appointments/appointmentsFormulario.php' ?>

        <div class="campo_appointments">
            <label for="status">Status:</label>
            <select name="status" id="status">
                
                <?php foreach($statuses as $status)  : ?>
                
                    <option <?php echo $appointment->status === $status->id ? 'selected' : '' ?> value="<?php echo s($status->id); ?>"><?php echo s($status->name); ?></option>
                    
                <?php endforeach; ?>
            </select>
        </div>

        </fieldset>   

        <input type="submit" value="Guardar" disabled class="boton boton-azul">



    </form>

</main>
