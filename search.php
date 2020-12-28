<?php
    //Include header and DB connection
    include 'include/header.php';
    include 'include/dbconnect.php';
    include 'include/functions.php';
    include 'include/menu.php';

    // Check for provided search term from index
    if (isset($_GET['term'])) {
        $searchTerm = $_GET['term'];
        $limit = 12;

        // Check wether the webiste should display the report or the sets
        if ($searchTerm == 'Rapport' OR $searchTerm == 'rapport') {
            header("Location: report.php");
            die(); // Ta bort??

        } else {
            
            // Search for term in DB
            $fullSql = "SELECT * FROM sets WHERE Setname LIKE '%{$searchTerm}%' OR SetID LIKE '%{$searchTerm}%'";
            $fullResult	= mysqli_query($connection, $fullSql);
            $numberOfResults = mysqli_num_rows($fullResult);
            $numberOfPages = ceil($numberOfResults / $limit);

            // find which page the user is on
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $thisPageFirstResult = ($page - 1) * $limit;

            $sql = "SELECT * FROM sets WHERE Setname LIKE '%{$searchTerm}%' OR SetID LIKE '%{$searchTerm}%' LIMIT $thisPageFirstResult,$limit";
            $result	= mysqli_query($connection, $sql);
        }
      
    }
    else {
        // Not found, send user back to index
        header("Location: index.php");
    }    
?>

<div id='search_results_container'>
    <?php displayResults($connection, $result); ?>
</div>

<?php
    // Pagination
    echo "<div class='pagination'>";
    for ($page = 1; $page <= $numberOfPages; $page++) {
        echo '<a href="search.php?term=' . $searchTerm . '&page=' . $page . '">' . $page . '</a> ';
    }
    echo "</div>";
?>

<?php
    include "include/footer.php";
?>