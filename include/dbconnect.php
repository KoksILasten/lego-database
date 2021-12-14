<?php
   try {
      $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");   // Connect to the lego DB
      $link = "http://www.itn.liu.se/~stegu/img.bricklink.com";            // Save link to the images connected to the DB
   }
   catch (Exception $e) {
      // Catch error messages if connection failed
      $error = $e->getMessage(); // vi borde ta hela den här error grejen!
      echo $error;
   }
?>