<?php
   $openDropdown = false; // Whether to start with the dropdown open or closed

   // Check search term, category and year
   if (isset($_POST["search-submit"])) {
      // Initiate url variables
      $termUrl = ''; //sätter den till inget först

      // Check if search term was used
      if (isset($_POST["search-term"]) && $_POST["search-term"] != "") {
         $searchTerm = $_POST["search-term"]; // Save search term
         $termUrl = 'term=' . $searchTerm;    // Make search term appear in url
      }


      // Check number of letters and if category or year is used in search
      $minLenght = 3;
      if (strlen($searchTerm) < $minLenght && strlen($searchTerm) != 0 && $catUrl == '' && $yearUrl == '') {
         header('Location: index.php?error=true'); // If not, redirect to index with error message
      }
      else {
         // Combine the url variables
         if ($termUrl != "" && $catUrl != "" || $termUrl != "" && $yearUrl != "") { //huh vad är det här eller snarare varför
            $termUrl .= '&';
         }
         $urlVar = $termUrl . $catUrl . $yearUrl;

         header('Location: search.php?' . $urlVar); // Send user to search page
      }
   }

<!-- Form value is same as your search !-->
<div id="searchbox_div">
   <form method="post" id='searchbox_form'>
      <div id="search_term_div">
         <button type="submit" id="search_btn" name="search-submit"><img src="assets/img/search.svg" alt="Search"></button>
         <input id='search_term_input' autocomplete="off" type="text" name="search-term" placeholder="Sök Lego-set / set-ID" value="<?php echo $searchTerm; ?>">
      </div>
   </form>
   <button id="filter_dropdown_btn" onclick="filterDropdown(false)">
      <img id='filter_dropdown_btn_img' src="assets/img/triangle.svg" alt="Filter Dropdown">
   </button>
</div>

<?php 
   if ($openDropdown) {
      // Call the dropdown function after the website is loaded in. This is because the script containing the function is
      // located in the bottom of BODY, because it needs to interact with elements on the page that needs to be loaded in first
      echo "<script>
      document.addEventListener('DOMContentLoaded', function(event){
         filterDropdown(false);
       });
      </script>";
   }
?>