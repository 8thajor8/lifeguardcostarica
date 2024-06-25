<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Nombre:</label>
            <input type="text" id="titulo" name="clinica[name]" placeholder="Nombre Clinica" value="<?php echo s($clinica->name); ?>" >
            
            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" name="clinica[description]" placeholder="Descripcion" value="<?php echo s($clinica->description); ?>" >
            
            <label for="region">Region:</label>
            <input type="text" id="region" name="clinica[region]" placeholder="Region" value="<?php echo s($clinica->region); ?>" >
            
            <label for="prescripcion">Prescription?</label>
            <input type="checkbox" id="prescripcion" name="clinica[prescription]" <?php if ($clinica->prescription == 1) echo 'checked'; ?>>

            <label for="xray">X-Ray?</label>
            <input type="checkbox" id="xray" name="clinica[xray]" <?php if ($clinica->xray == 1) echo 'checked'; ?>>

            <label for="airevac">Air Evac?</label>
            <input type="checkbox" id="airevac" name="clinica[airevac]" <?php if ($clinica->airevac == 1) echo 'checked'; ?>>
            
            <label for="link">Link:</label>
            <input type="text" id="link" name="clinica[link]" placeholder="Sitio Web" value="<?php echo s($clinica->link); ?>" >
            
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="clinica[image]">

            <?php if($clinica->image){ ?>
                <img class="imagen-small" src="../../imagenes/<?php echo $clinica->image; ?>">
            <?php }; ?> 

            
            
</fieldset>

       