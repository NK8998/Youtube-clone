<?php

if(isset($_POST['submit'])){
    $ffmpeg = "C:\\ffmpeg\\bin\\ffmpeg";
    $videoFile = $_FILES["file"]["tmp_name"];
    $imageFile = "j.jpg";
    $size= "364x205";
    $getfromSecond = 5;
 
    $cmd = "$ffmpeg -i $videoFile -an -ss $getfromSecond -s $size $imageFile 2>&1";
    shell_exec($cmd);


    if(shell_exec($cmd)){
     print_r("thumb created");
    }else {
     print_r("Thumbnail has not been generated");
    }
 
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="POST" enctype="multipart/form-data" action="generate-thumbnail.php">
    <label>Select video</label>
    <input type="file" name="file" required>
    <input type="submit" name="submit" value="Generate">
    </form>


</body>    
</html>   
    