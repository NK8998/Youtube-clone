<?php

include '../../Dashboard/Required.php';
$errors = [];

$email_ver = $_GET['email'];

if(!$email_ver){
    header("Location: ../register.php");
    exit();
}

if (isset($_POST["verify_email"])){
    $email = trim($_POST["email"]);
    $verification_code = $_POST["verification_code"];
    $sql = "SELECT * FROM user_info WHERE email='$email'";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    if($verification_code){
        if($rows['Verification_code'] !== $verification_code){
            $errors['verification_code'] = '<p style="color:crimson;">Wrong code. Try again</p>';
        }
    }
    

   
    if(!$verification_code){
        $errors['verification_code'] = '<p style="color:crimson;">Enter a code</p>';
    }
    if(empty($errors)){
        $sql = "UPDATE user_info SET email_verified_at = NOW() WHERE email ='$email' AND 
        Verification_code = '$verification_code' ";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Sign_in/Sign_in.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="email_verify.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper-total">
    <div class="container">
        <div class="form-container">
            <div class="wrapper-form">
    <div class="top-img"><img src="../images/Google_logo.svg" alt=""></div>
    <div class="paragraph1"><p>Verify your email address</p></div>
    <div class="paragraph2"><p>Enter the verification code we sent to <br> <?php echo $_GET['email']; ?>. If you don’t see it, check your <br> spam folder. </p></div>
    <form action="" method="post">
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
        <div class="form-control1">
        <input type="text" name="verification_code" class="input1 <?php echo isset($errors['verification_code']) ? 'is-invalid' : '' ?>" required>
        <div class="lab1 <?php echo isset($errors['verification_code']) ? 'is-invalid-lab' : '' ?>"><label for=""> <p>Enter code</p> </label></div></div>
        <div class="invalid-feedback">
                        <p><?php echo $errors['verification_code'] ?? '' ?></p>
                        </div>
        <div class="bottom-btn">
            <button type="button" onclick="myFunction()">Back</button>
        <input type="submit" name="verify_email" value="Next" formnovalidate>
        </div>
        </div>
        </div>
        <div class="right-side">
            <img src="../images/verify-email.svg" alt="">
        </div>
        </div>
        </form>

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
    </div>  
</body>
<script src="email.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</html>