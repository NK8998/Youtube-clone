<?php
include '../Dashboard/Required.php';

session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../watch.php");
    exit();
}
$user = $_SESSION['user_first_name'];
$l_name = $_SESSION['user_last_name'];



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
    <link rel="stylesheet" href="files_for_homepage/logged-in.css">
    </head>
<body>
    <div class="wrapper">
   <navbar class="navbar">
    <div class="container1">
        <div class="burger" onclick="toggleNav()">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="logo">
        <div><a href="#"><img src="../Icons/yt2.jpg" alt=""></a></div>
        <div><a href="#">YouTube</a></div>
    </div>
    </div>
    
    <div class="container2">
    
        <div class="searchbar"> 
        <div class="search-button-left in-focus"><img class="search-img"src="../Icons/search-thin.svg" alt=""></div>
            <input type="text" placeholder="Search" class="input">
        <div class="search-button"><button type="submit"><img class="search-img"src="../Icons/search-thin.svg" alt=""></button></div>
    </div>
   <div class="idie-mic">
        <div class="microphone"><button style="font-size:24px"><img class="search-img"src="../Icons/mic-microphone-icon.svg" alt=""></button></div>
    </div>
    </div>
    
    <div class="container3">
    
    <a href="../Dashboard/Channel-Dashboard.php?user=<?php echo $user; ?>&last_name=<?php echo $l_name; ?>">
            <div class="video-plus"><img src="../Icons/video-plus (2).svg" alt=""></div>
            </a>
        <div class="noti"> <object data="../Icons/notification.svg" type=""></object></div>
        <a href="Logout.php"><div class="profile-pic">
        <?php
            $pfp = substr(trim($user), 0, 1); 
           
            $sql = "SELECT * FROM user_info WHERE first_name = '$user'";
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

 <div class="left-nav-minimized">
        <div class="containers-min">
            <div class="icon"><img src="../Icons/home-house-svgrepo-com.svg" alt=""></div>
            <div class="description"><p>Home</p></div>
        </div>
        <div class="containers-min">
        <div class="icon"><img src="../Icons/YouTube_Shorts_(Outline).svg" alt=""></div>
            <div class="description"><p>Shorts</p> </div>
        </div>
        <div class="containers-min">
        <div class="icon"><img src="../Icons/subscriptions.svg" alt=""></div>
            <div class="description"><p>Subscriptions</p></div>
        </div>
        <div class="containers-min">
        <div class="icon"><img src="../Icons/library.svg" alt=""></div>
            <div class="description"><p>Library</p></div>
        </div>
    </div>


<div class="left-nav ">
    <a href="Logged-in-ver.php?user=<?php echo $user; ?>&last_name=<?php echo $l_name; ?>">
    <div class="containers">
        <div class="icon"><img src="../Icons/home-house-svgrepo-com.svg" alt=""></div>
        <div class="description"> <p>Home</p> </div>
    </div>
    </a>
    <div class="containers">
        <div class="icon"><img src="../Icons/YouTube_Shorts_(Outline).svg" alt=""></div>
        <div class="description"> <p>Shorts</p> </div>
    </div>
    <div class="containers">
        <div class="icon-1"><img src="../Icons/subscriptions.svg" alt=""></div>
        <div class="description"><p>Subscriptions</p></div>
    </div>

    <div class="hr one"></div>

    <div class="containers">
        <div class="icon"><img src="../Icons/library.svg" alt=""></div>
        <div class="description"> <p>Library</p> </div>
    </div>
    <div class="containers">                                
        <div class="icon"><img src="../Icons/history.svg" alt=""></div>
        <div class="description"> <p>History</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><img src="../Icons/Your videos.svg" alt=""></div>
        <div class="description"> <p>Your videos</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><img src="../Icons/watch-later-icon-original.svg" alt=""></div>
        <div class="description"> <p>Watch Later</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><img src="../Icons/scissor-outline-icon.svg" alt=""></div>
        <div class="description"> <p>Your Clips</p> </div>
    </div>
    <div class="containers">
        <div class="icon"><img src="../Icons/thumbs-up.svg" alt=""></div>
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
        <div class="icon"><img src="../Icons/fire-trending.svg" alt=""></div>
        <div class="description"> <p>Trending</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="../Icons/music-note-single_97768.svg" alt=""></div>
        <div class="description"> <p>Music</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="../Icons/youtube-gaming.svg" alt=""></div>
        <div class="description"><p>Gaming</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="../Icons/cup.svg" alt=""></div>
        <div class="description"><p>Sports</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="Subscriptions"><p>More from Youtube</p></div>
    <div class="containers sub">
        <div class="icon"><img class="no-filter" src="../Icons/Youtube_Studio_icon_2021.webp" alt=""></div>
        <div class="description"><p>Youtube Studio</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img class="no-filter" src="../Icons/youtube-kids-icon.svg" alt=""></div>
        <div class="description"><p>Youtube Kids</p> </div>
    </div>
    <div class="hr second"></div>
    <div class="containers sub">
        <div class="icon"><img  src="../Icons/settings-svgrepo-com.svg" alt=""></div>
        <div class="description"><p>Settings</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="../Icons/waving-flag.svg" alt=""></div>
        <div class="description"><p>Report history</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="../Icons/question-mark-button-svgrepo-com.svg" alt=""></div>
        <div class="description"><p>Help</p> </div>
    </div>
    <div class="containers sub">
        <div class="icon"><img src="../Icons/speech-bubble.svg" alt=""></div>
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
                    $username = $video['first_name'];
                    $sql2 = "SELECT * FROM user_info WHERE first_name='$username' ";
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