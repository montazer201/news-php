


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Form</title>
    <style>
        *{
            box-sizing: border-box;

        }
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        width: 100%;
        max-width: 500px;

        margin: 50px auto 0px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    h2 {
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        background-color: #f9f9f9;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        /* float: right; */
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }
        
    </style>
</head>
<body>
<?php
    include("functionvalidate.php");
    include("config.php");
    if(isset($_POST["add"])){

        if(isset($_FILES["image"],$_POST["title"],$_POST["description"])){
              
            $img = $_FILES["image"];
            $title=$_POST["title"];
            $description=$_POST["description"];
            $id_user=1;
            if(validateDescription($description) === true && validateTitle($title) === true){
               
                    $v = validateAndUploadImage($img);
                    if (!is_array($v)) {
                        echo "<h1 style='text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>تمت الاضافه بنجاح</h1 >";
                        mysqli_query($con,"INSERT INTO `posts`(`img`, `title`, `description`) VALUES ('$v','$title','$description')");
                        // echo "<h1 style='text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>File moved successfully!</h1 >";
                        echo "<h1 style='text-align:center'><a href='index.php'>العوده الى الصفحه الاضافه</a></h1>";
                        exit();
                    } else {
                        echo "<h1 style='background:red;text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>Error upload file.</h1 >";
                        
                    }
               
               
                    echo "<h1 style='background:red;text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>Error insert data</h1 >";
               
                
            }else{
                echo "<h1 style='background:red;text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>لم يتم الاضافه بسبب</h1 >";
                echo (is_bool(validateTitle($title)) ? "" :  "<h1 style='background:red;text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>".validateTitle($title)."</h1 >");
                echo (is_bool(validateDescription($description)) ? "" :  "<h1 style='background:red;text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>".validateDescription($description)."</h1 >");
               
   
               
                
            }


        }else{
            echo "<h1 style='background:red;text-align: center;margin: 15px 0px;box-shadow: 2px 2px 20px;padding: 12px 0px;'>يرجى ادخال جميع المعلومات</h1 >";

        }
    }

?>

    <div class="container">
        <h2>Upload News</h2>
        <form  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit" name="add">Upload</button>
        </form>
    </div>


    <a href="display.php" style="    
    text-align: center;
    font-size: 30px;
    display: block;
    font-family: system-ui;">المنشورات</a>
</body>
</html>
