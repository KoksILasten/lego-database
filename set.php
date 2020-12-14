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
            $imagePath = findImage($connection, $setId, true);
        }       
    }
    else {
        // Not found, send user back to index
        header("Location: index.php");
    }    
?>

<div id='set_page_container'>
    <?php
        echo "<div id='set_info_div'>" .
                "<img src='" . $imagePath . "' alt='" . $name . "'>" .
                "<div>" . 
                    "<p id='set_title'>" . $name . "</p>" .
                    "<p id='set_id'>ID: " . $setId . "</p>" .
                    "<button class='set_info set_info_cat'>" . $category . "</button>" .
                    "<button class='set_info set_info_year'>" . $year . "</button>" .
                "</div>" . 
            "</div>";
    ?>
</div>

<?php
    include "include/footer.php";
?>