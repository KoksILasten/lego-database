<?php
   echo 
   "<div id='set_info_div'>" .
      "<img src='" . $imagePath . "' alt='" . $name . "'>" .
      "<div id='set_content'>" . 
         "<p id='set_title'>" . $name . "</p>" .
         "<div class='category'>" .
            "<button class='set_info set_info_cat'>" . $category . "</button>" .
            "<button class='set_info set_info_year'>" . $year . "</button>" .
         "</div>" .
         "<p id='set_id'>ID: " . $setId . "</p>" .
      "</div>" . 
   "</div>" .
   "<div>" .
   "<p id='set_inventory_title'>Innehåller</p>" .
   "<hr>";
   displayInventory($connection, $setId);
   echo "</div>";
?>