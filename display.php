<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Article</title>
<style>
*{
    box-sizing: border-box;
    margin: 0px;
}
.container {
    width: 100%;
    max-width: 650px;
    margin: 0 auto;
}

.article {
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 30px;
}

.article img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 5px;
    /* height: 398px; */
    /* height: 300px;
    object-fit: contain; */
}

.article h2 {
    margin-top: 10px;
    text-align: center;
}

.article p {
    margin-top: 10px;
    text-align: center;
}


/*this for ticker */
       
.news-ticker {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    overflow: hidden;
}

.news-headlines {
    display: inline-block;
    white-space: nowrap;
    animation: ticker 20s linear infinite;
}

.ticker-item {
    padding: 0 20px;
}

@keyframes ticker {
    0% {
        transform: translateX(0%);
    }
    100% {
        transform: translateX(-100%);
    }
}



/*this for navbar*/

.navbar {
  background-color: #f2f2f2;
  overflow: hidden;
}

.navbar a {
    float: left;
    display: block;
    color: #333;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-family: system-ui;
    font-weight: 900;
    font-style: italic;
    font-size: 20px;
    text-decoration: underline;
    color: blue;
}

.navbar a:hover {
  background-color: #ddd;
}


</style>
</head>
<body>
<div class="news-ticker">
    <!-- style="border: 2px solid red;"  -->
    <div class="news-headlines" >
        <span   class="ticker-item">ابقى على اطلاع بآخر الأخبار والأحداث</span>
        <span   class="ticker-item">ابقى على اطلاع بآخر الأخبار والأحداث</span>
        <span   class="ticker-item">ابقى على اطلاع بآخر الأخبار والأحداث</span>
        <span   class="ticker-item">ابقى على اطلاع بآخر الأخبار والأحداث</span>
        <span   class="ticker-item">ابقى على اطلاع بآخر الأخبار والأحداث</span>
        <span   class="ticker-item">ابقى على اطلاع بآخر الأخبار والأحداث</span>
    </div>
</div>
<div class="navbar">
<a href="index.php">اضافه منشور</a>
<a href="deletePost.php">حذف المنشور</a>
</div>
<?php
    // Assuming you have established a database connection already
    // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
    include("config.php");
   
   
    // SQL query to select data from the table (replace 'your_table' with your actual table name)
    $sql = "SELECT img,title,description FROM posts ORDER BY ID DESC";
    $result = $con->query($sql);

    // Check if there are rows returned from the query
    if ($result->num_rows > 0) {
        // Loop through each row of the result set
        while($row = $result->fetch_assoc()) {
            echo "
                <div class='container'>
                    <div class='article'>
                        <img src='uploads/$row[img]' alt='News Image'>
                        <h2>$row[title]</h2>
                        <p>$row[description]</p>
                    </div>
                </div>
            ";
        }
    } else {
        echo "0 results";
    }
    // Close database connection
    $con->close();
    ?>


</body>
</html>
