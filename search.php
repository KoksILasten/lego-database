<?php
    //Include header and DB connection
    include 'include/header.php';
    include 'include/dbconnect.php';
    include 'include/functions.php';
    include 'include/menu.php';

    $limit = 12;
    $minLenght = 3;
    // Check for provided search term from index
    if (isset($_GET['term'])) {
        $searchTerm = $_GET['term'];

        // Check number of letters
        if (strlen($searchTerm) < $minLenght) {
            echo '<p class="prompt">För att enklare hitta det du söker, vänligen skriv minst fem tecken.</p>';

        } else {

            // Check wether the webiste should display the report or the sets
            if ($searchTerm == 'Rapport' OR $searchTerm == 'rapport') {
                header("Location: report.php");
                die();

            } else {
                // Search for term in DB
                $fullSql = "SELECT * FROM sets WHERE Setname LIKE '%{$searchTerm}%' OR SetID LIKE '%{$searchTerm}%'";
                $fullResult	= mysqli_query($connection, $fullSql);
                $numberOfResults = mysqli_num_rows($fullResult);
                $numberOfPages = ceil($numberOfResults / $limit);

                // Find which page the user is on
                if (!isset($_GET['page'])) {
                    $page = 1;
                    
                } else {
                    $page = $_GET['page'];
                }

                $thisPageFirstResult = ($page - 1) * $limit;

                $sql = "SELECT * FROM sets WHERE Setname LIKE '%{$searchTerm}%' OR SetID LIKE '%{$searchTerm}%' ORDER BY sets.Year DESC LIMIT $thisPageFirstResult,$limit";
                $result	= mysqli_query($connection, $sql);
            }
        }
 
    }
    else {
        // Not found, send user back to index
        header("Location: index.php");
        die();
    }    
?>

<div id='search_results_container'>
    <?php displayResults($connection, $result); ?>
</div>

<?php

function test() {
    echo "HELLO WORLD!";
}
    // Only show pagination if more than one page
    if ($numberOfPages > 1) {
        echo "<div class='pagination'>";

            for ($page = 1; $page <= $numberOfPages; $page++) {

                // Active button if clicked
                if ($_GET['page'] == $page) {
                    echo '<a style="background-color: #0f69d6a4; color: white;" class="page" href="search.php?term=' . $searchTerm . '&page=' . $page . '">' . $page . '</a> ';
                } else {
                    echo '<a class="page" href="search.php?term=' . $searchTerm . '&page=' . $page . '">' . $page . '</a> ';
                }

            }
        echo "</div>";
    }
?>

<?php
    include "include/footer.php";
?>