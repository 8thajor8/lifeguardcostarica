<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Nombre:</label>
            <input type="text" id="titulo" name="servicio[name]" placeholder="Nombre Servicio" value="<?php echo s($servicio->name); ?>" >
            
            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" name="servicio[description]" placeholder="Descripcion" value="<?php echo s($servicio->description); ?>" >
            
            <label for="availability">Disponibilidad:</label>
            <label for="allclinics">Todas las Clinicas</label>
            <input type="radio" id="allclinics" name="servicio[availability]" value="todas" <?php echo ($servicio->availability === 'todas') ? 'checked' : ''; ?>>
            <label for="someclinics">Clinic Based</label>
            <input type="radio" id="someclinics" name="servicio[availability]" value="algunas" <?php echo ($servicio->availability == 'algunas') ? 'checked' : ''; ?>>
           
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="servicio[image]">

            <?php if($servicio->image){ ?>
                <img class="imagen-small" src="../../imagenes/<?php echo $servicio->image; ?>">
            <?php }; ?> 

            
            
</fieldset>

       