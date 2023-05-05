const theatreMode = document.querySelector('.theatre-mode');
const recommendations = document.querySelector('.recommendations');
const video = document.querySelector('.myVideo');
const wrapperForVideoDescription = document.querySelector('.wrapper-for-video-and-description');
const videoContainer = document.querySelector('.video-container');
const description = document.querySelector('.description');
const wrapper = document.querySelector('.wrapper');
// 40% is the original marginTop
// 52% is the marginTop for description
function toggleTheatreandNormal(){
    if(theatreMode.classList.contains('active')){
    recommendations.style.marginTop = '40%';
    video.style.width = '70%';
    video.style.minWidth = '500px';
    wrapperForVideoDescription.style.paddingLeft = '0px';
    videoContainer.style.position = 'absolute';
    
    description.style.marginTop = '52%';
    description.style.paddingLeft = '0px';

    function setMarginTop() {
        if (window.matchMedia('(max-width: 60em)').matches) {
          video.style.minWidth = '400px';
          description.style.marginTop = '40%';
          recommendations.style.marginTop = '0%';
          recommendations.style.paddingLeft = '0px';
        } else {
          video.style.minWidth = '500px';
          description.style.marginTop = '52%';
          recommendations.style.marginTop ='40%';
        }
      }
      setMarginTop();
    window.addEventListener('load', setMarginTop);
    window.addEventListener('resize', setMarginTop);
}else{
    recommendations.style.marginTop = '0%';
    video.style.width = '100%';
    video.style.minWidth = 'none';
    wrapperForVideoDescription.style.paddingLeft = '0px';
    videoContainer.style.position = 'static';
    videoContainer.style.position = 'relative';
    description.style.marginTop = '0%';
    description.style.paddingLeft = '0px';

    function setMarginTop() {
        if (window.matchMedia('(max-width: 60em)').matches) {
        video.style.minWidth = 'none';
          description.style.marginTop = '0%';
          recommendations.style.marginTop = '0%';
          wrapper.style.flexDirection ='column';
          recommendations.style.paddingLeft = '0px';
        } else {
          wrapper.style.flexDirection = 'row';
          video.style.minWidth = 'none';
          description.style.marginTop = '0%';
          recommendations.style.marginTop = '0%';
          recommendations.style.paddingLeft = '0px';
        }
      }
      setMarginTop();
    window.addEventListener('load', setMarginTop);
    window.addEventListener('resize', setMarginTop);
}
}
   
theatreMode.addEventListener('click', function(){
    console.log(theatreMode.innerText);
    if(theatreMode.classList.contains('active')){
        theatreMode.classList.remove('active');
        theatreMode.innerHTML = '<p>' + 'Toggle theatre-mode' + '</p>';
        
    }else{
        theatreMode.classList.add('active');
        theatreMode.innerHTML = '<p>' + 'toggle normal-mode' + '</p>';

    }
    toggleTheatreandNormal();
});

