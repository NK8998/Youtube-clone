<?php
include_once '../Dashboard/Required.php';

if (isset($_POST['sub']) && ($_POST['sub'] == 'Subscribe') ) {
    $sub = $_POST['sub'];
    $subTo = $_POST['subscribedTo'];

    $username = mysqli_real_escape_string($conn, $_GET['name']);

    $sql = "SELECT * FROM subscriber_data WHERE username = '$username' AND subscribed_to = '$subTo'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo 'You are already subscribed';
    }else{
        $stmt = $conn->prepare("INSERT INTO subscriber_data (username, subscribed_to) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $subTo);
        $stmt->execute();
        $stmt->close();

        echo 'You have successfully subscribed';
    }
}

if(isset($_POST['unsubscribe']) && ($_POST['unsubscribe'] == 'Unsubscribe')){
    $subTo = $_POST['subscribedTo'];
    $username = mysqli_real_escape_string($conn, $_GET['name']);

    $sql = "DELETE FROM subscriber_data WHERE username = ? AND subscribed_to = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $subTo);
    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    echo 'Subscription removed';
    //  if($affected_rows > 0){
    //      echo 'Subscription removed';
    //  } else {
    //      echo 'No subscription found';
    //  }
}


if(isset($_POST['liked']) && $_POST['liked'] == 'Liked') {
    $username = mysqli_real_escape_string($conn, $_GET['name']);
    $vidId = mysqli_real_escape_string($conn, $_GET['vidId']);

    $sql = "SELECT * FROM like_dislike WHERE username='$username' AND vidId='$vidId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $liked = $row['liked'] ?? false;

    if(mysqli_num_rows($result) > 0) {
        if($liked) {
            $sql = "UPDATE like_dislike SET liked = false WHERE username = '$username' AND vidId = '$vidId'";
            $result = mysqli_query($conn, $sql);
            $message = 'Removed from liked videos';
        } else {
            $sql = "UPDATE like_dislike SET liked = true, disliked = false WHERE username = '$username' AND vidId = '$vidId'";
            $result = mysqli_query($conn, $sql);
            $message = 'Added to liked videos';
        }
    } else {
        $sql = "INSERT INTO like_dislike (username, vidId, liked) VALUES ('$username', '$vidId', true)";
        $result = mysqli_query($conn, $sql);
        $message = 'Added to liked videos';
    }

    $sql2 = "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND liked=true";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $likes = $row2['COUNT(*)'];

    echo json_encode(array('message' => $message, 'likes' => $likes));
}

if(isset($_POST['liked']) && $_POST['liked'] == 'Disliked') {
    $username = mysqli_real_escape_string($conn, $_GET['name']);
    $vidId = mysqli_real_escape_string($conn, $_GET['vidId']);

    $sql = "SELECT * FROM like_dislike WHERE username='$username' AND vidId='$vidId' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) > 0) {
    if($row['disliked']) {
        $sql2 = "UPDATE like_dislike SET disliked = false WHERE username = '$username' AND vidId = '$vidId'";
        $result2 = mysqli_query($conn, $sql2);
        
        $dislikes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND disliked=true"))['COUNT(*)'];

        echo json_encode(array('message' => 'Removed dislike', 'dislikes' => $dislikes));
    } else {
        $sql = "UPDATE like_dislike SET liked = false WHERE username = '$username' AND vidId = '$vidId'";
        mysqli_query($conn, $sql);
        $sql2 = "UPDATE like_dislike SET disliked = true WHERE username = '$username' AND vidId = '$vidId'";
        mysqli_query($conn, $sql2);

        $dislikes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND disliked=true"))['COUNT(*)'];

        echo json_encode(array('message' => 'Feedback shared with creator', 'dislikes' => $dislikes));
    }
} else {
    $stmt = $conn->prepare("INSERT INTO like_dislike (username, vidId) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $vidId);
    $stmt->execute();
    $stmt->close();
    $sql = "UPDATE like_dislike SET disliked = true WHERE username = '$username' AND vidId = '$vidId'";
    mysqli_query($conn, $sql);

    $dislikes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND disliked=true"))['COUNT(*)'];

    echo json_encode(array('message' => 'Feedback shared with creator', 'dislikes' => $dislikes));
}
}




















//  if(isset($_POST['liked']) && $_POST['liked'] == 'Liked'){
//      $username = mysqli_real_escape_string($conn, $_GET['name']);
//      $vidId = mysqli_real_escape_string($conn, $_GET['vidId']);

//      $sql = "SELECT * FROM like_dislike WHERE username='$username' AND vidId='$vidId' ";
//      $result = mysqli_query($conn, $sql);
//      $row = mysqli_fetch_assoc($result);
//      if(mysqli_num_rows($result) > 0){
//          if($row['liked'] == true){
//              $sql = "UPDATE like_dislike SET liked = false WHERE username = '$username' AND vidId = '$vidId'";
//              $result = mysqli_query($conn, $sql);

//              $sql2 = "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND liked=true";
//              $result2 = mysqli_query($conn, $sql2);
//              $row2 = mysqli_fetch_assoc($result2);
//              $likes = $row2['COUNT(*)'];

//              echo json_encode(array('message' => 'Removed from liked videos', 'likes' => $likes));
//          }elseif($row['liked'] == false){
//              $sql = "UPDATE like_dislike SET liked = true WHERE username = '$username' AND vidId = '$vidId'";
//              $result = mysqli_query($conn, $sql);
//              $sql2 = "UPDATE like_dislike SET disliked = false WHERE username = '$username' AND vidId = '$vidId'";
//              $result2 = mysqli_query($conn, $sql2);

//              $sql3 = "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND liked=true";
//              $result3 = mysqli_query($conn, $sql3);
//              $row2 = mysqli_fetch_assoc($result3);
//              $likes = $row2['COUNT(*)'];

//              echo json_encode(array('message' => 'Added to liked videos', 'likes' => $likes));
//          }
        
//      }else{
//         $stmt =$conn->prepare("INSERT INTO like_dislike (username, vidId) VALUES  (?, ?)");
//         $stmt->bind_param("ss", $username, $vidId);
//         $stmt->execute();
//         $stmt->close();
//         $sql = "UPDATE like_dislike SET liked = true WHERE username = '$username' AND vidId = '$vidId'";
//         mysqli_query($conn, $sql);

//         $sql2 = "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND liked=true";
//         $result2 = mysqli_query($conn, $sql2);
//         $row2 = mysqli_fetch_assoc($result2);
//         $likes = $row2['COUNT(*)'];

//         echo json_encode(array('message' => 'Added to liked videos', 'likes' => $likes));
//     }
    
// }
// if(isset($_POST['liked']) && $_POST['liked'] == 'Disliked'){
//     $username = mysqli_real_escape_string($conn, $_GET['name']);
//     $vidId = mysqli_real_escape_string($conn, $_GET['vidId']);

//     $sql = "SELECT * FROM like_dislike WHERE username='$username' AND vidId='$vidId' ";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);
    
//     if(mysqli_num_rows($result) > 0){
//         if($row['disliked'] == true){
//             $sql2 = "UPDATE like_dislike SET disliked = false WHERE username = '$username' AND vidId = '$vidId'";
//             $result2 = mysqli_query($conn, $sql2);

//             $sql2 = "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND disliked=true";
//             $result2 = mysqli_query($conn, $sql2);
//             $row2 = mysqli_fetch_assoc($result2);
//             $dislikes = $row2['COUNT(*)'];

//             echo json_encode(array('message' => 'Removed dislike', 'dislikes' => $dislikes));
//         }elseif($row['disliked'] == false){
//             $sql = "UPDATE like_dislike SET liked = false WHERE username = '$username' AND vidId = '$vidId'";
//             $result = mysqli_query($conn, $sql);
//             $sql2 = "UPDATE like_dislike SET disliked = true WHERE username = '$username' AND vidId = '$vidId'";
//             $result2 = mysqli_query($conn, $sql2);

//             $sql3 = "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND disliked=true";
//             $result3 = mysqli_query($conn, $sql3);
//             $row2 = mysqli_fetch_assoc($result3);
//             $dislikes = $row2['COUNT(*)'];

//             echo json_encode(array('message' => 'Feedback shared with creator', 'dislikes' => $dislikes));
//         }
       
//     }elseif(mysqli_num_rows($result) == 0){
//         $stmt =$conn->prepare("INSERT INTO like_dislike (username, vidId) VALUES  (?, ?)");
//         $stmt->bind_param("ss", $username, $vidId);
//         $stmt->execute();
//         $stmt->close();
//         $sql = "UPDATE like_dislike SET disliked = true WHERE username = '$username' AND vidId = '$vidId'";
//         mysqli_query($conn, $sql);

//         $sql3 = "SELECT COUNT(*) FROM like_dislike WHERE vidId='$vidId' AND disliked=true";
//         $result3 = mysqli_query($conn, $sql3);
//         $row2 = mysqli_fetch_assoc($result3);
//         $dislikes = $row2['COUNT(*)'];

//         echo json_encode(array('message' => 'Feedback shared with creator', 'dislikes' => $dislikes));

//     }
// }