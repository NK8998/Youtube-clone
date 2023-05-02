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
buttonLeft.classList.add('is-hidden');
const recommendations = document.getElementById('recommendations-links');

buttonLeft.addEventListener('click', function(){
  recommendations.scrollLeft -= 200;
})

buttonRight.addEventListener('click', function(){
    recommendations.scrollLeft += 200;
})

function toggleButtonVisibility() {
  const scrollPosition = recommendations.scrollLeft + recommendations.clientWidth;
  const isAtEnd = scrollPosition >= recommendations.scrollWidth;
  const isAtBeginning = recommendations.scrollLeft === 0;

  buttonLeft.classList.toggle('is-hidden', isAtBeginning);
  buttonRight.classList.toggle('is-hidden', isAtEnd);
}
recommendations.addEventListener('scroll', toggleButtonVisibility);


function handleDynamicContent(){

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



const unsubscribeDropdownButton = document.querySelector('.unsubscribe');
const unsubscribeConfirmation = document.querySelector('.unsubscribe-confirmation')
unsubscribeDropdownButton.addEventListener('click', function(){
  if(unsubscribeConfirmation.classList.contains('show-dropdown')){
    unsubscribeConfirmation.classList.remove('show-dropdown');
  }else{
    unsubscribeConfirmation.classList.add('show-dropdown');
  }
});
document.addEventListener('click', function(event) {
  const target = event.target;
  const dropdown = target.closest('.unsubscribe');
  if (!dropdown){
    unsubscribeConfirmation.classList.add('show-dropdown');
  }
});

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

window.onload = function() {
  handleDynamicContent();
};

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
            handleDynamicContent();
          } else {
            console.error(xhr.statusText);
          }
        }
        xhr.send(`liked=${liked}`);


});

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
            handleDynamicContent();
          } else {
            console.error(xhr.statusText);
          }
        }
        xhr.send(`liked=${disliked}`);
});

