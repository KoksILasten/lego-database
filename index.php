<?php
    // Checks if error message should be displayed
    if (isset($_GET['error'])) {
        $showError = true;
    }
    else {
        $showError = false;
    }

    // Header
    include 'include/header.php';
    include 'include/dbconnect.php';
    include 'include/functions.php';
?>

<div id="search">
    <a href="index.php"><h1 class="logo" id="title">Leegle</h1></a>    
    <?php 
        include 'include/searchbox.php';
        if ($showError) {
            // Display error message
            echo '<h3 class="prompt">För att enklare hitta det du söker, vänligen skriv minst tre tecken.</h3>';
        }
    ?>
</div>
<?php include 'include/footer.php'; ?>