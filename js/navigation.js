function openMenu(){
	document.getElementById('toogleNav').classList.toggle("show");
}


window.onclick = function(event) {
  if (!event.target.matches('.navBut')) {

    var dropdown = document.getElementById("toogleNav");
      var openDropdown = dropdown;
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
   
  }
}

$(".menu a").click(function(e){
	e.preventDefault();
});