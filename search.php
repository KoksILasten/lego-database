<?php
    // Data for searchbox
    if (isset($_GET['term']) || isset($_GET['cat']) || isset($_GET['year'])) {

        // Get the search arguments from the URL for paginator (after removing the unnecessary parts)
        $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];  
        $urlArgs = substr($url, strpos($url, '?'));
        $urlArgs = array_shift(explode('&page', $urlArgs));

        // Get term var if set
        if (isset($_GET['term'])) {
            $termPassed = $_GET['term'];
            $termSql = "(Setname LIKE '%{$termPassed}%' OR SetID LIKE '%{$termPassed}%')";
            $searchTerm = $termPassed; // For the searchbox value

            // Check whether the webiste should display the report or the sets
            if ($termPassed == 'Rapport' || $termPassed == 'rapport') {
                mysqli_close($connection); 
                header("Location: report.php");
                die();
            } 
        }
        else {
            $termPassed = '';
            $termSql = '';
        }

        // Get cat var if set
        if (isset($_GET['cat'])) {
            $catPassed = $_GET['cat'];
            $catSql = "CatID LIKE '" . $catPassed . "' ";
        }
        else {
            $catSql = '';
        }

        // Get year var if set
        if (isset($_GET['year'])) {
            $yearPassed = $_GET['year'];
            $yearSql = "(Year LIKE '" . $yearPassed . "'";
            for ($i=1; $i <= 9; $i++) { 
                $yearSql .= " OR Year LIKE '" . ($yearPassed + $i) . "'";
            }
            $yearSql .= ") ";
        }    
        else {
            $yearSql = '';
        }

        // Combine the sql search arguments
        if ($termSql != "" && $catSql != "" || $termSql != "" && $yearSql != "") {
           $termSql .= ' AND ';
        }
        if ($catSql != "" && $yearSql != "") {
           $catSql .= ' AND ';
        }
        $sqlArgs = $termSql . $catSql . $yearSql;
    }
    else {
        // No search arguments provided, sent user back
        header("Location: index.php");
        die();
    }

    
    //Include header and DB connection, a bit further down to not interfere with possible use of header()
    include 'include/header.php';
    include 'include/dbconnect.php';
    include 'include/functions.php';
    include 'include/menu.php';
    
    $limit = 12;

    // Check for provided search term from index
    if (isset($sqlArgs)) {

            // Search in DB
            $fullSql = "SELECT * FROM sets WHERE " . $sqlArgs;
            $fullResult	= mysqli_query($connection, $fullSql);
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
            $result	= mysqli_query($connection, $sql);
    }
    else {
        // Not found, send user back to index
        header("Location: index.php");
        die();
    }
?>

<div id='search_results_container'>
    <?php 
        // Generate search results
        displayResults($connection, $result, $termPassed, $catPassed, $yearPassed);
    ?>
</div>

<?php
    // Only show pagination if more than one page
    if ($numberOfPages > 1) {
        echo "<div class=footer>";
            echo "<div class='pagination'>";

                for ($page = 1; $page <= $numberOfPages; $page++) {
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
