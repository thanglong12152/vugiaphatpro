$(document).ready(function(){
    $(".sb-toggle-left").click(function(){
        $('#menu-fixed-bar').slideToggle("fast");
    });
});

$(document).ready(function() {
 
    $("#owl-demo").owlCarousel({
      nav:true,
      navText:["<div class='owl-prev' style=''>‹</div>","<div class='owl-next' style=''>›</div>"],
      dots: true,
      dotElement: 'button role="button" aria-labelledby="my-element-{n}"',
      items:1,
      autoplay:true,
      loop:true
    });
   
  });

  $('#play').on('click', function(e) {
    e.preventDefault();
    $("#player")[0].src += "?autoplay=1";
    $('#player').show();
    $('#video-cover').hide();
    $('#play').hide();
    $('#vd-ctx').css('z-index',3);
  });

  $(document).ready(function(){
    $('#slideshow_slider').slick({
      centerMode: true,
      centerPadding: '60px',
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });
  });

  $(document).ready(function(){
    $(".close").click(function(){
      $(".filters_in_field_inner.item").addClass("activated");
    });
  });

 