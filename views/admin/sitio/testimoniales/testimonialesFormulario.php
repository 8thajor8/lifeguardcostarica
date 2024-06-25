<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Nombre:</label>
            <input type="text" id="titulo" name="testimonial[name]" placeholder="Nombre Cliente" value="<?php echo s($testimonial->name); ?>" >
            
            <label for="review">Review:</label>
            <textarea id="review" name="testimonial[review]" placeholder="Ingrese aqui la reseña del cliente"><?php echo s($testimonial->review); ?></textarea>

            
            
            
            
</fieldset>

       