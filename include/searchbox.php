<?php
   $openDropdown = false; // Whether to start with the dropdown open or closed

   // Check search term, category and year
   if (isset($_POST["search-submit"])) {
      // Initiate url variables
      $termUrl = '';
      $catUrl = '';
      $yearUrl = '';

      // Check if search term was used
      if (isset($_POST["search-term"]) && $_POST["search-term"] != "") {
         $searchTerm = $_POST["search-term"]; // Save search term
         $termUrl = 'term=' . $searchTerm;    // Make search term appear in url
      }
      // Check if category was selected
      if ($_POST["category"] != 0) {
         $category = $_POST["category"];  // Save category
         $catUrl = 'cat=' . $category;   // Make cat appear in url
      }
      // Check if year was selected
      if ($_POST["year"] != 0) {
         $year = $_POST["year"];       // Save year
         $yearUrl = 'year=' . $year;  // Make year appear in url
      }


      // Check number of letters and if category or year is used in search
      $minLenght = 3;
      if (strlen($searchTerm) < $minLenght && strlen($searchTerm) != 0 && $catUrl == '' && $yearUrl == '') {
         header('Location: index.php?error=true'); // If not, redirect to index with error message
      }
      else {
         // Combine the url variables
         if ($termUrl != "" && $catUrl != "" || $termUrl != "" && $yearUrl != "") {
            $termUrl .= '&';
         }
         if ($catUrl != "" && $yearUrl != "") {
            $catUrl .= '&';
         }
         $urlVar = $termUrl . $catUrl . $yearUrl;

         header('Location: search.php?' . $urlVar); // Send user to search page
      }
   }

   // Generate the categories and year options from the database
   $catOptionsName = array();
   $catOptionsId= array();
   $yearSpan = array();
   $incrementsSpan = array();

   // Set categories options
   getCategories($connection, $catOptionsName, $catOptionsId);

   // Create the category options
   // Check if user has selected category from any previous page
   if (isset($catPassed)) {
      $catOptionsOutput = "<option value='0'>Kategori</option>";  // Don't set default as selected
      $openDropdown = true;                                       // Start page with filter dropdown open
   }   
   else {
      $catOptionsOutput = "<option value='0' selected>🔠 Kategori</option>"; // Set default as selected
      $catPassed = '';
   }
   foreach ($catOptionsId as $key => $option) {
      if ($option == $catPassed) {
         $catOptionsOutput .= "<option value='" . $option . "' selected>" . $catOptionsName[$key] . "</option>";
      }
      else {
         $catOptionsOutput .= "<option value='" . $option . "'>" . $catOptionsName[$key] . "</option>";
      }
   }
   
   // Set year options
   $yearSpan = getYearSpan($connection);
   createYearSpan($yearSpan, $incrementsSpan);

   // Create the year span options
   // Check if user has selected year from any previous page
   if (isset($yearPassed)) {
      $yearOptionsOutput = "<option value='0'>År</option>"; // Don't set default as selected
      $openDropdown = true;                                 // Start page with filter dropdown open
   }   
   else {
      $yearOptionsOutput = "<option value='0' selected>📅 År</option>"; // Set default as selected
      $yearPassed = '';
   }
   foreach ($incrementsSpan as $option) {
      if ($option == $yearPassed) {
         $yearOptionsOutput .= "
         <option value='" . $option . "' selected>
         " . $option . " - " . ($option + 9) .
         "</option>";
      }
      else {
         $yearOptionsOutput .= "
         <option value='" . $option . "'>
         " . $option . " - " . ($option + 9) .
         "</option>";
      }
   }
?>

<!-- Form value is same as your search !-->
<div id="searchbox_div">
   <form method="post" id='searchbox_form'>
      <div id="search_term_div">
         <button type="submit" id="search_btn" name="search-submit"><img src="assets/img/search.svg" alt="Search"></button>
         <input id='search_term_input' autocomplete="off" type="text" name="search-term" placeholder="Sök Lego-set / set-ID" value="<?php echo $searchTerm; ?>">
      </div>
      <div id="filter_dropdown_div">
         <div id='dropdown_offset'></div>
         <select class='set_info set_info_cat close' id="searchbox_cat_select" name="category">
            <?php echo $catOptionsOutput; ?>
         </select>
         <select class='set_info set_info_year close' id="searchbox_year_select" name="year">
            <?php echo $yearOptionsOutput; ?>
         </select>
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