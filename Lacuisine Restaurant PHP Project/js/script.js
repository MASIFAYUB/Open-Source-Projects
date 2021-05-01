$(document).ready(function () {


//Ripple Effect                  
    $("#header, .info").ripples({
        dropRadius: 25,
        perturbance: 10 
    })


// toggle btn
    $('.navbar-toggler').click(function(){

    $('.navbar-toggler').toggleClass('change')
    
    })


// sticky navbar less padding
    $(window).scroll(function(){

    let position = $(this).scrollTop();
    
    if(position>=718){
        $('.navbar').addClass('navbar-background');
        $('.navbar').addClass('fixed-top');
    }
    else{
        $('.navbar').removeClass('navbar-background');
        $('.navbar').removeClass('fixed-top');
    }
    })


// smooth scroll
    $('.nav-item a, .header-link, #back-to-top').click(function (link) {
        
        link.preventDefault();

        let target = $(this).attr('href');

        $('html, body').stop().animate({scrollTop: $(target).offset().top-25
        }, 2000);

    })

// back to top
    $(window).scroll(function(){

    let position = $(this).scrollTop();
    
    if(position>=718){
        $('#back-to-top').addClass('scrollTop');
    }
    else{
        $('#back-to-top').removeClass('scrollTop');   
    }
    })


//Magnific poppup
    $('.parent-container').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true
        }
    })
});