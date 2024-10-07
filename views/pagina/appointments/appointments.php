<main class="contenedor-app">
    <div class="contenedor-app__instructions">
        <div class="contenedor-app__instructions__content">
            <?php
                foreach($errores as $error):
            ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php
                endforeach;
            ?>
            <h1 class="appointments_tittle">Book a COVID-19 Test</h1>

            <h3>Our service</h3>

            <p>Lifeguard CR collects samples and delivers them to a laboratory in San José. Once the samples arrive, the lab takes 6 hours to process the sample and deliver the results for a PCR test, and only 3 hours for an antigen test. Lifeguard's guarantee is to deliver those samples to the lab in San Jose in less than 5 hours if taken before 12 pm. At this time, the samples leave for the lab. Samples taken after this will go to the lab the next day.</p>
            
            <p>Samples can either be taken at one of our clinics or through a house call.</p>
        </div>
    </div>

    <div class="contenedor-app__application">

        <nav class="tabs">

            <button type="button" data-paso="1">Personal Information</button>
            <button type="button" data-paso="2">Contact & Location</button>
            <button type="button" data-paso="3">Medical</button>
            <button type="button" data-paso="4">Appointment</button>

        </nav>

        <form class="formulario_application" method="POST" novalidate >
            <?php
                include 'appointmentsFormulario.php'
            ?>

            <div class="submit_button">
                <input type="submit" value="Schedule Appointment" class="boton-azul-flex">
            </div>

        </fieldset>   

        </form>

        <div class="paginacion">
            <button 
                id="anterior"
                class="boton"
            >&laquo; Previous</button>
            
            <button 
                id="siguiente"
                class="boton"
            >Next &raquo;</button>
        </div>
    </div>
</main>
