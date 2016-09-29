<?php
  include "page_template.html"
?>

<div id="temp-content" style="display: none;">
  <p style="text-align: center;">
    Welcome to my website!<br>
    I hope you will enjoy it and find useful stuff!<br>
  </p>

  <div id="gallery-container">
    <div class="home-img-container">
      <a href="about.php">
      <img src="img/jump.jpg" onmouseover="this.style.filter='grayscale(100%)'; this.style.opacity='0.5'" 
                              onmouseout="this.style.filter='grayscale(0%)'; this.style.opacity='1'"> 
      <div class="img-desc">ABOUT</div>
      </a>
    </div>

    <div class="home-img-container">
      <a href="research.php">
      <img src="img/research.jpg" onmouseover="this.style.filter='grayscale(100%)'; this.style.opacity='0.5'" 
                                  onmouseout="this.style.filter='grayscale(0%)'; this.style.opacity='1'"> 
      <div class="img-desc">RESEARCH</div>
      </a>
    </div>

    <div class="home-img-container">
      <a href="teaching.php">
      <img src="img/teaching.jpg" onmouseover="this.style.filter='grayscale(100%)'; this.style.opacity='0.5'" 
                                  onmouseout="this.style.filter='grayscale(0%)'; this.style.opacity='1'"> 
      <div class="img-desc">TEACHING</div>
      </a>
    </div>

    <div class="home-img-container">
      <a href="programming.php">
      <img src="img/programming6.jpg" onmouseover="this.style.filter='grayscale(100%)'; this.style.opacity='0.5'" 
                                      onmouseout="this.style.filter='grayscale(0%)'; this.style.opacity='1'"> 
      <div class="img-desc">PROGRAMMING</div>
      </a>
    </div>

    <div class="home-img-container">
      <a href="contact.php">
      <img src="img/contact3.jpg" onmouseover="this.style.filter='grayscale(100%)'; this.style.opacity='0.5'" 
                                  onmouseout="this.style.filter='grayscale(0%)'; this.style.opacity='1'"> 
      <div class="img-desc">CONTACT</div>
      </a>
    </div>

  </div>

</div>


<script>
var chapter = 'home' ;
var x = document.getElementById('temp-content') ;
document.getElementById('main').innerHTML = x.innerHTML ;
</script>

<script>
var x ;
// set main background
x = document.getElementById('main') ;
x.style.backgroundColor = 'transparent';

// set gallery container properties
x = document.getElementById('gallery-container') ;
x.style.width = '520px' ;
//x.style.height = '1000px' ; // increment this if new images are added
x.style.margin = '0 auto' ;
x.style.textAlign = 'center' ;
//x.style.border = 'solid' ;
//x.style.backgroundColor = 'black' ;

// set image container properties
x = document.getElementsByClassName('home-img-container') ;

var i;
for (i = 0; i < x.length; i++) {
    x[i].style.paddingBottom = '40px';
    x[i].style.margin = '30px';
    x[i].style.height = '200px';
    x[i].style.width = '200px';
    x[i].style.float = 'left';
    //x[i].style.display = 'inline';
    //x[i].style.border = 'solid';
    x[i].style.borderRadius = '50%' ;

    // set image properties
    x[i].getElementsByTagName('img')[0].style.height = '200px';
    x[i].getElementsByTagName('img')[0].style.width = '100%';
    x[i].getElementsByTagName('img')[0].style.borderRadius = '50%';

    // set description properties
    x[i].getElementsByClassName('img-desc')[0].style.textAlign = 'center';
    x[i].getElementsByClassName('img-desc')[0].style.color = '#707070';
}
</script>
