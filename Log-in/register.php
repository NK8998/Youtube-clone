<?php

// Import PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../Dashboard/Required.php';


//Load Composer's autoloader
require '../vendor/autoload.php';

define('REQUIRED_FIELD_ERROR', 'This field is required');
$errors = [];

$f_Name = '';
$l_Name = '';
$email = '';
$password = '';
$Cpass = '';


if(isset($_POST["register"])){
    $f_Name = $_POST['first_name'];
    $l_Name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Cpass = $_POST['Cpassword'];


    // Instantiation an$mail = passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try{
        $mail->STMPDEBUG = 0;

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'ne.kioko16@gmail.com';

        $mail->Password = 'ydbibbmfdnxljjyi';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        $mail->setFrom('ne.kioko16@gmail.com', 'Youtube');

        $mail->addAddress($email, $f_Name);

        $mail->isHTML(true);

        $verification_code = substr(number_format(time()* rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Email verification';
        $mail->Body = '<p> Your Verification code is: <b style="fontsixe:30px;">' . $verification_code . '</b></p>';

       

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
       
    }catch(Exception $e){
        
    }

    include 'error-handling.php';
   
    if(empty($errors)){
        $mail->send();

        
        $colors = array("red", "blue", "green", "orange","yellow"); 
        $random_number = rand(0, count($colors) - 1);
        $color = $colors[$random_number];
        $pfp = substr(trim($f_Name),0,1);

        $stmt = $conn->prepare("INSERT INTO user_info (first_name, last_name, email, password, Verification_code, email_verified_at, bgcolor_pfp, user_pfp) VALUES (?, ?, ?, ?, ?, NULL, ?, ?)");
        $stmt->bind_param("sssssss", $f_Name, $l_Name, $email, $password, $verification_code, $color, $pfp);
        $stmt->execute();
        $stmt->close();

        header("Location: email-verification/email_verification.php?email=".$email);
        exit();
    }
}
function post_data($field)
{
    $_POST[$field] ??= '';

    return htmlspecialchars(stripslashes($_POST[$field]));

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="log.css">
    <title>Create your Youtube account</title>
    </head>


    <body>
        <div class="wrapper-total">
<div class="wrapper">
    <div class="container">


        <div class="form-container">
                <div>
                <img src="images/Google_logo.svg" alt="">
                </div>
                    <div class="paragraph1"> 
                    <p>Create your Google Account </p>
                    </div>
                        <div class="paragraph2">
                            <p>to continue to Youtube</p>
                        </div>


                <form action="register.php" method="post">

                    <div class="form-control1 ">
                       
                            
                            <input type="text" name="first_name"  value="<?php echo $f_Name ?>" class="input1 <?php echo isset($errors['first_name']) ? 'is-invalid' : '' ?>" required>
                            <div class="lab1 <?php echo isset($errors['first_name']) ? 'is-invalid-lab' : '' ?>"><label for="" ><p>First name</p> </label></div>
                            <input type="text" name="last_name" value="<?php echo $l_Name ?>" class="input2 <?php echo isset($errors['last_name']) ? 'is-invalid' : '' ?>" required>
                            <div class="lab2 <?php echo isset($errors['last_name']) ? 'is-invalid-lab' : '' ?>"><label for="" ><p>Last name</p> </label></div>
                            </div>
                    <div class="invalid-feedback first">
                        <p><?php echo $errors['first_name'] ?? '' ?></p>
                        </div>

                    <div class="form-control2">
                        <input type="text" name="email" value="<?php echo $email ?>" class="input3 <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>" required>
                        <div class="lab3 <?php echo isset($errors['email']) ? 'is-invalid-lab' : '' ?>"><label for="" ><p>Your email address</p> </label></div>
                    </div>
                        
                    <div class="invalid-feedback second">
                    <p><?php echo $errors['email']  ?? "You'll need to confirm that this email belongs to you" ?></p>
                    </div>

                <div class="Create"> <button><a href="">Create a new Gmail address instead</a></button> </div>

                    <div class="form-control3">
                                <input type="password" name="password" value="<?php echo $password ?>" id="password" class="input4 <?php echo isset($errors['password']) ? 'is-invalid' : '' ?>" required>
                                <div class="lab4 <?php echo isset($errors['password']) ? 'is-invalid-lab' : '' ?>"><label for="" ><p>Password</p> </label></div>
                                <input type="password" name="Cpassword" value="<?php if(empty($errors['Cpassword'])){echo $Cpass;}?>"class="input5 <?php echo isset($errors['Cpassword']) ? 'is-invalid' : '' ?>" id="Cpass" required>
                                <div class="lab5 <?php echo isset($errors['Cpassword']) ? 'is-invalid-lab' : '' ?>"><label for="" ><p>Confirm</plabel></div>
                    </div>
                    <div class="invalid-feedback third">

                    <p><?php 
                    if(empty($errors)){
                        echo 'Use 8 or more characters with a mix of letters, numbers & <br> symbols';
                    }else{
                        echo $errors['Cpassword'] ?? '';
                    }?></p>
                        
                    </div>


                <div class="toggle">
                     <div><input type="checkbox" id="toggle-password"></div>
                     <div class="label"><label for="">Show password</label></div>
                </div>
            <div class="bottom-btn">
                <div class="btn-1"><button><a href="Sign_in/Sign_in.php">Sign in instead</a></button></div>
            <div class="btn-2"><button onclick="clear()" type="submit" name="register" formnovalidate>Next</button></div>
        </div>
    </form>
    </div>
        <div class="rightside">
        <div class="logo">
            <img src="images/account.svg" alt="">
        </div>
        <div class="catch-phrase">
            <p>One account. All of Google <br> working for you.</p>
        </div>
        </div>
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
<script src="register.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</html>