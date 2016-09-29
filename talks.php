<?php
  include "page_template.html" ;
  include "CV_DB.php" ;
?>

<div id="temp-content" style="display: none;">
  <h3>Talks</h3>
  <hr>
  <br>

  <div class="journal-list">
    <h4><u>International conferences and workshops</u>:</h4><br>
    <ul>
    <?php
      foreach ($DATABASE['TALKS_INTERNATIONAL_CONFERENCES_AND_WORKSHOPS'] as &$x) {
        echo "<li>" ;
        echo "<p><i><b>\"" . $x['TITLE'] . "\"</b></i></p>" . 
             $x['CONFERENCE_NAME'] . "<br>" .
             $x['DATE'] . ", " .
             $x['LOCATION'] . "<br><br>" ;
        echo "</li>" ;
      }
    ?>
    </ul>

    <h4><u>International seminars</u>:</h4><br>
    <ul>
    <?php
      foreach ($DATABASE['TALKS_INTERNATIONAL_SEMINARS'] as &$x) {
        echo "<li>" ;
        echo "<p><i><b>\"" . $x['TITLE'] . "\"</b></i></p>" . 
             $x['TYPE'] . "<br>" .
             $x['DATE'] . ", " .
             $x['LOCATION'] . "<br><br>" ;
        echo "</li>" ;
      }
    ?>
    </ul>

    <h4><u>National conferences</u>:</h4><br>
    <ul>
    <?php
      foreach ($DATABASE['TALKS_NATIONAL_CONFERENCES'] as &$x) {
        echo "<li>" ;
        echo "<p><i><b>\"" . $x['TITLE'] . "\"</b></i></p>" . 
             $x['CONFERENCE_NAME'] . "<br>" .
             $x['DATE'] . ", " .
             $x['LOCATION'] . "<br><br>" ;
        echo "</li>" ;
      }
    ?>
    </ul>

    <h4><u>National seminars</u>:</h4><br>
    <ul>
    <?php
      foreach ($DATABASE['TALKS_NATIONAL_SEMINARS'] as &$x) {
        echo "<li>" ;
        echo "<p><i><b>\"" . $x['TITLE'] . "\"</b></i></p>" . 
             $x['TYPE'] . "<br>" .
             $x['DATE'] . ", " .
             $x['LOCATION'] . "<br><br>" ;
        echo "</li>" ;
      }
    ?>
    </ul>

  </div>

</div>

<script>
var chapter = 'research' ;
var x = document.getElementById("temp-content") ;
document.getElementById("main").innerHTML = x.innerHTML ;
</script>

<!--
-->

