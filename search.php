<?php
if (!isset($_GET['term'])) { //våran search!! samt urlargs som är allting se rad 7!
    // No search arguments provided, sent user back
    header("Location: index.php");
    die();
}
// $urlArgs är våran search pga att urlargs innehåller sök termen, året och kategorin!!! 

//Include header and DB connection, a bit further down to not interfere with possible use of header()
include 'include/header.php';
include 'include/dbconnect.php';
include 'include/functions.php';
include 'include/menu.php';

$limit = 12;

// Check for provided search term from index
if (isset($search)) { //i vårat fall blir det search

    // Search in DB
    $fullSql = "SELECT * FROM sets WHERE " . //hela fuktionen + search
        $fullResult    = mysqli_query($connection, $fullSql);
    $numberOfResults = mysqli_num_rows($fullResult);
    $numberOfPages = ceil($numberOfResults / $limit);

    // Find which page the user is on
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    // Calculates which search results to show, based on current page
    $thisPageFirstResult = ($page - 1) * $limit;
    $sql = "SELECT * FROM sets WHERE " . $sqlArgs . "ORDER BY sets.Year DESC LIMIT $thisPageFirstResult,$limit";
    $result    = mysqli_query($connection, $sql);
} else {
    // Not found, send user back to index
    header("Location: index.php");
    die();
}
?>

<div id='search_results_container'>
    <?php
    // Generate search results
    displayResults($connection, $result, $termPassed);
    ?>
</div>

<?php
// Only show pagination if more than one page
if ($numberOfPages > 1) {
    echo "<div class=footer>";
    echo "<div class='pagination'>";

    for ($page = 1; $page <= $numberOfPages; $page++) { //switch page funktionen gissar jag
        // Active button if clicked
        if ($_GET['page'] == $page) {
            echo '<a style="background-color: #0f69d6a4; color: white;" class="page" href="search.php' . $urlArgs . '&page=' . $page . '">' . $page . '</a> ';
        } else {
            echo '<a class="page" href="search.php' . $urlArgs . '&page=' . $page . '">' . $page . '</a> ';
        }
    }

    echo "</div>";
    echo "</div>";
}

include "include/footer.php";
?>