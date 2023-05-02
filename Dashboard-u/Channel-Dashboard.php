<?php

include 'Required.php';

session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../watch.php");
    exit();
}

$user = $_GET['user'];
$l_name = $_GET['last_name'];



if(isset($_FILES['video_name'])){
    $error = array();
    $file_name = $_FILES['video_name']['name'];
    $file_tmp = $_FILES['video_name']['tmp_name'];
    $file_size = $_FILES['video_name']['size'];
    $path = "Uploads/".$file_name;
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $user = htmlspecialchars($_POST['f_name'], ENT_QUOTES);
    $l_name = htmlspecialchars($_POST['l_name'], ENT_QUOTES);
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES);
    $username = trim($user ." " . $l_name);
    $time_uploaded = time();
    $f_name = $user;
    $vidID = uniqid();
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);


    
    
    $allowed_extensions = array("mp4", "avi", "mkv", "mpeg", "3gp");
    $file_extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $max_file_size = 50000000000; 
    $vid_uid = $vidID . "." . $ext;
    
    if ($file_size > $max_file_size) {
        $error[] = "File size exceeds maximum limit of 5000MB";
    }

    if (!in_array($file_extension, $allowed_extensions)) {
        $error[] = "Invalid file type. Only MP4, AVI, MKV, MPEG, and 3GP files are allowed";
    }
    if(!$vidID){
        $error[] = "no video id";
    }else{
        $ffmpeg = "C:\\ffmpeg\\bin\\ffmpeg";
        $imageFile = "Thumbnails/" . $vidID . ".jpg";
        $size= "640x480";
        $getfromSecond = 25;
        $vid_thumbnail = $vidID . ".jpg";
     
        $cmd = "$ffmpeg -i $file_tmp -an -ss $getfromSecond -s $size $imageFile 2>&1";
        shell_exec($cmd);
    
    
        if(shell_exec($cmd)){
         print_r("thumb created");
        }else {
         print_r("Thumbnail has not been generated");
        }

    }
       
    if (empty($error)) {

        
        if(move_uploaded_file($file_tmp, "Uploads/". $vid_uid)){
            $stmt = $conn->prepare("INSERT INTO videos (vidUrl, title, username, time_uploaded, first_name, vid_uid, vid_thumbnail_url, vid_thumbnail, Category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $path, $title, $username, $time_uploaded, $f_name, $vid_uid, $imageFile, $vid_thumbnail, $category);
            if($stmt->execute()){
                echo 'Video Uploaded Successfully';
            }
            else {
                echo "Something went wrong";
            }
            $stmt->close();
        }
        else{
            echo 'Failed to upload video';
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
    <title>Channel dashboard</title>
</head>
<body>
    <form action="Channel-Dashboard.php?user=<?php echo $user; ?>&last_name=<?php echo $l_name; ?>" enctype="multipart/form-data" method="post">
        <input type="file" name="video_name">
        <input type="hidden" value="<?php echo $_GET['user'] ?>" name="f_name">
        <input type="hidden" value="<?php  echo $_GET['last_name']?>" name="l_name">
        <label for="">Title of your video</label><input type="text" name="title">
        <label for="">Category</label><input type="text" name="category">
        <input type="submit" value="upload">
    </form>
    
</body>
</html>