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
    // if($affected_rows > 0){
    //     echo 'Subscription removed';
    // } else {
    //     echo 'No subscription found';
    // }
}