
// Hides and shows scroll buttons and also allows users to press the right and left buttons to scroll
const searchbar = document.querySelector('.input');
const searchButton = document.querySelector('.search-button-left');
searchbar.addEventListener('focus', () => {
  searchButton.classList.remove('in-focus');
});
searchbar.addEventListener('blur', () => {
  searchButton.classList.add('in-focus');
});

const buttonRight = document.getElementById('slide-right');
const buttonLeft = document.getElementById('slide-left');
const buttonRightdropdown = document.querySelector('.slide-right-2');
const buttonLeftdropdown = document.querySelector('.slide-left-2');
buttonLeft.classList.add('is-hidden');
buttonLeftdropdown.classList.add('is-hidden');
const recommendations = document.getElementById('recommendations-links');
const shareDropdownIcons = document.querySelector('.icons-section');

buttonLeft.addEventListener('click', function(){
  recommendations.scrollLeft -= 200;
});
buttonLeftdropdown.addEventListener('click', function(){
  shareDropdownIcons.scrollLeft -=100;
});

buttonRight.addEventListener('click', function(){
    recommendations.scrollLeft += 200;
});
buttonRightdropdown.addEventListener('click', function(){
  shareDropdownIcons.scrollLeft +=100;
})

function toggleButtonVisibility() {
  const scrollPosition = recommendations.scrollLeft + recommendations.clientWidth;
  const isAtEnd = scrollPosition >= recommendations.scrollWidth;
  const isAtBeginning = recommendations.scrollLeft === 0;
  const scrollPositionShare = shareDropdownIcons.scrollLeft + shareDropdownIcons.clientWidth;
  const isAtEndShare = scrollPositionShare >= shareDropdownIcons.scrollWidth;
  const isAtBeginningShare = shareDropdownIcons.scrollLeft === 0;

  buttonLeft.classList.toggle('is-hidden', isAtBeginning);
  buttonRight.classList.toggle('is-hidden', isAtEnd);
  buttonLeftdropdown.classList.toggle('is-hidden', isAtBeginningShare);
  buttonRightdropdown.classList.toggle('is-hidden', isAtEndShare);
}
recommendations.addEventListener('scroll', toggleButtonVisibility);
shareDropdownIcons.addEventListener('scroll', toggleButtonVisibility);
// Hides and shows scroll buttons and also allows users to press the right and left buttons to scroll










// function handles the dynamic content after it has been loaded
function handleDynamicContent(){
// this ajax request helps a user to subscribe to an individual
const subscribed = document.querySelector('.subscribe-button');
const subscribedTo = document.querySelector('.channel');
if(subscribed){
  subscribed.addEventListener('click', function(){
    let channelsub = subscribedTo.innerText;
    let sub = subscribed.innerText;
    console.log(user_first_name);
    const xhr = new XMLHttpRequest();
        xhr.open('POST', 'sub.php?name=' + user_first_name, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (this.status === 200) {
      
            const response = xhr.responseText;
            document.querySelector('.show-subscribed-banner').innerHTML = response;
            document.querySelector('.sub-unsub').innerHTML = '<div class="unsubscribe-button"><img src="../Icons/bell.svg" alt=""><p>Subscribed</p><i class="fas fa-chevron-down"></i></div>';
            
            const message =  document.querySelector('.show-subscribed-banner');
            message.style.display = 'block';
            message.classList.add('banner-visible');
  
            function handleAnimationEnd() {
              message.style.display = 'none';
            }
            
            message.addEventListener('animationend', handleAnimationEnd);
            
            // Call the function to handle the dynamically loaded content
            handleDynamicContent();
          } else {
            console.error(xhr.statusText);
          }
        }
        xhr.send(`sub=${sub}&subscribedTo=${channelsub}`);
  
  });
}
// this ajax request helps a user to subscribe to an individual



//dropdowns

const subscribedButton = document.querySelector('.unsubscribe-button');
const subDropdown = document.querySelector('.subscribe-dropdown');
if(subscribedButton){
subscribedButton.addEventListener('click', function(e){
  if(subDropdown.classList.contains('show-dropdown')){
    subDropdown.classList.remove('show-dropdown');
  }else{
    subDropdown.classList.add('show-dropdown');
  }
});
document.addEventListener('click', function(event) {
  const target = event.target;
  const dropdown = target.closest('.unsubscribe-button');
  if (!dropdown){
    subDropdown.classList.add('show-dropdown');
  }
});
}


const shareButton = document.querySelector('.share');
const shareDropdown = document.querySelector('.share-dropdown-wrapper');
const dullBGShare = document.querySelector('.unsubscribe-confirmation-dull-bg-2');
if(shareButton){
shareButton.addEventListener('click', function(e){
  if(shareDropdown.classList.contains('show-dropdown')){
    shareDropdown.classList.remove('show-dropdown');
    dullBGShare.classList.remove('show-dropdown');
  }else{
    shareDropdown.classList.add('show-dropdown');
    dullBGShare.classList.add('show-dropdown');
  }
});
document.addEventListener('click', function(event) {
  const target = event.target;
  const dropdown = target.closest('.share');
  const dropdownShare = target.closest('.share-dropdown');
  if(shareDropdown.classList.contains('show-dropdown')){
    return;
  }else{
    if (!dropdown && !dropdownShare){
      shareDropdown.classList.add('show-dropdown');
      dullBGShare.classList.add('show-dropdown');
      
  }
  }
    
});
}


const dullBG = document.querySelector('.unsubscribe-confirmation-dull-bg');
const unsubscribeDropdownButton = document.querySelector('.unsubscribe');
const unsubscribeConfirmation = document.querySelector('.unsubscribe-confirmation')
unsubscribeDropdownButton.addEventListener('click', function(){
  if(unsubscribeConfirmation.classList.contains('show-dropdown')){
    unsubscribeConfirmation.classList.remove('show-dropdown');
    dullBG.classList.remove('show-dropdown');

  }else{
    unsubscribeConfirmation.classList.add('show-dropdown');
    dullBG.classList.add('show-dropdown');
  }
});
document.addEventListener('click', function(event) {
  const target = event.target;
  const dropdown = target.closest('.unsubscribe');
  if (!dropdown){
    unsubscribeConfirmation.classList.add('show-dropdown');
    dullBG.classList.add('show-dropdown');
  }
});
//dropdowns


// this ajax request helps a user to unsubscribe to an individual
const unsubscribeConfirmationButton = document.querySelector('.unsubscribe-confirm');
if(unsubscribeConfirmationButton){
  unsubscribeConfirmationButton.addEventListener('click', function(){
    console.log(unsubscribeConfirmationButton.innerText);
    let unsubscribe = unsubscribeConfirmationButton.innerText;
    let channelsub = subscribedTo.innerText;
    const xhr = new XMLHttpRequest();
        xhr.open('POST', 'sub.php?name=' + user_first_name, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (this.status === 200) {
            const response = xhr.responseText;
            document.querySelector('.show-subscribed-banner').innerHTML = response;
            document.querySelector('.sub-unsub').innerHTML = '<div class="subscribe-button"><p>Subscribe</p> </div>';
            
            const message =  document.querySelector('.show-subscribed-banner');
            message.style.display = 'block';
            message.classList.add('banner-visible');
  
            function handleAnimationEnd() {
              message.style.display = 'none';
            }
            
            message.addEventListener('animationend', handleAnimationEnd);
            
            // Call the function to handle the dynamically loaded content
            handleDynamicContent();
          } else {
            console.error(xhr.statusText);
          }
        }
        xhr.send(`unsubscribe=${unsubscribe}&subscribedTo=${channelsub}`);
  });
}
}
// this ajax request helps a user to unsubscribe to an individual

// this ajax request helps a user to like a video
const likeIcon = document.querySelector('.feather-thumbs-up');
const likeButton = document.querySelector('.like');
likeButton.addEventListener('click', function(){
  const likeButtonContent = document.querySelector('.liked');
  console.log(likeButtonContent.innerText);
  const liked = likeButtonContent.innerText;
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'sub.php?name=' + user_first_name + '&vidId=' + vidId, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (this.status === 200) {
            const response = JSON.parse(xhr.responseText);
            document.querySelector('.show-subscribed-banner').innerHTML = response.message;
            document.querySelector('.likes-count').innerHTML = response.likes;
            if(likeIcon.classList.contains('filler-for-svg')){
              likeIcon.classList.remove('filler-for-svg');
            }else{
              likeIcon.classList.add('filler-for-svg');
              if(dislikeIcon.classList.contains('filler-for-svg')){
                const dislikeCount = document.querySelector('.dislikes-count');
                dislikeCount.innerHTML -= 1;
              }
              dislikeIcon.classList.remove('filler-for-svg'); 
            }
            const message =  document.querySelector('.show-subscribed-banner');
            message.style.display = 'block';
            message.classList.add('banner-visible');
  
            function handleAnimationEnd() {
              message.style.display = 'none';
            }
            
            message.addEventListener('animationend', handleAnimationEnd);
            
            // Call the function to handle the dynamically loaded content
           
          } else {
            console.error(xhr.statusText);
          }
        }
        xhr.send(`liked=${liked}`);


});
// this ajax request helps a user to like a video

// this ajax request helps a user to dislike a video
const dislikeIcon = document.querySelector('.feather-thumbs-down');
const dislikeButton = document.querySelector('.dislike');
dislikeButton.addEventListener('click', function(){
  const dislikeButtonContent = document.querySelector('.disliked');
  console.log(dislikeButtonContent.innerText);
  const disliked = dislikeButtonContent.innerText;
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'sub.php?name=' + user_first_name + '&vidId=' + vidId, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (this.status === 200) {
      
            const response = JSON.parse(xhr.responseText);
            document.querySelector('.show-subscribed-banner').innerHTML = response.message;
            document.querySelector('.dislikes-count').innerHTML = response.dislikes;
            if(dislikeIcon.classList.contains('filler-for-svg')){
              dislikeIcon.classList.remove('filler-for-svg');
             
            }else{
              dislikeIcon.classList.add('filler-for-svg');
              if(likeIcon.classList.contains('filler-for-svg')){
                const likeCount = document.querySelector('.likes-count');
                likeCount.innerHTML -= 1;
              }
              likeIcon.classList.remove('filler-for-svg');
              
              
            }
            
            const message =  document.querySelector('.show-subscribed-banner');
            message.style.display = 'block';
            message.classList.add('banner-visible');
  
            function handleAnimationEnd() {
              message.style.display = 'none';
            }
            
            message.addEventListener('animationend', handleAnimationEnd);
            
            // Call the function to handle the dynamically loaded content
        
          } else {
            console.error(xhr.statusText);
          }
        }
        xhr.send(`liked=${disliked}`);
});
// this ajax request helps a user to dislike a video

window.onload = function() {
  handleDynamicContent();
};


//video-controls
const playButton = document.querySelector('.play-button');
const pauseButton = document.querySelector('.pause-button');
const progressBar = document.querySelector('.progress');
const bufferBar = document.querySelector('.background-loaded');
const clickRegion = document.querySelector('.click-region');
const video = document.querySelector('.video-main');


playButton.classList.add('play-pause-hidden');
pauseButton.classList.remove('play-pause-hidden');
playButton.addEventListener('click', function(){
  video.play();
  pauseButton.classList.remove('play-pause-hidden');
  playButton.classList.add('play-pause-hidden');
});
pauseButton.addEventListener('click', function(){
  video.pause();
  pauseButton.classList.add('play-pause-hidden');
  playButton.classList.remove('play-pause-hidden');
});
video.addEventListener('timeupdate', function(){
  const progress = video.currentTime / video.duration;
  progressBar.style.width = `${progress * 100}%`;
});
video.addEventListener('progress', () => {
  if (video.buffered.length > 0) {
    const bufferEnd = video.buffered.end(video.buffered.length - 1);
    const bufferProgress = bufferEnd / video.duration;
    bufferBar.style.width = `${bufferProgress * 100}%`;
  }
});
video.addEventListener('click', function() {
  if (video.paused) {
    video.play();
    pauseButton.classList.remove('play-pause-hidden');
    playButton.classList.add('play-pause-hidden');
  } else {
    video.pause();
    pauseButton.classList.add('play-pause-hidden');
    playButton.classList.remove('play-pause-hidden');
  }
});
clickRegion.addEventListener('click', jump);
function jump(e){
  let bar = e.currentTarget;
      let percent = e.offsetX / bar.offsetWidth;
      video.currentTime = percent * video.duration;
}

const theatreButton = document.querySelector('.theatre-btn');
const recommendationsSection = document.querySelector('.recommendations-section');
const videoDescription = document.querySelector('.video-description');
const videoAndCommentSection =document.querySelector('.video-and-comment-section');
const wrapperForEverything = document.querySelector('.wrapper-for-everything');
const videoContainer = document.querySelector('.video-container');
const commentSection = document.querySelector('.comment-section');

function toggleTheatreClass(element) {
  element.classList.toggle('theatre');
}

theatreButton.addEventListener('click', function() {
  toggleTheatreClass(recommendationsSection);
  toggleTheatreClass(videoDescription);
  toggleTheatreClass(videoAndCommentSection);
  toggleTheatreClass(video);
  toggleTheatreClass(videoContainer);
  toggleTheatreClass(wrapperForEverything);
  toggleTheatreClass(commentSection);
});
//video-controls



























// theatreButton.addEventListener('click', function(){
//     if(recommendationsSection.classList.contains('theatre')){
//       recommendationsSection.classList.remove('theatre');
//     }else{
//       recommendationsSection.classList.add('theatre');
//     }
//     if(videoDescription.classList.contains('theatre')){
//       videoDescription.classList.remove('theatre');
//     }else{
//      videoDescription.classList.add('theatre');
//     }
//     if(videoAndCommentSection.classList.contains('theatre')){
//       videoAndCommentSection.classList.remove('theatre');
//     }else{
//      videoAndCommentSection.classList.add('theatre');
//     }
//     if(video.classList.contains('theatre')){
//       video.classList.remove('theatre');
//     }else{
//      video.classList.add('theatre');
//     }
//     if(videoContainer.classList.contains('theatre')){
//       videoContainer.classList.remove('theatre');
//     }else{
//      videoContainer.classList.add('theatre');
//     }
//     if(wrapperForEverything.classList.contains('theatre')){
//       wrapperForEverything.classList.remove('theatre');
//     }else{
//      wrapperForEverything.classList.add('theatre');
//     }

// });
