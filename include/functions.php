<?php

function displayResults($connection, $result) {
   $imagePathPrefix = "http://www.itn.liu.se/~stegu76/img.bricklink.com/";

   // Display search
   while ($row = mysqli_fetch_array($result))	{
      $setId = $row['SetID'];
      $colorId = $row['ColorID'];
      $name = $row['Setname'];
      $year = $row['Year'];
      $imagePath = findImage($connection, $setId); 
      
      echo "<div class='result_container'>";
      echo "<img src='" . $imagePathPrefix . $imagePath  . "' alt='" . $name  . "'>";
      echo "<p class='result_title'>" . $name . "</p>";
      echo "</div>";
   }
}

function findImage($connection, $itemId) {
   $images = mysqli_query($connection, "SELECT * FROM	images WHERE ItemID LIKE '" . $itemId . "'");
   
   while ($row = mysqli_fetch_array($images))	{
      if ($row['has_gif']) {
         return "S/" . $itemId . ".gif";
      }
      else if ($row['has_jpg']) {
         return "S/" . $itemId . ".jpg";
      }
      else {
        return "noimage_small.png";
      }
    
   }

   return "(notFound)";
}

?>