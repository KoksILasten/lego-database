// Script file containing the hanling of the searchbox

let leaveDropdownActive = false; // Used to start the page with the filter dropdown open

// Set the width of the 'dropdown_offset' div based on the width and margin of the submit button
let searchBtn = document.getElementById('search_btn');
document.getElementById('dropdown_offset').style.width = searchBtn.offsetWidth + 'px';

// Animates the filter search dropdown
function filterDropdown(isOpen) {
   let searchbox = document.getElementById('searchbox_div');
   let degree;

   // Check if the dropdown div should open or close
   if (isOpen) {
      searchbox.style.height = '30pt'; // Close dropdown
      degree = 0;                      // Add to rotation
      searchbox.style.boxShadow = '0px 0px 2px rgba(0,0,0,0.3)';
   }
   else {
      searchbox.style.height = '66pt'; // Open dropdown
      degree = 180;                    // Add to rotation
      searchbox.style.boxShadow = 'none';
      searchbox.style.boxShadow = '0px 0px 30px 2px rgba(82,146,200,0.2)';
   }

   // Change 'filter dropdown' button 
   document.getElementById("filter_dropdown_btn").setAttribute( "onClick", "javascript: filterDropdown(" + !isOpen + ");" );  // Edit onclick function
   $("#filter_dropdown_btn_img").css('transform','rotate(' + degree + 'deg)');                                                // Rotate image 180 degrees
}

// Remove focus from a select element when...
// ...an option is selected
$(".set_info").on('change', function(){
   $(this).blur();                  // Remove focus from element
   $('#search_term_input').focus(); // Also, focus on the text input
});
// ...the same select is pressed twice
$(".set_info").on('click', function(){
   // Check if dropdown is open
   if ($(this).hasClass("open")) {
      $(this).blur();               // Remove focus from element
      $(this).removeClass('open');  // Remove 'open' class
      $(this).addClass('close');    // Add 'close' class
   }
   else {
      $(this).removeClass('close'); // Remove 'close' class
      $(this).addClass('open');     // Add 'open' class
   }
});
// ...the mouse leaves the dropdown
$(".set_info").on('mouseleave', function(){
   $(this).blur(); // Remove focus from element
});
