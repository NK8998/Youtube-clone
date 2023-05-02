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
            <div class="unsubscribe-confirmation show-dropdown">
                <div class="user-unsubscribe"> <p>Unsubscribe from <?php echo $row2['username'] ?> ?</p> </div>
                <div class="flex-for-confirmation-banner">
                <div class="cancel"><p>Cancel</p></div>
                <div class="unsubscribe-confirm"><p>Unsubscribe</p></div>
                </div>
            </div>
            
        </div>
       
    <div class="rest-of-navigations">
        <div class="like-and-dislike">
            <div class="like">
            <img src="../Icons/thumbs-up-solid.svg" alt="">
            <div><p>20K</p></div>
            </div>
            <div class="separator"></div>
            <div class="dislike">
            <img src="../Icons/thumbs-down.svg" alt="">
            <div><p>3.3K</p></div>
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
            $thumbnail = $video['vid_thumbnail_url'];
            $vid_uid = $video['vid_uid'];
            $unique_id = 'myVideo_' . $video['vid_uid'];
            $vid_url = $video['vidUrl'];
            $url = 'template.php?vidId=' . $vid_uid;

           
        ?>
       
        <div class="vid-container">
            <div class="flex-for-video-and-description">
            <div><a href="template.php?<?= http_build_query(['title' => $video['vidUrl'], 'vidId' => $video['vid_uid']]) ?>"rel="noopener noreferrer"><div>
            <div class="wrapper-for-video-controls" onmouseover="play(this)" onmouseout="stop(this)">
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








</body>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="files_for_template/template.js"></script>
<?php
echo '<script>var user_first_name = "' . $user_name . '";</script>';
?>
</html>

