
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

window.addEventListener('load', () => {
  const filterAllButton = document.getElementById('all');
  filterAllButton.click();
});

let currentFilter = '';
function handleRecommendationLinks() {
  const recommendationLinks = document.querySelectorAll('.recommendations-links li');
  recommendationLinks.forEach(link => {
    link.addEventListener('click', (event) => {
      event.preventDefault();

      if (currentFilter === link.textContent) {
        return;
      }

      recommendationLinks.forEach(link => {
        link.classList.remove('recommendations-active')
      });

      // Add active class to clicked recommendation link
      event.target.classList.add('recommendations-active');
      


      currentFilter = link.textContent;

      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'filter.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (this.status === 200) {
          // handle response here
          const response = xhr.responseText;
          document.querySelector('.videos-container').innerHTML = response;

          // Call the function to handle the dynamically loaded content
          handleDynamicContent();
        } else {
          console.error(xhr.statusText);
        }
      }
      xhr.send(`filter=${currentFilter}`);
    });
  });
}



document.addEventListener('DOMContentLoaded', function() {
  handleRecommendationLinks();
});



function play(video){
  document.getElementById(video.id).play();
}

function stop(video){
  document.getElementById(video.id).currentTime = 0;
  document.getElementById(video.id).pause();
}

function handleDynamicContent() {
  // Your code to handle the dynamically loaded content goes here

let videos = document.getElementsByTagName('video');

Object.entries(videos).forEach(([num, video]) => {
  video.load();

  const progressBar = video.parentNode.querySelectorAll('.red-bar-background');
  const bufferBar = video.parentNode.querySelector('.red-bar-background-loaded-bar');
  let hoverCont = video.closest('.vid-container');
  let anchorTag = video.parentNode.closest('a');
  let redBar = video.parentNode.querySelector('.red-bar-click-region');
  let controls = video.parentNode.querySelector('.controls');
  const muteButton = video.parentNode.querySelector('.mute-button');
  const volumeIcons = video.parentNode.querySelectorAll('.mute-button i');
  const totalTimeElements = video.parentNode.querySelectorAll('.total-time');
  const time = video.parentNode.querySelectorAll('.time');
  const totalTime = video.parentNode.querySelectorAll('.time-remaining');
  const timeElement_container = video.parentNode.querySelectorAll('.time-and-time-remaining');
  const poster = video.parentNode.querySelectorAll('.video-poster');
  const redDot = video.parentNode.querySelectorAll('.red-dot');
  const backroundBar = video.parentNode.querySelector('.red-bar');


    controls.addEventListener('mouseover', function(e){
      if(e.target === controls ){
        e.preventDefault();
        e.stopPropagation();
      }
      redDot.forEach(function(element){
        element.classList.add("red-dot-active");
      })
      progressBar.forEach(function(element){
        element.classList.add('bar-growth');
      })
      bufferBar.classList.add('bar-growth');
      backroundBar.classList.add('bar-growth');
  
    })
  
    controls.addEventListener('mouseout', function(e){
      redDot.forEach(function(element){
        element.classList.remove("red-dot-active");
      })
      progressBar.forEach(function(element){
        element.classList.remove('bar-growth');
      })
      bufferBar.classList.remove('bar-growth');
      backroundBar.classList.remove('bar-growth');
  
    })
  

    
  
  

  anchorTag.addEventListener('click', (e) => {
    if (e.target === redBar || e.target === progressBar ) {
      e.preventDefault();
    }
  });



 
  hoverCont.addEventListener('mouseover', function() {
    video.play();
    controls.classList.remove('is-hidden');
    video.style.borderRadius = '0px';
     video.style.transition = 'border-radius 0.3s ease-in-out';
     totalTimeElements.forEach(function(element) {
       element.classList.add('is-hidden-smooth');
     });
     poster.forEach(function(element){
       element.style.borderRadius = '0px';
       element.classList.add('is-hidden-poster');
      
     })
    
   });

  hoverCont.addEventListener('mouseout', function(event) {
    
    if (!event.relatedTarget || !hoverCont.contains(event.relatedTarget)) {
      bufferBar.style.width = 0;
      controls.classList.add('is-hidden');
      video.style.borderRadius = '15px';
      video.currentTime = 0
      video.pause();
      
      totalTimeElements.forEach(function(element) {
        element.classList.remove('is-hidden-smooth');
      });
    }
    timeElement_container.forEach(function(element){
      element.style.transition = 'all .0001s';
    });
    
    poster.forEach(function(element){
      element.style.borderRadius = '15px';
      element.classList.remove('is-hidden-poster');
      element.style.transition = 'all .3s ease-in-out';
      
    })

  });



  video.addEventListener('timeupdate', () => {
    const progress = video.currentTime / video.duration;
    progressBar.forEach(function(element){
        element.style.width = `${progress * 100}%`;
    });
    redDot.forEach(function(element){
      element.style.left = `${progress * 100}%`;
    })

    time.forEach(function(element) {
      element.textContent = formatTime(video.currentTime);
    });
  
    totalTime.forEach(function(element) {
      element.textContent = formatTime(video.duration);
    });
  });
  function formatTime(time) {
    const hours = Math.floor(time / 3600);
    let remainingSeconds = time - (hours * 3600);
    const minutes = Math.floor(remainingSeconds / 60);
    const seconds = Math.floor(remainingSeconds % 60);
    
    if (hours > 0) {
      return `${hours}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    } else {
      return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }
  }
  



  video.addEventListener('progress', () => {
    if (video.buffered.length > 0) {
      const bufferEnd = video.buffered.end(video.buffered.length - 1);
      const bufferProgress = bufferEnd / video.duration;
      bufferBar.style.width = `${bufferProgress * 100}%`;
    }
  });
  
  video.addEventListener('loadedmetadata', function() {
    const hours = Math.floor(video.duration / 3600);
    let remainingSeconds = video.duration - (hours * 3600);
    const minutes = Math.floor(remainingSeconds / 60);
    const seconds = Math.floor(remainingSeconds % 60);
    let formattedTime = '';
    if (hours > 0) {
      formattedTime = `${hours.toString().padStart(1, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    } else {
      formattedTime = `${minutes.toString().padStart(1, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    totalTimeElements.forEach(function(element) {
      element.textContent = formattedTime;
    });
  });
 
  redBar.addEventListener('click', jump);
  function jump(e) {
    if (e.target === redBar || e.target === progressBar || e.target === bufferBar) {
      e.preventDefault();
      e.stopPropagation();
      let bar = e.currentTarget;
      let percent = e.offsetX / bar.offsetWidth;
      video.currentTime = percent * video.duration;
    }
  }
 
  
  muteButton.addEventListener('click', function(e) {
    const isMuted = video.muted;
    video.muted = !isMuted;
  
    volumeIcons.forEach(icon => {
      if (video.muted) {
        muteButton.classList.remove('unmuted');
      } else {
        muteButton.classList.add('unmuted');
      }
    });
  
    e.stopPropagation();
    e.preventDefault();
  });


  let timeoutId;
  function hideTime() {
    timeElement_container.forEach(function(element) {
      element.classList.add('is-hidden-smooth-time');
      element.style.transform = 'translateY(-15px)';
      element.style.transition = 'all .2s ease-in-out';
      
    });
  }
  
  hoverCont.addEventListener('mousemove', function() {
    timeElement_container.forEach(function(element) {
      element.classList.remove('is-hidden-smooth-time');
      element.style.transform = 'translateY(-25px)';
      element.style.transition = 'all .2s ease-in-out';
    });
    
    clearTimeout(timeoutId);
    timeoutId = setTimeout(hideTime, 5000);
  });



});
}

const leftNavLinks = document.querySelectorAll('.left-nav a');

leftNavLinks.forEach(link => {
  if (link.href === window.location.href) {
    link.querySelector('.containers').classList.add('active');
  }
});


const navButton = document.querySelector('.burger');
const minimizedNav = document.querySelector('.left-nav-minimized');
const expandedNav = document.querySelector('.left-nav');
const emptyBlock = document.querySelector('.empty');
const vidContainer = document.querySelector('.videos-container');
const filler = document.querySelector('.filler-between-nav-and-links');
// function toggleNav(){
//   if (minimizedNav.style.display === 'none') {
//     minimizedNav.style.display = 'block';
//     expandedNav.style.display = 'none';
//     emptyBlock.style.minWidth = '50px';
//     vidContainer.style.paddingLeft = '30px';
//     filler.style.marginLeft = '80px';
//  } else {
//     minimizedNav.style.display = 'none';
//     expandedNav.style.display = 'block';
//     emptyBlock.style.minWidth = '230px';
//     vidContainer.style.paddingLeft = '0px';
//     filler.style.marginLeft = '237px';
//  }
// }
function toggleNav() {
  const isMinimized = minimizedNav.style.display === 'none';
  const emptyBlockWidth = isMinimized ? '50px' : '230px';
  const paddingLeft = isMinimized ? '30px' : '0px';
  const marginLeft = isMinimized ? '80px' : '237px';

  minimizedNav.style.display = isMinimized ? 'block' : 'none';
  expandedNav.style.display = isMinimized ? 'none' : 'block';
  emptyBlock.style.minWidth = emptyBlockWidth;
  vidContainer.style.paddingLeft = paddingLeft;
  filler.style.marginLeft = marginLeft;
}


const searchbar = document.querySelector('.input');
const searchButton = document.querySelector('.search-button-left');
searchbar.addEventListener('focus', () => {
  searchButton.classList.remove('in-focus');
});
searchbar.addEventListener('blur', () => {
  searchButton.classList.add('in-focus');
});

handleDynamicContent()




















