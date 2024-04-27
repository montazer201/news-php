<?php
// Assuming you have established a database connection already
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
include("config.php");


// Function to get the base URL of the current page
function base_url() {
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}

// SQL query to select data from the table (replace 'your_table' with your actual table name)
$sql = "SELECT ID, img, title, description FROM posts ORDER BY ID DESC";
$result = $con->query($sql);

// Check if there are rows returned from the query
if ($result->num_rows > 0) {
    // Loop through each row of the result set
    while($row = $result->fetch_assoc()) {
        echo "
            <div class='container'>
                <div class='article' style='width:200px;text-align:center;float:left;margin:20px'>
                    <img src='uploads/$row[img]' alt='News Image' style='width:100%'>
                    <h2 style='width: 100%;word-break: break-word;'>$row[title]</h2>
                    <p  style='width: 100%;word-break: break-word;' >$row[description]</p>
                    <div>
                        <a href='" . base_url() . "?action=delete&id=$row[ID]'>Delete</a>
                    </div>
                </div>
            </div>
        ";
    }
} else {
    echo "0 results";
}
// Close database connection
$con->close();




if(isset($_GET["action"])){
    switch($_GET["action"]){
        case "delete":
                include("config.php");
                $sql = "DELETE FROM `posts` WHERE id=$_GET[id]";
                $result = $con->query($sql);
              echo "<script>location.assign('a.php')</script>";
            break;
        default:
            echo "";
               echo "<script>location.assign('a.php')</script>";
            break;
    }

}


?>