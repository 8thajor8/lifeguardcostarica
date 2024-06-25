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
    const navLinks = document.querySelectorAll('.navegacion-index a')

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