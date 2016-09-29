<?php
  include "page_template.html"
?>

<div id="temp-content" style="display: none;">
<h3>Magma</h3>
<hr>
<br>

In this page you can find the Magma code of 
either intrinsics (ready to be installed as a Magma package) 
or functions (ready to be loaded within a Magma workspace).

<br><br>

<div class="magma-index">
  <h4><u>Index</u></h4>

  <br>
  <b>Elliptic curves</b>
  <ul>
    <li><a href="#nist_elliptic_curves_m">NIST elliptic curves</a></li>
    <li><a href="#invalid_curve_attack_m">Invalid curve attack</a></li>
  </ul>

  <br>
  <b>Public key cryptography</b>
  <ul>
    <li><a href="#kpabeGPSW2006">Key-policy Attribute-Based encryption</a></li>
  </ul>

  <br>
  <b>Nonlinear codes</b>
  <ul>
    <li><a href="#johnson_bound">The Johnson upper bound</a></li>
    <li><a href="#nordtrom-robinson_code">The Nordstrom-Robinson code</a></li>
  </ul>

  <br>
  <b>Polynomial systems</b>
  <ul>
    <li><a href="#traverso_algorithm">The Traverso algorithm</a></li>
  </ul>

</div>


<br><br><hr><br>

<h4 id="nist_elliptic_curves_m">NIST elliptic curves</h4>
<br>

  <table class="CodeInfo">
    <tr>
      <td><b>Type: </b></td>
      <td>intrinsic</td>
    </tr>
    <tr>
      <td><b>Description: </b></td>
      <td>This package contains the definition of some NIST elliptic curves, 
          precisely:<br>
          <i>P-192, P-224, P-256, P-384, P-521, K-163, B-163</i><br>
          It can be useful for testing them.
      </td>
    </tr>
    <tr>
      <td><b>View code: </b></td>
      <td><a href="nist_elliptic_curves.php">NIST_Elliptic_Curves.m</a></td>
    </tr>
    <tr>
      <td><b>Download: </b></td>
      <td><a href="file/NIST_Elliptic_Curves.m" target="_blank">NIST_Elliptic_Curves.m</a>
      </td>
    </tr>
    </table> 

<br><br><hr><br>

<h4 id="invalid_curve_attack_m">Invalid curve attack</h4>
<br>

  <table class="CodeInfo">
    <tr>
      <td><b>Type: </b></td>
      <td>function</td>
    </tr>
    <tr>
      <td><b>Description: </b></td>
      <td>This is a simple exercise which shows 
          how to solve the dicrete logarithm problem over any curve
          with an <i>invalid curve attack</i>.<br>
          In particular I show how to break NIST P-192 prime curve.
      </td>
    </tr>
    <tr>
      <td><b>View code: </b></td>
      <td><a href="invalid_curve_attack.php">invalid_curve_attack.m</a></td>
    </tr>
    <tr>
      <td><b>Download: </b></td>
      <td><a href="file/invalid_curve_attack.m" target="_blank">invalid_curve_attack.m</a>
      </td>
    </tr>
    </table> 

<br><br><hr><br>

<h4 id="kpabeGPSW2006">Key-policy Attribute-Based encryption</h4>
<br>

  <table class="CodeInfo">
    <tr>
      <td><b>Type: </b></td>
      <td>function</td>
    </tr>
    <tr>
      <td><b>Description: </b></td>
      <td>A Magma implementation of the 
          Key-Policy Attribute-based Encryption scheme defined in the paper<br>
          "<i>Attribute-based Encryption for 
              Fine-Grained Access Control of Encrypted Data</i>", <br>
          2006 - Goyal, Pandey, Sahai, Waters
      </td>
    </tr>
    <tr>
      <td><b>View code: </b></td>
      <td><a href="kpabe_gpsw_2006.php">kpabe-GPSW-2006</a></td>
    </tr>
    <tr>
      <td><b>Download: </b></td>
      <td><a href="file/kpabeGPSW2006.tar.gz" target="_blank">kpabeGPSW2006.tar.gz</a>
      </td>
    </tr>
    </table> 

<br><br><hr><br>

<h4 id="johnson_bound">The Johnson upper bound</h4>
<br>

  <table class="CodeInfo">
    <tr>
      <td><b>Type: </b></td>
      <td>intrinsic</td>
    </tr>
    <tr>
      <td><b>Description: </b></td>
      <td>This is an improvement of Magma internal implementation 
          of the Johnson upper bound.
          Magma functions <code>JohnsonBound(n,d)</code> 
          works only over binary fields, 
          while my function <code>JohnsonBound_(K,n,d)</code>
          is defined for all finite fields.
          Furthermore, in the binary case, my function 
          <code>JohnsonBound_2(n,d)</code>
          (which is based on the original 1962 Johnson's article) 
          performs better then <code>JohnsonBound(n,d)</code>.
          The smallest values for which this is true are:
          <table class="JohnsonBound">
            <tr>
              <td><code>n</code></td>
              <td><code>d</code></td>
              <td><code>JohnsonBound(n,d)</code></td>
              <td><code>JohnsonBound(n,d)_2</code></td>
            </tr>
            <tr>
              <td>5</td>
              <td>3</td>
              <td>5</td>
              <td>4</td>
            </tr>
            <tr>
              <td>6</td>
              <td>4</td>
              <td>5</td>
              <td>4</td>
            </tr>
            <tr>
              <td>7</td>
              <td>5</td>
              <td>3</td>
              <td>2</td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td><b>View code: </b></td>
      <td><a href="johnson_bound.php">JohnsonBound.m</a></td>
    </tr>
    <tr>
      <td><b>Download: </b></td>
      <td><a href="file/JohnsonBound.m" target="_blank">JohnsonBound.m</a>
      </td>
    </tr>
    </table> 

<br><br><hr><br>

<h4 id="nordtrom-robinson_code">The Nordstrom-Robinson code</h4>
<br>

  <table class="CodeInfo">
    <tr>
      <td><b>Type: </b></td>
      <td>intrinsic</td>
    </tr>
    <tr>
      <td><b>Description: </b></td>
      <td>The Nordstrom-Robinson code is a 
          binary nonlinear (16, 256)-code. 
          The existence of the Nordstrom-Robinson code shows that 
          A_2(16,6) = 256.
          <br>
          This file provides a Magma intrinsic to generate this code
          following the steps described in:
          <br>
          <i>
          Huffman-Pless, "Fundamentals of Error Correcting Codes", Chapter 2.3.4 - The Nordstrom-Robinson code
          </i>
      </td>
    </tr>
    <tr>
      <td><b>View code: </b></td>
      <td><a href="nordstrom_robinson_code.php">Nordstrom-RobinsonCode.m</a></td>
    </tr>
    <tr>
      <td><b>Download: </b></td>
      <td><a href="file/Nordstrom-RobinsonCode.m" target="_blank">Nordstrom-RobinsonCode.m</a>
      </td>
    </tr>
  </table> 

  <br><br><hr><br>

  <h4 id="traverso_algorithm">The Traverso algorithm</h4>
  <br>

  <table class="CodeInfo">
    <tr>
      <td><b>Type: </b></td>
      <td>intrinsic</td>
    </tr>
    <tr>
      <td><b>Description: </b></td>
      <td>Traverso introduced his algorithm in 1992, 
          during the conference MEGA, 
          in a scenario related to Groebner bases computation
          of a zero-dimensional ideal. 
          Given a linear representation (Q,M) of an ideal I and 
          r groebner descriptions GD = {c_1,...,c_r} 
          of r new polynomials not in I, 
          the Traverso algorithm 
          returns the linear representation of an ideal J 
          where J = I U GD = I U {c_1,...,c_r}.
          <br>
          The file contains an implementation of the algorithm as described in
          <br>
          <i>
          "SPES II", Mora, Fig 29.3, Traverso's Algorithm
          </i>.
      </td>
    </tr>
    <tr>
      <td><b>View code: </b></td>
      <td><a href="traverso.php">Traverso.m</a></td>
    </tr>
    <tr>
      <td><b>Download: </b></td>
      <td><a href="file/Traverso.m" target="_blank">Traverso.m</a>
      </td>
    </tr>
    </table> 
</div>

<script>
var chapter = 'programming' ;
var x = document.getElementById("temp-content") ;
document.getElementById("main").innerHTML = x.innerHTML ;
</script>

<!--
-->

