<?php
   echo 
   "<div id='set_info_div'>" .
      "<img src='" . $imagePath . "' alt='" . $name . "'>" .
      "<div>" . 
         "<p id='set_title'>" . $name . "</p>" .
         "<p id='set_id'>ID: " . $setId . "</p>" .
         "<button class='set_info set_info_cat'>" . $category . "</button>" .
         "<button class='set_info set_info_year'>" . $year . "</button>" .
      "</div>" . 
   "</div>" .
   "<div id='set_inventory_div'>" .
   "<p id='set_inventory_title'>Innehåller</p>" .
   "<hr>" .
   ""
?>