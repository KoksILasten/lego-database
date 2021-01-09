<?php

// Display search results based on search term
function displayResults($connection, $result) {
   if($result->num_rows === 0) {
      $searchTerm = $_GET['term'];
      // No results
      echo '<div class="prompt">';
         echo "Din sökning: " . $searchTerm . " - finns inte bland sökresultaten. ";
      echo "</div>";
         // Img
         echo '<div class="error">';
         echo "<img src='assets/img/noresult.jpg' alt='Inga resultat'>";
         echo '</div>';
         // Suggestions 
      echo '<div class="prompt">';   
         echo "Alternativ: <br />";
         echo " - Kontrollera om det finns stavfel. <br />"; 
         echo " - Testa andra ord. <br />";
         echo " - Testa en annan kategori. <br />";
      echo "</div>";
      echo "</div>";
   }
   else {
      // Results found, display search
         while ($row = mysqli_fetch_array($result))	{
            $setId = $row['SetID'];
            $name = $row['Setname'];
            $year = $row['Year'];
            $catId = $row['CatID'];
            $imagePath = findImage($connection, $setId, "S", "", true);
            echo '<div class="sets">';
               echo "<a href='set.php?setId=" . $setId . "'><div class='result_container'>";
                  echo "<img src='" . $imagePath  . "' alt='" . $name  . "'>";

                  echo "<div>";
                     echo "<p class='result_title'>" . $name . "</p>";
                     echo "<p class='result_categories'>🔠 " . findCategory($connection, $catId) . "</p>";
                     echo "<p class='result_year'>📅 " . $year . "</p>";
                  echo "</div>";
               echo "</div></a>";
            echo '</div>';
         }
   }

}

// Find image path from corresponding item ID, small or large
function findImage($connection, $itemId, $type, $colorId, $getLarge) {
   $imagePathPrefix = "http://www.itn.liu.se/~stegu76/img.bricklink.com/";

   // Check if color is used as search argument. If so, make it fit into the url and use it as search term in DB
   if ($colorId != "") {
      $images = mysqli_query($connection, "SELECT * FROM	images WHERE ItemID LIKE '" . $itemId . "' AND ItemtypeID LIKE '" . $type . "' AND ColorID LIKE '" . $colorId . "'");
      $colorId .= "/";
   }
   else {
      $images = mysqli_query($connection, "SELECT * FROM	images WHERE ItemID LIKE '" . $itemId . "' AND ItemtypeID LIKE '" . $type . "'");
   }


      while ($row = mysqli_fetch_array($images))	{
      if ($getLarge) {
         // Get large image
         if ($row['has_largejpg']) {
            return $imagePathPrefix . $type . "L/" . $colorId . $itemId . ".jpg";
         }
         else if ($row['has_largegif']) {
            return $imagePathPrefix . $type . "L/" . $colorId . $itemId . ".gif";
         }
      }
      if ($row['has_jpg']) {
         return $imagePathPrefix . $type . "/" . $colorId . $itemId . ".jpg";
      }
      else if ($row['has_gif']) {
         return $imagePathPrefix . $type . "/" . $colorId . $itemId . ".gif";
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
   // , p.Partname, m.Minifigname
   // $inventory = mysqli_query($connection, "SELECT 
   //    i.SetID, i.ItemtypeID, i.ItemID, i.Quantity i.ColorID
   //    FROM inventory AS i
   //    -- INNER JOIN parts AS p ON i.ItemID = p.PartID
   //    -- INNER JOIN minifigs AS m ON i.ItemID = m.MinifigID
   //    WHERE i.SetID LIKE '" . $setId . "' ORDER BY i.ItemtypeID, i.Quantity");

   $inventory = mysqli_query($connection, "SELECT * FROM inventory WHERE SetID LIKE '" . $setId . "' ORDER BY ItemtypeID, Quantity");

   echo "<div class='set_inventory_div' id='inventory_minifigs_div'>"; // Start minifigs div

   // Search for the minifigs
   while ($row = mysqli_fetch_array($inventory)) {
      if ($row['ItemtypeID'] == "M") {
         $outputtingMinifigs = true; // Starts with outputting minifigs
         $imagePath = findImage($connection, $row['ItemID'], "M", "", false);
         displayCell ($row['ItemID'], getMinifigName($connection, $row['ItemID']), $row['Quantity'], $imagePath);
      }
      else if ($row['ItemtypeID'] == "P") {
         // Check if last output was a minifig
         if ($outputtingMinifigs) {
            // End minifigs div and start parts div
            echo "</div><hr><div class='set_inventory_div' id='inventory_parts_div'>";
            $outputtingMinifigs = false;
         }

         $imagePath = findImage($connection, $row['ItemID'], "P", $row['ColorID'], false);
         displayCell ($row['ItemID'], getPartName($connection, $row['ItemID']), $row['Quantity'], $imagePath);
      }
   }

   echo "</div>"; // End parts div
}

// Output the part or minifig cell
function displayCell ($itemId, $partName, $quantity, $imagePath) {
   // NOTE: We replace every "'" in $partName with "?quote?" for it to work as a argument in the function. We switch it back later inte the function
   echo "<div class=\"part_cell\" onclick=\"displayPartDetails('" . $itemId . "', '" . str_replace("'", "?quote?", $partName) . "', '" . $quantity . "', '" . $imagePath . "')\">
            <p>" . $quantity . " x</p>
            <div class='item_img_div'>
               <img src=" . $imagePath . ">
            </div>
         </div>";
}

function getPartName($connection, $partId) {
   $parts = mysqli_query($connection, "SELECT * FROM parts WHERE PartID LIKE '" . $partId . "'");
   while ($row = mysqli_fetch_array($parts)) {
      return $row['Partname'];
   }
}

function getMinifigName($connection, $minifigId) {
   $minifigs = mysqli_query($connection, "SELECT * FROM minifigs WHERE MinifigID LIKE '" . $minifigId . "'");
   while ($row = mysqli_fetch_array($minifigs)) {
      return $row['Minifigname'];
   }
}

?>