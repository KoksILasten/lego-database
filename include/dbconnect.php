<?php
   try {
      $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
      $link = "http://www.itn.liu.se/~stegu/img.bricklink.com";
   }
   catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
   }
?>