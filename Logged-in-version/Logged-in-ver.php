<?php
include '../Dashboard/Required.php';

session_start();
if(!isset($_SESSION['user_uid'])){
    header("Location: ../watch.php");
    exit();
}
$user = $_SESSION['user_first_name'];
$l_name = $_SESSION['user_last_name'];
$email =  $_SESSION['email'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title> YouTube</title>
    <link rel="icon" href="../Icons/Youtube-icon.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="files_for_homepage/logged-in.css">
    </head>
<body>
<div class="loading-image">
    <div class="navbar-pseudo"></div>
</div>
    <div class="wrapper">
   <navbar class="navbar">
    <div class="container1">
        <div class="burger">
        <svg viewBox="0 0 24 24" fill="white"style="pointer-events: none; display: block; width: 24px; height: 24px;"><path d="M21,6H3V5h18V6z M21,11H3v1h18V11z M21,17H3v1h18V17z"></path></svg>
        </div>
        <div class="logo">
        <div><a href="Logged-in-ver.php"><img src="../Icons/YouTube_Logo.svg" alt=""></a></div>
    </div>
    </div>
    
    <div class="container2">
    
        <div class="searchbar"> 
        <div class="search-button-left in-focus"><img class="search-img"src="../Icons/search-thin.svg" alt=""></div>
            <input type="text" placeholder="Search" class="input">
        <div class="search-button"><button type="submit"><img class="search-img"src="../Icons/search-thin.svg" alt=""></button></div>
    </div>
   <div class="idie-mic">
        <div class="microphone"><button style="font-size:24px"><svg viewBox="0 0 24 24" class="mic-svg" fill="white" style="pointer-events: none; display: block; width: 25px; height: 25px;"><path d="M12 3C10.34 3 9 4.37 9 6.07V11.93C9 13.63 10.34 15 12 15C13.66 15 15 13.63 15 11.93V6.07C15 4.37 13.66 3 12 3ZM18.5 12H17.5C17.5 15.03 15.03 17.5 12 17.5C8.97 17.5 6.5 15.03 6.5 12H5.5C5.5 15.24 7.89 17.93 11 18.41V21H13V18.41C16.11 17.93 18.5 15.24 18.5 12Z"></path></svg></button></div>
    </div>
    </div>
    
    <div class="container3">
    
    <a href="../Dashboard/Channel-Dashboard.php">
            <div class="video-plus"><svg viewBox="0 0 24 24" fill="white" style="pointer-events: none; display: block; width: 24px; height: 24px"><path d="M14,13h-3v3H9v-3H6v-2h3V8h2v3h3V13z M17,6H3v12h14v-6.39l4,1.83V8.56l-4,1.83V6 M18,5v3.83L22,7v8l-4-1.83V19H2V5H18L18,5 z"></path></svg></div>
            </a>
        <div class="noti"><svg viewBox="0 0 24 24" fill="white" style="pointer-events: none; display: block; width: 24px; height:24px;"><path d="M10,20h4c0,1.1-0.9,2-2,2S10,21.1,10,20z M20,17.35V19H4v-1.65l2-1.88v-5.15c0-2.92,1.56-5.22,4-5.98V3.96 c0-1.42,1.49-2.5,2.99-1.76C13.64,2.52,14,3.23,14,3.96l0,0.39c2.44,0.75,4,3.06,4,5.98v5.15L20,17.35z M19,17.77l-2-1.88v-5.47 c0-2.47-1.19-4.36-3.13-5.1c-1.26-0.53-2.64-0.5-3.84,0.03C8.15,6.11,7,7.99,7,10.42v5.47l-2,1.88V18h14V17.77z"></path></svg></div>
        <a href="Logout.php"><div class="profile-pic">
        <?php
            $pfp = substr(trim($user), 0, 1); 
           
            $sql = "SELECT * FROM user_info WHERE first_name = '$user' AND email= '$email'";
            $result=mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);

            echo '<p style="background-color:' . $row['bgcolor_pfp'] . '; padding:8px 13px;padding-top: 9px;">' . $pfp . '</p>';

        ?>
        </div></a>

    </div>
   </navbar>
   <br>
  

</nav>
 <div class="flex">

 <div class="left-nav-minimized" style="display:none;">
 
        <div class="containers-min">
            <div class="icon"><svg viewBox="0 0 24 24" fill="white"  class="svg-leftnav" style="pointer-events: none; display: block; "><path d="M4,10V21h6V15h4v6h6V10L12,3Z"></path></svg></div>
            <div class="description"><p>Home</p></div>
        </div>
        <div class="containers-min">
        <div class="icon"><svg viewBox="0 0 24 24"  class="svg-leftnav" style="pointer-events: none; display: block; "><path d="M10 14.65v-5.3L15 12l-5 2.65zm7.77-4.33c-.77-.32-1.2-.5-1.2-.5L18 9.06c1.84-.96 2.53-3.23 1.56-5.06s-3.24-2.53-5.07-1.56L6 6.94c-1.29.68-2.07 2.04-2 3.49.07 1.42.93 2.67 2.22 3.25.03.01 1.2.5 1.2.5L6 14.93c-1.83.97-2.53 3.24-1.56 5.07.97 1.83 3.24 2.53 5.07 1.56l8.5-4.5c1.29-.68 2.06-2.04 1.99-3.49-.07-1.42-.94-2.68-2.23-3.25zm-.23 5.86l-8.5 4.5c-1.34.71-3.01.2-3.72-1.14-.71-1.34-.2-3.01 1.14-3.72l2.04-1.08v-1.21l-.69-.28-1.11-.46c-.99-.41-1.65-1.35-1.7-2.41-.05-1.06.52-2.06 1.46-2.56l8.5-4.5c1.34-.71 3.01-.2 3.72 1.14.71 1.34.2 3.01-1.14 3.72L15.5 9.26v1.21l1.8.74c.99.41 1.65 1.35 1.7 2.41.05 1.06-.52 2.06-1.46 2.56z"> </path></svg></div>
            <div class="description"><p>Shorts</p> </div>
        </div>
        <div class="containers-min">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M10,18v-6l5,3L10,18z M17,3H7v1h10V3z M20,6H4v1h16V6z M22,9H2v12h20V9z M3,10h18v10H3V10z"></path></svg></div>
            <div class="description"><p>Subscriptions</p></div>
        </div>
        <div class="containers-min">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M11,7l6,3.5L11,14V7L11,7z M18,20H4V6H3v15h15V20z M21,18H6V3h15V18z M7,17h13V4H7V17z"></path></svg></div>
            <div class="description"><p>Library</p></div>
        </div>
    </div>


<div class="left-nav ">

    <a href="Logged-in-ver.php" >
    <div class="containers">
        <div class="icon"><svg viewBox="0 0 24 24"   class="svg-leftnav" style="pointer-events: none; display: block; "><path d="M4,10V21h6V15h4v6h6V10L12,3Z"></path></svg></div>
        <div class="description"> <p>Home</p> </div>
    </div>
    </a>
    <div class="containers">
        <div class="icon"><svg viewBox="0 0 24 24"  class="svg-leftnav" style="pointer-events: none; display: block; "><path d="M10 14.65v-5.3L15 12l-5 2.65zm7.77-4.33c-.77-.32-1.2-.5-1.2-.5L18 9.06c1.84-.96 2.53-3.23 1.56-5.06s-3.24-2.53-5.07-1.56L6 6.94c-1.29.68-2.07 2.04-2 3.49.07 1.42.93 2.67 2.22 3.25.03.01 1.2.5 1.2.5L6 14.93c-1.83.97-2.53 3.24-1.56 5.07.97 1.83 3.24 2.53 5.07 1.56l8.5-4.5c1.29-.68 2.06-2.04 1.99-3.49-.07-1.42-.94-2.68-2.23-3.25zm-.23 5.86l-8.5 4.5c-1.34.71-3.01.2-3.72-1.14-.71-1.34-.2-3.01 1.14-3.72l2.04-1.08v-1.21l-.69-.28-1.11-.46c-.99-.41-1.65-1.35-1.7-2.41-.05-1.06.52-2.06 1.46-2.56l8.5-4.5c1.34-.71 3.01-.2 3.72 1.14.71 1.34.2 3.01-1.14 3.72L15.5 9.26v1.21l1.8.74c.99.41 1.65 1.35 1.7 2.41.05 1.06-.52 2.06-1.46 2.56z"> </path></svg></div>
        <div class="description"> <p>Shorts</p> </div>
    </div>
    <div class="containers">
        <div class="icon-1"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M10,18v-6l5,3L10,18z M17,3H7v1h10V3z M20,6H4v1h16V6z M22,9H2v12h20V9z M3,10h18v10H3V10z"></path></svg></div>
        <div class="description"><p>Subscriptions</p></div>
    </div>

    <div class="hr one"></div>

    <div class="containers">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M11,7l6,3.5L11,14V7L11,7z M18,20H4V6H3v15h15V20z M21,18H6V3h15V18z M7,17h13V4H7V17z"></path></svg></div>
        <div class="description"> <p>Library</p> </div>
    </div>
    <div class="containers">                                
        <div class="icon"><svg viewBox="0 0 24 24"  class="svg-leftnav" style="pointer-events: none; display: block; "><path d="M14.97,16.95L10,13.87V7h2v5.76l4.03,2.49L14.97,16.95z M22,12c0,5.51-4.49,10-10,10S2,17.51,2,12h1c0,4.96,4.04,9,9,9 s9-4.04,9-9s-4.04-9-9-9C8.81,3,5.92,4.64,4.28,7.38C4.17,7.56,4.06,7.75,3.97,7.94C3.96,7.96,3.95,7.98,3.94,8H8v1H1.96V3h1v4.74 C3,7.65,3.03,7.57,3.07,7.49C3.18,7.27,3.3,7.07,3.42,6.86C5.22,3.86,8.51,2,12,2C17.51,2,22,6.49,22,12z"></path></svg></div>
        <div class="description"> <p>History</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M10,8l6,4l-6,4V8L10,8z M21,3v18H3V3H21z M20,4H4v16h16V4z"></path></svg></div>
        <div class="description"> <p>Your videos</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block; "><path d="M14.97,16.95L10,13.87V7h2v5.76l4.03,2.49L14.97,16.95z M12,3c-4.96,0-9,4.04-9,9s4.04,9,9,9s9-4.04,9-9S16.96,3,12,3 M12,2c5.52,0,10,4.48,10,10s-4.48,10-10,10S2,17.52,2,12S6.48,2,12,2L12,2z"></path></svg></div>
        <div class="description"> <p>Watch Later</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><g class="style-scope yt-icon"><path d="M8,7c0,0.55-0.45,1-1,1S6,7.55,6,7c0-0.55,0.45-1,1-1S8,6.45,8,7z M7,16c-0.55,0-1,0.45-1,1c0,0.55,0.45,1,1,1s1-0.45,1-1 C8,16.45,7.55,16,7,16z M10.79,8.23L21,18.44V20h-3.27l-5.76-5.76l-1.27,1.27C10.89,15.97,11,16.47,11,17c0,2.21-1.79,4-4,4 c-2.21,0-4-1.79-4-4c0-2.21,1.79-4,4-4c0.42,0,0.81,0.08,1.19,0.2l1.37-1.37l-1.11-1.11C8,10.89,7.51,11,7,11c-2.21,0-4-1.79-4-4 c0-2.21,1.79-4,4-4c2.21,0,4,1.79,4,4C11,7.43,10.91,7.84,10.79,8.23z M10.08,8.94L9.65,8.5l0.19-0.58C9.95,7.58,10,7.28,10,7 c0-1.65-1.35-3-3-3S4,5.35,4,7c0,1.65,1.35,3,3,3c0.36,0,0.73-0.07,1.09-0.21L8.7,9.55l0.46,0.46l1.11,1.11l0.71,0.71l-0.71,0.71 L8.9,13.91l-0.43,0.43l-0.58-0.18C7.55,14.05,7.27,14,7,14c-1.65,0-3,1.35-3,3c0,1.65,1.35,3,3,3s3-1.35,3-3 c0-0.38-0.07-0.75-0.22-1.12l-0.25-0.61L10,14.8l1.27-1.27l0.71-0.71l0.71,0.71L18.15,19H20v-0.15L10.08,8.94z M17.73,4H21v1.56 l-5.52,5.52l-2.41-2.41L17.73,4z M18.15,5l-3.67,3.67l1,1L20,5.15V5H18.15z"></path></svg></div>
        <div class="description"> <p>Your clips</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><g class="style-scope yt-icon"><path d="M18.77,11h-4.23l1.52-4.94C16.38,5.03,15.54,4,14.38,4c-0.58,0-1.14,0.24-1.52,0.65L7,11H3v10h4h1h9.43 c1.06,0,1.98-0.67,2.19-1.61l1.34-6C21.23,12.15,20.18,11,18.77,11z M7,20H4v-8h3V20z M19.98,13.17l-1.34,6 C18.54,19.65,18.03,20,17.43,20H8v-8.61l5.6-6.06C13.79,5.12,14.08,5,14.38,5c0.26,0,0.5,0.11,0.63,0.3 c0.07,0.1,0.15,0.26,0.09,0.47l-1.52,4.94L13.18,12h1.35h4.23c0.41,0,0.8,0.17,1.03,0.46C19.92,12.61,20.05,12.86,19.98,13.17z"></path></svg></div>
        <div class="description"> <p>Liked videos</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="Subscriptions"><p>Subscriptions</p></div>
    <div class="containers sub">
        <div class="icon"><img class="no-filter" src="../Icons/n.jpg" alt=""></div>
        <div class="description"> <p>MrBeast</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="Subscriptions"><p>Explore</p></div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M14.72,17.84c-0.32,0.27-0.83,0.53-1.23,0.66c-1.34,0.33-2.41-0.34-2.62-0.46c-0.21-0.11-0.78-0.38-0.78-0.38 s0.35-0.11,0.41-0.13c1.34-0.54,1.89-1.24,2.09-2.11c0.2-0.84-0.16-1.56-0.31-2.39c-0.12-0.69-0.11-1.28,0.12-1.9 c0.02-0.05,0.12-0.43,0.12-0.43s0.11,0.35,0.13,0.41c0.71,1.51,2.72,2.18,3.07,3.84c0.03,0.15,0.05,0.3,0.05,0.46 C15.8,16.3,15.4,17.26,14.72,17.84z M12.4,4.34c-0.12,0.08-0.22,0.15-0.31,0.22c-2.99,2.31-2.91,5.93-2.31,8.55l0.01,0.03l0.01,0.03 c0.06,0.35-0.05,0.7-0.28,0.96c-0.24,0.26-0.58,0.41-0.95,0.41c-0.44,0-0.85-0.2-1.22-0.6c-0.67-0.73-1.17-1.57-1.5-2.46 c-0.36,0.77-0.75,1.98-0.67,3.19c0.04,0.51,0.12,1,0.25,1.43c0.18,0.6,0.43,1.16,0.75,1.65c1.05,1.66,2.88,2.82,4.78,3.05 c0.42,0.05,0.85,0.08,1.26,0.08c1.34,0,3.25-0.27,4.74-1.57c1.77-1.56,2.35-3.99,1.44-6.06c-0.04-0.1-0.06-0.14-0.09-0.19 l-0.04-0.08c-0.21-0.42-0.47-0.81-0.75-1.14c-0.24-0.3-0.48-0.56-0.79-0.83c-0.3-0.27-0.64-0.51-1-0.77 c-0.46-0.33-0.93-0.67-1.38-1.09C12.98,7.83,12.3,6.11,12.4,4.34 M14.41,2c0,0-0.2,0.2-0.56,0.99c-0.66,1.92-0.15,3.95,1.34,5.39 c0.73,0.69,1.61,1.17,2.36,1.84c0.32,0.29,0.62,0.59,0.89,0.93c0.36,0.42,0.66,0.89,0.91,1.38c0.05,0.1,0.1,0.2,0.14,0.3 c1.12,2.55,0.36,5.47-1.73,7.31C16.23,21.47,14.22,22,12.22,22c-0.47,0-0.95-0.03-1.41-0.09c-2.29-0.28-4.42-1.66-5.63-3.57 c-0.39-0.6-0.68-1.26-0.88-1.93c-0.16-0.54-0.25-1.1-0.29-1.67c-0.12-1.88,0.67-3.63,1.08-4.31c0.41-0.69,1.55-2.18,1.55-2.18 s0,0.03-0.01,0.09C6.41,10.11,7,11.88,8.22,13.22c0.15,0.17,0.27,0.22,0.34,0.22c0.06,0,0.09-0.04,0.08-0.09 C7.79,9.59,8.37,6,11.35,3.7c0.59-0.46,1.51-0.94,1.98-1.18C13.8,2.28,14.41,2,14.41,2L14.41,2z"></path></svg></div>
        <div class="description"> <p>Trending</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M12,4v9.38C11.27,12.54,10.2,12,9,12c-2.21,0-4,1.79-4,4c0,2.21,1.79,4,4,4s4-1.79,4-4V8h6V4H12z M9,19c-1.66,0-3-1.34-3-3 s1.34-3,3-3s3,1.34,3,3S10.66,19,9,19z M18,7h-5V5h5V7z"></path></svg></div>
        <div class="description"> <p>Music</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M10,12H8v2H6v-2H4v-2h2V8h2v2h2V12z M17,12.5c0-0.83-0.67-1.5-1.5-1.5S14,11.67,14,12.5c0,0.83,0.67,1.5,1.5,1.5 S17,13.33,17,12.5z M20,9.5C20,8.67,19.33,8,18.5,8S17,8.67,17,9.5c0,0.83,0.67,1.5,1.5,1.5S20,10.33,20,9.5z M16.97,5.15l-4.5,2.53 l-0.49,0.27l-0.49-0.27l-4.5-2.53L3,7.39v6.43l8.98,5.04l8.98-5.04V7.39L16.97,5.15 M16.97,4l4.99,2.8v7.6L11.98,20L2,14.4V6.8 L6.99,4l4.99,2.8L16.97,4L16.97,4z"></path></svg></div>
        <div class="description"><p>Gaming</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M17 3V5V6V10V10.51L16.99 10.97C16.94 13.1 15.66 14.94 13.74 15.67H13.72L13.66 15.69L13 15.95V16.65V19V20H14V21H15H10V20H11V19V16.65V15.95L10.34 15.71L10.26 15.68H10.25C8.33 14.95 7.05 13.11 7 10.98V10.51V10V6V5V3H17ZM18 2H6V5H4V6V10V11H6.01C6.07 13.53 7.63 15.78 9.97 16.64C9.98 16.64 9.99 16.64 10 16.65V19H9V20H8V22H16V20H15V19H14V16.65C14.01 16.65 14.02 16.65 14.03 16.64C16.36 15.78 17.93 13.54 17.99 11H20V10V6V5H18V2ZM18 10V6H19V10H18ZM5 10V6H6V10H5Z"></path></svg></div>
        <div class="description"><p>Sports</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="Subscriptions"><p>More from Youtube</p></div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="no-filter" style="pointer-events: none; display: block; width: 24px; height: 24px;"><path fill="red" d="M11.13 1.21c.48-.28 1.26-.28 1.74 0l8.01 4.64c.48.28.87.97.87 1.53v9.24c0 .56-.39 1.25-.87 1.53l-8.01 4.64c-.48.28-1.26.28-1.74 0l-8.01-4.64c-.48-.28-.87-.97-.87-1.53V7.38c0-.56.39-1.25.87-1.53l8.01-4.64z"></path><path fill="#fff" d="m12.71 18.98 4.9-2.83c.41-.24.64-.77.64-1.24V9.24c0-.47-.23-1-.64-1.24l-4.9-2.82c-.41-.23-1.02-.23-1.42 0L6.39 8c-.4.23-.64.77-.64 1.24v5.67c0 .47.24 1 .64 1.24l4.9 2.83c.2.12.46.18.71.18.26-.01.51-.07.71-.18z" class="style-scope yt-icon"></path><path fill="red" d="m12.32 5.73 4.89 2.83c.16.09.41.31.41.67v5.67c0 .37-.25.54-.41.64l-4.89 2.83c-.16.09-.48.09-.64 0l-4.89-2.83c-.16-.09-.41-.34-.41-.64V9.24c.02-.37.25-.58.41-.68l4.89-2.83c.08-.05.2-.07.32-.07s.24.02.32.07z" class="style-scope yt-icon"></path><path fill="#fff" d="M9.88 15.25 15.5 12 9.88 8.75z"></path></svg></div>
        <div class="description"><p>Youtube Studio</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img class="no-filter" src="../Icons/youtube-kids-icon.svg" alt=""></div>
        <div class="description"><p>Youtube Kids</p> </div>
    </div>
    <div class="hr second padded"></div>
    <div class="containers sub padded">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,8c-2.21,0-4,1.79-4,4s1.79,4,4,4s4-1.79,4-4 S14.21,8,12,8L12,8z M13.22,3l0.55,2.2l0.13,0.51l0.5,0.18c0.61,0.23,1.19,0.56,1.72,0.98l0.4,0.32l0.5-0.14l2.17-0.62l1.22,2.11 l-1.63,1.59l-0.37,0.36l0.08,0.51c0.05,0.32,0.08,0.64,0.08,0.98s-0.03,0.66-0.08,0.98l-0.08,0.51l0.37,0.36l1.63,1.59l-1.22,2.11 l-2.17-0.62l-0.5-0.14l-0.4,0.32c-0.53,0.43-1.11,0.76-1.72,0.98l-0.5,0.18l-0.13,0.51L13.22,21h-2.44l-0.55-2.2l-0.13-0.51 l-0.5-0.18C9,17.88,8.42,17.55,7.88,17.12l-0.4-0.32l-0.5,0.14l-2.17,0.62L3.6,15.44l1.63-1.59l0.37-0.36l-0.08-0.51 C5.47,12.66,5.44,12.33,5.44,12s0.03-0.66,0.08-0.98l0.08-0.51l-0.37-0.36L3.6,8.56l1.22-2.11l2.17,0.62l0.5,0.14l0.4-0.32 C8.42,6.45,9,6.12,9.61,5.9l0.5-0.18l0.13-0.51L10.78,3H13.22 M14,2h-4L9.26,4.96c-0.73,0.27-1.4,0.66-2,1.14L4.34,5.27l-2,3.46 l2.19,2.13C4.47,11.23,4.44,11.61,4.44,12s0.03,0.77,0.09,1.14l-2.19,2.13l2,3.46l2.92-0.83c0.6,0.48,1.27,0.87,2,1.14L10,22h4 l0.74-2.96c0.73-0.27,1.4-0.66,2-1.14l2.92,0.83l2-3.46l-2.19-2.13c0.06-0.37,0.09-0.75,0.09-1.14s-0.03-0.77-0.09-1.14l2.19-2.13 l-2-3.46L16.74,6.1c-0.6-0.48-1.27-0.87-2-1.14L14,2L14,2z"></path></svg></div>
        <div class="description"><p>Settings</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M13.18,4l0.24,1.2L13.58,6h0.82H19v7h-5.18l-0.24-1.2L13.42,11H12.6H6V4H13.18 M14,3H5v18h1v-9h6.6l0.4,2h7V5h-5.6L14,3 L14,3z"></path></svg></div>
        <div class="description"><p>Report history</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M15.36,9.96c0,1.09-0.67,1.67-1.31,2.24c-0.53,0.47-1.03,0.9-1.16,1.6L12.85,14h-1.75l0.03-0.28 c0.14-1.17,0.8-1.76,1.47-2.27c0.52-0.4,1.01-0.77,1.01-1.49c0-0.51-0.23-0.97-0.63-1.29c-0.4-0.31-0.92-0.42-1.42-0.29 c-0.59,0.15-1.05,0.67-1.19,1.34L10.32,10H8.57l0.06-0.42c0.2-1.4,1.15-2.53,2.42-2.87c1.05-0.29,2.14-0.08,2.98,0.57 C14.88,7.92,15.36,8.9,15.36,9.96z M12,18c0.55,0,1-0.45,1-1s-0.45-1-1-1s-1,0.45-1,1S11.45,18,12,18z M12,3c-4.96,0-9,4.04-9,9 s4.04,9,9,9s9-4.04,9-9S16.96,3,12,3 M12,2c5.52,0,10,4.48,10,10s-4.48,10-10,10S2,17.52,2,12S6.48,2,12,2L12,2z"></path></svg></div>
        <div class="description"><p>Help</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><svg viewBox="0 0 24 24" class="svg-leftnav" style="pointer-events: none; display: block;"><path d="M13,14h-2v-2h2V14z M13,5h-2v6h2V5z M19,3H5v16.59l3.29-3.29L8.59,16H9h10V3 M20,2v15H9l-5,5V2H20L20,2z"></path></svg></div>
        <div class="description"><p>Send feedback</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="external-links"><p>About Press Copyright Contact us  Creators Advertise Developers <br> <br>
        Terms Privacy Policy & Safety How YouTube works Test new features <br> <br> © 2023 Google LLC</p></div>
    <div class="containers sub">
        <div class="icon"></div>
        <div class="description"></div>
    </div>
    
</div>
<div class="filler-between-nav-and-links"></div>
<div class="block">
<div class="recommendations fixed" id="recommendations">
    <div id="slide-left" class="slide-left"> <button><img src="../Icons/Button-left.svg" alt=""></button></div>
    <div id="recommendations-links" class="recommendations-links">
       
        <li class="filter-button" id="all">All</li>
        <li class="filter-button">Music</li>
        <li class="filter-button">Education</li>
        <li class="filter-button">Sports</li>
        <li class="filter-button">Social media</li>
        <li class="filter-button">Weight lifting</li>
        <li class="filter-button">Microsoft flight simulator</li>
        <li class="filter-button">Playstation</li>
        <li class="filter-button">PC Gaming</li>
        <li class="filter-button">Comedy</li>
        <li class="filter-button">Art</li>
        <li class="filter-button">Science</li>
        <li class="filter-button">Explore</li>
        <li class="filter-button">New to you</li>
       
    </div>

    <div id="slide-right" class="slide-right"><button><img src="../Icons/Button-right.svg" alt=""></button></div>
   </div>
        </div>
    </div>
</div>


<div class="flex2">
    <div class="empty"></div>

    <div class="videos-container">
        <?php
        $sql = "SELECT * FROM videos ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
        while($video = mysqli_fetch_assoc($result)){  
        ?>
        
        <div class="vid-container">
            <div><a href="template.php?<?= http_build_query(['title' => $video['vidUrl'], 'vidId' => $video['vid_uid']]) ?>"rel="noopener noreferrer"><div>
                
            <div class="wrapper-for-video-controls" onmouseover="play(this)" onmouseout="stop(this)">
            <img src="../Dashboard/<?php echo $video['vid_thumbnail_url'] ?>" alt="" class="video-poster" style="height:205px; width:364px; border-radius:15px; pointer-events: none ; ">
                <video src="../Dashboard/Uploads/<?php echo $video['vid_uid'] ?>" class="videos" id="<?php echo 'myVideo_' . $video['vid_uid'] ?>"  muted></video >
                <div class="time-container">
                    <div class="total-time"><p></p></div>
                </div>
                <div class="controls is-hidden">
                    <div class="mute-button">
                    <i class='fas fa-volume-mute'></i>
                    <i class='fas fa-volume-up '></i>
                    </div>
                  
                    <div class="red-bar">
                    <div class="time-and-time-remaining">
                        <div class="time-and-time-rem-contianer">
                        <div class="time"><p></p></div>
                        <div><p>/</p></div>
                        <div class="time-remaining"><p></p></div>
                        </div>
                </div>
                        <div class="red-bar-click-region"></div>
                        <div class="red-bar-and-dot">
                        <div class="red-bar-background" style="pointer-events: none ;"></div>
                        <div class="red-dot"></div>
                        </div>
                        <div class="red-bar-background-loaded-bar" style="pointer-events: none ;"></div>
                    </div>
                        
                    </div>

                </div>
            </div></a></div>

            <div class="description">
                <div class="pfp"><p>
                    <?php 
                    $user_uid = $video['user_uid'];
                    $sql2 = "SELECT * FROM user_info WHERE user_uid='$user_uid'";
                    $result2 = mysqli_query($conn, $sql2);
                    $rows = mysqli_fetch_assoc($result2);
                    echo '<p style="background-color:' . $rows['bgcolor_pfp'] . '; padding:8px 14px;padding-top: 9px;">' .  $rows['user_pfp'] . '</p>';
                    
                    ?>
                </p></div>
                <div class="describe-video">
                    <div class="title" style="text-overflow: ellipsis;">
                        <p><?php echo $video['title']?></p>
                    </div>
                    <div class="channel">
                        <p><?php echo $video['username']?></p>
                    </div>
                    <div class="flex-6">
                        <div>113.3k views</div>
                        <div>.</div>
                        <div><?php 
                        $uploaded_at = $video['time_uploaded'];

                        $now = new DateTime();
                        $uploaded_time = new DateTime();
                        $uploaded_time->setTimestamp($uploaded_at);
                        $interval = $now->diff($uploaded_time);
                        
                        if ($interval->y > 0) {
                            echo $interval->format('%y year' . ($interval->y > 1 ? 's' : '') . ' ago');
                        } elseif ($interval->m > 0) {
                            echo $interval->format('%m month' . ($interval->m > 1 ? 's' : '') . ' ago');
                        } elseif ($interval->d > 0) {
                            echo $interval->format('%d day' . ($interval->d > 1 ? 's' : '') . ' ago');
                        } elseif ($interval->h > 0) {
                            echo $interval->format('%h hour' . ($interval->h > 1 ? 's' : '') . ' ago');
                        } elseif ($interval->i > 0) {
                            echo $interval->format('%i minute' . ($interval->i > 1 ? 's' : '') . ' ago');
                        } else {
                            echo 'just now';
                        } ?></div>
                    </div>
                </div>

                        
                <div class="dots-set for-video">
            <div class="dots-settings"></div>
            <div class="dots-settings"></div>
            <div class="dots-settings"></div>
        </div>

            </div>
            </div>
           
        <?php
        }
        }else{
         echo "Empty";
        }
        ?>
    </div>


</div>




</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="files_for_homepage/index.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</html>