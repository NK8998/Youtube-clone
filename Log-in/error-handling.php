<?php
  $sql = "SELECT * FROM user_info where (email='$email'); ";

  $result=mysqli_query($conn, $sql);
 if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_assoc($result);
      if($email == isset($row['email'])){
        $errors['email'] = '<p style="color:crimson;">This email already exists</p>';
}
}

if(!$f_Name || !$l_Name){
    $errors['first_name'] = '<p style="color:crimson;">Enter first and last names</p>';
}elseif(strlen($f_Name) < 3 || strlen($f_Name) > 20){
    $errors['first_name'] = '<p style="color:crimson;">Are you sure you entered your names correctly?</p>';
}

if(!$l_Name){
    $errors['last_name'] = REQUIRED_FIELD_ERROR;
}

if(!$email){
    $errors['email'] = '<p style="color:crimson;">Choose a Gmail address</p>';
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = '<p style="color:crimson;">This field must be a valid email address</p>';
}


if(!$password){
    $errors['password'] = '<p style="color:crimson;">Enter a password</p>';
    $errors['Cpassword'] = '<p style="color:crimson;">Enter a password</p>';
}
if(!$Cpass && !$password){
    $errors['Cpassword'] = '<p style="color:crimson;">Enter a password</p>';
    $errors['password'] = '<p style="color:crimson;">Enter a password</p>';

}
if($password){
    if(!$Cpass){
        $errors['Cpassword'] = '<p style="color:crimson;">Confirm your password</p>';
    }
}
if($password && $Cpass && strcmp($password, $Cpass) !== 0){
    $errors['Cpassword'] = '<p style="color:crimson;">Those passwords did not match. Try again</p>';
}
if($password){
    if(strlen($password) < 8){
        $errors['Cpassword'] = '<p style="color:crimson;">Use 8 characters or more for your password</p>';
        $errors['password'] = '<p style="color:crimson;">Use 8 characters or more for your password</p>';
    }
}
if($password){
    if(!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)){
        $errors['Cpassword'] = '<p style="color:crimson;">Use 8 or more characters with a mix of letters, numbers & <br> symbols</p>';
        $errors['password'] = '<p style="color:crimson;">Use 8 or more characters with a mix of letters, numbers & <br> symbols</p>';
    }
}


