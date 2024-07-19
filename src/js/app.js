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
        accordion();
        clipCurtain();
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
    
    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');

        }else{
                navegacion.classList.add('mostrar');
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

function clipCurtain() {
    var header = document.querySelector('.video-container');
    var inicio = document.querySelector('.inicio');
    var portada = document.querySelector('.portada');

    window.addEventListener('scroll', function () {
        var scrollY = window.scrollY;
        var headerHeight = header.offsetHeight;
        var portadaHeight = portada.offsetHeight;
        var inicioHeight = inicio.offsetHeight;
        var portadaTop = portada.offsetTop;

        // Adjust this factor to slow down the clipping effect
        var scrollFactor = 2; // Increase this value to slow down the effect

        if (scrollY < headerHeight * scrollFactor) {
            var clipValue = (scrollY / (headerHeight * scrollFactor)) * 50; // Adjusting to clip from 0 to 50%
            header.style.clipPath = `inset(${clipValue}% 0 ${clipValue}% 0)`;
        } else {
            header.style.clipPath = `inset(50% 0 50% 0)`; // Fully clipped from top and bottom

            // Check if scrollY has passed the end of portada
            if (scrollY >= portadaTop + portadaHeight) {
                // Change the position property of inicio
                inicio.style.position = 'absolute';
                inicio.style.top = `${portadaTop + portadaHeight}px`; // Adjust based on portada's position and height
                inicio.style.zIndex = '3'; // Ensure it's above other content
            } else {
                // Reset inicio's position when not at the end of portada
                inicio.style.position = 'fixed';
                inicio.style.top = '0'; // Reset top position as needed
                inicio.style.zIndex = '4'; // Ensure it's above header and portada
            }
        }
    });
}