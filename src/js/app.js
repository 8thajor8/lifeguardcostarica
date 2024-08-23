document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    navegacionFija();
    
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
    
}

function navegacionFija() {
    const barra = document.querySelector('.barra')
    const transportation = document.querySelector ('.fixed-scroll')
    

    window.addEventListener('scroll', function(){
        if(transportation.getBoundingClientRect().bottom < 1){
            barra.classList.add('fixed')
           
        } else{
            barra.classList.remove('fixed')
            
        }
    })


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



