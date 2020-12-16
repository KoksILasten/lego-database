<?php

// Display search results based on search term
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
         $imagePath = findImage($connection, $setId, "S", true);

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

// Find image path from corresponding item ID, small or large
function findImage($connection, $itemId, $type, $getLarge) {
   $imagePathPrefix = "http://www.itn.liu.se/~stegu76/img.bricklink.com/";

   $images = mysqli_query($connection, "SELECT * FROM	images WHERE ItemID LIKE '" . $itemId . "'");

   while ($row = mysqli_fetch_array($images))	{
      if ($getLarge) {
         // Get large image
         if ($row['has_largejpg']) {
            return $imagePathPrefix . $type . "L/" . $itemId . ".jpg";
         }
         else if ($row['has_largegif']) {
            return $imagePathPrefix . $type . "L/" . $itemId . ".gif";
         }
      }
      if ($row['has_jpg']) {
         return $imagePathPrefix . $type . "/" . $itemId . ".jpg";
      }
      else if ($row['has_gif']) {
         return $imagePathPrefix . $type . "/" . $itemId . ".gif";
      }
      else {
        return $imagePathPrefix . "noimage_small.png";
      }
   }
   return "(notFound)";
}

// Find category name from its ID
function findCategory($connection, $catId) {
   $categories = mysqli_query($connection, "SELECT * FROM categories WHERE CatID LIKE '" . $catId . "'");

   while ($row = mysqli_fetch_array($categories)) {
      return $row['Categoryname'];
   }
   return "(not found)";
}

function displayInventory($connection, $setId) {
   $inventory = mysqli_query($connection, "SELECT * FROM	inventory WHERE SetID LIKE '" . $setId . "'");

   // Search for the minifigs
   while ($row = mysqli_fetch_array($inventory)) {
      if ($row['ItemTypeId'] == "P") {
         echo "PART: " . getPart($connection, $row['ItemTypeId']);
      }
      else {
         echo "MINIFIG: " . getMinifig($connection, $row['ItemTypeId']);
      }
   }
}

function getPart($connection, $partId) {
   $parts = mysqli_query($connection, "SELECT * FROM parts WHERE PartID LIKE '" . $partId . "'");
   while ($row = mysqli_fetch_array($parts)) {
      return $row['Minifigname'];
   }
}

function getMinifig($connection, $minifigId) {
   $minifigs = mysqli_query($connection, "SELECT * FROM minifigs WHERE MinifigID LIKE '" . $minifigId . "'");
   while ($row = mysqli_fetch_array($parts)) {
      return $row['Minifigname'];
   }
}

?>