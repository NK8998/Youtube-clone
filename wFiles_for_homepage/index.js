if (window.location.href === 'http://localhost/Youtube/' || window.location.href === 'http://localhost/Youtube/') {
  window.location.href = 'http://localhost/Youtube/watch';
}


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


function play(video){
  document.getElementById(video.id).play();
}

function stop(video){
  document.getElementById(video.id).currentTime = 0;
  document.getElementById(video.id).pause();
}

let videos = document.getElementsByTagName('video');

console.log(typeof(videos));
Object.entries(videos).forEach(([num, video]) => {
  const progressBar = video.parentNode.querySelector('.red-bar-background');
  const bufferBar = video.parentNode.querySelector('.red-bar-background-loaded-bar');
  let hoverCont = video.closest('.wrapper-for-video-controls');
  let anchorTag = video.parentNode.closest('a');
  let redBar = video.parentNode.querySelector('.red-bar');
  let controls = video.parentNode.querySelector('.controls');
  const muteButton = video.parentNode.querySelector('.mute-button');
  const volumeIcons = video.parentNode.querySelectorAll('.mute-button i');


  anchorTag.addEventListener('click', (e) => {
    if (e.target === redBar) {
      e.preventDefault();
    }
  });

  hoverCont.addEventListener('mouseover', function() {
    video.play();
    controls.classList.remove('is-hidden');
    video.style.borderRadius = '0px';
    video.style.transition = 'border-radius 0.3s ease-in-out';
  });

  hoverCont.addEventListener('mouseout', function(event) {
    if (!event.relatedTarget || !hoverCont.contains(event.relatedTarget)) {
      video.currentTime = 0;
      bufferBar.style.width = 0;
      controls.classList.add('is-hidden');
      video.style.borderRadius = '15px';
      video.pause();
    }
  });

  video.addEventListener('timeupdate', () => {
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

 

  redBar.addEventListener('click', jump);
  function jump(e) {
    if (e.target === redBar) {
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

 
});

const leftNavLinks = document.querySelectorAll('.left-nav a');

leftNavLinks.forEach(link => {
  if (link.href === window.location.href) {
    link.querySelector('.containers').classList.add('active');
  }
});