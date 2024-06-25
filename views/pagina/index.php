<main>
    
    
    <div class="contenedor fixed-scroll transportation">
            <h2 class="section-headline">Medical Transportation</h2>

            <div class="iconos-transportation">
                <div class="icono">
                    <img src="/build/img/seaLogo.svg" alt="icono seadoctor" loading="lazy">
                    <h3>Sea Doctor</h3>
                    <p>Boat Ambulance: We have an advanced life support boat ambulance that can aid in the territorial waters of the Pacific Ocean of Costa Rica up to 80 Nautical Miles. <a href="https://sea-dr.com" target="_blank"> LEARN MORE</a></p>
                </div>
                <div class="icono">
                    <img src="/build/img/airLogo.svg" alt="icono air evac" loading="lazy">
                    <h3>Air Evacuation</h3>
                    <p>We are dedicated to providing high-quality and compassionate ambulance and emergency medical services. We have Fixed or Rotary wing air-crafts available. Trust us to take care of you in times of need.</p>
                </div>
                <div class="icono">
                    <img src="/build/img/groundLogo.svg" alt="icono ground evac" loading="lazy">
                    <h3>Ground Ambulance</h3>
                    <p>Emergency Ambulance Response: We can help you in your times of need! When seconds count our ambulance and doctor service will be available for you.</p>
                </div>
            </div>

    </div>
    


        <section class="separator imagen-tele highlight" id="telemedicine">
            <div class="overlay"></div>
            <div class="contenido-separator">
                <h2>Telehealth</h2>
                <p>Instant Teleconsultation: Connect with a Doctor Now for Immediate Medical Advice and Care</p>
                <a href="https://wa.me/50685129111" target="_blank" class="boton-amarillo">Get Started</a>
            </div>
        </section>

        
        <div class= index-clinicas>
        <section class="seccion contenedor highlight" id="clinicas">

            <h2>Our Clinics</h2>

            

                <?php
                
                    include 'listadoClinicas.php';
                 ?>

                
            <div class="alinear-derecha">
                <a href="/clinicas" class="boton-verde">See All</a>
            </div>
        </section>
        </div>

        <section class="separator imagen-xray">
            <div class="overlay"></div>
            <div class="contenido-separator">
                <h2>X-RAY IMAGING</h2>
                <p>Experience cutting-edge X-ray technology with minimal radiation exposure at LifeGuard Costa Rica. Across multiple locations, we offer convenient portable X-ray services, bringing our advanced imaging capabilities directly to you</p>
                <a href="https://wa.me/50685129111" target="_blank" class="boton-amarillo">Get Booked</a>
            </div>
        </section>

        <section id="servicios" class="highlight">
            <div class="background-servicios ">
            <div class="overlay"></div>

                <div class="contenedor  seccion-inferior "">
                    <section class="blog">
                        <h2>Services</h2>

                        <?php
                    
                            include 'listadoServicios.php';

                        ?>
                        
                    </section>
                    

                    <section class="testimoniales">
                        <h3>Testimonials</h3>
                        
                        <?php
                    
                            include 'testimoniales.php';

                        ?>
                        

                    </section>

                    

                </div>
            </div>
        </section>

        <section id="contactus" class=" separator imagen-contact highlight">
            <div class="overlay"></div>
            <div class="contenido-separator">
                <h2>Contact Us</h2>
                <p>We are available 24 hours a day, 365 days a year! Reach out to us through any of the following methods:</p>
                <a href="https://wa.me/50685129111" target="_blank" class="boton-verde">WhatsApp</a>
                <p><strong>Costa Rica: </strong><a class="" href="tel:+50640019867">+506 4001 9867</a></p>
                <p><strong>USA: </strong><a class="" href="tel:+130540019867"> +1 (305) 770 6155</a></p>
                <p><strong>Israel: </strong><a class="" href="tel:+97233741320"> +972 3374 1320</a></p>
                <p><strong>Email: </strong> <a href="mailto:ops@lgcr.co">ops@lgcr.co</a></p>
            </div>
        </section>

        <section id="aboutus" class="contenedor seccion highlight">
            <div class="container">
                <h2>About Us</h2>
                <div class="content odd">
                    <div class="image">
                        <picture>
                            <source srcset="./build/img/aboutmedical.webp" type="image/webp">
                            <source srcset="./build/img/aboutmedical.jpg" type="image/jpg">
                                <img loading="lazy" src="./build/img/aboutmedical.webp" alt="Medical Team">
                        </picture>
                    </div>
                    <div class="text">
                        <p>Welcome to LifeGuard Costa Rica, your trusted partner in comprehensive medical and emergency services. We pride ourselves on our dedication to providing exceptional care and support whenever you need it. Our 24/7 service ensures that you have access to skilled agents who can connect you with the right health professionals, whether it's for an air ambulance or a medical consultation.</p>
                    </div>
                    
                </div>
                <div class="content even">
                    <div class="image">
                        <picture>
                            <source srcset="./build/img/ambulance.webp" type="image/webp">
                            <source srcset="./build/img/ambulance.jpg" type="image/jpg">
                                <img loading="lazy" src="./build/img/ambulance.jpg" alt="Ambulance">
                        </picture>
                    </div>
                    <div class="text">
                        <p>In moments when every second counts, our emergency ambulance response team is ready to deliver rapid and reliable assistance. Our private ambulance services are strategically positioned in key locations, ensuring swift and effective transportation in times of need.</p>
                    </div>
                </div>
                <div class="content odd">
                    <div class="image">
                        <picture>
                            <source srcset="./build/img/airambulance.webp" type="image/webp">
                            <source srcset="./build/img/airambulance.jpg" type="image/jpg">
                                <img loading="lazy" src="./build/img/airambulance.jpg" alt="Air Ambulance">
                        </picture>
                    </div>
                    <div class="text">
                        <p>We also offer specialized air medical evacuation services, providing critical care and transportation from various areas. Additionally, our advanced life support boat ambulance is capable of offering assistance within the territorial waters of the Pacific Ocean of Costa Rica, reaching up to 80 nautical miles.</p>
                    </div>
                    
                </div>
                <div class="content even">
                    <div class="image">
                        <picture>
                            <source srcset="./build/img/travelinsurance.webp" type="image/webp">
                            <source srcset="./build/img/travelinsurance.JPG" type="image/jpg">
                                <img loading="lazy" src="./build/img/travelinsurance.JPG" alt="Insurance">
                        </picture>
                    </div>
                    <div class="text">
                        <p>For insurance companies, we provide a comprehensive suite of services designed to enhance the travel experience. From assistance with lost travel documentation to arranging VIP transportation and medical house calls, we handle it all with professionalism and care.</p>
                    </div>
                </div>
                <div class="text">
                    <p>At LifeGuard Costa Rica, our mission is to ensure that you receive the highest standard of care and support, no matter the circumstance. Discover the difference with our dedicated team and comprehensive services.</p>
                </div>
            </div>
        </section>
</main>