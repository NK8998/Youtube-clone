<?php
include '../Dashboard/Required.php';

session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../watch.php");
    exit();
}
$user = trim($_SESSION['user_first_name']);
$l_name = trim($_SESSION['user_last_name']);

$user_name = trim($user .' '. $l_name);

$vid_uuid = $_GET['vidId'];

$sql = "SELECT * FROM videos WHERE vid_uid = '$vid_uuid'";
$result2=mysqli_query($conn, $sql);
$row2 = mysqli_fetch_assoc($result2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="files_for_template/template.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
<navbar class="navbar">
    <div class="container1">
        <div class="burger">
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
   </div>
   <br>
   <div class="wrapper-for-everything">
<div class="flex-wrapper-for-video-and-recomendations">
  
<div class="video-and-comment-section">
    <div class="video-container">
    <div><video class="video" src="../Dashboard/Uploads/<?php echo $vid_uuid; ?>" controls></video></div>
    </div>
<div class="video-description">
    <div class="title"><p><?php echo $row2['title'];?></p></div>
    <div class="navigations-for-video">
        <div class="channel-and-subscribe">
            <div class="pfp"><img src="../Icons/j.jpg" alt=""></div>
            <div class="block-for-channel-and-sub">
            <div class="channel"><p><?php echo $row2['username'];?></p></div>
            <div class="sub-count"><p>
            <?php
                $subscribers = trim($row2['username']);
                $sub_count = "SELECT COUNT(*) FROM subscriber_data WHERE subscribed_to = '$subscribers';";
                $result3 = mysqli_query($conn, $sub_count);
                $row3 = mysqli_fetch_assoc($result3);
                echo $row3['COUNT(*)'];
              ?>
                 subscribers
            </p></div>
            </div>
            <div class="sub-unsub">
            <?php 
            $channel = $row2['username'];
            $sql4 = "SELECT * FROM subscriber_data WHERE username='$user_name' AND subscribed_to='$channel'";
            $result = mysqli_query($conn, $sql4);
            if(mysqli_num_rows($result) > 0){
                echo ' <div class="unsubscribe-button"><img src="../Icons/bell.svg" alt=""><p>Subscribed</p><i class="fas fa-chevron-down"></i></div>';
            }elseif(mysqli_num_rows($result) == 0){
                echo ' <div class="subscribe-button"><p>Subscribe</p> </div>';
            }
            
            ?>
           
        </div>
        <div class="subscribe-dropdown show-dropdown">
            <div class="sub-dropdown-content"><img src="../Icons/bell-notification-icon.svg" alt=""> <p>All</p> </div>
            <div class="sub-dropdown-content"><img src="../Icons/bell.svg" alt="" style="transform:scale(1.1);"><p>Personalized</p></div>
            <div class="sub-dropdown-content"><img src="../Icons/bell-off.svg" alt=""><p>None</p></div>
            <div class="sub-dropdown-content unsubscribe"><img src="../Icons/Unsubscribe-icon.svg" alt=""style="transform:scale(0.9);"><p>Unsubscribe</p></div>
        </div>
            
            <div class="show-subscribed-banner "><p></p></div>
           
          
            
            
        </div>
        
    <div class="rest-of-navigations">
        <div class="like-and-dislike">
            <div class="like">
            <p class="liked">Liked</p>
            <?php
                $sql6 = "SELECT * FROM like_dislike where username='$user_name' AND vidId='$vid_uuid'";
                $result6 = mysqli_query($conn, $sql6);
                if(mysqli_num_rows($result6) > 0){
                    $row4 = mysqli_fetch_assoc($result6);
                if($row4['liked'] == true){
                    echo '<svg class="feather feather-thumbs-up filler-for-svg" fill="none" height="22" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>';
                }elseif($row4['liked'] == false){
                    echo '<svg class="feather feather-thumbs-up" fill="none" height="22" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>';
                }

                }else{
                    echo '<svg class="feather feather-thumbs-up" fill="none" height="22" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>';
                }
                
            ?>
            
            <div ><p class="likes-count">
                <?php 
                $sql8 = "SELECT COUNT(*) FROM like_dislike WHERE vidId = '$vid_uuid' AND liked= true;";
                $result7 = mysqli_query($conn, $sql8);
                if(mysqli_num_rows($result7) > 0){
                    $row6 = mysqli_fetch_assoc($result7);
                    echo $row6['COUNT(*)'];
                }else{
                    echo '0';
                }
               
                 ?>
            </p></div>
            </div>
            <div class="separator"></div>
            <div class="dislike">
            <p class="disliked">Disliked</p>
            <?php
                $sql7 = "SELECT * FROM like_dislike where username='$user_name' AND vidId='$vid_uuid'";
                $result7 = mysqli_query($conn, $sql7);
                if(mysqli_num_rows($result7) > 0){
                    $row5 = mysqli_fetch_assoc($result7);
                if($row5['disliked'] == true){
                    echo '<svg class="feather feather-thumbs-down filler-for-svg" fill="none" height="22" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"/></svg>';
                }elseif($row5['disliked'] == false){
                    echo '<svg class="feather feather-thumbs-down" fill="none" height="22" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"/></svg>';
                }

                }else{
                    echo '<svg class="feather feather-thumbs-down" fill="none" height="22" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"/></svg>';
                }
                
            ?>
           
            <div><p class="dislikes-count">
            <?php
                $sql9 = "SELECT COUNT(*) FROM like_dislike WHERE vidId = '$vid_uuid' AND disliked= true;";
                $result8 = mysqli_query($conn, $sql9);
                if(mysqli_num_rows($result8) > 0){
                    $row7 = mysqli_fetch_assoc($result8);
                    echo $row7['COUNT(*)'];
                }else{
                    echo '0';
                }
               
                 ?>
            </p></div>
            </div>
        </div>

        <div class="share"><img src="../Icons/share-button.svg" alt=""><button>Share</button></div>
        <div class="download"><img src="../Icons/download.svg" alt=""><button>Download</button></div>
        <div class="dots-for-extra-navigations">
            <div class="dots"></div>
            <div class="dots"></div>
            <div class="dots"></div>
        </div>
    </div>
    </div>

    <div class="full-video-description">
        <div class="top-description">
            <div class="views">154,729 views</div>
            <div class="date-uploaded">27 Apr 2023</div>
            <div class="tags"><p> #IGN #Gaming #StarWars</p></div>
        </div>
        <div class="full-description">
            <p>Take a look at the latest trailer for Star Wars Jedi: Survivor where actor Cameron Monaghan (Cal Kestis) gets some coaching on how to be a Jedi with the one and only Mark Hamill, Luke Skywalker himself. Star Wars Jedi: Survivor is available on April 28 for PlayStation 5, Xbox Series S|X, and PC.</p>
        </div>
        <div class="tags"><p> #IGN #Gaming #StarWars</p></div>
        <div class="collapse-div"><p>Show less</p></div>
    </div>

</div>

</div>

<div class="recommendations-section">
<div class="recommendations fixed" id="recommendations">
    <div id="slide-left" class="slide-left"> <button><img src="../Icons/Button-left.svg" alt=""></button></div>
    <div id="recommendations-links" class="recommendations-links">
       
        <li class="filter-button" id="all">All</li>
        <li class="filter-button">From Josh A</li>
        <li class="filter-button">Related</li>
        <li class="filter-button">Recently Uploaded</li>
       
    </div>

    <div id="slide-right" class="slide-right"><button><img src="../Icons/Button-right.svg" alt=""></button></div>
   </div>
   <div class="reccomendadtions-videos">
    <div class="videos-container">
        <?php
        $sql = "SELECT * FROM videos ORDER BY RAND()";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
        while($video = mysqli_fetch_assoc($result)){  
           
        ?>
       
        <div class="vid-container">
            <div class="flex-for-video-and-description">
            <div><a href="template.php?<?= http_build_query(['title' => $video['vidUrl'], 'vidId' => $video['vid_uid']]) ?>"rel="noopener noreferrer"><div>
            <div class="wrapper-for-video-controls">
            <img src="../Dashboard/<?php echo $video['vid_thumbnail_url'] ?>" alt="" class="video-poster" style="height:105px; width:184px; border-radius: 10px; pointer-events: none ; ">
                <video src="../Dashboard/Uploads/<?php echo $video['vid_uid'] ?>" class="videos" id="<?php echo 'myVideo_' . $video['vid_uid'] ?>"  muted></video >
                <div class="time-container">
                    <div class="total-time"><p></p></div>
                </div>
                </div>
            </div></a></div>

            <div class="description">
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
            </div>
       
        <?php
        }
        }else{
         echo "Empty";
        }
        ?>
    </div>
   </div>
</div>


</div>
<div class="comment-section">
    <div class="top-row">
        <div class="total-comments"><p>758 Comments</p></div>
        <div class="sort"><img src="../Icons/sort-by.svg" alt=""> <p>Sort by</p> </div>
    </div>
    <div class="users-pfp-and-input">
        <img src="../Icons/n.jpg" alt="">
        <input type="text" placeholder="Add a comment..." class="input2">
    </div>
    <div class="comments">
        
    </div>
</div>



</div>
<div class="share-dropdown-wrapper show-dropdown">
<div class="share-dropdown ">
    <div class="share-top"><p>Share</p></div>
    <div class="icons-section">
        <div class="slide-left-2"><img src="../Icons/Button-left.svg" alt=""></div>
    <div class="icon-and-description">
        <div class="icon embed"><img src="../Icons/embed.png" alt=""></div>
        <div class="icon-description"> <p>Embed</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/whatsapp.png" alt=""></div>
        <div class="icon-description"><p>Whatsapp</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon facebook"><img src="../Icons/facebook.png" alt=""></div>
        <div class="icon-description"><p>Facebook</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/twitter.png" alt=""></div>
        <div class="icon-description"><p>Twitter</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/mail.png" alt=""></div>
        <div class="icon-description"><p>Email</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/KakaoTalk.png" alt=""></div>
        <div class="icon-description"><p>KakaoTalk</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/Reddit.png" alt=""></div>
        <div class="icon-description"><p>Reddit</p></div>
    </div>
    <div class="icon-and-description vk-flex">
        <div class="icon vk"><img src="../Icons/VK.png" alt=""></div>
        <div class="icon-description"><p>Vk</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/OK.png" alt=""></div>
        <div class="icon-description"><p>Ok</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon Pinterest"><img src="../Icons/Pinterest.png" alt=""></div>
        <div class="icon-description"><p>Pinterest</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/blogger.png" alt=""></div>
        <div class="icon-description"><p>Blogger</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/Tumblr.png" alt=""></div>
        <div class="icon-description"><p>tumblr</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon"><img src="../Icons/LinkedIn.png" alt=""></div>
        <div class="icon-description"><p>linkedIn</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon skyrock"><img src="../Icons/skyrock.png" alt=""></div>
        <div class="icon-description"><p>Skyrock</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon mix"><img src="../Icons/mix.png" alt=""></div>
        <div class="icon-description"><p>Mix</p></div>
    </div>
    <div class="icon-and-description">
        <div class="icon goo"><img src="../Icons/Goo.svg" alt=""></div>
        <div class="icon-description"><p>Goo</p></div>
    </div>
    <div class="slide-right-2"><img src="../Icons/Button-right.svg" alt=""></div>
</div>
    <div class="input-field">
        <input type="text" class="input-for-share-dropdown" value="https://youtu.be/V9hwz3KBVx0" readonly>
        <div class="copy-btn"><button>copy</button></div>
    </div>
    
    <div class="hr"></div>
    <div class="bottom-share-navs">
        <div><input type="checkbox" class="checkbox-input"></div>
        <div><p>Start at <span>0:04</span></p></div>
    </div>
</div>
</div>

<div class="unsubscribe-confirmation show-dropdown">
    <div class="user-unsubscribe"> <p>Unsubscribe from <?php echo $row2['username'] ?> ?</p> </div>
    <div class="flex-for-confirmation-banner">
    <div class="cancel"><p>Cancel</p></div>
    <div class="unsubscribe-confirm"><p>Unsubscribe</p></div>
    </div>
</div>


<div class="unsubscribe-confirmation-dull-bg show-dropdown"></div>
<div class="unsubscribe-confirmation-dull-bg-2 show-dropdown"></div>


</body>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="files_for_template/template.js"></script>
<?php
echo '<script>var user_first_name = "' . $user_name . '";</script>';
?>
<?php
echo '<script>var vidId = "' . $vid_uuid . '";</script>';
?>
</html>

