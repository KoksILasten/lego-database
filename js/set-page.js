// Script file containing the hanling of filter change and the "part detail" window on the set page

// Change the category filter. Called on when clicking on the category button
function changeCategory(id) {
   // Change category in selection box
   $selectionBox = document.getElementById('searchbox_cat_select');
   $selectionBox.value=id;

   filterDropdown(false);           // Open dropdown if it is closed
   $('#search_term_input').focus(); // And focus on the text input

   // Change class on selection box for a short time to highlight
   $('#searchbox_cat_select').addClass('cat_selectbox_hover_js');
   setTimeout(function(){
      $('#searchbox_cat_select').removeClass('cat_selectbox_hover_js');
   }, 200)
}

// Change the year filter. Called on when clicking on the year button
function changeYear(year) {
   // Step down to the closest number dividable by 10, as these are the values used in the selection box
   while (year % 10 != 0) {
      year--;
   }

   // Change year in selection box
   $selectionBox = document.getElementById('searchbox_year_select');
   $selectionBox.value=year;

   filterDropdown(false);           // Open dropdown if it is closed
   $('#search_term_input').focus(); // And focus on the text input

   // Change class on selection box for a short time to highlight
   $('#searchbox_year_select').addClass('year_selectbox_hover_js');
   setTimeout(function(){
      $('#searchbox_year_select').removeClass('year_selectbox_hover_js');
   }, 200)
}

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