<?php
   // Check search term
   if (isset($_POST["search-submit"])) {
      
      if (isset($_POST["search-term"]) && $_POST["search-term"] != "") {
         $searchTerm = $_POST["search-term"];
         header('Location: search.php?term=' . $searchTerm);
      }  
  }
?>

<form method="post">
        <input type="text" name="search-term" placeholder="Sök på set-ID eller Lego-set">
        <input type="submit" name="search-submit" value="SÖK">
</form>