<?php

include '../../Dashboard/Required.php';
if(!isset($_GET['email'])){
    header("Location: Sign_in.php");
                exit();
}
$email = $_GET['email'];
$errors = array();

if(isset($_POST['submit_btn'])){
    $password = $_POST['password'];
    
    if(empty($password)){
        $errors['password'] = '<p style="color:crimson;">Password is required</p>';
    }

    if(empty($errors)){
        $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) == 0){
            $errors['password'] = '<p style="color:crimson;">Incorrect password</p>';
        }else{
            $row = mysqli_fetch_assoc($result);
            if($row['email_verified_at'] == null) {
                $errors['password'] = '<p style="color:crimson;">Your email address is not verified. Please check your inbox for a verification email and <a href="../email-verification/email_verification.php?email=' . $email . '">Go here</a> .</p>';
            } else {
                $params = session_get_cookie_params();
                $params["httponly"] = true;
                session_set_cookie_params($params["lifetime"], $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
                
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_first_name'] = trim($row['first_name']);
                $_SESSION['user_last_name'] = trim($row['last_name']);
                session_regenerate_id(true);
                header("Location: ../../Logged-in-version/Logged-in-ver.php?user=" . $row['first_name'] . "&last_name=" . $row['last_name']);
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
    <link rel="stylesheet" href="pass.css">
    <title>Youtube</title>
</head>
<body>
    <div class="wrapper-total">
    <div class="container">
    <div class="centered">
    <div class="logo"><img src="../images/Google_logo.svg" alt=""></div>
    <div class="paragraph1"><p>Welcome</p></div>
    <a href="Sign_in.php?email=<?php echo $email; ?>"><div class="paragraph2">
        <i class='fas fa-user-circle'></i>
        <p><?php echo $email ?></p>
        <i class='fas fa-chevron-down'></i>
    </div></a>
    </div>
    <form action="" method="post">

    <div><input type="password" name="password" class="input1 <?php echo isset($errors['password']) ? 'is-invalid' : '' ?>"  id="password" required>
    <div class="lab1 <?php echo isset($errors['password']) ? 'is-invalid-lab' : '' ?>"><p>Enter your password</p></div></div>
    
    <div class="invalid-feedback"><?php echo $errors['password'] ?? '' ?></div>
<div>
    <div class="pass-check">
        <div><input type="checkbox" id="toggle-password"></div>
        <div><label for="">Show password</label></div>
    </div>

    <div class="bottom-btn">
        <button><a href="">Forgot Password?</a></button>
    <input type="submit" value="Next" name="submit_btn" formnovalidate>
    </div>

    </form>
    </div>
    </div>

    <div class="bottom-nav">
<div class="bottom-row">
            <div>
                <div class="current-lang"><p>English(United States)</p><i class='fas fa-caret-down'></i></div>
                <div class="dropdown">
                    <div><p>English(United States)</p></div>
                    <div><p>English(United Kingdom)</p></div>
                    <div><p>French</p> </div>
                    <div><p>German</p> </div>
                    <div><p>Czech</p> </div>
                    <div><p>Hungarian</p> </div>
                    <div><p>Kiswahili</p> </div>
                    <div><p>Arabic</p> </div>
                    <div><p>Spanish</p> </div>
                    <div><p>Chinese</p> </div>
                    <div><p>Hungarian</p> </div>
                    <div><p>Kiswahili</p> </div>
                    <div><p>Arabic</p> </div>
                    <div><p>Spanish</p> </div>
                    <div><p>Chinese</p> </div>
                </div>
             </div>
              
</div> 
<div class="bottom-links">
                <a href="">Help</a>
                <a href="">Privacy</a>
                <a href="">Terms</a>
        </div>
</div>

    </div>
</body>
<script src="pass.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</html>