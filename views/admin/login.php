<div class="login-container">
    
    
    <div class="login">
        <p class="descripcion-pagina">Log In</p>

        <?php
        foreach($errores as $error):
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
        endforeach;
    ?>


        <form class="formulario-login" method="POST" action="/login" novalidate>

            <div class="campo_login">
                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    placeholder="Tu e-mail"
                    name="email"
                />
            </div>

            <div class="campo_login">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    placeholder="Tu password"
                    name="password"
                />
            </div>

            <input type="submit" class="boton" value="Iniciar Sesion">
        </form>

        
    </div>
</div>