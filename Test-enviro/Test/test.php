<?php

include 'Required.php';


if(isset($_FILES['video_name'])){
    $error = array();
    $file_name = $_FILES['video_name']['name'];
    $file_tmp = $_FILES['video_name']['tmp_name'];
    $path = "Uploads/".$file_name;
    $title = $_POST['title'];

    if(empty($error) == true){
        $fileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $extensions = array("mp4","avi","mkv","mpeg","3gp");

        if(in_array($fileType,$extensions)){
            if(move_uploaded_file($file_tmp, "Uploads/". $file_name)){
                $sql = "INSERT INTO test_videos(vidUrl, title) VALUES('$path', '$title')";
                $query = $conn->query($sql);
                if($query){
                    echo 'Video Uploaded Successfully';
                }
                else echo "Something went wrong";
            }
            else{
                echo 'Failed to upload video';
            }
        }
        else{
            echo "Incorrect file format";
        }
    }
    else{
        print_r($error);
    }

}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>Document</title>
</head>
<body>

<form action="test.php" enctype="multipart/form-data" method="post">
        <input type="file" name="video_name">
       <br>
        <label for="">Title of your video</label><input type="text" name="title"> <br>
        <input type="submit" value="upload">
    </form>


<?php
  ?>

<div class="videos-container">
<?php
$sql = "SELECT * FROM test_videos ORDER BY id ASC";
$result = mysqli_query($conn, $sql);


while($video = mysqli_fetch_assoc($result)){
    $title = $video['title'];
    ?>
    
    <div class="container" >
        <div>
            <div class="wrapper">
                <div class="wrapper-controls-and-video" id="hover-container">
            <video  id="myVideo" src="<?php echo $video['vidUrl'] ?>"></video>
            <div class="controls">
                    <div class="red-bar" onclick="jump(event)">
                        <div class="red-bar-background"></div>
                        <div class="red-bar-background-loaded-bar"></div>

                        </div>
                    </div>
                    </div>
                    </div>
            </div>
        <div><p><?php echo $title?></p></div>
    </div>
        <div></div>
        </div>
        
    
        <?php }?>
    </div>
   

</body>
<script src="test.js"></script>
</html>