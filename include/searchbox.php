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
<form method="post">
      <input type="submit" value="🔎" name="search-submit">
      <input action="#" autocomplete="off" type="text" name="search-term" placeholder="Sök på set-ID eller Lego-set" value="<?php $searchTerm = $_GET['term']; echo $searchTerm; ?>"> 
</form>