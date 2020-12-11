<?php
    // Header
    include 'include/header.php';

    // Check search term
    if (isset($_POST["search-submit"])) {
        // Check search term for nr of characters
        if (isset($_POST["search-term"]) && $_POST["search-term"] != "") {
           $searchTerm = $_POST["search-term"];
           header('Location: search.php?term=' . $searchTerm);
        }  
    }
?>

<div class="search">
    <a href="index.php"><h1 id="title">Leegle</h1></a>
    
    <form method="post" action="">
        <input type="text" name="search-term" placeholder="Sök på set-ID eller Lego-set">
        <input type="submit" name="search-submit" value="SÖK">
    </form>
</div>
<img src="images/brick.png" alt="">
</body>
</html>