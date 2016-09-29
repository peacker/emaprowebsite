<?php
  include "page_template.html"
?>

<div id="temp-content" style="display: none;">
<h3>Invalid curve attack</h3>
<hr>
<br>

<pre>
<code class="magma">
// ---------------------------------------------
// EXERCISE
// --------
// Apply the invalid curve attack to a NIST curve
// ---------------------------------------------

// In general
// we choose the size b of the curve
bit := 160 ;
// choose a curve which is secure
p := NextPrime(2^bit) ;
q := p ;
K := FiniteField(p) ;
a := K!-3 ;
b := 0 ;
// increase b until a prime order curve is found
time repeat
  b := b + 1 ;
  if K!4*a^3+27*b^2 ne 0 then
    E := EllipticCurve([K | a,b]) ;
  end if ;
  time flag := IsPrime(#E) ;
until flag ;
b ;

// generate a base point P, a secret key k and Q = k*P
P := Random(E) ;
k := Random(Order(P)) ;
k ;
Q := k*P ;

// choose a curve which is weak
bit := 160 ;
p := NextPrime(2^bit) ;
q := p ;
K := FiniteField(q) ;
a := K!-3 ;
b := 0 ;
time repeat
  b := b + 1 ;
  if K!4*a^3+27*b^2 ne 0 then
    E := EllipticCurve([K | a,b]) ;
    F := Factorization(#E) ;
    max := Max({F[i][1] : i in [1..#F]}) ;
  end if ;
  nfact := #F ;
  ng := #Generators(E) ;
  flag := Log(2,max) le 40  and ng eq 1 ;
  if (b mod 100) eq 0 then
    b ;
  end if ;
until flag ;
b ;


// find a point of maximum order in the weak curve
repeat
  P := Random(E) ;
until Order(P) eq #E ;

N := Order(P) ;

// For each power of a prime p^e in F find a point of order p^e
PP := [] ;
for i in [1..#F] do
  PP[i] := Integers()!(N/F[i][1]^F[i][2]) * P ;
end for ;
[Order(PP[i]) : i in [1..#PP]] ;

// ask the user to compute "invalid" logarithms
QQ := [k*PP[i] : i in [1..#PP]] ;
Pi := [F[i][1]^F[i][2] : i in [1..#F]] ;

// solve the "invalid" logarithms
time Ki := [Log(PP[i],QQ[i]) : i in [1..#PP] ] ;
// we can now solve the ChineseRemainderTheorem
time k1 := ChineseRemainderTheorem(Ki,Pi) ;
k1 eq k ;

/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////


// we break NIST P-192 with invalide curve attack
// NIST P-192
p := 2^192 - 2^64 - 1 ;
q := p ;
K := FiniteField(q) ;
a := K!-3 ;
bN := K! 0x64210519e59c80e70fa7e9ab72243049feb8deecc146b9b1 ;
EN := EllipticCurve([K | a,bN]) ;
rN := 6277101735386680763835789423176059013767194773182842284081 ;

// WEAK CURVE
p := 2^192 - 2^64 - 1 ;
q := p ;
K := FiniteField(q) ;
a := K!-3 ;
b := 0 ;
/* // search for the curve
time repeat
  b := b + 1 ;
  if K!4*a^3+27*b^2 ne 0 then
    E := EllipticCurve([K | a,b]) ;
    F := Factorization(#E) ;
    max := Max({F[i][1] : i in [1..#F]}) ;
  end if ;
  nfact := #F ;
  ng := #Generators(E) ;
  flag := Log(2,max) le 40  and ng eq 1 ;
  if (b mod 100) eq 0 then
    b ;
  end if ;
until flag ;
b ;
// 2436
*/
bW := K!2436 ;
EW := EllipticCurve([K | a,bW]) ;
rW := #EW ;
F := Factorization(rW) ;
F ;
// [ <3, 2>, <173, 1>, <313, 1>, <857, 1>, <1453, 1>, <16301, 1>, <624829, 1>, <1543511, 1>, <159607069, 1>, <4370843969, 1>, <943142251561, 1> ]

// find a point in NIST P-192 of maximum order
repeat
  P := Random(EN) ;
until Order(P) eq #EN ;
 
N := Order(P) ;
N ;

// choose a key
k := Random(Order(P)) ;
k ;
Q := k*P ;

// find a point in EW (the weak curve) of maximum order
repeat
  PW := Random(EW) ;
until Order(PW) eq #EW ;

N := Order(PW) ;

// For each power of a prime p^e in F find a point of order p^e
PP := [] ;
for i in [1..#F] do
  PP[i] := Integers()!(N/F[i][1]^F[i][2]) * PW ;
end for ;
[Order(PP[i]) : i in [1..#PP]] ;
// [ 9, 173, 313, 857, 1453, 16301, 624829, 1543511, 159607069, 4370843969, 943142251561 ]

QQ := [k*PP[i] : i in [1..#PP]] ;
time Ki := [Log(PP[i],QQ[i]) : i in [1..#PP] ] ;
// Time: 5.260
Pi := [F[i][1]^F[i][2] : i in [1..#F]] ;

// we can now solve the ChineseRemainderTheorem
time k1 := ChineseRemainderTheorem(Ki,Pi) ;
// Time: 0.000
k1 ;
// 251697511401526846594265382788855133579109928922384519879
k1 eq k ; 
// true

</code>
</pre>

<script>
var chapter = 'programming' ;
var x = document.getElementById('temp-content') ;
document.getElementById('main').innerHTML = x.innerHTML ;
</script>

<!--
-->

