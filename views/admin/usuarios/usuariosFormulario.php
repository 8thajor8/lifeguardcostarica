<fieldset>
            <legend>Informacion General</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo s($usuario->nombre); ?>" >
            
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo s($usuario->email); ?>" >
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password">
                       
</fieldset>
