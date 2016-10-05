<?php
  include "page_template.html"
?>

<div id="temp-content" style="display: none;">
  <h3>Contact</h3>
  <hr>
  <br>

  <p>
  MAIL:          eemanuele [punto] bellini [chiocciola] gmail [punto] com
  </p>
  <br>

  <p>
  PHONE:      +39 393 55 680 22
  </p>
  <br>

  <p>
  LINKEDIN:  https://it.linkedin.com/in/emabellini
  </p>

  <br><br><hr><br>

  <p>
  ...or drop me a message here:
  </p><br>

  <form id="contact-form" action="contact.php" method="POST" >

    <div class="row">
      <label for="name">Name:</label><br>
      <input id="name" class="input" name="name" 
             placeholder="your name" type="text" 
             value="" /><br />
    </div>

    <div class="row">
      <label for="email">Email:</label><br>
      <input id="email" class="input" name="email" 
             placeholder="your email" 
             type="email" value=""/><br />
    </div>

    <div class="row">
      <label for="message">Message:</label><br />
      <textarea id="message" class="input" name="message" 
                placeholder="your message"></textarea><br />
    </div>

    <div class="row">
      <label for="human">
        *Which is the first prime number? (Anti-spam)
      </label><br />
      <input name="human" class="input" name="human" 
             placeholder="your answer" value=""/>
    </div>

    <br>
    <input id="submit-button" name="submit"  type="submit" value="SEND EMAIL" 
           onmouseover="submitOverFunction()"
           onmouseleave="submitLeaveFunction()"/>
  </form>	

  <?php
      $name = test_input($_POST['name']);
      //$name = $_POST['name'];

      $email = test_input($_POST['email']);
      //$email = $_POST['email'];

      $message = test_input($_POST['message']);
      //$message = $_POST['message'];

      $body = "From: $name\n E-Mail: $email\n Message:\n $message";

      $from = 'From: EmaProWebSite'; 
      $to = 'eemanuele.bellini@gmail.com'; 
      $subject = 'Hello';

      $human = test_input($_POST['human']);
      //$human = $_POST['human'];

      function test_input($data) {
        $data = trim($data); // Strip unnecessary characters (extra space, tab, newline) from the user input data
        $data = stripslashes($data); // Remove backslashes (\) from the user input data
        $data = htmlspecialchars($data);
        return $data;
      }		
		

      //echo '<p>POST_submit:</p>' . $_POST['submit'] ;
      if ($_POST['submit'] && $human == '2') {		
        //echo '<p>MAIL RESULT:</p>' . mail ($to, $subject, $body, $from) ;		
        // NOTE: for the mail function to work, 
        // a mail server must be installed on the web server 
        if (mail ($to, $subject, $body, $from)) { 
	        echo '<br><p style="color: blue;">Your message has been sent! Thank you!</p>';
          $_POST['name'] = "" ;
          $_POST['email'] = "" ;
          $_POST['message'] = "" ;
          $_POST['human'] = "" ;
        } else { 
          echo '<br><p style="color: red;">Something went wrong, go back and try again!</p>'; 
        } 
      } else if ($_POST['submit'] && $human != '2') {
        echo '<br><p style="color: red;">You answered the anti-spam question incorrectly!</p>';
      }
  ?>				

<!--
  <?php
  $action=$_REQUEST['action'];
  if ($action=="")    /* display the contact form */
      {
      ?>
      <form id="contact-form" action="contact.php" method="POST" enctype="multipart/form-data">
        <div class="row">
	        <label for="name">Name:</label><br>
	        <input id="name" class="input" name="name" placeholder="your name" type="text" value="" /><br />
        </div>
        <div class="row">
	        <label for="email">Email:</label><br>
	        <input id="email" class="input" name="email" placeholder="your_email@your_domain.something" type="email" value=""/><br />
        </div>
        <div class="row">
	        <label for="message">Message:</label><br />
	        <textarea id="message" class="input" name="" placeholder="your message" ></textarea><br />
        </div>
        <br>
        <input id="submit-button" type="submit" value="SEND EMAIL" 
               onmouseover="submitOverFunction()"
               onmouseleave="submitLeaveFunction()"/>
      </form>			
      <?php
      } 
  else                /* send the submitted data */
      {
      $name=$_REQUEST['name'];
      $email=$_REQUEST['email'];
      $message=$_REQUEST['message'];
      if (($name=="")||($email=="")||($message==""))
          {
          echo "All fields are required, please fill <a href=\"\">the form</a> again.";
          }
      else{        
          $from="From: $name<$email>\r\nReturn-path: $email";
          $subject="Message sent using your contact form";
          mail("eemanuele.bellini@gmail.com", $subject, $message, $from);
          echo "Email sent!";
          }
      }  
  ?> 
-->
</div>

<script>
var chapter = 'contact' ;
var x = document.getElementById('temp-content') ;
document.getElementById('main').innerHTML = x.innerHTML ;
</script>

<script>
// STYLE
var x ;
x = document.getElementById('contact-form') ;
x.textAlign = 'center' ;
x.style.width = document.getElementById('temp-content').width ;
//x.style.padding = '20px' ;
//x.style.width = '100%' ;

var textBgColor = '#707070' ;
var textColor = '#F0F0F0' ;
x = document.getElementsByClassName('input') ;
var i ;
for (i = 0; i < x.length; i++) {
  x[i].style.border = '3px solid #cccccc' ;
  x[i].style.width = '100%' ;
  x[i].style.backgroundColor = textBgColor ;
  x[i].style.color = textColor ;
  x[i].style.padding = '3px' ;
  //x[i].style.margin = '0px' ;
  // to make text area fit with the borders (otherwise the exceed the 100%)
  x[i].style.boxSizing = 'border-box' ; 
}

x = document.getElementById('message') ;
x.style.height = '200px' ;

x = document.getElementById('submit-button') ;
x.style.border = '3px solid #cccccc' ;
x.style.width = '100%' ;
x.style.backgroundColor = textBgColor ;
x.style.fontFamily = '"Open Sans", sans-serif' ;
x.style.fontWeight = '600' ;
x.style.fontVariant = 'small-caps' ;
x.style.color = textColor ;

function submitOverFunction() {
  var y ;
  y = document.getElementById("submit-button") ;
  y.style.backgroundColor = '#CCCCCC' ;
  y.style.color = '#000000' ;
}
function submitLeaveFunction() {
  var y ;
  y = document.getElementById("submit-button") ;
  y.style.backgroundColor = textBgColor ;
  y.style.color = textColor ;
}
</script>

<!--
-->

