<?php
    //Include header, functions and DB connection
    include 'include/dbconnect.php';
    include 'include/functions.php';
    include 'include/header.php';
    include 'include/menu.php';

    // Check for provided search term from index
    if (isset($_GET['setId'])) {
        $setId = $_GET['setId'];

        // Search for term in DB
        $result	= mysqli_query(
            $connection, "SELECT * FROM sets WHERE SetID LIKE '$setId'"
        );

        while ($row = mysqli_fetch_array($result))	{
            $name = $row['Setname'];
            $category = findCategory($connection, $row['CatID']);
            $year = $row['Year'];
            $imagePath = findImage($connection, $setId, "S", true);
        }       
    }
    else {
        // Not found, send user back to index
        header("Location: index.php");
    }    
?>

<div id='set_page_container'>
    <?php
        include "include/set_output.php";
    ?>
</div>

<?php
    include "include/footer.php";
?>