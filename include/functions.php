<?php

function displayResults($connection, $result) {
   if($result->num_rows === 0) {
      $searchTerm = $_GET['term'];
      // no results
      echo "<div>";
         echo "Din sökning: " . $searchTerm . " finns inte bland sökresultaten. <br />";
         echo "Suggestions: <br />";
         echo " - Kontrollera om det finns stavfel. <br />"; //Skriv in andra förslag än de från google
         echo " - Testa andra ord. <br />";
         echo " - Testa en annan kategori. <br />";
      echo "</div>";
   }
   else {
     // Results found, display search
      while ($row = mysqli_fetch_array($result))	{
         $setId = $row['SetID'];
         $name = $row['Setname'];
         $year = $row['Year'];
         $catId = $row['CatID'];
         $imagePath = findImage($connection, $setId, true);

         echo "<a href='set.php?setId=" . $setId . "'><div class='result_container'>";
            echo "<img src='" . $imagePath  . "' alt='" . $name  . "'>";

            echo "<div>";
               echo "<p class='result_title'>" . $name . "</p>";
               echo "<p class='result_categories'>Kategori: " . findCategory($connection, $catId) . "</p>";
               echo "<p class='result_year'>År: " . $year . "</p>";
            echo "</div>";
         echo "</div></a>";

      }
   }

}

function findImage($connection, $itemId, $getLarge) {
   $imagePathPrefix = "http://www.itn.liu.se/~stegu76/img.bricklink.com/";

   $images = mysqli_query($connection, "SELECT * FROM	images WHERE ItemID LIKE '" . $itemId . "'");

   while ($row = mysqli_fetch_array($images))	{
      if ($getLarge) {
         // Get large image
         if ($row['has_largejpg']) {
            return $imagePathPrefix . "SL/" . $itemId . ".jpg";
         }
         else if ($row['has_largegif']) {
            return $imagePathPrefix . "SL/" . $itemId . ".gif";
         }
      }
      if ($row['has_jpg']) {
         return $imagePathPrefix . "S/" . $itemId . ".jpg";
      }
      else if ($row['has_gif']) {
         return $imagePathPrefix . "S/" . $itemId . ".gif";
      }
      else {
        return $imagePathPrefix . "noimage_small.png";
      }
   }
   return "(notFound)";
}

function findCategory($connection, $catId) {
   $categories = mysqli_query($connection, "SELECT * FROM categories WHERE CatID LIKE '" . $catId . "'");

   while ($row = mysqli_fetch_array($categories)) {
      return $row['Categoryname'];
   }
   return "(not found)";
}

?>