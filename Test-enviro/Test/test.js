// let hoverCont = document.getElementById("hover-container");
// let vid = document.getElementById("myVideo");
// let bar_progress = document.querySelector('.red-bar-background');
// let loadedBar = document.querySelector('.red-bar-background-loaded-bar');

// hoverCont.addEventListener('mouseover', function(){
//   vid.play();
// });

// hoverCont.addEventListener('mouseout', function(event){
//   if (!event.relatedTarget || !hoverCont.contains(event.relatedTarget)) {
//     if(vid.currentTime < 30){
//       vid.currentTime = 0;
//     }
//     vid.buffered=0;
//     loadedBar.style.width=0 + "%";
//     vid.pause();
//   }
// });


// vid.addEventListener('timeupdate', function(){
//   let barposition = vid.currentTime / vid.duration;
//   bar_progress.style.width = barposition * 100 + "%";
// });

// vid.addEventListener('progress', function() {
//   let buffered = vid.buffered;
//   if (buffered.length > 0) {
//     let loadedposition = buffered.end(0) / vid.duration;
//     loadedBar.style.width = loadedposition * 100 + "%";
//   }
// });

// vid.addEventListener('seeked', function() {
//   let loadedposition = vid.buffered.end(0) / vid.duration;
//   loadedBar.style.width = loadedposition * 100 + "%";
// });

// function jump(e) {
//   let bar = e.currentTarget;
//   let percent = e.offsetX / bar.offsetWidth;
//   vid.currentTime = percent * vid.duration;
// }

// Get all the video elements on the page
let videos = document.getElementsByTagName('video');

// Loop over each video element
for (let i = 0; i < videos.length; i++) {
  let video = videos[i];
  let hoverCont = video.closest('.wrapper-controls-and-video');
  let bar_progress = hoverCont.querySelector('.red-bar-background');
  let loadedBar = hoverCont.querySelector('.red-bar-background-loaded-bar');

  hoverCont.addEventListener('mouseover', function() {
    video.play();
  });

  hoverCont.addEventListener('mouseout', function(event) {
    if (!event.relatedTarget || !hoverCont.contains(event.relatedTarget)) {
      video.currentTime = 0;
      video.buffered = 0;
      loadedBar.style.width = 0;
      video.pause();
    }
  });

  video.addEventListener('timeupdate', function() {
    let barposition = video.currentTime / video.duration;
    bar_progress.style.width = barposition * 100 + "%";
  });

  video.addEventListener('progress', function() {
    let buffered = video.buffered;
    if (buffered.length > 0) {
      let loadedposition = buffered.end(0) / video.duration;
      loadedBar.style.width = loadedposition * 100 + "%";
    }
  });

  video.addEventListener('seeked', function() {
    let loadedposition = video.buffered.end(0) / video.duration;
    loadedBar.style.width = loadedposition * 100 + "%";
  });

  function jump(e) {
    let bar = e.currentTarget;
    let percent = e.offsetX / bar.offsetWidth;
    video.currentTime = percent * video.duration;
  }
}
