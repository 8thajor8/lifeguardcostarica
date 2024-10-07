<main class="login-container">
    <div class="">
        <h1>Administrador de Sistema</h1>
        
        <div class="contenedor-boxes">

            <div class="box">
                <div class="box-header">
                    <i class="box-icon fa-regular fa-calendar"></i>
                    <h2 class="box-title">Utilidades</h2>
                </div>
                <div class="box-body">
                    <ul class="config-list">
                        <li class="config-item"><a href="/reportes/listado">Reportes Medicos</a></li>
                        <li class="config-item"><a href="/pacientes/listado">Pacientes</a></li>
                        <li class="config-item"><a href="/appointments/listado">Appointments Lista</a></li>
                        <li class="config-item"><a href="/appointments/status/listado">Appointments Estados</a></li>
                        
                        <!-- Add more configuration options here -->
                    </ul>
                </div>
            </div>

            <?php if(is_admin()) { ?>
            <div class="box">
                <div class="box-header">
                    <i class="box-icon fas fa-cog"></i>
                    <h2 class="box-title">Site Configuration</h2>
                </div>
                <div class="box-body">
                    <ul class="config-list">
                        <li class="config-item"><a href="/clinicas/listado">Clinicas</a></li>
                        <li class="config-item"><a href="/servicios/listado">Servicios</a></li>
                        <li class="config-item"><a href="/testimoniales/listado">Reviews</a></li>
                        <li class="config-item"><a href="#">About us</a></li>
                        <!-- Add more configuration options here -->
                    </ul>
                </div>
            </div>
             <?php } ?>

             <?php if(is_admin()) { ?>
            <div class="box">
                <div class="box-header">
                    <i class="box-icon fas fa-users"></i>
                    <h2 class="box-title">CRM Configuration</h2>
                </div>
                <div class="box-body">
                    <ul class="config-list">
                        <li class="config-item"><a href="/usuarios/listado">Usuarios</a></li>
                        
                        <!-- Add more configuration options here -->
                    </ul>
                </div>
            </div>
            <?php } ?>
            
            
        </div>
    </div>
</main>