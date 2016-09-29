//////////////////////////////////////////////////////////////////////////////
// Work done by PHD student Emanuele Bellini,                               //
// University of Trento, 2014.                                              //
//                               Emanuele Bellini, 2014                     //
//////////////////////////////////////////////////////////////////////////////

NextConfiguration := function (LL,MAX,MIN) 
// 
// Example:
// nc := NextConfiguration([0,0,0],[1,2,2],[0,0,0]) ; nc ;
// // [0,0,1] ;
// nc := NextConfiguration([0,0,1],[1,2,2],[0,0,0]) ; nc ;
// // [ 0, 0, 2 ]
// nc := NextConfiguration([0,0,2],[1,2,2],[0,0,0]) ; nc ;
// // [ 0, 1, 0 ]
// ...
// nc := NextConfiguration([1,2,1],[1,2,2],[0,0,0]) ; nc ;
// // [ 1, 2, 2 ]
// nc := NextConfiguration([1,2,2],[1,2,2],[0,0,0]) ; nc ;
// // [ 1, 2, 2 ]
// 

local L, i ;
  L := LL ;
  // CHECKS
  if #L ne #MAX then
    return "ERROR! The two list must have the same length!" ;
  end if ;
  for j in [1..#L] do
    if L[j] lt MIN[j] or L[j] gt MAX[j] then
      return "ERROR! The input sequence is out of range!" ;
    end if ;
  end for ;

  // CHECK IF FINISHED
  if MAX eq L then
    return L ; 
  // FIND NEW CONFIGURATION
  else 
    // find the rightmost element to increase
    i := #L ;
    while L[i] eq MAX[i] do
      i := i - 1 ;
    end while ;
    L[i] := L[i] + 1 ;
    for j in [i+1..#L] do
      L[j] := MIN[j] ;
    end for ;
  end if ;

  return L ;
end function ;

//////////////////////////////////////////////////////////////////////////////

intrinsic HilbertStaircase(G::SeqEnum) -> SeqEnum
{
Return the set of leading monomials under the Hilbert staircase 
of the ideal generated by G.
}
// G must be a reduced groebner basis
  return [LeadingMonomial(g) : g in G] ;
end intrinsic ;

//////////////////////////////////////////////////////////////////////////////

intrinsic MonomialsUnderHilbertStaircase (G::SeqEnum) ->SeqEnum
{
Return a list containing 
all the monomials under the Hilbert Staircase. 
The monomials are in the ring R|G. 
Note that G must be a reduced groebner basis 
of a finite dimensional ideal!
}
// Returns a list containing 
// all the monomials under the Hilbert Staircase
// The monomials are in the ring R|G
//
// G must be a reduced groebner basis
// of a finite dimensional ideal!!
// 
local HS ; // leading monomials of G
local N ; // monomials under the Hilbert Staircase
local E, temp ;
local R ; // polynomial ring
local RG ; // R/G
local max, ind ;
local extr ;

  R := Parent(G[1]) ;
  RG := quo<R | G> ;
  HS := HilbertStaircase(G) ;
  N := {} ;

  // FIND "SINGLE-VARIABLE" LEADING MONOMIAL
  extr := [0 : i in [1..Rank(R)]] ;
  for m in HS do
    E := Exponents(m) ;
    if #[x : x in E | x ne 0] eq 1 then
      max,ind := Max(E) ;
      extr[ind] := E[ind] ;
    end if ;
  end for ;

  // CREATE HYPER-CUBE
  N := [] ;
  E := [0 : i in [1..Rank(R)]] ;
  Append(~N,E) ;
  repeat
    E := NextConfiguration(E,extr,[0 : i in [1..#E]]) ;
    Append(~N,E) ;
  until E eq extr ;

  // EXCLUDE MONOMIAL OVER THE STAIRCASE
  for m in HS do
    E := Exponents(m) ;
    temp := E ;
    Exclude(~N,temp) ;
    repeat
      temp := NextConfiguration(temp,extr,E) ;
      Exclude(~N,temp) ;
    until temp eq extr ;
  end for ;

  return Sort([&*[RG.i^e[i] : i in [1..Rank(R)]] : e in N]) ;
end intrinsic ;

//////////////////////////////////////////////////////////////////////////////

IdealDegree := function(I) 
// computes the number of elements under the Hilbert Staircase
// #N(I)
// Definition 27.12.1, "SPES II", Mora

  if not IsZeroDimensional(I) then
    "The degree can be computed only for a zero dimensional ideal!!" ;
    return -1 ;
  end if ;

  return #MonomialsUnderHilbertStaircase(Groebner(I)) ;
end function ;

//////////////////////////////////////////////////////////////////////////////

GroebnerRepresentation := function(I,Q) 
// Q = {q1,...,qs}
// is a linear indipendent set such that
// R[x1,...,xk]/I = Span of Q with respect to K
// see def. 29.3.2, "SPES II", Mora
//
// Example:
// K := Rationals() ;
// R<x2,x1> := PolynomialRing(K,2,"grevlex") ;
// f := [
//       x2^3 - x1*x2^2,
//       x1^2*x2,
//       x1^3 - x2^2 + x1*x2,
//       x2^4
//      ] ;
// I := Ideal(f) ;
// Q := MonomialsUnderHilbertStaircase(G) ;
// GroebnerRepresentation(Basis(I),Q) ;
//
 
local K ; // base field
local R ; // polynomial ring over K
local G ; // groebner basis of I
local s ; // number of elements in Q
local n ; // number of variables x1,...,xn
local M ; // set of n square matrices
local Xh_ql ; // RG.h*Q[l]
local Mon ; // monomials of Xh_ql
local Coeff ; // coefficients of Xh_ql
local ind ;

  R := Parent(I[1]) ;
  K := BaseRing(R) ;

  G := GroebnerBasis(I) ;

  RG := quo<R | G> ;

  n := Rank(RG) ;
  s := #Q ;
  M := [] ;
  for h in [1..n] do
    M[h] := Matrix(K,s,s,[]) ;
    for l in [1..s] do
      Xh_ql := RG.h*RG!Q[l] ;
      Mon := Monomials(Xh_ql) ;
      Coeff := Coefficients(Xh_ql) ;
      for j in [1..s] do
        ind := Index(Mon,Q[j]) ;
        if ind ne 0 then
          M[h][l][j] := Coeff[ind] ;
        end if ;
      end for ;
    end for ;
  end for ;

  return Q, M ;
end function ;

//////////////////////////////////////////////////////////////////////////////

intrinsic LinearRepresentation(I::SeqEnum : vect := false) -> SeqEnum, SeqEnum
{
A linear representation of an Ideal I 
is a Groebner representation where Q is the set 
of the monomials under the Hilbert Staircase.
}
// A linear representation of an Ideal I
// is a Groebner representation where Q is the set
// of the monomials under the Hilbert Staircase
// EXAMPLE 29.2.1, "SPES II", Mora
// K := Rationals() ;
// R<x2,x1> := PolynomialRing(K,2,"grevlex") ;
// f := [
//       x2^3 - x1*x2^2,
//       x1^2*x2,
//       x1^3 - x2^2 + x1*x2,
//       x2^4
//      ] ;
// I := Ideal(f) ;
// LinearRepresentation(GroebnerBasis(I)) ;
//
// if vect = true Q is returned as a vector of vectors and M as a matrix
// if vect = false Q is returned as a vector of monomials and M as a list of monomials
//
 
local K ; // base field
local R ; // polynomial ring over K
local Q ; // R[x1,...,xk]/I = Span of Q with respect to GF(2)
          // i.e. monomials under the Hilbert Staircase
local G ; // groebner basis of I
local s ; // number of elements in Q
local n ; // number of variables x1,...,xn
local M ; // set of n square matrices
local Xh_ql ; // RG.h*Q[l]
local Mon ; // monomials of Xh_ql
local Coeff ; // coefficients of Xh_ql
local ind ;

  R := Parent(I[1]) ;
  K := BaseRing(R) ;

  G := GroebnerBasis(I) ;
  Q := MonomialsUnderHilbertStaircase(G) ;

  RG := quo<R | G> ;

  n := Rank(RG) ;
  s := #Q ;
  M := [] ;

  if vect then // VECTORIAL CASE
    for h in [1..n] do
      M[h] := Matrix(K,s,s,[]) ;
      for l in [1..s] do
        Xh_ql := RG.h*RG!Q[l] ;
        Mon := Monomials(Xh_ql) ;
        Coeff := Coefficients(Xh_ql) ;
        for j in [1..s] do
          ind := Index(Mon,Q[j]) ;
          if ind ne 0 then
            M[h][l][j] := Coeff[ind] ;
          end if ;
        end for ;
      end for ;
    end for ;
    Q := [] ;
    for i in [1..s] do
      Q[i] := Vector(BaseRing(RG),[0 : j in [1..s]]) ;
      Q[i][i] := 1 ;
    end for ;
  else // POLYNOMIAL CASE
    for h in [1..n] do
      M[h] := [] ;
      for l in [1..s] do
        M[h][l] := RG.h * Q[l] ;
      end for ;
    end for ; 
  end if ;

  return Q, M ;
end intrinsic ;

//////////////////////////////////////////////////////////////////////////////

intrinsic LinearRepresentationPOLY(I::RngMPol) -> SeqEnum
{
A linear representation of an Ideal I 
is a Groebner representation where Q is the set 
of the monomials under the Hilbert Staircase.
}
// A linear representation of an Ideal I
// is a Groebner representation where Q is the set
// of the monomials under the Hilbert Staircase
// EXAMPLE 29.2.1, "SPES II", Mora
// K := Rationals() ;
// R<x2,x1> := PolynomialRing(K,2,"grevlex") ;
// f := [
//       x2^3 - x1*x2^2,
//       x1^2*x2,
//       x1^3 - x2^2 + x1*x2,
//       x2^4
//      ] ;
// I := Ideal(f) ;
// LinearRepresentationPOLY(GroebnerBasis(I)) ;
//

local R ;// polynomial ring
local A ; // affine algebra R/I
local Q ;
 
  if I eq [] then
    return [] ;
  end if ;
 
  R := Parent(I[1]) ;
  A := quo< R | I > ;

  return SetToSequence(MonomialBasis(A)) ;
end intrinsic ;

//////////////////////////////////////////////////////////////////////////////

GroebnerDescription := function(g,Q : vect:=true)
// g must be a polynomial in R
// Q must be the set of the monomials under the Hilbert Staircase
//   where each monomial is in R/G, 
//   where G is a Groebner basis
//
// The complexity to compute Groebner Description
// should be 
// O(uds^2), where:
// - s is the number of elements in Q
// - d is the degree of g
// - u is the number of monomials of g in R
// The complexity can be reduced to
// O(Hor(f)s^2), where
// - Hor(f) <= ud, is the Horner complexity of f, i.e.
//   the number of + required by the recursive Horner representations
//
// if vect = true the description is given as a vector
// else it is given as a polynomial in the algebra with base Q
//

local R ;
local RG ;
local rem ; // remainder of g mod I
local rem_c ; // coefficients of the remainder
local rem_m ; // monomials of the remainder
local GD ; // groebner description of g with respect to Q

  if g eq 0 then 
    return Vector([Parent(Q[1])!0 : i in [1..#Q]]) ;
  end if ;

  R := Parent(g) ;
  RG := Parent(Q[1]) ;

  rem := RG!Evaluate(g,[RG.i : i in [1..Rank(RG)]]) ;
  if not vect then
    return rem ;
  else
    rem_c := Coefficients(rem) ;
    rem_m := Monomials(rem) ;

    GD := [Parent(rem_c[1])!0 : i in [1..#Q]] ;
    for i in [1..#rem_m] do
      GD[Index(Q,rem_m[i])] := rem_c[i] ;
    end for ;
    
    return Vector(GD) ;
  end if ;
end function ;

//////////////////////////////////////////////////////////////////////////////

intrinsic Traverso( QQ::SeqEnum, MM::SeqEnum, GD::SeqEnum : verb:=true ) 
-> SeqEnum, SeqEnum
{
Given 
a linear representation (Q,M) of an ideal I and
r groebner descriptions GD = (c_1,...,c_r)
of r new polynomials not in I,
returns the linear representation of an ideal J
where J = I U GD = I U (c_1,...,c_r).
}
// from "SPES II", Mora, Fig 29.3, Traverso's Algorithm
// Given
// - a linear representation (Q,M) of an ideal I
// - r groebner descriptions GD = {c_1,...,c_r} 
//   of r new polynomials not in I
// returns the linear representation of an ideal J
// where J = I U GD = I U {c_1,...,c_r}
// INPUT:
// - Q, monomials under the Hilbert Staircase
// - M, multiplication tables for each variable
// - GD, sequence of r Groebner descriptions
// 
// EXAMPLE:
// SetVerbose("User1", 0) ; // to not print
// SetVerbose("User1", 1) ; // to print verbose
// q := 2 ; k := 2 ;
// R := PolynomialRing(GF(q),k,"grevlex") ;
// G := [R.i^q-R.i : i in [1..k]] ;
// G := GroebnerBasis(G) ;
// Q,_ := LinearRepresentation(G : vect := false ) ;
// _,M := LinearRepresentation(G : vect := true ) ;
// c := Vector(GF(2),[1,0,0,1]) ;
// Q1,M1 := TraversoVECT(Q,M,[c]) ;
//

local n ; // number of variables
local Q ; // 
local M ; //
local s ; // number of elements in Q
local B ; // set of r Groebner descriptions
local c ; // single Groebner description
local iota ; //
local Q_iota, M_iota, c_iota, d_iota ;
local B1 ; //  
local temp ; //

  M := MM ;
  Q := QQ ;
  n := #M ;
  s := #Q ;
  I := [i : i in [1..s]] ;
  B := GD ;

  vprint User1: "------ BEGIN TRAVERSO'S ALGORITHM ------" ;

  while B ne [] do

    c := B[1] ; // or c := Random(B) ; // is there an efficient choice?

    vprint User1: "----------------------------------------" ;
    vprint User1: "----------------------------------------" ;
    vprint User1: "B = ", B ;
    vprint User1:   "I = ", I ;
    vprint User1: "c = ", c ;

    Exclude(~B,c) ; // remove c from B

    for m in M do
      temp := c*m ;
      if Weight(temp) ne 0 and not temp in B then // c*m != 0...0 and c*m not in B
        Append(~B,temp) ;
      end if ;
    end for ;

    iota := Maximum( { j : j in [1..Ncols(c)] | c[j] ne 0 } ) ;

    // UPDATE Q
    Q_iota := Q[iota] ;
    Remove(~Q, iota) ;
    s := #Q ;

    // SAVE iota COLUMNS AND REMOVE THEM FROM M
    M_iota := [RemoveRow(Submatrix(M[h],1,iota,Nrows(M[h]),1),iota) : h in [1..n] ] ;
    M := [RemoveRowColumn(M[h],iota,iota) : h in [1..n]] ;

    // SAVE iota COORDINATE AND REMOVE IT FROM c
    c_iota := c[iota] ;
    c := RemoveColumn(c,iota)[1] ;

    vprint User1: "---------- B U [c*m : m in M] ----------" ;
    vprint User1: "B = ", B ;
    vprint User1: "I = ", I ;
    vprint User1: "iota = ", iota ;
    vprintf User1: "Q[%o] = %o \n",iota,Q_iota ;
    vprintf User1: "c[%o]^-1 = %o \n",iota,c_iota^-1 ;

    // REPLACE Q[iota] IN MULTIPLICATION TABLES
    for h in [1..n] do
      for j in [1..Nrows(M[h])] do // for j in I do
        for l in [1..Ncols(M[h])] do // for l in I do
          M[h][l][j] := M[h][l][j] - c_iota^-1 * c[j] * M_iota[h][l][1] ;
        end for ;
      end for ;
    end for ;

    vprint User1: "M = ", M ;

    B1 := B ;
    B := [] ;

    // REPLACE Q[iota] IN GROEBNER DESCRIPTIONS
    for x in B1 do
      d := x ;
      d_iota := d[iota] ;
      d := RemoveColumn(d,iota)[1] ;
      for j in [1..s] do
        d[j] := d[j] - c_iota^-1 * c[j] * d_iota ;
      end for ;
      if (Weight(d) ne 0) and (not d in B) then // d != 0...0
        Append(~B,d) ;
      end if ;
    end for ;
  end while ;

  return Q, M ;
end intrinsic ;

/*
// EXAMPLE
q := 2 ; k := 2 ;
R := PolynomialRing(GF(q),k,"grevlex") ;
G := [R.i^q-R.i : i in [1..k]] ;
G := GroebnerBasis(G) ;
Q,_ := LinearRepresentation(G : vect := false ) ;
_,M := LinearRepresentation(G : vect := true ) ;
c := Vector(GF(2),[1,0,0,1]) ;
Q1,M1 := Traverso(Q,M,[c]) ;
*/