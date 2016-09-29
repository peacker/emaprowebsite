<?php
  include "page_template.html"
?>

<div id="temp-content" style="display: none;">
  <h3>Teaching</h3>
  <hr>
  <br>  

  <div class="course-list">
    <ul>
    <?php
      include "CV_DB.php" ;
      foreach ($DATABASE['TEACHING'] as &$x) {
        echo "<li>" ;
        echo "<p><i><b>\"" . $x['COURSE_NAME'] . "\"</b></i></p>" . 
             $x['ROLE'] . ", " .
             "(course owner: " . $x['COURSE_OWNER'] . ")<br>" .
             $x['INSTITUTE'] . ", " .
             $x['INSTITUTE_CITY'] . ", " .
             $x['INSTITUTE_COUNTRY'] . "<br>" .
             $x['STARTING_DATE'] .
             " -- " . $x['ENDING_DATE'] . ", " . 
             $x['HOURS'] . "h<br>" .
             "<br>" ;
        echo "</li>" ;
      }
    ?>
    </ul>
  </div>

</div>

<script>
var chapter = 'teaching' ;
var x = document.getElementById('temp-content') ;
document.getElementById('main').innerHTML = x.innerHTML ;
</script>

<!--
-->

