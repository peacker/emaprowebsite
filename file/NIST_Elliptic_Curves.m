//////////////////////////////////////////////////////////////////////////////
// Work done by Emanuele Bellini,                                           //
// University of Trento, 2015.                                              //
//////////////////////////////////////////////////////////////////////////////

/*
The following NIST curves are defined:
P-192
P-224
P-256
P-384
P-521

K-163
B-163
*/

//////////////////////////////////////////////
//////////////// PRIME CURVES ////////////////
//////////////////////////////////////////////

// ---------------------------------------------------------------------------

intrinsic NIST_P_192 () -> CrvEll
{
  Return NIST curve P-192 and its size.
}
// NIST P-192
// E, n, G := NIST_P_192() ;
local p, q, K, a, b, E, n ;

  p := 2^192 - 2^64 - 1 ;
  q := p ;
  K := FiniteField(q) ;
  a := K!-3 ;
  b := K! 0x64210519e59c80e70fa7e9ab72243049feb8deecc146b9b1 ;
  E := EllipticCurve([K | a, b]) ;
  r := 6277101735386680763835789423176059013767194773182842284081 ;

  // base point
  Gx := K!0x188da80eb03090f67cbf20eb43a18800f4ff0afd82ff1012 ;
  Gy := K!0x07192b95ffc8da78631011ed6b24cdd573f977a11e794811 ;
  G := E![Gx,Gy] ;

  return E, r, G ;
end intrinsic ;

// ---------------------------------------------------------------------------

intrinsic NIST_P_224 () -> CrvEll
{
  Return NIST curve P-224 and its size.
}
// NIST P-224
// E, n, G := NIST_P_224() ;
local p, q, K, a, b, E, n ;

  p := 2^224 - 2^96 + 1 ;
  q := p ;
  K := FiniteField(q) ;
  a := K!-3 ;
  //b := K!18958286285566608000408668544493926415504680968679321075787234672564 ;
  b := K!0xb4050a850c04b3abf54132565044b0b7d7bfd8ba270b39432355ffb4 ;
  E := EllipticCurve([K | a, b]) ;
  r := 26959946667150639794667015087019625940457807714424391721682722368061 ;

  // base point
  Gx := K!0xb70e0cbd6bb4bf7f321390b94a03c1d356c21122343280d6115c1d21 ;
  Gy := K!0xbd376388b5f723fb4c22dfe6cd4375a05a07476444d5819985007e34 ;
  G := E![Gx,Gy] ;

  return E, r, G ;
end intrinsic ;

// ---------------------------------------------------------------------------

intrinsic NIST_P_256 () -> CrvEll
{
  Return NIST curve P-256 and its size.
}
// NIST P-256
// E, n, G := NIST_P_256() ;
local p, q, K, a, b, E, n ;

  p := 115792089210356248762697446949407573530086143415290314195533631308867097853951 ;
  //p := 2^256 - 2^224 + 2^192 + 2^96 - 1 ;
  q := p ;
  K := FiniteField(q) ;
  a := K!-3 ;
  //b := K!18958286285566608000408668544493926415504680968679321075787234672564 ;
  b := K!0x5ac635d8aa3a93e7b3ebbd55769886bc651d06b0cc53b0f63bce3c3e27d2604b ;
  E := EllipticCurve([K | a, b]) ;
  r := 115792089210356248762697446949407573529996955224135760342422259061068512044369 ;

  // base point
  Gx := K!0x6b17d1f2e12c4247f8bce6e563a440f277037d812deb33a0f4a13945d898c296 ;
  Gy := K!0x4fe342e2fe1a7f9b8ee7eb4a7c0f9e162bce33576b315ececbb6406837bf51f5 ;
  G := E![Gx,Gy] ;

  return E, r, G ;
end intrinsic ;

// ---------------------------------------------------------------------------

intrinsic NIST_P_384 () -> CrvEll
{
  Return NIST curve P-384 and its size.
}
// NIST P-384
// E, n, G := NIST_P_384() ;
local p, q, K, a, b, E, n ;

  p := 2^384 - 2^128 - 2^96 + 2^32 - 1 ; ;
  q := p ;
  K := FiniteField(q) ;
  a := K!-3 ;
  //a := K!0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEFFFFFFFF0000000000000000FFFFFFFC ;
  b := K!0xB3312FA7E23EE7E4988E056BE3F82D19181D9C6EFE8141120314088F5013875AC656398D8A2ED19D2A85C8EDD3EC2AEF ;
  E := EllipticCurve([K | a, b]) ;
  r := 6277101735386680763835789423176059013767194773182842284081 ;

  // base point
  Gx := K!0xAA87CA22BE8B05378EB1C71EF320AD746E1D3B628BA79B9859F741E082542A385502F25DBF55296C3A545E3872760AB7 ;
  Gy := K!0x3617DE4A96262C6F5D9E98BF9292DC29F8F41DBD289A147CE9DA3113B5F0B8C00A60B1CE1D7E819D7A431D7C90EA0E5F ;
  G := E![Gx,Gy] ;

  return E, r, G ;
end intrinsic ;

// ---------------------------------------------------------------------------

intrinsic NIST_521 () -> CrvEll
{
  Return NIST curve P-521 and its size.
}
// NIST P-521
// E, n, G := NIST_P_521() ;
local p, q, K, a, b, E, n ;

  //p := 6864797660130609714981900799081393217269435300143305409394463459185543183397656052122559640661454554977296311391480858037121987999716643812574028291115057151 ;
  p := 2^521 - 1 ;
  q := p ;
  K := FiniteField(q) ;
  a := K!-3 ;
  b := K!0x051953eb9618e1c9a1f929a21a0b68540eea2da725b99b315f3b8b489918ef109e156193951ec7e937b1652c0bd3bb1bf073573df883d2c34f1ef451fd46b503f00 ;
  P := EllipticCurve([K | a, b]) ;
  r := 6864797660130609714981900799081393217269435300143305409394463459185543183397655394245057746333217197532963996371363321113864768612440380340372808892707005449 ;

  // base point
  Gx := K!0xc6858e06b70404e9cd9e3ecb662395b4429c648139053fb521f828af606b4d3dbaa14b5e77efe75928fe1dc127a2ffa8de3348b3c1856a429bf97e7e31c2e5bd66 ;
  Gy := K!0x11839296a789a3bc0045c8a5fb42c7d1bd998f54449579b446817afbd17273e662c97ee72995ef42640c550b9013fad0761353c7086a272c24088be94769fd16650 ;
  G := E![Gx,Gy] ;

  return E, r, G ;
end intrinsic ;


///////////////////////////////////////////////
//////////////// BINARY CURVES ////////////////
///////////////////////////////////////////////

// PSEUDORANDOM BINARY CURVE
// E:  y^2 + x*y = x^3 + x^2 + b

// KOBLITZ CURVE
// E:  y^2 + x*y = x^3 + a*x^2 + 1
// a = 1 => cofactor = 2
// a = 0 => cofactor = 4

// ---------------------------------------------------------------------------

intrinsic NIST_K_163 () -> CrvEll
{
  Return NIST Koblitz curve K-163 and its size.
}
// NIST K-163
local R, m, f, base, K, a, E, r, c, gx, gy, P ;

  R<z> := PolynomialRing(GF(2)) ;
  m := 163 ;
  f := z^m + z^7 + z^6 + z^3 + 1 ;
  base := [z^i : i in [0..m-1]] ;
  K := ExtensionField< GF(2), z | f >  ; // F_2^163 with respect to the irreducible polynomial p
  a := K!1 ;
  E := EllipticCurve([K | 1,a,0,0,1]) ;
  r := 5846006549323611672814741753598448348329118574063 ;

  // base point (polynomial basis)
  c := IntegerToSequence(0x2fe13c0537bbc11acaa07d793de4e6d5e5c94eee8,2) ;
  gx := &+[c[i]*base[i] : i in [1..#c]] ;
  c := IntegerToSequence(0x289070fb05d38ff58321f2e800536d538ccdaa3d9,2) ;
  gy := &+[c[i]*base[i] : i in [1..#c]] ;
  G := E![gx,gy,1] ;

  return E, r, G ;
end intrinsic ;


// ---------------------------------------------------------------------------

intrinsic NIST_B_163 () -> CrvEll
{
  Return NIST Koblitz curve B-163 and its size.
}
// NIST B-163
local R, m, f, base, K, a, b, E, c, gx, gy, P ;

  R<z> := PolynomialRing(GF(2)) ;
  m := 163 ;
  f := z^m + z^7 + z^6 + z^3 + 1 ;
  base := [z^i : i in [0..m-1]] ;
  K := ExtensionField< GF(2), z | f >  ; // F_2^163 with respect to the irreducible polynomial p
  a := 1 ;
  c := IntegerToSequence(0x20a601907b8c953ca1481eb10512f78744a3205fd, 2) ; // coefficients vector
  b := &+[c[i]*base[i] : i in [1..#c]] ;

  E := EllipticCurve([K | 1,a,0,0,1]) ;

  h := 2 ; // cofactor
  r := 5846006549323611672814742442876390689256843201587 ;

  return E, h, r ;
end intrinsic ;

// ---------------------------------------------------------------------------
