<a href="index.php"><h1 class="title">Leegle</h1></a>

<?php
    //Include header and DB connection
    include 'include/header.php';
    include 'include/dbconnect.php';

    // Check for provided search term from index
    if (isset($_GET['term'])) {
        $searchTerm = $_GET['term'];
        $limit = 10;

        // Search in DB

        // lägga till brick-sök, limit, order
        $result	= mysqli_query($connection,	"SELECT * FROM sets WHERE Setname LIKE '%{$searchTerm}%' LIMIT $limit"); // ,  categories, inventory, parts, itemtypes, colors, minifigs, collection, images 
    }
    else {
        // Not found, send user back to index
        header("Location: index.php");
    }
    
    // Display search
    while	($row = mysqli_fetch_array($result))	{
        $name = $row['Setname'];
        $year = $row['Year'];
  
        echo $name . " - ";
        echo $year;
        echo ("<br>");
     }
    
?>



</body>
</html>