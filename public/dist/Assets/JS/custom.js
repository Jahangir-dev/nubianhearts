
$('#myCarousel').carousel({
  interval: false
});

//scroll slides on swipe for touch enabled devices

//$("#myCarousel").on("touchstart", function(event){
//
//  var yClick = event.originalEvent.touches[0].pageY;
//  $(this).one("touchmove", function(event){
//
//      var yMove = event.originalEvent.touches[0].pageY;
//      if( Math.floor(yClick - yMove) > 1 ){
//          $(".carousel").carousel('next');
//      }
//      else if( Math.floor(yClick - yMove) < -1 ){
//          $(".carousel").carousel('prev');
//      }
//  });
//  $(".carousel").on("touchend", function(){
//      $(this).off("touchmove");
//  });
//});



$('.owl-carousel').owlCarousel({
  loop:true,
  margin:30,
  nav:false,
  autoplay:true,
  autoplayTimeout:3000,
  responsive:{
      0:{
          items:1
      },
      600:{
          items:2
      },
      1000:{
          items:3
      }
  }
})


if ($(window).width() > 992) {
  $(window).scroll(function(){  
     if ($(this).scrollTop() > 250) {
        $('.header').addClass("fixed-top");
        // add padding top to show content behind navbar
        $('body').css('padding-top', $('.header').outerHeight() + 'px');
      }else{
        $('.header').removeClass("fixed-top");
         // remove padding top from body
        $('body').css('padding-top', '0');
      }   
  });
} // end if