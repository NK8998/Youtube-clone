<?php
include_once '../Dashboard/Required.php';

if (isset($_POST['filter'])) {
    $filter = mysqli_real_escape_string($conn, $_POST['filter']);
    if($filter == 'All'){
        $sql = "SELECT * FROM videos ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

    }else{
        $sql = "SELECT * FROM videos WHERE Category='$filter' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
    }

  if (mysqli_num_rows($result) > 0) {
    while ($video = mysqli_fetch_assoc($result)) {
        $username = $video['first_name'];
        $sql2 = "SELECT * FROM user_info WHERE first_name='$username' ";
        $result2 = mysqli_query($conn, $sql2);
        $rows = mysqli_fetch_assoc($result2);

        $uploaded_at = $video['time_uploaded'];

        $now = new DateTime();
        $uploaded_time = new DateTime();
        $uploaded_time->setTimestamp($uploaded_at);
        $interval = $now->diff($uploaded_time);
        
        if ($interval->y > 0) {
            $interval =  $interval->format("%y year" . ($interval->y > 1 ? "s" : "") . " ago");
        } elseif ($interval->m > 0) {
            $interval =  $interval->format('%m month' . ($interval->m > 1 ? 's' : '') . ' ago');
        } elseif ($interval->d > 0) {
            $interval = $interval->format('%d day' . ($interval->d > 1 ? 's' : '') . ' ago');
        } elseif ($interval->h > 0) {
            $interval = $interval->format("%h hour" . ($interval->h > 1 ? "s" : "") . " ago");
        } elseif ($interval->i > 0) {
            $interval =  $interval->format('%i minute' . ($interval->i > 1 ? 's' : '') . ' ago');
        } else {
            $interval =  "just now";
        } 
      
       echo '
       
       <div class="vid-container">
       <div><a href="template.php?' . http_build_query(['title' => $video['vidUrl'], 'vidId' => $video['vid_uid']]) . '" rel="noopener noreferrer"><div> 
                
            <div class="wrapper-for-video-controls" onmouseover="play(this)" onmouseout="stop(this)">
            <img src="../Dashboard/' . $video['vid_thumbnail_url'] . '" alt="" class="video-poster" style="height:205px; width:364px; border-radius:15px; pointer-events: none ;">
            <video src="../Dashboard/Uploads/' . $video['vid_uid'] . '" class="videos" id="myVideo_' . $video['vid_uid'] . '" muted></video>
                <div class="time-container">
                    <div class="total-time"><p></p></div>
                </div>
                <div class="controls is-hidden">
                    <div class="mute-button">
                    <i class="fas fa-volume-mute"></i>
                    <i class="fas fa-volume-up "></i>
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
                    
                
                <p style="background-color:' . $rows['bgcolor_pfp'] . '; padding:8px 14px;padding-top: 9px;">' .  $rows['user_pfp'] . '</p>' .
                '</div>

                <div class="describe-video">
                    <div class="title" style="text-overflow: ellipsis;">
                    <p>' . $video['title'] . '</p>
                    </div>
                    <div class="channel">
                        <p>' . $video['username'] .'</p>
                    </div>
                    <div class="flex-6">
                        <div>113.3k views</div>
                        <div>.</div>
                        <div>' . $interval .
                      
                           '</div> 
                        
                    </div>
                </div>

                        
                <div class="dots-set for-video">
            <div class="dots-settings"></div>
            <div class="dots-settings"></div>
            <div class="dots-settings"></div>
        </div>

            </div>
            </div>
   ';
    
    }
}
}

?>

