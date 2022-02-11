$(document).ready(function () {
  $('.carousel').carousel({
    interval: 200000
  });
})
// scrolling down
var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
  var currentScrollPos = window.pageYOffset;
  var myElement = $(".down-menu-hbg");
  var a;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("home-header").style.top = "0";
    var scroll = $(window).scrollTop();
    if(scroll==0){
      myElement.show();
    }
    else{
      myElement.hide();
    }
  } 
  else {
    document.getElementById("home-header").style.top = "-130px";
    myElement.hide();
  }
  
  prevScrollpos = currentScrollPos;
}

