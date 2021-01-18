<?php
   echo 
   "<div id='set_info_div'>" .
      "<img src='" . $imagePath . "' alt='" . $name . "'>" .   // Set image
      "<div id='set_content'>" . 
         "<p id='set_title'>" . $name . "</p>" .               // Set title
         "<div class='category'>" .
            "<button class='set_info set_info_cat' onclick=\"changeCategory('" . $catId . "')\">" . $catName . "</button>" .  // Set category
            "<button class='set_info set_info_year' onclick=\"changeYear('" . $year . "')\">" . $year . "</button>" .         // Set year
         "</div>" .
         "<p id='set_id'>ID: " . $setId . "</p>" .             // Set id
      "</div>" . 
   "</div>" .
   "<div>";
   displayInventory($connection, $setId); // Output set inventory
   echo "</div>";
?>