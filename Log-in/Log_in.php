<?php
include '../Dashboard/Required.php';
session_start();

if(isset($_POST["login"])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if(mysqli_num_rows($result) == 0){
        print_r("email not found");
    }
    if(mysqli_num_rows($result) >0){
        $user = mysqli_fetch_object($result);
        if($password != $user->password){
            echo "Password is incorrect";
        }
        if ($password == $user->password) {
            if ($user->email_verified_at == null) {
                echo "Please verify your email <a href='email-verification/email_verification.php?email=" . $email . "'>from here</a>";
            } else {
                session_start();
                $_SESSION['user_id'] = $user->id;
                // regenerate session ID and delete old session data
                session_regenerate_id(true);
                header("Location: ../Logged-in-version/Logged-in-ver.php?user=" . $user->first_name . "&last_name=" . $user->last_name);
                exit();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Log_in/Log_in.css">
    <title>Youtube</title>
</head>
<body>
    


<form action="" method="post">

    <div><input type="email" name="email" placeholder="Your email"></div>
    <div><input type="password" name="password" placeholder="Enter password"></div>
    <div><input type="submit" name="login" value="Login"></div>

</form>


</body>
<script src="Log_in/Log_in.js"></script>
</html>
