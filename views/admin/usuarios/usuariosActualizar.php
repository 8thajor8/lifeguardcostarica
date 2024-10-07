<main class="contenedor seccion">

    <h1>Actualizar Usuario</h1>

    <a href="/configuracion" class="boton boton-azul"> Volver </a>


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
        
        <fieldset id="paso-1" >
            <legend>Informacion Usuario</legend>

            <div class="two-col">
                <div class="campo_appointments">
            <label for="user_titulo">Titulo:</label>
            <select name="user_titulo" id="user_titulo">
                <option value="" <?php echo ($usuario->user_titulo == '') ? 'selected' : ''; ?>>-- Seleccione Titulo --</option>
                <?php foreach($titulos as $titulo)  : ?>
                
                    <option <?php echo $usuario->user_titulo === $titulo->id ? 'selected' : '' ?> value="<?php echo s($titulo->id); ?>"><?php echo s($titulo->nombre); ?></option>
                    
                <?php endforeach; ?>
            </select>
        </div>
    
        <div class="campo_appointments">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo s($usuario->nombre); ?>" >
        </div>
    

        <div class="campo_appointments">
            <label for="user_especialidad">Especialidad:</label>
            <input type="text" id="user_especialidad" name="user_especialidad" placeholder="Especialidad" value="<?php echo s($usuario->user_especialidad); ?>" >
        </div>

        <div class="campo_appointments">
            <label for="user_codigo">Codigo:</label>
            <input type="text" id="user_codigo" name="user_codigo" placeholder="Codigo" value="<?php echo s($usuario->user_codigo); ?>" >
        </div>
    </div>

    <div class="two-col">
        <div class="campo_appointments">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email" disabled value="<?php echo s($usuario->email); ?>" >
        </div>

        <div class="campo_appointments">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password">
        </div>

        <div class="campo_appointments campo_appointments__check">
            <label for="is_admin">Admin?</label>
            <input type="checkbox" id="is_admin" name="is_admin" <?php if ($usuario->is_admin == 1) echo 'checked'; ?>>
        </div>
    </div>
            </div>
        </fieldset>
        

        <input type="submit" value="Actualizar Usuario" class="boton boton-azul">



    </form>

</main>