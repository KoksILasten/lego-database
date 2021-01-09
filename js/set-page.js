// Hanling of the "part detail" window on the set page

// $('.item_img_div').mouseenter(function() {
//    $(this).children('img').fadeTo("fast" , 0.4, function() {
//       var idDiv = $(this).parent().children('div');
//       idDiv.slideDown("fast",);

//       // Check if text is overflowing
//       if (idDiv.prop('scrollWidth') > idDiv.width() ) {
//          idDiv.css('font-size',"-=0.2em");
//       }   
//    });
// });
// $('.item_img_div').mouseleave(function() {
//    // Stop animation when leaving div
//    $(this).children('img').stop();
//    $(this).children('div').stop();

//    $(this).children('div').slideUp("fast", function() {
//       $(this).parent().children('img').fadeTo("fast" , 1);
//    });
// });

function displayPartDetails(id, name, quantity, imagePath) {
   // Change img and text on the "part details" page
   document.getElementById("part_details_img").src = imagePath;   // img scr
   document.getElementById("part_details_img").alt = name;        // img alt
   document.getElementById("part_details_text_div").innerHTML =        // ID and name
      "<p id='part_name'>" + name.replaceAll("?quote?", "'") + "</p>" +
      "<p id='part_id'>ID: " + id + "</p>";
}