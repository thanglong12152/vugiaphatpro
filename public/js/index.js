$(document).ready(function () {
  $(".sb-toggle-left").click(function () {
    $('#menu-fixed-bar').slideToggle("fast");
  });
});

$(document).ready(function () {

  $("#owl-demo").owlCarousel({
    nav: true,
    navText: ["<div class='owl-prev' style=''>‹</div>", "<div class='owl-next' style=''>›</div>"],
    dots: true,
    dotElement: 'button role="button" aria-labelledby="my-element-{n}"',
    items: 1,
    autoplay: true,
    loop: true
  });

});

$('#play').on('click', function (e) {
  e.preventDefault();
  $("#player")[0].src += "?autoplay=1";
  $('#player').show();
  $('#video-cover').hide();
  $('#play').hide();
  $('#vd-ctx').css('z-index', 3);
});

$(document).ready(function () {
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

$(document).ready(function () {
  $(".close").click(function () {
    $(".filters_in_field_inner.item").addClass("activated");
  });
});
$('#keyword').keyup(function () {
  var name_prod = $("#keyword").val();
  //alert(name_prod);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'post',
    url: '/search/product',
    data: { name_prod: name_prod },
    success: function (data) {
      //alert(data);

      $('.autocomplete-suggestions').replaceWith(data);


    },
    error: function () {
      alert('Error');
    }
  });
});

$(document).ready(function () {
  $('.quantity_modal').bind('keyup mouseup', function () {
    var sl = $('.quantity_modal').val();

    var price = $('#price_modal').data('price');;

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      url: '/caculate',
      data: { sl: sl, price: price },
      success: function (data) {
        $('#price_modal').html(data);
        $('input[name=totalPrice]').val(data);
      },
      error: function () {
        alert('Error');
      }
    })
  });
});


function deleteProduct(id,cartId) {

  var id = id;
  var cartId = cartId;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  $.ajax({
    method: 'post',
    url: '/delete/cart',
    data: {
      id : id,
      cartId: cartId,
    },
    success: function(data){
      location.reload();
      console.log(data);
    },
    error: function (err) {
      console.log(err);
    }
  })
}
