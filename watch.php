

<?php
include 'Dashboard/Required.php';

$params = session_get_cookie_params();
$params["httponly"] = true;
session_set_cookie_params($params["lifetime"], $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
session_start();
if(isset($_SESSION['user_id'])){
    $user = $_SESSION['user_first_name'] ;
    $l_name = $_SESSION['user_last_name'] ;
    header("Location: Logged-in-version/Logged-in-ver.php?user=$user&last_name=$l_name");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title> Youtube</title>
    <link rel="icon" href="https://www.svgrepo.com/download/13671/youtube.svg" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="wFiles_for_homepage/index.css">
    </head>    
<body>
        
    <div class="wrapper"><!-- div contains the navbar, left-navigations and filter-buttons -->     
   <navbar class="navbar">

    <div class="container1">
        <div class="burger">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="logo">
            <div><a href="#"><img src="Logged-in-version/yt2.jpg" alt=""></a></div>
            <div><a href="#">YouTube</a></div>
        </div>
    </div>
    
    <div class="container2">
        <div class="searchbar"> <input type="text" placeholder="Search">
            <div class="search-button"><button type="submit"><i class="fa fa-search"></i></button></div>
        </div>
        <div class="idie-mic">
            <div class="microphone"><button style="font-size:24px"><i class="fa fa-microphone"></i></button></div>
        </div>
    </div>

    <div class="container3">
        <div class="dots-set">
            <div class="dots-settings"></div>
            <div class="dots-settings"></div>
            <div class="dots-settings"></div>
        </div>
        <div class="sign-in-btn">
            <i class='far fa-user-circle'></i>
            <a href="Log-in/Sign_in/Sign_in">Sign in</a>
        </div>
    </div>

</navbar>

   <br>
  

</nav>
 <div class="flex">
  
<div class="left-nav "> <!-- div contains the left-navigations -->     
    <a href="watch">
    <div class="containers">
        <div class="icon"><img src="Icons/home-house-svgrepo-com.svg" alt=""></div>
        <div class="description"> <p>Home</p></div>
    </div>
    </a>
    <a href="ttt.php">
    <div class="containers">
        <div class="icon"><img src="Icons/YouTube_Shorts_(Outline).svg" alt=""></div>
        <div class="description"> <p>Shorts</p> </div>
    </div>
    </a>
    <a href="jjj.php">
    <div class="containers">
        <div class="icon-1"><img src="Icons/subscriptions.svg" alt=""></div>
        <div class="description"><p>Subscriptions</p></div>
    </div>
    </a>
    <div class="hr second"></div>

    <div class="containers">
        <div class="icon"><img src="Icons/library.svg" alt=""></div>
        <div class="description"> <p>Library</p> </div>
    </div>
    <div class="containers">                                
        <div class="icon"><img src="Icons/history.svg" alt=""></div>
        <div class="description"> <p>History</p> </div>
    </div>
    <div class="hr second"></div>

    <div class="Subscriptions pursuade"><p>Sign in to like videos, comment, and subscribe.</p></div>

    <div class="containers-btn">
    <div class="sign-in-btn left-btn-nav">
         <i class='far fa-user-circle'></i>
        <a href="Log-in/Sign_in/Sign_in">Sign in</a>
    </div>
    </div>

    <div class="hr second line"></div>
   
   
    <div class="Subscriptions"><p>Explore</p></div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/fire-trending.svg" alt=""></div>
        <div class="description"> <p>Trending</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/music-note-single_97768.svg" alt=""></div>
        <div class="description"> <p>Music</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/youtube-gaming.svg" alt=""></div>
        <div class="description"><p>Gaming</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/cup.svg" alt=""></div>
        <div class="description"><p>Sports</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/add-add-plus-sign.svg" alt=""></div>
        <div class="description"><p>Browse channels</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="Subscriptions"><p>More from Youtube</p></div>
    <div class="containers sub">
        <div class="icon"><img class="no-filter" src="Icons/youtube-kids-icon.svg" alt=""></div>
        <div class="description"><p>Youtube Kids</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="containers sub">
        <div class="icon"><img  src="Icons/settings-svgrepo-com.svg" alt=""></div>
        <div class="description"><p>Settings</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/waving-flag.svg" alt=""></div>
        <div class="description"><p>Report history</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/question-mark-button-svgrepo-com.svg" alt=""></div>
        <div class="description"><p>Help</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="Icons/speech-bubble.svg" alt=""></div>
        <div class="description"><p>Send feedback</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="external-links"><p>About Press Copyright Contact us  Creators Advertise Developers <br> <br>
Terms Privacy Policy & Safety How YouTube works Test new features <br> <br> © 2023 Google LLC</p></div>
</div>
<div class="filler-between-nav-and-links"></div>    
<div class="block">
<div class="recommendations fixed" id="recommendations"> <!-- filter buttons --> 
    <div id="slide-left" class="slide-left"> <button><img src="Logged-in-version/Button-left.svg" alt=""></button></div>
    <div id="recommendations-links" class="recommendations-links">
       <a href="">All</a>
       <a href="">Gaming</a>
       <a href="">Music</a>
       <a href="">Live</a>
       <a href="">Podcasts</a>
       <a href="">Weight Training</a>
       <a href="">Computer Hardware</a>
       <a href="">Microsoft Flight Simulator</a>
       <a href="">Mixes</a>
       <a href="">The Weeknd</a>
       <a href="">Superhero movies</a>
       <a href="">Cars</a>
       <a href="">Rapping</a>
       <a href="">Action-Adventure Games</a>
       <a href="">Conversation</a>
       <a href="">Recently Uploaded</a>
       <a href="">New to you</a>
    </div>

    <div id="slide-right" class="slide-right"><button><img src="Logged-in-version/Button-right.svg" alt=""></button></div>
   </div><!-- filter buttons --> 
</div>
    </div>
</div><!-- div contains the navbar, left-navigations and filter-buttons -->     


<div class="flex2">
    <div class="empty"></div>
    <div class="videos-container"><!-- div contains all the videos -->
        <?php
        $sql = "SELECT * FROM videos ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
        while($video = mysqli_fetch_assoc($result)){  
        ?>
        
        <div class="vid-container"><!--div for each video --> 
            <div><a href="template.php?<?= http_build_query(['title' => $video['vidUrl'], 'vidId' => $video['vid_uid']]) ?>"rel="noopener noreferrer"><div>
               
                <div class="wrapper-for-video-controls" onmouseover="play(this)" onmouseout="stop(this)"><!-- div for the video and the controls -->
                <video src="Dashboard/Uploads/<?php echo $video['vid_uid'] ?>" class="videos" id="<?php echo 'myVideo_' . $video['vid_uid'] ?>"  muted ></video > 
                    <div class="controls is-hidden"> <!-- div for controls --> 
                    <div class="mute-button">
                    <i class='fas fa-volume-mute'></i>
                    <i class='fas fa-volume-up '></i>
                    </div>
                    <div class="red-bar-click-region">
                        <div class="red-bar">
                            <div class="red-bar-background"></div>
                            <div class="red-bar-background-loaded-bar"></div>
                        </div>
                    </div>
                </div><!-- div for controls --> 
                </div><!-- div for the video and the controls -->
                
            </div></a></div>

            <div class="description"><!-- div for the entire video description --> 
                <div class="pfp"><p>
                <?php 
                    $username = $video['first_name'];
                    $sql2 = "SELECT * FROM user_info WHERE first_name='$username' ";
                    $result2 = mysqli_query($conn, $sql2);
                    $rows = mysqli_fetch_assoc($result2);
                    echo '<p style="background-color:' . $rows['bgcolor_pfp'] . '; padding:8px 14px;padding-top: 9px;">' .  $rows['user_pfp'] . '</p>';
                    
                    ?>
                </p></div>
                <div class="describe-video">
                    <div class="title">
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
          
            </div><!--div for each video --> 
           

        <?php
        }
        }else{
         echo "Empty";
        }
        ?>
    </div><!-- div contains all the videos -->
</div>




</body>
<script src="wFiles_for_homepage/index.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>


<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</html>