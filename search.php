<?php
    //Include header and DB connection
    include 'include/header.php';
    include 'include/dbconnect.php';
    include 'include/functions.php';
    include 'include/menu.php';

    // Check for provided search term from index
    if (isset($_GET['term'])) {
        $searchTerm = $_GET['term'];
        $limit = 5;

        // Check wether the webiste should display the report or the sets
        if ($searchTerm == 'Rapport' OR $searchTerm == 'rapport') {
            header("Location: report.php");
            die();

        } else {
            // Search for term in DB
            $result	= mysqli_query(
            $connection, "SELECT * FROM sets WHERE Setname LIKE '%{$searchTerm}%' OR SetID LIKE '%{$searchTerm}%' LIMIT $limit"
        );
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
    include "include/footer.php";
?>