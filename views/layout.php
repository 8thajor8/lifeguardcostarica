<?php

    $auth = $_SESSION['login'] ?? false ;

    if(!isset ($inicio)){
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LifeGuard Costa Rica provides 24/7 urgent care, medical transportation, and telemedicine consultations. Services include sea, air, and ground ambulance evacuations, clinical laboratory, X-ray imaging, emergency medical consultations, medical prescriptions, chronic disease control, and more. Contact us for immediate medical assistance.">
    <meta name="keywords" content="urgent care, medical transportation, telemedicine, sea doctor, air evacuation, ground ambulance, clinical laboratory, X-ray imaging, emergency medical consultation, medical prescriptions, chronic disease control, Nosara Clinic, Lifeguard Medical Center, Santa Teresa Clinic, Cobano Clinic, Monteverde Doctor, Langosta Doctor, Costa Rica healthcare, medical services, emergency services, teleconsultation, medical evacuation, ambulance services">
    <meta property="og:url" content="https://lifeguardcostarica.com/">
    <meta property="og:site_name" content="Lifeguard Costa Rica">
    <meta property="og:title" content="Lifeguard Costa Rica">
    <meta property="og:description" content="24/7 Urgent Care, Evacuations and Telemedicine Consultations">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://i.imgur.com/pvTvcl0.png">
    <meta property="og:locale" content="en_IN">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Lifeguard Costa Rica">
    <meta name="twitter:description" content="24/7 Urgent Care, Evacuations and Telemedicine Consultations">
    <meta name="twitter:image" content="https://i.imgur.com/pvTvcl0.png">
    <meta name="twitter:image:alt" content="Lifeguard Costa Rica">

    <link rel="icon" href="/build/img/favicon.svg" />
    <title>Lifeguard Costa Rica</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <script src="https://kit.fontawesome.com/55d940ec4a.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <?php if($inicio) { ?> <div class="video-container">
            <video autoplay muted loop id="background-video">
                <source src="/build/img/video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="overlay"></div>
        </div> <?php } ?>
        <div class="contenedor contenido-header">
            <div class="barra">
                
                <div class="barra-interna">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="Logotipo de Lifeguard">
                    </a>


                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="icono menu responsive">
                    </div>
                </div>

                <nav class="navegacion navegacion-index">
                    <a href="<?php echo $inicio ? "#telemedicine" : "/#telemedicine" ?>">Telemedicine Now</a>
                    <a href="<?php echo $inicio ? "#clinicas" : "#" ?>">Our Clinics</a>
                    <a href="<?php echo $inicio ? "#servicios" : "/#servicios" ?>">Services</a>
                    
                    <a href="<?php echo $inicio ? "#contactus" : "/#contactus" ?>">Contact</a>
                    <a href="<?php echo $inicio ? "#aboutus" : "/#aboutus" ?>">About Us</a>
                </nav>
                
            </div>

            <?php echo $inicio ? "<h1>24/7 Urgent Care, Evacuations and Telemedicine Consultations</h1>" : "" ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer ">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="<?php echo $inicio ? "#telemedicine" : "/#telemedicine" ?>">Telemedicine Now</a>
                <a href="<?php echo $inicio ? "#clinicas" : "#" ?>">Our Clinics</a>
                <a href="<?php echo $inicio ? "#servicios" : "/#servicios" ?>">Services</a>
                
                <a href="<?php echo $inicio ? "#contactus" : "/#contactus" ?>">Contact</a>
                <a href="<?php echo $inicio ? "#aboutus" : "/#aboutus" ?>">About Us</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados 2024 &copy;</p>
    </footer>

    <script>
        var inicio = <?php echo $inicio ? 'true' :'false'; ?>;
        
    </script>
    <script src="./build/js/bundle.min.js"></script>
</body>
</html>