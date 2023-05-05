const videoContainer = document.querySelector('.video-container');
const theatre = document.querySelector('.theatre-btn');
const video = document.querySelector('video');
const wrapper = document.querySelector('.wrapper');

theatre.addEventListener('click', function(){
    if(videoContainer.classList.contains('theatre')){
        videoContainer.classList.remove('theatre');
    }else{
        videoContainer.classList.add('theatre');
    }
    if(video.classList.contains('theatre')){
        video.classList.remove('theatre');
    }else{
        video.classList.add('theatre');
    }
    if(wrapper.classList.contains('theatre')){
        wrapper.classList.remove('theatre');
    }else{
        wrapper.classList.add('theatre');
    }
});