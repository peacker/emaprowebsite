//////////////////////////////////////////////////////////////////////////////
// Work done by PHD student Emanuele Bellini,                               //
// under the supervision of prof. Massimiliano Sala.                        //
// University of Trento, 2012.                                              //
//                               Emanuele Bellini, 2012                     //
//////////////////////////////////////////////////////////////////////////////

RR := function(m,r,l)
/* 
RR is called by R, which returns a bound for R(m,r,l) using Johnson's techniques, ("A new upper bound for error-correcting codes", Selmer M. Johnson, 1962, Ire Transactions On Information Theory). Recall that R(m,r,l) = A_2(m,2r-2l,r) 
*/
  local bound, k, t ;

  // Check parameters m, r 
  if (m lt 1) or (not IsIntegral(m)) then // m >= 1
    printf "Error! Parameter (1) must be an integer greater than or equal to 1\n" ;
    return -1 ;
  end if ;
  if (r lt 0) or r gt m or (not IsIntegral(r) ) then // 0 <= r <= m
    printf "Error! Parameter (2) must be an integer in the range [0 .. parameter (1) ]\n" ;
    return -1 ;
  end if;
  if l lt 0 or l gt m then // 0 <= l <= m
    printf "Error! Parameter (3) must be an integer in the range [0 .. parameter (1) ]\n" ;
    return -1 ;
  end if ;
  
  // Border line cases
  if r eq m and l eq m then // r = m, l = m
    return 2 ;
  end if ;
  if r eq m and l lt m then // r = m, l < m
    return 1 ;
  end if ;
  if r eq 0 then // r = 0
    return 1 ;
  end if ;
    
  bound := -1 ;
  if r^2 - m*l gt 0 then // we can apply R(m,r,l) <= Floor( m(r-l) / (r^2-ml) ) 
    if l gt 0 then 
      bound := Min( m*(r-l) div (r^2-m*l) , Floor(m/r * $$(m-1,r-1,l-1) ) ) ; // sometimes one more reduction returns a better lower bound
    else // if l = 0 we can not check further
      bound := m*(r-l) div (r^2-m*l) ;
    end if ;
  else // we can apply R(m,r,l) <= Floor( m/r * R(m-1,r-1,l-1) ) until l = 0
    //[m,r,l] ;
    bound := Floor( m/r * $$(m-1,r-1,l-1) ) ;
  end if ;

  // search for the best R such that R(R-1)l >= (m-t)k^2 + t(k+1)^2 - rR, where R is the variable bound

  k := r*bound div m ;
  t := r*bound - m*k ;
  while ( bound*(bound-1)*l lt (m-t)*k^2 + t*(k+1)^2 - r*bound ) do
    //[bound,bound*(bound-1)*l , (m-t)*k^2 + t*(k+1)^2 - r*bound ] ;
    bound := bound - 1 ;
    k := Floor(r*bound/m) ;
    t := r*bound - m*k ;
  end while ;
  
  return bound ;
end function ;

//////////////////////////////////////////////////////////////////////////////

R := function(m,r,l) 
/*
R returns a bound for R(m,r,l) using Johnson's techniques, ("A new upper bound for error-correcting codes", Selmer M. Johnson, 1962, Ire Transactions On Information Theory). Recall that R(m,r,l) = A_2(m,2r-2l,r) 
----------------------------------------------------------------------------
INPUT: 
  - integer m  s.t. m >= 1
  - integer r  s.t. 0 <= r <= m
  - integer l  s.t. 0 <= l <= m
OUTPUT: 
  - Johnson Bound for R(n,d,w)
  
Calls function RR()
Let R(m,r,l) be the maximum number of vectors of size m and weigth r such that the inner product of any pair of row vectors is less than or equal to l. 
Compute R(m,r,l) using bounds from Johnson 1963.
Since R(m,r,l) = R(m,m-r,m-2r+l), then R chooses the minimum between them, i.e. Min( RR(m,r,l) , RR(m,m-r,m-2r+l) ).
Returns -1 in case of bad parameters.
----------------------------------------------------------------------------
*/
  // Check parameters m, r 
  if (m lt 1) or (not IsIntegral(m)) then // m >= 1
    printf "Error! Parameter (1) must be an integer greater than or equal to 1\n" ;
    return -1 ;
  end if ;
  if (r lt 0) or r gt m or (not IsIntegral(r) ) then // 0 <= r <= m
    printf "Error! Parameter (2) must be an integer in the range [0 .. parameter (1) ]\n" ;
    return -1 ;
  end if;
  if l lt 0 or l gt m then // 0 <= l <= m
    printf "Error! Parameter (3) must be an integer in the range [0 .. parameter (1) ]\n" ;
    return -1 ;
  end if ;
  
  // Border line cases
  if r eq m and l eq m then // r = m, l = m
    return 2 ;
  end if ;
  if r eq m and l lt m then // r = m, l < m
    return 1 ;
  end if ;
  if r eq 0 then // r = 0
    return 1 ;
  end if ;
  
  
  //Return Min[ RR(m,r,l) , RR(m,m-r,m-2r+l) ] ;
  if m-2*r+l lt 0 then
    return RR(m,r,l) ;
  end if;
  return Min( RR(m,r,l) , RR(m,m-r,m-2*r+l) ) ;
end function ;

//////////////////////////////////////////////////////////////////////////////


intrinsic JohnsonBound_2 (n::RngIntElt, d::RngIntElt) -> RngIntElt
{
Return the Johnson upper bound for the cardinality of a largest code over GF(2) of length n and minimum distance d. 
Johnson's Bound formulas are as in the original article from 1962.
}
/* 
Compute Johnson Bound using algorithm from Johnson's Article 1962, 
("A new upper bound for error-correcting codes", Selmer M. Johnson, 1962, 
Ire Transactions On Information Theory)
*/
  local e,denom1,denom2 ;
  
  // Check parameters n, d 
  requirege n, 1; // n >= 1
  requirerange d, 1, n; // 1 <= d <= n

  // Case d even
  if IsEven(d) then // if d is even A_2(n,d) = A_2(n-1,d-1)
    return $$(n-1,d-1) ; 
  end if ;
  e := (d-1) div 2 ;
  
  // Border line cases
  if (d eq 1) then // If d = 1 return the vector space cardinality
    return 2^n;
  end if ;
  
  // Choose the minimum from the two formula where the following terms are replaced:
  // [n/(e+1)]  <-->  1 + (d+1  e+1)R(n,d+1,e+1)/( (n  e+1)-(d  e)R(n,d,e) )
  denom1:= &+[Binomial(n,i): i in [0 .. e]] +  
           ( Binomial(n,e+1) - Binomial(d,e) * R(n,d,e) ) / 
           Floor(n/(e+1) ) ;
  if ((Binomial(n,e+1)-Binomial(d,e)*R(n,d,e)) gt 0) then
     denom2:=   &+[Binomial(n,i):i in [0..e]] + 
                ( Binomial(n,e+1) - Binomial(d,e) * R(n,d,e) ) / 
                (1+( Binomial(d+1,e+1)*R(n,d+1,e+1)/(Binomial(n,e+1)-Binomial(d,e)*R(n,d,e)) ) )  ;
    return  Min ( Floor(2^n/denom1) , Floor(2^n/denom2) )  ;
  else 
    return Floor( 2^n / denom1 );
  end if;

end intrinsic ;

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

AA_ := function(K,n,d,w)
  
  local q ;
  
  q := #K ;
  // Check parameters
  if (not IsField(K)) then
    printf "Error! parameter (1) must be a field\n" ;
    return -1 ;
  end if ;
  if (n lt 1) or (not IsIntegral(n)) then // n >= 1
    printf "Error! parameter (2) must be an integer greater than 1\n" ;
    return -1 ;
  end if ;
  if (d lt 1) or (d gt n) or (not IsIntegral(d)) then // 1 <= d <= n
    printf "Error! parameter (3) must be an integer in the range [1 .. parameter (2) ]\n" ;
    return -1 ;
  end if ;
  if w lt 0 or w gt n or (not IsIntegral(w)) then // 0 <= w <= n
    printf "Error! parameter (4) must be an integer in the range [1 .. parameter (2) ]\n" ;
    return -1 ; 
  end if ;
    
  // Border line cases
  if w eq 0 then // w = 0
   return 1 ;
  end if ;
  if n eq 1 or (d eq n and w eq n) then
    return q - 1 ;
  end if ;       
  
  //compute A_q(n,d,w)
  if d gt 2*w then   // d > 2wn*d*(q-1) div (q*w^2-2*(q-1)*n*w+n*d*(q-1))
    return 1 ;
  end if ;
  // check if Restricted Johnson Bound can be used
  if ( q*w^2 - 2*(q-1)*n*w + n*d*(q-1) gt 0 ) then 
    if w gt 0 and n gt d+1 then // use that A_q(n,d,w) <= n*(q-1)/w * A_q(n-1,d-w-1)
      return Min( n*d*(q-1) div (q*w^2-2*(q-1)*n*w+n*d*(q-1)) , n*(q-1) * $$(K,n-1,d,w-1) div w );
    else
      return n*d*(q-1) div (q*w^2-2*(q-1)*n*w+n*d*(q-1)) ;
    end if ;
  else // use that A_q(n,d,w) <= n*(q-1)/w * A_q(n-1,d-w-1)
    return n*(q-1) * $$(K,n-1,d,w-1) div w ;
  end if ;

  return 0 ;
end function ;

//////////////////////////////////////////////////////////////////////////////

A_ := function(K,n,d,w) 
/*
----------------------------------------------------------------------------
INPUT: 
  - field characteristic q, must be a prime power 
  - integer n s.t. n >= 1
  - integer d s.t. 1 <= d <= n
  - integer w s.t. 0 <= w <= n
OUTPUT: 
  - Johnson Bound for A_q(n,d,w)
  
Calls function AA_()

Compute A_q(n,d,w) using bounds from Huffman-Pless 2003
If q = 2, A_q(n,d,w) = A_q(n,d,n-w), so A_ chooses the minimum between them, i.e. Min( AA_q(n,d,w) , AA_q(n,d,n-w) )
----------------------------------------------------------------------------
*/
  local q ;
  
  q := #K ; // cardinality of the field
  
  // Check parameters
  if (not IsField(K)) then
    printf "Error! parameter (1) must be a field\n" ;
    return -1 ;
  end if ;
  if (n lt 1) or (not IsIntegral(n)) then // n >= 1
    printf "Error! parameter (2) must be an integer greater than 1\n" ;
    return -1 ;
  end if ;
  if (d lt 1) or (d gt n) or (not IsIntegral(d)) then // 1 <= d <= n
    printf "Error! parameter (3) must be an integer in the range [1 .. parameter (2) ]\n" ;
    return -1 ;
  end if ;
  if w lt 0 or w gt n or (not IsIntegral(w)) then // 0 <= w <= n
    printf "Error! parameter (4) must be an integer in the range [1 .. parameter (2) ]\n" ;
    return -1 ; 
  end if ;
  
  // Border line cases
  if w eq 0 then // w = 0
   return 1 ;
  end if ;
  if n eq 1 or (d eq n and w eq n) then
    return q - 1 ;
  end if ;       
  
  if q eq 2 then
    return Min( AA_(K,n,d,w) , AA_(K,n,d,n-w) ) ;
  else
    return AA_(K,n,d,w) ;
  end if ;

end function ;

//////////////////////////////////////////////////////////////////////////////

intrinsic JohnsonBound_ (K::FldFin, n::RngIntElt, d::RngIntElt) -> RngIntElt
{
Return the Johnson upper bound for the cardinality of a largest code over K of length n and minimum distance d.
}
/*
----------------------------------------------------------------------------
INPUT: 
  - field K 
  - integer n s.t. n >= 1
  - integer d s.t. 1 <= d <= n
OUTPUT: 
  - Johnson Bound for A_q(n,d)
  
Calls function A_() which calls function AA_()
----------------------------------------------------------------------------
Return the Johnson upper bound for the cardinality of a largest q_ary code
of length n and minimum distance d. 

Important note: 
  the formula implemented is taken from the original article by Johnson 
  ("A new upper bound for error-correcting codes", Selmer M. Johnson, 1962, 
   Ire Transactions On Information Theory) 
  in the binary case, and from Huffman-Pless in the q_ary case 
  ("Fundamentals of Error Correcting Codes", W. Cary Huffman and Vera Pless, 
   2003, Cambridge University Press). 
  The bound strictly depends from the value A_q(n,d,w), 
  which is the maximum number of codewords for a q_ary code of 
  length n, distance d, and whose words have all weight w. 
  Since this value cannot be computed explicitly, 
  in this implementation A_q(n,d,w) is only bounded following the techniques 
  showed in the mentioned papers. 
  Thus it is possible to obtain better values using the Johnson Bound 
  if the value A_q(n,d,w) is known or better bounded.
*/

  local q, t, s, k , A ;
  
  // Check parameters
  requirege n, 1; // n >= 1
  requirerange d, 1, n; // 1 <= d <= n

  q := #K ; 
  
  // Border line cases
  if n eq 1 or d eq n then
    return q ;
  end if ;       
  if (d eq 1) then // If d = 1 return the vector space cardinality
    return q^n;
  end if ;
  
  if IsEven(d) then // A_q(n,d) <= A_q(n-1,d-1)
    return $$(K,n-1,d-1) ; 
  end if ;  
  
  k := 0 ;

  t := (d-1) div 2 ; 
  
  //compute Sum_0^t (n i)*(q-1)^i
  s := &+[Binomial(n,i)*(q-1)^i: i in [0 .. t]] ;

/* UNCOMMENT the following lines (if statement) if you want to call the function JohnsonBound_2 when q = 2 */  
//  if q eq 2 then //compute Johnson bound for A_2(n,d) 
//      A := JohnsonBound_2(n,d) ;
//  else //compute Johnson bound for A_q(n,d) when q > 2
    A := Floor( q^n / ( s + ( Binomial(n,t+1)*(q-1)^(t+1) - Binomial(d,t)*A_(K,n,d,d) ) / A_(K,n,d,t+1) ) ) ;
//  end if ;
  
  return A ;

end intrinsic ;
