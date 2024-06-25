<div class="contenedor-clinicas" id="clinicas">

    <?php foreach($clinicas as $clinica) : ?>
    <div class="clinica">
        <picture>
            
            <img loading="lazy" src="/imagenes/<?php echo $clinica->image; ?>" alt="<?php echo $clinica->name; ?>">
        </picture>
        
        <div class="contenido-clinica">
            <h3><?php echo $clinica->name; ?></h3>
            <p><?php echo $clinica->description; ?></p>
            <p class="ubicacion"><?php echo $clinica->region; ?></p>

            <ul class="iconos-caracteristicas">

            <?php if(intval($clinica->prescription) === 1){ ?>
                <li class="prescription">
                    <img loading="lazy" src="./build/img/medicamentos.svg" alt="icono meds"> 
                    
                </li>
            <?php } ?>

            <?php if(intval($clinica->xray) === 1){ ?>
                <li class="xray">
                    <img loading="lazy" src="./build/img/xray.svg" alt="icono xray"> 
                    
                </li>
            <?php } ?>

            <?php if(intval($clinica->airevac) === 1){ ?>
                <li class="airevac">
                    <img loading="lazy" src="./build/img/plane.svg" alt="icono air"> 
                    
                </li>
            <?php } ?>

            </ul>
            <a href="<?php echo $clinica->link; ?>" class="boton-amarillo-block">See Clinic</a>
        </div>
    </div>
    <?php endforeach; ?>
                
</div>

