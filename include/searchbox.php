<?php
   // Check search term
   if (isset($_POST["search-submit"])) {
      
      if (isset($_POST["search-term"]) && $_POST["search-term"] != "") {
         $searchTerm = $_POST["search-term"];
         header('Location: search.php?term=' . $searchTerm);
      }  
  }
?>

<!-- Form value is same as your search !-->
<div id="searchbox_div">
   <form method="post">
      <div id="search_term_div">
         <button type="submit" id="search_btn" name="search-submit"><img src="assets/img/search.png" alt="Search"></button>
         <input action="#" autocomplete="off" type="text" name="search-term" placeholder="Sök på Lego-set eller set-ID" value="<?php $searchTerm = $_GET['term']; echo $searchTerm; ?>">
      </div>
      <div id="filter_dropdown_div">
         <div id="flexbox_margin"></div>
         <!-- <select id="searchbox_cat_select" name="categories"></select>
         <select id="searchbox_year_select" name="year"></select> -->
      </div>
   </form>
   <button id="filter_dropdown_btn" onclick="filterDropdown(false)"><img src="assets/img/filter_dropdown.svg" alt="Filter Dropdown"></button>
</div>