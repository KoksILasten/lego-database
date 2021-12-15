<?php
//Include header, functions and DB connection
include 'include/dbconnect.php';
include 'include/functions.php';
include 'include/header.php';
include 'include/menu.php';

// Check for provided search term from index
if (isset($_GET['setId'])) {
    $setId = $_GET['setId'];

    // Search for id in set DB
    $result    = mysqli_query(
        $connection,
        "SELECT * FROM sets WHERE SetID LIKE '$setId'"
    );
    // Retrieve information about set
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['Setname'];
        $catId = $row['CatID'];
        $catName = findCategory($connection, $catId);
        $year = $row['Year'];
        $imagePath = findImage($connection, $setId, "S", "", true);
    }
} else {
    // Not found, send user back to index
    header("Location: index.php");
}
?>

<div id='set_page_container' class='container_normal'>
    <?php
    // Display set img, info and inventory
    include "include/set_output.php";
    ?>
</div>
<div id="part_details_div_container" class="part_details_hide">
    <div id="part_details_div">
        <div>
            <img src="assets/img/no_image.png" alt="no image" id="part_details_img">
        </div>
        <div id="part_details_text_div">
        </div>
    </div>
</div>

<script src="js/set-page.js"></script>
<?php include "include/footer.php"; ?>