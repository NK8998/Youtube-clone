
const dropDownButton = document.querySelector('.current-lang')
const dropDownWindow = document.querySelector('.dropdown')

dropDownButton.addEventListener('click', 
   ()=> dropDownWindow.classList.toggle('show'))

window.onclick = function(e){
   if (!e.target.matches('.current-lang') && 
         dropDownWindow.classList.contains('show')){
       dropDownWindow.classList.remove('show')
  }
}

const dropdown = document.querySelector(".dropdown");

// Add a click event listener to the dropdown menu
dropdown.addEventListener("click", function(event) {
  // Get the selected item
  const selectedItem = event.target.innerText;

  // Set the button text to the selected item
  const button = document.querySelector(".current-lang");
  button.innerHTML = "<p>" + selectedItem + "</p>" + "<i class='fas fa-caret-down'></i>";
});