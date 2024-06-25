<div class="service-list">
    <?php foreach($servicios as $servicio) : ?>
        <div class="service">
            <div class="imagen">
                <picture>
                    <img loading="lazy" src="/imagenes/<?php echo $servicio->image; ?>" alt="<?php echo $servicio->name; ?>">
                </picture>
            </div>

            <div class="texto-entrada">
                
                    <h4><?php echo $servicio->name; ?></h4>
                    <p class="informacion-meta">Available in: <span><?php echo $servicio->availability === 'todas' ? 'All Clinics' : 'Clinic Based' ; ?></span></p>
                    
                    <p class="descripcion">
                        <?php echo $servicio->description; ?>
                    </p>
            
            </div>

        </div>

    <?php endforeach; ?>

</div>