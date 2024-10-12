let paso = 1;
let pasoInicial = 1;
let pasoFinal = 4;

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    navegacionFija();
    enableForm();
    eventListeners();
    
    if(inicio){
        scrollNav();
        restaltarEnlace();
        testimonialSlider();
        videoLoader();
        playVideo();
        accordion();
        clipCurtain();
        iconosCollapsable();
        
    }
    if(appFormulario){
        mostrarSeccion();
        tabs();
        botonesPaginador();
        paginaAnterior();
        paginaSiguiente();
        toggleFieldsHousecall();
        toggleFieldsSymptoms();
        seleccionarHora();
        scheduleSuccess();
    }
    
}

function navegacionFija() {
    const barra = document.querySelector('.barra')
    const transportation = document.querySelector ('.fixed-scroll')
    
    if(transportation){
        window.addEventListener('scroll', function(){
            if(transportation.getBoundingClientRect().bottom < 1){
                barra.classList.add('fixed')
            
            } else{
                barra.classList.remove('fixed')
                
            }
        })
    }


}

function scrollNav(){
    const navLinks = document.querySelectorAll('.navegacion-index .scroll')

    navLinks.forEach( link => {
        link.addEventListener('click', e => {
            e.preventDefault()
            const sectionScroll = e.target.getAttribute('href')
            const section = document.querySelector(sectionScroll)

            section.scrollIntoView({behavior: 'smooth'})

           
            
        })
    })
}

function restaltarEnlace (){
    document.addEventListener('scroll', function(){
        const sections =  document.querySelectorAll('.highlight')
        
        const navLinks =  document.querySelectorAll('.navegacion-index a')
        
        let actual = '';
        
        sections.forEach( section => {
            const sectionTop = section.offsetTop
            const sectionHeight = section.clientHeight
            
           
            if(window.scrollY >= (sectionTop - sectionHeight /3 )){
                
                actual = section.id;
                
                
            }
            
        })

        

        navLinks.forEach(link => {
            link.classList.remove('active')
            if(link.getAttribute('href') === '#' + actual){
                link.classList.add('active');
            }
        })
        
    })
    
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionMobile);
    
    
    const housecallCheckbox = document.getElementById('housecall');
    const symptomsCheckbox = document.getElementById('have_symptoms');
    const convertBtn = document.getElementById('convertBtn');
    if(housecallCheckbox){
        housecallCheckbox.addEventListener('change', toggleFieldsHousecall);
        convertBtn.addEventListener('click', extractLatLngFromLink);
        symptomsCheckbox.addEventListener('change', toggleFieldsSymptoms);
    }
    
    
   

}

function navegacionMobile(){
    const navegacion = document.querySelector('.navegacion');
    const navegacionContainer = document.querySelector('.barra');
    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
        navegacionContainer.classList.remove('barraOverlay');
        }else{
                navegacion.classList.add('mostrar');
                navegacionContainer.classList.add('barraOverlay');
            }
    
}

function testimonialSlider(){
    const testimonials = document.querySelectorAll('.testimonial');
    let currentIndex = 0;

    function showTestimonial(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.classList.remove('active');
            if (i === index) {
                testimonial.classList.add('active');
            }
        });
    }

    function nextTestimonial() {
        currentIndex = (currentIndex + 1) % testimonials.length;
        showTestimonial(currentIndex);
    }

    showTestimonial(currentIndex);
    setInterval(nextTestimonial, 5000);
}

function accordion(){
    
        const accordionItems = document.querySelectorAll('.accordion-item');
        
        accordionItems.forEach(item => {
          item.querySelector('.item-tittle-container').addEventListener('click', () => {
            
            item.classList.toggle('active');
            item.querySelector('.accordion-content').classList.toggle('active');
          });
        });
      
}

function videoLoader(){
    
    var video = document.getElementById('background-video');
    var loader = document.getElementById('video-loader');
    
    // Listen for the 'canplaythrough' event to ensure the video is fully loaded
    video.addEventListener('canplaythrough', function() {
        loader.style.display = 'none'; // Hide the loader
        video.style.display = 'block'; // Show the video
    });

    // Fallback in case 'canplaythrough' doesn't fire
    video.addEventListener('loadeddata', function() {
        if (video.readyState >= 3) {
            loader.style.display = 'none'; // Hide the loader
            video.style.display = 'block'; // Show the video
        }
    });

    // Attempt to play the video to trigger the loading
    video.play().catch(function(error) {
        console.log('Error trying to play video:', error);
    });
}


function clipCurtain() {
    var header = document.querySelector('.video-container');
    var mainContent = document.querySelector('main');
    var tituloHeader = document.querySelector('.titulo-header h1');
    var imageFrame = document.querySelector('.portada-fixed .image-frame');
    var imageFrame2 = document.querySelector('.portada-fixed2 .image-frame');
    var ghostDiv = document.querySelector('.ghost-div');
    var inicio = document.querySelector('.inicio');
   

    // Adjust this factor to slow down the clipping effect
    var scrollFactor = 1; // Increase this value to slow down the effect
    // Adjust this threshold to start the h1 effect later
    var startEffectThreshold = header.offsetHeight * 0.2; // 20% of header height
    // Delay before starting image resize effect
    var imageResizeDelay = header.offsetHeight * 0.5; // Start resizing after half the header height

    // Calculate when to fix the main content
    var ghostDivOffset = ghostDiv.offsetHeight * 0.5; // Adjust this value to start fixing slightly before reaching the bottom of ghost-div
    var imageFrameTop = imageFrame2.offsetTop;
    var imageFrameHeight = imageFrame2.offsetHeight;

    window.addEventListener('scroll', function () {
        var scrollY = window.scrollY;
        var headerHeight = header.offsetHeight;

        // Clipping effect starts immediately
        if (scrollY < headerHeight * scrollFactor) {
            var clipValue = (scrollY / (headerHeight * scrollFactor)) * 60; // Adjusting to clip from 0 to 60%
            header.style.clipPath = `inset(${clipValue}% 0 ${clipValue}% 0)`;
        } else {
            header.style.clipPath = `inset(60% 0 60% 0)`; // Fully clipped from top and bottom
        }

        // Only start the h1 and frame effect after reaching the threshold
        if (scrollY < headerHeight * scrollFactor && scrollY > startEffectThreshold) {
            var relativeScrollY = scrollY - startEffectThreshold;
            var effectRange = headerHeight * (scrollFactor - 0.2); // Adjust the range of the effect

            // Delay image resizing effect
            if (scrollY > imageResizeDelay) {
                var relativeResizeScrollY = scrollY - imageResizeDelay;
                var resizeEffectRange = effectRange - (imageResizeDelay - startEffectThreshold);

                // Update opacity and size of the h1 element more gradually
                var opacityValue = 1 - (relativeScrollY / effectRange); // Reduces from 1 to 0 more gradually
                var scaleValue = 1 - (relativeScrollY / effectRange) * 0.5; // Reduces from 1 to 0.5 more gradually
                tituloHeader.style.opacity = opacityValue;
                tituloHeader.style.transform = `scale(${scaleValue})`;

                // Update size of the image frame more gradually after delay
                var frameScaleValue = 1 - (relativeResizeScrollY / resizeEffectRange) * 0.5; // Reduces from 1 to 0.5
                imageFrame.style.transform = `scale(${frameScaleValue})`;
                imageFrame2.style.transform = `scale(${frameScaleValue})`;
            } else {
                // Before the delay threshold, keep the images at their initial size
                imageFrame.style.transform = 'scale(1)';
                imageFrame2.style.transform = 'scale(1)';
            }
        } else if (scrollY <= startEffectThreshold) {
            // Reset to initial state before reaching the threshold
            tituloHeader.style.opacity = 1;
            tituloHeader.style.transform = 'scale(1)';
            imageFrame.style.transform = 'scale(1)';
            imageFrame2.style.transform = 'scale(1)';
        }

        // Fix the entire main content slightly before scrolling past the ghost div
        if (scrollY < ghostDivOffset) {
            
            mainContent.classList.add('fixed-main');
            ghostDiv.style.opacity = '0'; // Hide the ghost div
          

        } else {
            mainContent.classList.remove('fixed-main');
            ghostDiv.style.opacity = '1'; // Show the ghost div
            
        }

        if(scrollY < (imageFrameTop + imageFrameHeight*2)){
            
            inicio.style.position = 'fixed';
            inicio.style.top = '0'; // Reset top position as needed
            inicio.style.zIndex = '4'; // Ensure it's above header and portada
            
        } else{
            
            // Reset inicio's position when not at the end of portada
            inicio.style.position = 'absolute';
            inicio.style.top = '0'; // Adjust based on portada's position and height
            inicio.style.zIndex = '3'; // Ensure it's above other content
        }
        
    });
    
}

function playVideo(){
    var video = document.getElementById('background-video');
    if (video) {
        video.play().catch(function(error) {
            console.log('Error trying to play video:', error);
        });
    }
}

function iconosCollapsable(){
    const modal = document.getElementById('modal');
    const video = document.getElementById('modal-video');
    const closeModalButton = document.querySelector('.close-modal');

    // Functions to open modal with the right animation
    function openModal(animationClass, videoSource) {
        modal.style.display = 'flex';
        modal.classList.remove('modal-slide-up', 'modal-slide-down', 'modal-slide-left');
        modal.classList.add(animationClass);
        video.src = videoSource;
        video.play();

        document.body.classList.add('no-scroll');
    }

    // Event listeners for the icons
    document.querySelector('.iconos-transportation .icono:nth-child(1)').addEventListener('click', function() {
        openModal('modal-slide-up', '/build/img/sea-division.mp4');
    });

    document.querySelector('.iconos-transportation .icono:nth-child(2)').addEventListener('click', function() {
        openModal('modal-slide-down', '/build/img/air-division.mp4');
    });

    document.querySelector('.iconos-transportation .icono:nth-child(3)').addEventListener('click', function() {
        openModal('modal-slide-left', '/build/img/ground-division.mp4');
    });

    // Close modal functionality
    closeModalButton.addEventListener('click', function() {
        modal.style.display = 'none';
        video.pause();
        video.src = ''; // Stop the video

        // Re-enable scrolling
        document.body.classList.remove('no-scroll');
    });

}

function mostrarSeccion(){
    //Ocultar la seccion q tenga la clase mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }
    //Seleccionar la seccion con el paso correspondiente
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    
    seccion.classList.add('mostrar'); 

    //Resaltar tab actual
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function(e){
            paso = parseInt(e.target.dataset.paso);
            
            mostrarSeccion();
            botonesPaginador();
            
        })
    })
    
}

function botonesPaginador(){

    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    if(paso === 1){
        paginaAnterior.classList.add('ocultar_boton');
        paginaSiguiente.classList.remove('ocultar_boton');
    } else if(paso === 4 ){
        paginaAnterior.classList.remove('ocultar_boton');
        paginaSiguiente.classList.add('ocultar_boton');
    } else {
        paginaSiguiente.classList.remove('ocultar_boton');
        paginaAnterior.classList.remove('ocultar_boton');
    }

    mostrarSeccion();

}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
        
    })
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
        
    })
}

function toggleFieldsHousecall() {
    const housecallCheckbox = document.getElementById('housecall');
    const housecall_fields = document.getElementById('housecall_fields');
    const latitudInput = document.getElementById('latitud');
    const longitudInput = document.getElementById('longitud');
    
    if (housecallCheckbox.checked) {
        
        housecall_fields.classList.add('unhide');
        
    } else {
        housecall_fields.classList.remove('unhide');
        latitudInput.value = '';
        longitudInput.value = '';
        
    }
}

function extractLatLngFromLink() {
    const googleMapsLink = document.getElementById('google_location').value;
    const regex = /@([-0-9.]+),([-0-9.]+)/;
    const latitudInput = document.getElementById('latitud');
    const longitudInput = document.getElementById('longitud');
    const match = googleMapsLink.match(regex);

    if (match) {
        const latitud = match[1];
        const longitud = match[2];

        latitudInput.value = latitud;
        longitudInput.value = longitud;
    } else {
       
        mostrarAlerta('Please enter a valid Google Maps link.', 'error', '.contenedor-app__instructions__content', '.appointments_tittle')
    }
}

function toggleFieldsSymptoms() {
    const symptomsCheckbox = document.getElementById('have_symptoms');
    const symptom_fields = document.getElementById('symptom_fields');
    const current =  document.getElementById('current_symptoms');
    const date_symptoms =  document.getElementById('date_symptoms');
    
    if (symptomsCheckbox.checked) {
        
        symptom_fields.classList.add('unhide');
        
    } else {
        symptom_fields.classList.remove('unhide');
        current.value = '';
        date_symptoms.value = '';

        
        
    }
}

function seleccionarHora(){

    const inputHora = document.querySelector('#time_appointment');
    inputHora.addEventListener('input', function(e){
        
        const horaCita= e.target.value
        const hora = horaCita.split(':')[0]

        if(hora < 8 || hora > 17){
            e.target.value = '';
            mostrarAlerta('Clinic Hours are between 8 and 17 hs.', 'error', '.contenedor-app__instructions__content', '.appointments_tittle')
        }  
    })
}

function mostrarAlerta(mensaje, tipo, elem, prevelem, desaparece = true){

    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    };

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const elemento = document.querySelector(elem);
    const antesde = document.querySelector(prevelem);
    elemento.insertBefore(alerta, antesde);

    if(desaparece){
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

}

function scheduleSuccess(){
    if(appointment){
        
        mostrarAlerta('Your appointment has been scheduled successfully', 'exito', '.contenedor-app__instructions__content', '.appointments_tittle')
        setTimeout(() => {
            window.location.href = '/appointments';
        }, 5000);
    }
}

function enableForm(){

    const form = document.getElementById('formulario__appointments__admin');
    
    if(form){
        const editButton = document.getElementById('editButton');
        const inputs = form.querySelectorAll('input, select');

    inputs.forEach(input => {
        input.setAttribute('disabled', true);
    });
    // Enable all fields when "Edit" button is clicked
    editButton.addEventListener('click', () => {
        inputs.forEach(input => {
            input.removeAttribute('disabled');
        });
        
        editButton.setAttribute('disabled', true);
    });
    }
    
}

function mostrarModal(reporteId, patientName){
    // Get the modal
    var modal = document.getElementById("uploadModal");
    if(modal){
        document.getElementById('verified_report').value = '';
        document.querySelector('.paciente_notas').textContent = patientName;
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the span (button), open the modal
        modal.style.display = "block";
        
        document.getElementById("reporte_id").value = reporteId;
        // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

        // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
}
    


function relatedModal(reporteId){
    // Get the modal
    var modal = document.getElementById("relatedModal");
    if(modal){
        document.getElementById('file_id').value = '';
        if(modal){
       
        // Get the <span> element that closes the modal
        var span = document.getElementById("closeModal");
        
        // When the user clicks the span (button), open the modal
        modal.style.display = "block";
        
        document.getElementById("file_reporte_id").value = reporteId;
        // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                
                modal.style.display = "none";
            }

        // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    }
    
}

function mostrarModalPaciente(){
    // Get the modal
    var modal = document.getElementById("pacienteModal");
    
    if(modal){
       
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the span (button), open the modal
        modal.style.display = "block";
        
        
        // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

        // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    }

async function crearPaciente() {
    
    var form = document.getElementById('crear_paciente_modal');
    var formData = new FormData(form);

try {
        //Peticion hacia la API
        const url = '/api/pacientes';

        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        })

        const resultado = await respuesta.json();
       
        var errorContainer = document.getElementById('error-container');
        errorContainer.innerHTML = '';
        if(resultado.resultado){
            var pacienteId = resultado.resultado.id;
            var pacienteNombre = resultado.patient_name;
            document.getElementById('pacienteModal').style.display = 'none';
            
            var selectPaciente = document.getElementById('patient_id'); // Adjust the ID to match your select element
            var newOption = document.createElement('option');

            newOption.value = pacienteId;
            newOption.text = pacienteNombre;
            selectPaciente.appendChild(newOption);

            selectPaciente.value = pacienteId;

            form.reset();
            
        } else{
            resultado.errores.forEach(error => {
                var errorDiv = document.createElement('div');
                errorDiv.classList.add('alerta', 'error');
                errorDiv.innerText = error;
                errorContainer.appendChild(errorDiv);
            });
        }
    } catch (error) {

        alert('error')
        
    }
   
}


function diagnosticoField(){

    const diagnosticoContainer = document.getElementById('diagnosticoContainer');
    const newDiagnosticoDiv = document.createElement('div');
    newDiagnosticoDiv.classList.add('input_plus');
    
    newDiagnosticoDiv.innerHTML = `
        
            <input type="text" name="diagnostico[]" />
            <button type="button" class="remove-btn"><i class="fa-solid fa-trash"></i></button>
        
    `;
    
    diagnosticoContainer.appendChild(newDiagnosticoDiv);

    // Add event listener to remove button
    newDiagnosticoDiv.querySelector('.remove-btn').addEventListener('click', function() {
        diagnosticoContainer.removeChild(newDiagnosticoDiv);
    });
}

function planField(){

    const planContainer = document.getElementById('planContainer');
    const newPlanDiv = document.createElement('div');
    newPlanDiv.classList.add('input_plus');
    
    newPlanDiv.innerHTML = `
        
            <input type="text" name="plan[]" />
            <button type="button" class="remove-btn"><i class="fa-solid fa-trash"></i></button>
        
    `;
    
    planContainer.appendChild(newPlanDiv);

    // Add event listener to remove button
    newPlanDiv.querySelector('.remove-btn').addEventListener('click', function() {
        planContainer.removeChild(newPlanDiv);
    });
}

