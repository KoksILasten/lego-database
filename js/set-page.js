// Script file containing the hanling of filter change and the "part detail" window on the set page


function displayPartDetails(id, name, quantity, imagePath) {
   // Change img and text on the "part details" div
   document.getElementById("part_details_img").src = imagePath;   // img scr
   document.getElementById("part_details_img").alt = name;        // img alt
   document.getElementById("part_details_text_div").innerHTML =   // ID and name
      "<p id='part_name'>" + name.replaceAll("?quote?", "'") + "</p>" +
      "<p id='part_id'>ID: " + id + "</p>";

   // Check if the container is hidden
   let detailsDiv = document.getElementById('part_details_div_container');
   if ($('#part_details_div_container').hasClass('part_details_hide')) {
      // Add and remove classes from part_details_div_container and set_page_container
      $('#part_details_div_container').addClass('part_details_show');
      $('#part_details_div_container').removeClass('part_details_hide');
      $('#set_page_container').addClass('container_extended');
      $('#set_page_container').removeClass('container_normal');
   }
}

// Hide the "part details" container when clicking on the main div background
$('#set_page_container').on('click', function(event) {
   // Compare the element clicked (event.target) with the element that has the click attached (this)
   if (event.target === this) {
      if ($('#part_details_div_container').hasClass('part_details_show')) {
         // Add and remove classes from part_details_div_container and set_page_container
         $('#part_details_div_container').addClass('part_details_hide');
         $('#part_details_div_container').removeClass('part_details_show');
         $('#set_page_container').addClass('container_normal');
         $('#set_page_container').removeClass('container_extended');
      }
   }
 });