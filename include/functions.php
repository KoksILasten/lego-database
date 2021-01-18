<?php

// Find and return all category names as an array
function getCategories($connection, &$catOptionsName, &$catOptionsId) {
   $categories = mysqli_query($connection, "SELECT * FROM categories ORDER BY Categoryname");

   while ($row = mysqli_fetch_array($categories)) {
      $entryId = $row['CatID'];
      $entryName = $row['Categoryname'];

      // Check so that the entry contains characters, to rule out year categories
      if(preg_match("/[a-z]/i", $entryName)){
         array_push($catOptionsId, $entryId);
         array_push($catOptionsName, $entryName);
     }
   }
}

// Checks if the category is used by any sets (Not used because of performance issues)
function categoryUsed($connection, $id) {
   $sets = mysqli_query($connection, "SELECT * FROM sets WHERE CatID LIKE '" . $id . "'");

   while ($row = mysqli_fetch_array($sets)) {
      return true;
   }

   return false;
}

// Find and return the year span of all the LEGO sets in set DB
function getYearSpan($connection) {
   $yearSpan = array();

   $sets = mysqli_query($connection, "SELECT * FROM sets
      WHERE Year = (SELECT Year FROM sets ORDER BY Year LIMIT 1)
      OR Year = (SELECT Year FROM sets WHERE Year NOT IN('?') ORDER BY Year DESC LIMIT 1)
      ");

   while ($row = mysqli_fetch_array($sets)) {
      array_push($yearSpan, $row['Year']);
   }

   return $yearSpan;
}

// Creates a span between the 2 numbers in the provided array with increments of 10
function createYearSpan($numbers, &$span) {
   $lower = $numbers[0];
   $higher = $numbers[1];

   // Lower 'lower' to the closest increment below
   while ($lower % 10 != 0) {
      $lower--;
   }

   // Raise 'higher' to the closest increment above
   while ($higher % 10 != 0) {
      $higher++;
   }

   // Create the span with the new lower and higher
   for ($i=$lower; $i < $higher; $i=$i+10) { 
      array_push($span, $i);
   }
}

// Display search results based on search term
function displayResults($connection, $result, $term, $cat, $year) {
   if($result->num_rows === 0) {
      // No results   

      // Combine the search arguments, starting with the search term
      $message = '';
      if ($term != "") {
         $message .= 'Din sökning "<span class="prompt_quote">' . $term . '</span>"';
         if ($cat != "") {
            $message .= '<br>under kategorin "<span class="prompt_quote">' . findCategory($connection, $cat) . '</span>"';
         }
         if ($year != "") {
            $message .= '<br>mellan åren "<span class="prompt_quote">' . $year . ' - ' . ($year + 9) . '</span>"';
         }
         $message .= '<br>gav tyvärr inga resultat';
      }
      else if ($cat != "") {
         $message .= 'Kategorin "<span class="prompt_quote">' . findCategory($connection, $cat) . '</span>"';
         if ($year != "") {
            $message .= '<br>mellan åren "<span class="prompt_quote">' . $year . ' - ' . ($year + 9) . '</span>"';
         }
         $message .= '<br>är tyvärr tom';
      }
         
      echo "<div class='prompt'>";
         echo "<div id='error_arguments'>" . $message . "</div>";
      echo "</div>";
      // No result image
      echo '<div class="error">';
      echo "<img src='assets/img/noresult.jpg' alt='Lego clones'>";
         // Suggestions if no results on searchterm
         echo "<div class='list'>";
            echo "<h2>Alternativ:</h2>";
            echo "<ul>";
               echo "<li>Kontrollera om det finns stavfel.</li>"; 
               echo "<li>Testa andra ord.</li>";
               echo "<li>Testa en annan kategori eller annat årsspann.</li>";
            echo "</ul>";
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
         return "assets/img/no_image.png";
      }
   }
   return "(notFound)"; // Something went wrong in the search, used for troubleshooting
}

// Find category name from its ID
function findCategory($connection, $catId) {
   $categories = mysqli_query($connection, "SELECT * FROM categories WHERE CatID LIKE '" . $catId . "'");

   while ($row = mysqli_fetch_array($categories)) {
      return $row['Categoryname']; // Category found, return name
   }
   return "(not found)"; // Something went wrong in the search, used for troubleshooting
}

function displayInventory($connection, $setId) {
   $mCells = 0;
   $pCells = 0;
   $outputtingMinifigs = true; // Starts with outputting minifigs

   $inventory = mysqli_query($connection, "SELECT * FROM inventory WHERE SetID LIKE '" . $setId . "' ORDER BY ItemtypeID, Quantity");

   ob_start(); // If both minifig and part section is empty: remove every output below

    // Start inventory and minifigs div
   echo "<p id='set_inventory_title'>Innehåller</p>
      <hr>
      <div class='set_inventory_div' id='inventory_minifigs_div'>";

   // Search for the minifigs
   while ($row = mysqli_fetch_array($inventory)) {
      if ($row['ItemtypeID'] == "M") {
         // Output new minifig cell
         $imagePath = findImage($connection, $row['ItemID'], "M", "", false);                                     // Get Image path to minifig
         displayCell ($row['ItemID'], getMinifigName($connection, $row['ItemID']), $row['Quantity'], $imagePath); // Output cell
         $mCells++;
      }
      else if ($row['ItemtypeID'] == "P") {
         // Check if last output was a minifig
         if ($outputtingMinifigs) {
            echo '</div>'; // End minifig div

            // Check if minifig section is used
            if ($mCells > 0) {
               echo '<hr>';
            }

            // Start parts div
            echo "<div class='set_inventory_div' id='inventory_parts_div'>";
            $outputtingMinifigs = false;
         }

         // Output new part cell
         $imagePath = findImage($connection, $row['ItemID'], "P", $row['ColorID'], false);                     // Get Image path to minifig
         displayCell ($row['ItemID'], getPartName($connection, $row['ItemID']), $row['Quantity'], $imagePath); // Output cell
         $pCells++;
      }
   }
   echo "</div>"; // End parts div

   // Check if minifig- and/or parts section is empty
   if ($mCells == 0 || $pCells == 0) {
      // Check if both sections is empty
      if ($mCells == 0 && $pCells == 0) {
         ob_end_clean(); // Remove everything until and including the 'Innehåller' heading
         echo '<hr>';
      }
      // Check part section
      if ($pCells == 0) {
         echo "<p class='empty_section_p'> Information om bitar saknas</p>";
      }
   }
}

// Output the part or minifig cell
function displayCell ($itemId, $partName, $quantity, $imagePath) {
   // NOTE: We replace every "'" in $partName with "?quote?" for it to work as a argument in the function. We switch it back later inte the function
   echo "<div class=\"part_cell\" onclick=\"displayPartDetails('" . $itemId . "', '" . str_replace("'", "?quote?", $partName) . "', '" . $quantity . "', '" . $imagePath . "')\">
            <p>" . $quantity . " x</p>
            <div class='item_img_div'>
               <img src='" . $imagePath . "' alt='" . $partName . "'>
            </div>
         </div>";
}

// Uses the provided ID to search for the corresponding name in the part DB
function getPartName($connection, $partId) {
   $parts = mysqli_query($connection, "SELECT * FROM parts WHERE PartID LIKE '" . $partId . "'");
   while ($row = mysqli_fetch_array($parts)) {
      return $row['Partname']; // Part found, return name
   }
   return "(not found)"; // Something went wrong in the search, used for troubleshooting
}

// Uses the provided ID to search for the corresponding name in the minifig DB
function getMinifigName($connection, $minifigId) {
   $minifigs = mysqli_query($connection, "SELECT * FROM minifigs WHERE MinifigID LIKE '" . $minifigId . "'");
   while ($row = mysqli_fetch_array($minifigs)) {
      return $row['Minifigname']; // Minifig found, return name
   }
   return "(not found)"; // Something went wrong in the search, used for troubleshooting
}

?>