// Animate parts images on hover to display its ID

$('.item_img_div').mouseenter(function() {
   $(this).children('img').fadeTo("fast" , 0.4, function() {
      var idDiv = $(this).parent().children('div');
      idDiv.slideDown("fast",);

      // Check if text is overflowing
      if (idDiv.prop('scrollWidth') > idDiv.width() ) {
         idDiv.css('font-size',"-=0.2em");
      }   
   });
});
$('.item_img_div').mouseleave(function() {
   // Stop animation when leaving div
   $(this).children('img').stop();
   $(this).children('div').stop();

   $(this).children('div').slideUp("fast", function() {
      $(this).parent().children('img').fadeTo("fast" , 1);
   });
});



