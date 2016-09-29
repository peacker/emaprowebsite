<?php
  include "page_template.html"
?>

<div id="temp-content" style="display: none;">
<h3>AES with template</h3>
<hr>
<br>

<div class="cpp-index">
  <h4><u>Index</u></h4>

  <ul>
  <br>
  <b>Source</b>
    <li><a href="#tbbc_cpp">tbbc.cpp</a></li>
  <b>Headers</b>
    <li><a href="#tbbc_h">tbbc.h</a></li>
    <li><a href="#tbbc_hxx">tbbc.hxx</a></li>
    <li><a href="#tbbcaes_128m8s_h">tbbcAES_128m8s.h</a></li>
    <li><a href="#tbbcaes_128m8s_hxx">tbbcAES_128m8s.hxx</a></li>
    <li><a href="#tbbcbunny_24m24k_h">tbbcBUNNY_24m24k.h</a></li>
    <li><a href="#tbbcbunny_24m24k_hxx">tbbcBUNNY_24m24k.hxx</a></li>
    <li><a href="#myfunctions_h">myFunctions.h</a></li>
  </ul>
</div>

<br><br><hr><br>

<h4 id="tbbc_cpp">tbbc.cpp</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/

// tbbc.cpp : main function
//

//#ifdef WIN32
  //  #include "stdafx.h" // works for Visual C++ 2010
//#endif

#include &ltiostream>
#include &ltstdio.h>
#include &ltstdlib.h>
#include &lttime.h>
#include &ltiomanip> // to use the function setw()
#include &ltbitset> // to use the Bitset class
#include &ltmath.h>
#include &ltsstream> // used in ucharToString() to convert from unsigned char to string

#include "tbbc.h" //definition of the class TBBC
#include "tbbcAES_128m8s.h"   //definition of the class TBBCAES
#include "tbbcBUNNY_24m24k.h" //definition of the class TBBCBUNNY

using namespace std;


//instantiation of a TBBC, first create a type, then an instance of that type

typedef TBBCAES<128,10> AES_128_10 ; // define a type AES 
                                     // which is an instance of TBBCAES
                                     // 128 is key size
                                     // 10 is number of rounds
typedef TBBCAES<192,12> AES_192_12 ; // define a type AES 
typedef TBBCAES<256,14> AES_256_14 ; // define a type AES
typedef TBBCAES<64,5> AES_64_10 ; // define a type AES

typedef TBBCBUNNY<6,5> BUNNY_5 ; // define a type BUNNY

typedef TBBC<16,32,3,3> TBBC_16_32_3_3 ; // define a type TBBC

int main(int argc, char* argv[]) {
  cout << "|---------------------------------------|\n"
       << "|---------------------------------------|\n"
       << "|------------ Welcome to... ------------|\n"
       << "|---------------------------------------|\n"
       << "|----______---__-------__------___------|\n"
       << "|---|__  __|-|| \\-----|| \\----//  \\-----|\n"
       << "|------||----||_/-----||_/---||---------|\n"
       << "|------||----|| \\-----|| \\---||---------|\n"
       << "|------||----||  \\----||  \\--||---------|\n"
       << "|-----/__\\ . ||__/- . ||__/ . \\___/ . --|\n"
       << "|---------------------------------------|\n"
       << "|--- TRANSLATION-BASED BLOCK CIPHERS ---|\n"
       << "|---------------------------------------|\n"
       << "|---------------------------------------|\n\n" ;

  ////////////////////////////////////////////////////////////////////////////

  //AES_128_10 instantiation
  AES_128_10 aes_128_10 ;

  AES_128_10::msgType m128 ;
  AES_128_10::keyType k128 ;
  AES_128_10::msgType c128 ;

  cout << "----------------------------------------------------" << endl ;
  cout << "AES-128\n"
       << "PARAMETERS: |m|=128 |k|=128 |n|=10" << endl ;
  k128 = hexTo<bitset<128> >("2b7e151628aed2a6abf7158809cf4f3c") ;
  m128 = hexTo<bitset<128> >("6bc1bee22e409f96e93d7e117393172a") ;
  //k128 = hexTo<bitset<128> >("00000000000000000000000000000000") ;

  cout << "       k = " << bitsetToHex(k128) << endl ;
  c128 = aes_128_10.encode(m128,k128) ;
  cout << "       m = " << bitsetToHex(m128) << endl ;
  cout << "Enc(m,k) = " << bitsetToHex(c128) << endl ;
  cout << "Dec(c,k) = " << bitsetToHex(aes_128_10.decode(c128,k128)) << endl ;

  ////////////////////////////////////////////////////////////////////////////

  AES_192_12 aes_192_12 ;

  AES_192_12::msgType m192 ;
  AES_192_12::keyType k192 ;
  AES_192_12::msgType c192 ;

  cout << "----------------------------------------------------" << endl ;
  cout << "AES-192\n"
       << "PARAMETERS: |m|=128 |k|=192 |n|=12" << endl ;
  m128 = hexTo<bitset<128> >("6bc1bee22e409f96e93d7e117393172a") ;
  k192 = hexTo<bitset<192> >("8e73b0f7da0e6452c810f32b809079e562f8ead2522c6b7b") ;
  //k192 = hexTo<bitset<192> >("000102030405060708090a0b0c0d0e0f1011121314151617") ;
  cout << "       k = " << bitsetToHex(k192) << endl ;
  c128 = aes_192_12.encode(m128,k192) ;
  cout << "       m = " << bitsetToHex(m128) << endl ;
  cout << "Enc(m,k) = " << bitsetToHex(c128) << endl ;
  cout << "Dec(c,k) = " << bitsetToHex(aes_192_12.decode(c128,k192)) << endl ;

  ////////////////////////////////////////////////////////////////////////////

  AES_256_14 aes_256_14 ;

  AES_256_14::msgType m256 ;
  AES_256_14::keyType k256 ;
  AES_256_14::msgType c256 ;

  cout << "----------------------------------------------------" << endl ;
  cout << "AES-256\n"
       << "PARAMETERS: |m|=128 |k|=256 |n|=14" << endl ;
  m256 = hexTo<bitset<128> >("6bc1bee22e409f96e93d7e117393172a") ;
  //k256 = hexTo<bitset<256> >("0000000000000000000000000000000000000000000000000000000000000000") ;
  k256 = hexTo<bitset<256> >("603deb1015ca71be2b73aef0857d77811f352c073b6108d72d9810a30914dff4") ;
  cout << "       k = " << bitsetToHex(k256) << endl ;
  c256 = aes_256_14.encode(m256,k256) ;
  cout << "       m = " << bitsetToHex(m256) << endl ;
  cout << "Enc(m,k) = " << bitsetToHex(c256) << endl ;
  cout << "Dec(c,k) = " << bitsetToHex(aes_256_14.decode(c256,k256)) << endl ;

  ////////////////////////////////////////////////////////////////////////////

  //AES_64_10 instantiation
  AES_64_10 aes_64_10 ; //declare a variable of the type "AES_64_10"

  AES_64_10::msgType m64 ;
  AES_64_10::keyType k64 ;
  AES_64_10::msgType c64 ;

  cout << "----------------------------------------------------" << endl ;
  cout << "AES-64 (Non-standard scheme)\n"
       << "PARAMETERS: |m|=128 |k|=64 |n|=5" << endl ;
  m64 = hexTo<bitset<128> >("e93d7e117393172ae93d7e117393172a") ;
  k64 = hexTo<bitset<64> >("0102030405060708") ;

  cout << "       k = " << bitsetToHex(k64) << endl ;
  c64 = aes_64_10.encode(m64,k64) ;
  cout << "       m = " << bitsetToHex(m128) << endl ;
  cout << "Enc(m,k) = " << bitsetToHex(c64) << endl ;
  cout << "Dec(c,k) = " << bitsetToHex(aes_64_10.decode(c64,k64)) << endl ;

  ////////////////////////////////////////////////////////////////////////////

  //BUNNY_5 instantiation
  BUNNY_5 bunny_5 ; // declare a variable of the type "BUNNY_5"

  BUNNY_5::msgType m24 ;
  BUNNY_5::keyType k24 ;
  BUNNY_5::msgType c24 ;

  cout << "----------------------------------------------------" << endl ;
  cout << "BUNNY-24 (Non-standard scheme)\n"
       << "PARAMETERS: |m|=24 |k|=24 |n|=5" << endl ;
  m24 = hexTo<bitset<24> >("e93d7e") ;
  k24 = hexTo<bitset<24> >("010203") ;

  cout << "       k = " << bitsetToHex(k24) << endl ;
  c24 = bunny_5.encode(m24,k24) ;
  cout << "       m = " << bitsetToHex(m24) << endl ;
  cout << "Enc(m,k) = " << bitsetToHex(c24) << endl ;
  cout << "Dec(c,k) = " << bitsetToHex(bunny_5.decode(c24,k24)) << endl ;

  ////////////////////////////////////////////////////////////////////////////

  //TBBC_16_32_3_3 instantiation
  TBBC_16_32_3_3 tbbc ; // declare a variable of the type "TBBC_16_32_3_3"

  TBBC_16_32_3_3::msgType m ;
  TBBC_16_32_3_3::keyType k ;
  TBBC_16_32_3_3::msgType c ;

  cout << "----------------------------------------------------" << endl ;
  cout << "TBBC-16-32-3-3 (Identity cipher)\n"
       << "PARAMETERS: |m|=16 |k|=32 |sbox|=3 |n|=5" << endl ;
  m = hexTo<bitset<16> >("01ab") ;
  k = hexTo<bitset<32> >("0123abcd") ;

  cout << "       k = " << bitsetToHex(k) << endl ;
  c = tbbc.encode(m,k) ;
  cout << "       m = " << bitsetToHex(m) << endl ;
  cout << "Enc(m,k) = " << bitsetToHex(c) << endl ;
  cout << "Dec(c,k) = " << bitsetToHex(tbbc.decode(c,k)) << endl ;

  return 0 ;
}

</code>
</pre>

<br><br><hr><br>

<h4 id="tbbc_h">tbbc.h</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/

#ifndef TBBC_H
#define TBBC_H

#include &ltiostream>
#include &ltstdio.h>
#include &ltstdlib.h>
#include &lttime.h>
#include &ltiomanip> // to use the function setw()
#include &ltbitset> // to use the bitset class
#include &ltvector>

#include &ltmath.h>

#include &ltsstream>

#include "myFunctions.h"


#ifndef ASSERT1
  #include &ltsstream>
  #define ASSERT1(COND,MSG)                                     \
    if ( !(COND) ) {                                            \
      std::ostringstream ost ;                                  \
      ost << "\n--------------------------------------------"   \
          << "\nfile: " << __FILE__                             \
          << "\nline: " << __LINE__                             \
          << '\n' << MSG << '\n'                                \
          << "\n--------------------------------------------" ; \
      throw std::runtime_error(ost.str()) ;                     \
    }
#endif

#ifndef ASSERT
  #define ASSERT(COND,MSG)                                       \
    if ( !(COND) ) {                                             \
      cerr << "\n--------------------------------------------"   \
           << "\nfile: " << __FILE__                             \
           << "\nline: " << __LINE__                             \
           << '\n' << MSG << '\n'                                \
           << "\n--------------------------------------------" ; \
      exit(1) ;                                                  \
    }
#endif


using namespace std;

//! TBBC CLASS
/*!
This class allows to instantiate a block cipher working on nb_msg bits, 
with a master key of nb_key bits, whose s-boxes take input of nb_sbox bits, 
and with nround rounds.
*/
template <unsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
class TBBC {
  public:
    /*! Is the type of a message string (eg, bitset<128>, bitset<24>, etc..) */
    typedef bitset&ltnb_msg>       msgType ;
    /* ! Is the type of a key string (eg, bitset<256>, bitset<128>, etc..) */
    typedef bitset&ltnb_key>       keyType ;

    /*! Is the type of a message string which is input into the sBox 
       (e.g., bitset<8>, bitset<6>, etc..) */
    typedef bitset&ltnb_sbox>     sboxType ;
    /*! Is the type of a word string, 
        used in the keyschedule or in the mixing layer 
       (e.g., bitset<128*4>, etc..)*/
    typedef bitset&ltnb_sbox*4>     wordType ;
    /*! Is the type of the vector containing the round keys */
    typedef vector&ltmsgType> roundkeyType ;

    //! Contains the round keys
    roundkeyType rk;

    // CONSTRUCTORS
    TBBC() ;

    // Print functions
    void printParameter() ;

    // CODING FUNCTIONS
    virtual msgType encode( msgType m, keyType k ) ;
    virtual msgType decode( msgType m, keyType k ) ;

  protected:
    // ROUND FUNCTIONS
    // Sbox
    //   virtual ... " = 0 " means declared as pure virtual, 
    //   i.e. it will always be declared in class inheriting from this class
    // EX:
    // virtual sboxType sbox( unsigned nbox, sboxType x ) = 0 ; 
    virtual sboxType sbox( unsigned nbox, sboxType x ) ; 
    virtual sboxType sboxInverse( unsigned nbox, sboxType x ) ;

    virtual msgType sBox (msgType m) ; // sBox based on sbox
    virtual msgType sBoxInverse (msgType m)  ; // sBox based on sbox

    // Mixing layer
    virtual msgType mixingLayer (msgType m ) ;
    virtual msgType mixingLayerInverse (msgType m ) ;

    //Add round key
    virtual msgType addRoundKey (msgType m, msgType k) ;


    // KEY SCHEDULE
    virtual void keySchedule(keyType k) ;

  public:
    // MISC FUNCTIONS
    sboxType extractBlock           ( unsigned nblk, msgType x ) ;
    sboxType extractKeyBlock        ( unsigned nblk, keyType x ) ;
    sboxType extractFromWordToSboxType ( unsigned pos, wordType x ) ;
    msgType  insertBlock            ( msgType m, unsigned nblk, sboxType x ) ;
    msgType  copyIntoRoundKey       ( msgType m, unsigned pos, wordType x) ;
    wordType copyIntoWord           ( wordType m, unsigned pos, sboxType x) ;
    wordType extractWord            ( unsigned pos, keyType x ) ;
} ;

#include "tbbc.hxx"

#endif

</code>
</pre>

<br><br><hr><br>

<h4 id="tbbc_hxx">tbbc.hxx</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/

////////////////////////////////////////////////////
//////VIRTUAL//METHODS//OF//THE//BASE//CLASS////////
////////////////////////////////////////////////////

////////////////
//CONSTRUCTORS//
////////////////

/*!
Allocate the space needed to fill a vector containing all the round keys.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
TBBC&ltnb_msg, nb_key, nb_sbox,nround>::TBBC(){
  rk.resize(nround+1) ; // allocates memory for the round keys
}


/////////////////////////////////////////////////
////////////////MISC//FUNCTIONS//////////////////
/////////////////////////////////////////////////

//!Print to the terminal the current parameters of the block cipher.
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
void
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::printParameter() {
  std::cout << "-------------------------------\n" ;
  std::cout << "|  TBBC's PARAMETERS are:  " << setw (5) <<            "|\n" ;
  std::cout << "|       S-box size:      "   << setw (5) << nb_sbox << "|\n" ;
  std::cout << "|       Message size:    "   << setw (5) << nb_msg  << "|\n" ;
  std::cout << "|       Key size:        "   << setw (5) << nb_key  << "|\n" ;
  std::cout << "|       Number of Rounds:"   << setw (5) << nround  << "|\n" ;
  std::cout << "-------------------------------\n" ;
}

/*!
Extracts nb_sbox from a msgType x, i.e. extracts the block number nblk 
(block 0 is the rightmost) from x.
*/
/*!
Extracts nb_sbox bits in position [nblk*nb_sbox..nblk*nb_sbox + nb_sbox-1] 
from a string of type msgType and insert them in a string of type sboxType.

Exits from program if the position pos is negative or greater 
then the size of msgType minus the size of sboxType.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sboxType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::extractBlock( unsigned nblk, msgType x ) {
  sboxType y ;
  for ( unsigned i = 0 ; i < nb_sbox ; ++i) y[i] = x[i+nblk*nb_sbox] ;
  return y ;
}

/*!
Extracts nb_sbox from a keyType x, i.e. extracts the block number nblk 
(block 0 is the rightmost) from x.
*/
/*!
Extracts nb_sbox bits in position [nblk*nb_sbox..nblk*nb_sbox + nb_sbox-1] 
from a string of type keyType and insert them in a string of type sboxType.

Exits from program if the position pos is negative or greater 
then the size of keyType minus the size of sboxType.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sboxType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::extractKeyBlock( unsigned nblk, keyType x ) {
  sboxType y ;
  for ( unsigned i = 0 ; i < nb_sbox ; ++i) y[i] = x[i+nblk*nb_sbox] ;
  return y ;
}

/*! Extracts from word of type wordType nb_sbox bits and return 
them as an sboxType.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sboxType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::extractFromWordToSboxType( unsigned pos, wordType x ) {
  sboxType y ;
  ASSERT( pos <= (x.size() - y.size()) && pos >= 0,
    "Error: trying to extract from a position which is not allowed!" ) ;
  // this is because x[0] refers to the rightmost bit
  pos = x.size() - pos - y.size() ; 
  // std::copy( x.begin() + pos, x.begin() + pos + y.size(), y.begin() ) ;
  for ( unsigned i = 0 ; i < y.size() ; ++i) y[i] = x[i+pos] ;
  return y ;
}

/*! 
Copies the bitset x in m in the block nblk of m 
(to copy a string fitting the sbox size into a message).
*/
/*!
- INPUT: a message m of type msgType, 
         the position pos where to start the copy, 
         the part x of the message to be copied of type sboxType.

- OUTPUT: the new copy of m.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::insertBlock( msgType m, unsigned nblk, sboxType x ) {
  for (unsigned i = 0 ; i < nb_sbox ; ++i ) m[i+nblk*nb_sbox] = x[i] ;
  return m;
}

//!Copies the bitset x in m at position pos (to copy a word into a key).
/*!
- INPUT: a key m of type keyType, the position pos where to start the copy, 
         the part x of the message to be copied of type wordType.

- OUTPUT: the new copy of m.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::copyIntoRoundKey(msgType m, unsigned pos, wordType x){
  // this is because x[0] refers to the rightmost bit
  pos = m.size() - pos - x.size() ; 
  for (unsigned i = 0 ; i < x.size() ; ++i ) m[i+pos] = x[i] ;
  return m;
}

//! Copies the bitset x in m at position pos (to copy a word into a message).
/*!
- INPUT: a message m of type msgType, 
         the position pos where to start the copy, 
         the part x of the message to be copied of type wordType.

- OUTPUT: the new copy of m.
*/

template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::wordType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::copyIntoWord(wordType m, unsigned pos, sboxType x){
  // this is because x[0] refers to the rightmost bit
  pos = m.size() - pos - x.size() ; 
  for (unsigned i = 0 ; i < x.size() ; ++i ) m[i+pos] = x[i] ;
  return m;
}

//! Extract a word of 32 bits from a keyType element.
/*!
- INPUT: a key x, and the position pos which indicates 
         where the extraction has to be made.

- OUTPUT: a string y of 32 bits.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::wordType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::extractWord( unsigned pos, keyType x ) {
  wordType y ;
  ASSERT( pos <= (x.size() - y.size()) && pos >= 0,
    "Error: trying to extract from a position which is not allowed!" ) ;
  // this is because x[0] refers to the rightmost bit
  pos = x.size() - pos - y.size() ; 
  // std::copy( x.begin() + pos, x.begin() + pos + y.size(), y.begin() ) ;
  for ( unsigned i = 0 ; i < y.size() ; ++i) y[i] = x[i+pos] ;
  return y ;
}


//////////////////////////////////
///////ENCODING//FUNCTIONS////////
//////////////////////////////////

//!Encoding function for TBBC block cipher.
/*!
- INPUT: a message m of type msgType (a bitset of dimension N) and 
         a key k of type keyType (a bitset of dimension M).

- OUTPUT: an (encrypted) message c of the same type as m.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::encode( msgType m, keyType k ) {
  msgType c ;
  c = m ;

  keySchedule(k) ;

  //Round 0, a-tipical
  c = addRoundKey(c,rk[0]) ;
  //cout << "state at round: 0 --> " << bitsetToHex(c) << endl ;
  //Tipical rounds
  for (unsigned i = 1 ; i <= nround ; ++i){
    c = sBox(c) ;
    //cout << "state after sBox: --> " << bitsetToHex(c) << endl ;
    c = mixingLayer(c) ;
    //cout << "state after mixL: --> " << bitsetToHex(c) << endl ;
    c = addRoundKey(c,rk[i]) ;
    //cout << "state at round: " << i <<  " --> " << bitsetToHex(c) << endl ;
  }

  return c ;
}


//!Decoding function for TBBC block cipher.
/*!
- INPUT: a message m of type msgType (a bitset of dimension N) and 
         a key k of type keyType (a bitset of dimension M).

- OUTPUT: an (decrypted) message c of the same type as m.
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::decode (msgType m, keyType k) {
  msgType c ;
  c = m ;

  keySchedule(k) ;

  keySchedule(k) ;
  //Tipical rounds
  for (unsigned i = nround ; i > 0 ; --i){
    c = addRoundKey(c,rk[i]) ;
    c = mixingLayerInverse(c) ;
    c = sBoxInverse(c) ;
  }
  //Round 0, a-tipical
  c = addRoundKey(c,rk[0]) ;

  return c ;
}

//////////////////////////////////////////////
///////////////KEY-SCHEDULE///////////////////
//////////////////////////////////////////////

//!Key-Schedule STEP - Bunny's style.
/*!
Empty function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
void TBBC&ltnb_msg,nb_key,nb_sbox,nround>::keySchedule(keyType k) {

}



///////////////////////////////
////// TBBC Add Round Key//////
///////////////////////////////

//!Add round key STEP.
/*!
Identity function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::addRoundKey (msgType m, msgType k){
  return m ;
  //return m ^ k;
}

////////////////////////////////
////// TBBC Nonlinear Step//////
////////////////////////////////

//!TBBC S-box STEP.
/*!
Identity function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sBox (msgType m){
  msgType  c = m ;

  return c;
}

//!TBBC S-box Inverse STEP.
/*!
Identity function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sBoxInverse (msgType m){
  msgType  c = m ;

  return c;
}

//! S-box table
/*!
Identity function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sboxType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sbox(unsigned nbox, sboxType x) {

  return x ;
}

//! Inverse of the sbox
/*!
Identity function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sboxType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::sboxInverse(unsigned nbox, sboxType x) {

  return x ;
}
////////////////////////////////
//////// TBBC Linear Step///////
////////////////////////////////

//!TBBC Mixing Layer STEP.
/*!
Identity function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::mixingLayer (msgType m){
  msgType  c = m ;

  return c;
}

//!TBBC Mixing Layer Inverse STEP.
/*!
Identity function
*/
template &ltunsigned nb_msg, unsigned nb_key, unsigned nb_sbox, unsigned nround>
inline
typename TBBC&ltnb_msg,nb_key,nb_sbox,nround>::msgType
TBBC&ltnb_msg,nb_key,nb_sbox,nround>::mixingLayerInverse (msgType m){
  msgType  c = m ;

  return c;

}
</code>
</pre>


<br><br><hr><br>

<h4 id="tbbcaes_128m8s_h">tbbcAES_128m8s.h</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/

#include "tbbc.h"

//!TBBCAES CLASS
/*!
This class inherits the methods from TBBC class, 
and specifies the virtual methods which are different from TBBC's.

TBBCAES allows to instantiate a block cipher as AES working on 128 bits, 
with a master key of nb_key bits, whose s-box take input of 8 bits, 
and with nround rounds.
*/
template &ltunsigned nb_key, unsigned nround>
class TBBCAES : public TBBC<128,nb_key,8,nround> {
public:

  typedef TBBC<128,nb_key,8,nround> TBBC128_8 ;

  typedef typename TBBC128_8::msgType      msgType ;
  typedef typename TBBC128_8::keyType      keyType ;
  typedef typename TBBC128_8::sboxType     sboxType ;
  typedef typename TBBC128_8::wordType     wordType ;
  typedef typename TBBC128_8::roundkeyType roundkeyType ;

private:
  //! Contains the round keys
  roundkeyType rk;
  bitset<32> rcon[16] ; // Constant assigned to each keyschedule round

public:
  // CONSTRUCTORS
  TBBCAES() ;

  // CODING FUNCTIONS
  virtual msgType encode(msgType m, keyType k) ;
  virtual msgType decode(msgType m, keyType k) ;

private:
// if private can not be tested in main!!

  // SBOX

  virtual msgType sBox        ( msgType m ) ; // sBox based on sbox
  virtual msgType sBoxInverse ( msgType m )  ; // sBox based on sbox

  virtual sboxType sbox       ( unsigned nbox, sboxType x ) ;
  virtual sboxType sboxInverse( unsigned nbox, sboxType x ) ;

  // MIXING LAYER
  virtual msgType mixingLayer        ( msgType m )  ;
  virtual msgType mixingLayerInverse ( msgType m )  ;

  msgType shiftRows     ( msgType m ) const ;
  msgType shiftRowsInv  ( msgType m ) const ;
  msgType mixColumns    ( msgType m ) const ;
  msgType mixColumnsInv ( msgType m ) const ;

  // ADD ROUND KEY
  virtual msgType addRoundKey (msgType m, msgType k) ;

  // KEY SCHEDULE
  virtual void keySchedule(keyType k) ;

} ;

#include "tbbcAES_128m8s.hxx"
</code>
</pre>

<br><br><hr><br>

<h4 id="tbbcaes_128m8s_hxx">tbbcAES_128m8s.hxx</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/
////////////////////////////////////////
////////METHODS//FOR//AES//CLASS////////
////////////////////////////////////////

////////////////
//CONSTRUCTORS//
////////////////

/*!
Allocate the space needed to fill a vector containing all the round keys.
*/
template &ltunsigned nb_key, unsigned nround>
inline
TBBCAES&ltnb_key,nround>::TBBCAES(){
  rk.resize(nround+1) ; // allocates memory for the round keys
  rcon[0]  = bitset<32> (string("10001101000000000000000000000000"));
  rcon[1]  = bitset<32> (string("00000001000000000000000000000000"));
  rcon[2]  = bitset<32> (string("00000010000000000000000000000000"));
  rcon[3]  = bitset<32> (string("00000100000000000000000000000000"));
  rcon[4]  = bitset<32> (string("00001000000000000000000000000000"));
  rcon[5]  = bitset<32> (string("00010000000000000000000000000000"));
  rcon[6]  = bitset<32> (string("00100000000000000000000000000000"));
  rcon[7]  = bitset<32> (string("01000000000000000000000000000000"));
  rcon[8]  = bitset<32> (string("10000000000000000000000000000000"));
  rcon[9]  = bitset<32> (string("00011011000000000000000000000000"));
  rcon[10] = bitset<32> (string("00110110000000000000000000000000"));
  rcon[11] = bitset<32> (string("01101100000000000000000000000000"));
}

//////////////////////////////////
///////ENCODING//FUNCTIONS////////
//////////////////////////////////

//! Encoding function designed for AES block cipher.
/*!
- INPUT: a message m of type msgType (a bitset of dimension N) and 
         a key k of type keyType (a bitset of dimension M).

- OUTPUT: an (encrypted) message c of the same type as m.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::encode( msgType m, keyType k ) {
  msgType c ;
  c = m ;

  keySchedule(k) ; //use TBBCAES keyschedule

  //Round 0, a-tipical
  c = this->addRoundKey(c,rk[0]) ;
  //cout << "state at round: 0 --> " << bitsetToHex(c) << endl ;

  //TYPICAL rounds
  for (unsigned i = 1 ; i < nround ; ++i){
    //AES sBox
    c = sBox(c) ;
    //cout << "state after sBox: --> " << bitsetToHex(c) << endl ;

    // AES mixing layer
    c = shiftRows(c) ;
    c = mixColumns(c) ;
    //cout << "state after mixL: --> " << bitsetToHex(c) << endl ;

    //AES add round key
    c = this->addRoundKey(c,rk[i]) ;
    //cout << "state at round: " << i <<  " --> " << bitsetToHex(c) << endl ;
  }
  //AES sBox
  c = sBox(c) ;
  //cout << "state after sBox: --> " << bitsetToHex(c) << endl ;

  // AES mixing layer - ATYPICAL (no mixColumns)
  c = shiftRows(c) ;
  //cout << "state after mixL: --> " << bitsetToHex(c) << endl ;

  //AES add round key
  c = this->addRoundKey(c,rk[nround]) ;
  //cout << "state at round: " << nround << " --> " << bitsetToHex(c) << endl ;

  return c ;
}

//! Decoding function designed for AES block cipher.
/*!
- INPUT: a message m of type msgType (a bitset of dimension N) and 
         a key k of type keyType (a bitset of dimension M).

- OUTPUT: an (encrypted) message c of the same type as m.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::decode( msgType m, keyType k ) {
  msgType c ;
  c = m ;
  keySchedule(k) ; //use TBBCAES keyschedule

  //Round 0, a-tipical (no mixColumns Inverse)
  c = this->addRoundKey(c,rk[nround]) ;

  // AES mixing layer - ATYPICAL (no mixColumns)
  c = shiftRowsInv(c) ;

  //AES sBox
  c = sBoxInverse(c) ;

  //TYPICAL rounds
  for (unsigned i = nround - 1 ; i > 0 ; --i){
    //AES add round key
    c = this->addRoundKey(c,rk[i]) ;

    // AES mixing layer
    c = mixColumnsInv(c) ;
    c = shiftRowsInv(c) ;

    //AES sBox
    c = sBoxInverse(c) ;
  }

  //AES add round key
  c = this->addRoundKey(c,rk[0]) ;

  return c ;
}

//////////////////////////////////////////////////
///////////////AES KEY-SCHEDULE///////////////////
//////////////////////////////////////////////////

//! Key-Schedule STEP - AES style.
/*!
- INPUT: a master key k of type keyType.

- OUTPUT: return a pointer to a vector of msgType 
          (this elements are the round key, 
          which must be the same length/type as the message).
*/
template &ltunsigned nb_key, unsigned nround>
inline
void
TBBCAES&ltnb_key,nround>::keySchedule(keyType k) {
  //AES128 needs 11 round keys
  //AES128 needs 13 round keys
  //AES128 needs 15 round keys
  //nround is the number of rounds without counting the first whitening
  unsigned int n, b ;
  unsigned nk ; // number of 32-bit words in the cipher key (4,6,8)
  unsigned nb ; // number of words in the state (4)
  sboxType temp ;

  unsigned icon = 1 ; // index to count the costant rcon for each round
  b = (nround+1)*16 ; // 16 bytes * 11,13,15 rounds = 176,208,240
  n = nb_key / 8 ; // nb_sbox=8 is the sbox size
  //if      ( nb_key == 128 ) n = 16 ;
  //else if ( nb_key == 192 ) n = 24 ;
  //else if ( nb_key == 256 ) n = 32 ;
  nk = nb_key / 32 ; // 4, 6, 8
  nb = 4 ;

  //number of 32-bit-words generated
  unsigned nword = (nround+1) * nb ;// (nround+1) * 4

  //i.e.: nrow round keys at a time are filled
  //unsigned ncol = nb_msg/nb_sbox ;
  //unsigned nrow = nb_msg/nb_sbox + 1 ;

  vector&ltwordType> w ; // w will contains 32 bits words

  w.resize(nword) ; // initialize a vector of nword elements of type sboxType, 
                    // set to 00...0

  //CREATE w, a vector of nwords words
  //put the key bits in the first 16 words
  for (unsigned i = 0 ; i < nk ; ++i) {
    w[i] = this->extractWord(i*8*4,k) ;
    //cout << "w[" << i << "] = "<< bitsetToHex(w[i]) << endl ;
  }

  for (unsigned i = nk ; i < nword ; ++i){
    w[i] = w[i-1] ;
    if ( i % nk == 0){
      //Rotate the word w[i] 8 bits to the left
      w[i] = rotLeft(w[i],8) ;
      //Apply the sBoxes to w[i]
      for (unsigned j = 0 ; j < 4 ; ++j){
        // extract nb_sbox bits starting from left to right
        temp = this->extractFromWordToSboxType( j*8, w[i]) ; 
        // elaborate the nb_sbox bits extracted
        temp = sbox(1,temp) ; 
        // put temp in the position j*8 of the message w[i]
        w[i] = this->copyIntoWord(w[i],j*8,temp) ; 
      }
      //Exor rcon[i]
      w[i] = w[i] ^ rcon[icon] ;
      ++icon ;
    }
    else if (nk > 6 && (i % nk == 4)) {
      //Apply the sBoxes to w[i]
      for (unsigned j = 0 ; j < 4 ; ++j){
        // extract nb_sbox bits starting from left to right
        temp = this->extractFromWordToSboxType( j*8, w[i]) ; 
        // elaborate the nb_sbox bits extracted
        temp = sbox(1,temp) ; 
        // put temp in the position j*8 of the message w[i]
        w[i] = this->copyIntoWord(w[i],j*8,temp) ; 
      }
    }
    //Exor w[i-nk]
    w[i] = w[i] ^ w[i-nk] ;
    //cout << "w[" << i << "] = "<< bitsetToHex(w[i]) << endl ;
  }

  //CREATE the ROUND KEYS
  for (unsigned i = 0 ; i <= nround ; ++i) {
    for (unsigned j = 0 ; j < 4 ; ++j) {
      rk[i] = this->copyIntoRoundKey(rk[i], j*32, w[i*4+j]) ;
    }
    //cout << "rk[" << i << "] = " << bitsetToHex(rk[i]) << endl ;
  }
  return ;
}

///////////////////////////////
//////TBBC Add Round Key//////
///////////////////////////////
/*!
Add round key STEP.

Sum with a round key k, which must be the same length of the message m.

- INPUT: a message m of type msgType, and a round key k of type msgType 
         (the type must be the same as the message, 
         otherwise they can't be added together)

- OUTPUT: the exor of m and k
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::addRoundKey (msgType m, msgType k){
  return m ^ k;
}

//////////////////////////////////
////////LINEAR//FUNCTIONS/////////
//////////////////////////////////

//! ShiftRows STEP.
/*!
It is AES shift rows. Works for msgType of 128 bits, grouped in a 4x4 matrix of 16 bytes.

- INPUT: a message m of type msgType.

- OUTPUT: the message m elaborated by the shiftrow step.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::shiftRows (msgType m ) const {
  // Shift second row
  MoveBits(m, 112, 80, 8) ;
  MoveBits(m, 80, 48, 8) ;
  MoveBits(m, 48, 16, 8) ;
  // Shift third row
  MoveBits(m, 104, 40, 8) ;
  MoveBits(m, 72, 8, 8) ;
  // Shift fourth row
  MoveBits(m, 32, 0, 8) ;
  MoveBits(m, 64, 32, 8) ;
  MoveBits(m, 96, 64, 8) ;
  return m ;
}

//! ShiftRows Inverse STEP.
/*!
Does the opposite operation as the ShiftRows.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::shiftRowsInv (msgType m ) const {
  // Shift second row
  MoveBits(m, 16, 48, 8) ;
  MoveBits(m, 80, 48, 8) ;
  MoveBits(m, 112, 80, 8) ;
  // Shift third row
  MoveBits(m, 104, 40, 8) ;
  MoveBits(m, 72, 8, 8) ;
  // Shift fourth row
  MoveBits(m, 96, 64, 8) ;
  MoveBits(m, 64, 32, 8) ;
  MoveBits(m, 32, 0, 8) ;
  return m ;
}

//!MixColumns STEP.
/*!
It is AES mix columns step. It works for 128 bits messages. 
Takes 4 bytes at a time and creates a polynomial in \f$ F_2^8 \f$; 
this is then multiplied by another polynomial in the same field.

- INPUT: a message m of type msgType.

- OUTPUT: the message m elaborated by the mix columns step.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::mixColumns (msgType m ) const {
  unsigned char col[4] ;
  msgType c ;
  string msgStr = bitsetToHex(m) ;
  string tmp ;

  for (unsigned i = 0 ; i < 4 ; ++i){ //for each column do
    tmp.assign(msgStr,i*8,8) ;    // put in tmp a column as a string
    stringToUchar(tmp,col) ;    // put in col a column as unsigned char
    gmix_column(col) ;        // mix the column
                    // put in tmp the column mixed
    tmp.assign("") ;
    for (unsigned j = 0 ; j < sizeof(col) ; ++j)
      tmp.append(ucharToString(col[j])) ;
                    //replace the msg
    msgStr.replace(i*8,8,tmp) ;
  }
  return msgType (hexTo&ltbitset<128> >(msgStr)) ;
}

//! MixColumns Inverse STEP.
/*!
Inverse of the mix columns step.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::mixColumnsInv (msgType m ) const {
  unsigned char col[4] ;
  string  msgStr = bitsetToHex(m) ;
  string tmp ;

  for (unsigned i = 0 ; i < 4 ; ++i){ //for each column do
    tmp.assign(msgStr,i*8,8) ;        // put in tmp a column as a string
    stringToUchar(tmp,col) ;          // put in col a column as unsigned char
    gmix_columnInv(col) ;             // mix the column
                                      // put in tmp the column mixed
    tmp.assign("") ;
    for (unsigned j = 0 ; j < sizeof(col) ; ++j)
      tmp.append(ucharToString(col[j])) ;

    msgStr.replace(i*8,8,tmp) ;       //replace the msg
  }
  return msgType (hexTo&ltbitset<128 > >(msgStr)) ;
}

//!Mixing Layer STEP.
/*!
Combinations of the ShiftRows and the MixColumns steps.

- INPUT: a message m of type msgType.

- OUTPUT: the message m elaborated by shift rows and mix columns steps.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::mixingLayer (msgType m ) {
  msgType c ;
  c = m ;
  c = shiftRows(c) ;
  c = mixColumns(c) ;
  return c ;
}

//!Mixing Layer Inverse STEP.
/*!
Combinations of the MixColumnsInverse and the ShiftRowsInverse steps.

- INPUT: a message m of type msgType.

- OUTPUT: the message m elaborated by the inverse of mix columns and then the inverse of shift rows steps.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::mixingLayerInverse (msgType m ) {
  msgType c ;
  c = m ;
  c = mixColumnsInv(c) ;
  c = shiftRowsInv(c) ;
  return c ;
}

////////////////////////////////
///////AES Nonlinear Step///////
////////////////////////////////

//! AES S-box STEP.
/*!
This function receives a message and 
              applies the sboxes as many times as needed 
(it uses alwayas the same sbox table):

  m = (m_1, m_2, ..., m_3)  ===>  (sbox_1(m_1), sbox_2(m_2), ..., sbox_r(m_r))

- INPUT: a message m of type msgType.

- OUTPUT: the message m elaborated by the sbox.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::sBox (msgType m){
  msgType c ;
  c = m ;
  sboxType s ;

  unsigned n = 16 ; // nb_msg / nb_sbox ;
  for (unsigned i = 0 ; i < n ; ++i){
    s = this->extractBlock(i,m) ; // extract nb_sbox bits starting from left to right
    //For AES
    s = sbox(1,s) ; // elaborate the nb_sbox bits extracted
    c = this->insertBlock(c,i,s) ; // put nb_bit bits in the position i*nb_sbox of the message c
  }
  return c;
}

//! AES S-box Inverse STEP.
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::msgType
TBBCAES&ltnb_key,nround>::sBoxInverse (msgType m){
  msgType c ;
  c = m ;
  sboxType s ;

  unsigned n = 16 ; // nb_msg / nb_sbox ;
  for (unsigned i = 0 ; i < n ; ++i){
    s = this->extractBlock(i,m) ; // extract nb_sbox bits starting from left to right
    //For AES
    s = sboxInverse(1,s) ; // elaborate the nb_sbox bits extracted
    c = this->insertBlock(c,i,s) ; // put nb_bit bits in the position i*nb_sbox of the message c
  }
  return c;
}

//! S-box table
/*!
This finction works with 8 bits.

- INPUT: an element x of type sboxType.

- OUTPUT: an element of type sboxType elaborated by the sbox.

Note: the parameter nbox is not used, but has to be inserted.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::sboxType
TBBCAES&ltnb_key,nround>::sbox(unsigned nbox, sboxType x) {
  static int AES_sbox_table [256] = { 
      99,124,119,123,242,107,111,197, 48,  1,103, 43,254,215,171,118,
     202,130,201,125,250, 89, 71,240,173,212,162,175,156,164,114,192,
     183,253,147, 38, 54, 63,247,204, 52,165,229,241,113,216, 49, 21,
       4,199, 35,195, 24,150,  5,154,  7, 18,128,226,235, 39,178,117,
       9,131, 44, 26, 27,110, 90,160, 82, 59,214,179, 41,227, 47,132,
      83,209,  0,237, 32,252,177, 91,106,203,190, 57, 74, 76, 88,207,
     208,239,170,251, 67, 77, 51,133, 69,249,  2,127, 80, 60,159,168,
      81,163, 64,143,146,157, 56,245,188,182,218, 33, 16,255,243,210,
     205, 12, 19,236, 95,151, 68, 23,196,167,126, 61,100, 93, 25,115,
      96,129, 79,220, 34, 42,144,136, 70,238,184, 20,222, 94, 11,219,
     224, 50, 58, 10, 73,  6, 36, 92,194,211,172, 98,145,149,228,121,
     231,200, 55,109,141,213, 78,169,108, 86,244,234,101,122,174,  8,
     186,120, 37, 46, 28,166,180,198,232,221,116, 31, 75,189,139,138,
     112, 62,181,102, 72,  3,246, 14, 97, 53, 87,185,134,193, 29,158,
     225,248,152, 17,105,217,142,148,155, 30,135,233,206, 85, 40,223,
     140,161,137, 13,191,230, 66,104, 65,153, 45, 15,176, 84,187, 22 } ;
  return sboxType ( AES_sbox_table[x.to_ulong()] );
}

//! Inverse of the sbox
/*!
This finction works with 8 bits.

- INPUT: an element x of type sboxType.

- OUTPUT: an element of type sboxType elaborated by the inverse of the sbox function.

Note: the parameter nbox is not used, but has to be inserted.
*/
template &ltunsigned nb_key, unsigned nround>
inline
typename TBBCAES&ltnb_key,nround>::sboxType
TBBCAES&ltnb_key,nround>::sboxInverse(unsigned nbox, sboxType x) {
  static int AES_sbox_Inv_table [256] = {
     82,  9,106,213, 48, 54,165, 56,191, 64,163,158,129,243,215,251,
    124,227, 57,130,155, 47,255,135, 52,142, 67, 68,196,222,233,203,
     84,123,148, 50,166,194, 35, 61,238, 76,149, 11, 66,250,195, 78,
      8, 46,161,102, 40,217, 36,178,118, 91,162, 73,109,139,209, 37,
    114,248,246,100,134,104,152, 22,212,164, 92,204, 93,101,182,146,
    108,112, 72, 80,253,237,185,218, 94, 21, 70, 87,167,141,157,132,
    144,216,171,  0,140,188,211, 10,247,228, 88,  5,184,179, 69,  6,
    208, 44, 30,143,202, 63, 15,  2,193,175,189,  3,  1, 19,138,107,
     58,145, 17, 65, 79,103,220,234,151,242,207,206,240,180,230,115,
    150,172,116, 34,231,173, 53,133,226,249, 55,232, 28,117,223,110,
     71,241, 26,113, 29, 41,197,137,111,183, 98, 14,170, 24,190, 27,
    252, 86, 62, 75,198,210,121, 32,154,219,192,254,120,205, 90,244,
     31,221,168, 51,136,  7,199, 49,177, 18, 16, 89, 39,128,236, 95,
     96, 81,127,169, 25,181, 74, 13, 45,229,122,159,147,201,156,239,
    160,224, 59, 77,174, 42,245,176,200,235,187, 60,131, 83,153, 97,
     23, 43,  4,126,186,119,214, 38,225,105, 20, 99, 85, 33, 12,125 } ;
  return sboxType ( AES_sbox_Inv_table[x.to_ulong()] );
}
</code>
</pre>

<br><br><hr><br>

<h4 id="tbbcbunny_24m24k_h">tbbcBUNNY_24m24k.h</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/

#include "tbbc.h"

//! TBBCBUNNY CLASS
/*!
This class allows to instantiate a block cipher working on 24 bits, 
with a master key of 24 bits, whose s-boxes take input of nb_sbox bits, 
and with nround rounds.
*/
template &ltunsigned nb_sbox, unsigned nround>
class TBBCBUNNY : public TBBC&lt24,24,nb_sbox,nround> {
public:

  typedef TBBC&lt24,24,nb_sbox,nround> TBBC2424 ;

  typedef typename TBBC2424::msgType      msgType ;
  typedef typename TBBC2424::keyType      keyType ;
  typedef typename TBBC2424::sboxType     sboxType ;
  typedef typename TBBC2424::wordType     wordType ;
  typedef typename TBBC2424::roundkeyType roundkeyType ;

  //! Contains the round keys
  roundkeyType rk;

  // CONSTRUCTORS
  TBBCBUNNY() ;

  // CODING FUNCTIONS
  virtual msgType encode(msgType m, keyType k) ;
  virtual msgType decode(msgType m, keyType k) ;

private:

  // SBOX
  virtual sboxType sbox( unsigned nbox, sboxType x ) ;
  virtual sboxType sboxInverse( unsigned nbox, sboxType x ) ;

  // MIXING LAYER
  virtual msgType mixingLayer (msgType m ) ;
  virtual msgType mixingLayerInverse (msgType m ) ;

  // ADD ROUND KEY
  virtual msgType addRoundKey (msgType m, msgType k) ;

  // KEY SCHEDULE
  virtual void keySchedule(keyType k) ;

} ;


#include "tbbcBUNNY_24m24k.hxx"
</code>
</pre>

<br><br><hr><br>

<h4 id="tbbcbunny_24m24k_hxx">tbbcBUNNY_24m24k.hxx</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/

//CONSTRUCTOR
//!Constructor
/*!
Allocate the space needed to fill a vector containing all the round keys.
*/
template &ltunsigned nb_sbox, unsigned nround>
inline
TBBCBUNNY&ltnb_sbox,nround>::TBBCBUNNY(){
  rk.resize(nround+1) ; // allocates memory for the round keys
}

/*!
Encoding function for TBBC block cipher.

- INPUT: a message m of type msgType (a bitset of dimension N) 
         and a key k of type keyType (a bitset of dimension M).

- OUTPUT: an (encrypted) message c of the same type as m.
*/
template &ltunsigned nb_sbox, unsigned nround>
inline
typename TBBCBUNNY&ltnb_sbox,nround>::msgType
TBBCBUNNY&ltnb_sbox,nround>::encode( msgType m, keyType k ) {
  msgType c ;
  c = m ;
  keySchedule(k) ;
  //Round 0, a-tipical
  c = addRoundKey(c,rk[0]) ;
  //cout << "state at round: 0 --> " << bitsetToHex(c) << endl ;
  //Tipical rounds
  for (unsigned i = 1 ; i <= nround ; ++i){
    c = this->sBox(c) ;
    //cout << "state after sBox: --> " << bitsetToHex(c) << endl ;
    c = mixingLayer(c) ;
    //cout << "state after mixL: --> " << bitsetToHex(c) << endl ;
    c = addRoundKey(c,rk[i]) ;
    //cout << "state at round: " << i <<  " --> " << bitsetToHex(c) << endl ;
  }
  return c ;
}

/*!
Decoding function for TBBC block cipher.

- INPUT: a message m of type msgType (a bitset of dimension N) and a key k of type keyType (a bitset of dimension M).

- OUTPUT: an (decrypted) message c of the same type as m.
*/
template &ltunsigned nb_sbox, unsigned nround>
inline
typename TBBCBUNNY&ltnb_sbox,nround>::msgType
TBBCBUNNY&ltnb_sbox,nround>::decode (msgType m, keyType k) {
  msgType c ;
  c = m ;
  //keyschedule
  keySchedule(k) ;
  //Tipical rounds
  for (unsigned i = nround ; i > 0 ; --i){
    c = addRoundKey(c,rk[i]) ;
    //cout <<   "state after add round: " << i <<  " --> " << bitsetToHex(c) << endl ;
    c = mixingLayerInverse(c) ;
    //cout << "state after mixLInv: --> " << bitsetToHex(c) << endl ;
    c = this->sBoxInverse(c) ;
    //cout << "state after sBoxInv: --> " << bitsetToHex(c) << endl ;
  }
  //Round 0, a-tipical
  c = addRoundKey(c,rk[0]) ;
  return c ;
}

//////////////////////////////////////////////
///////////////KEY-SCHEDULE///////////////////
//////////////////////////////////////////////
/*!
Key-Schedule STEP - TBBC's style.

- INPUT: a master key k of type keyType.

- OUTPUT: return a pointer to a vector of msgType 
          (this elements are the round key, 
          which must be the same length/type as the message).
*/
template &ltunsigned nb_sbox, unsigned nround>
inline
void TBBCBUNNY&ltnb_sbox,nround>::keySchedule(keyType k) {
  //number of word generated
  unsigned nword = 80 ;//(nround+10) * 4 ;//to have some more bitsj
  //dimension of the blocks that fill the round keys
  //i.e.: nrow round keys at a time are filled
  unsigned nb_msg = 24 ;
  unsigned ncol   = nb_msg/nb_sbox ;
  unsigned nrow   = nb_msg/nb_sbox + 1 ;
  vector&ltsboxType> w ;

  w.resize(nword) ; // initialize a vector of nword elements of type sboxType, 
                    // set to 00...0

  //CREATE W, a vector of 80 words
  //put the key bits in the first 4 words
  for (unsigned i = 0 ; i < ncol ; ++i) w[i] = this->extractBlock(i,k) ;

  w[4] = sbox(0,w[0]) ^ w[1];
  w[5] = sbox(1,w[1]) ^ w[2];
  w[6] = sbox(2,w[2]) ^ w[3];
  w[7] = sbox(3,w[3]) ^ w[0];

  for (unsigned i = 8; i < w.size() ; ++i){
      // se i = 0 mod 8 => w[i] = w[i-8] ^ s2(RB(w[i-1])) + 101010
      if (i % 8 == 0) w[i] = w[i-8] ^ sbox(1,(w[i-1]<<1)) ^ sboxType (string("101010")) ;
      // se i = 4 mod 8 => w[i] = w[i-8] ^ sbox(2,w[i-1])
      else if (i % 8 == 4) w[i] = w[i-8] ^ sbox(2,w[i-1]) ;
      // se i != 0 mod 4 w[i] = w[i-8] ^ w[i-1]
      else w[i] = w[i-8] ^ w[i-1] ;
  }

  //CREATE the ROUND KEYS
  //0,5,10,15
  //1,6,11,16
  //2,7,12,17
  //3,8,13,18
  //4,9,14,19
  //..
  //20,25,30,35...
  unsigned pos = 0 ;
  for (unsigned i = 0 ; i <= nround ; ++i){
    if ( (i % nrow) == 0 ) pos = i * ncol ;
    for (unsigned j = 0 ; j < ncol ; ++j){
      rk[i] = this->insertBlock(rk[i],j,w[pos+j*nrow]) ;
    }
    ++pos ;
  }

  //Print W
  /*cout << endl ;
  cout << "k = " << k << endl ;
  cout << "W = " << endl ;
  for (unsigned i = 0; i < w.size() ; ++i){
    if (i % 4 == 3) cout << " " << w[i] << endl ;
    else cout << " " << w[i] ;
  }*/
return ;
}

///////////////////////////////
//////TBBC Add Round Key//////
///////////////////////////////
/*!
Add round key STEP.

Sum with a round key k, which must be the same length of the message m.

- INPUT: a message m of type msgType, and a round key k of type msgType 
         (the type must be the same as the message, 
         otherwise they can't be added together)

- OUTPUT: the exor of m and k
*/
template &ltunsigned nb_sbox, unsigned nround>
inline
typename TBBCBUNNY&ltnb_sbox,nround>::msgType
TBBCBUNNY&ltnb_sbox,nround>::addRoundKey (msgType m, msgType k){
  return m ^ k;
}


//////////////////////////////
//////TBBC Mixing Layer//////
//////////////////////////////
/*!
Mixing-Layer STEP.

It is always a linear function, which in the case of TBBC block cipher 
it is implemented as a multiplication by a 24x24 matrix.

- INPUT: a message m of type msgType.

- OUTPUT: the message m elaborated by the mixing layer.
*/
template &ltunsigned nb_sbox, unsigned nround>
inline
typename TBBCBUNNY&ltnb_sbox,nround>::msgType
TBBCBUNNY&ltnb_sbox,nround>::mixingLayer (msgType m ) {
  unsigned const nb_msg = 24 ;
  bitset&ltnb_msg> lambda[nb_msg] ;
  msgType c ;
  // creation of lambda
  if (m.size() == 24) {
    lambda[0]  = bitset&ltnb_msg> (string("001010001000110011100101"));
    lambda[1]  = bitset&ltnb_msg> (string("000101000100110100111111"));
    lambda[2]  = bitset&ltnb_msg> (string("101111000010011010110010"));
    lambda[3]  = bitset&ltnb_msg> (string("111010000001001101011001"));
    lambda[4]  = bitset&ltnb_msg> (string("011101101101101011100001"));
    lambda[5]  = bitset&ltnb_msg> (string("100011111011111000111101"));
    lambda[6]  = bitset&ltnb_msg> (string("100001000101011000000010"));
    lambda[7]  = bitset&ltnb_msg> (string("111101101111001100000001"));
    lambda[8]  = bitset&ltnb_msg> (string("110011111010000110101101"));
    lambda[9]  = bitset&ltnb_msg> (string("110100011101000011111011"));
    lambda[10] = bitset&ltnb_msg> (string("011010100011101100110000"));
    lambda[11] = bitset&ltnb_msg> (string("001101111100010110011000"));
    lambda[12] = bitset&ltnb_msg> (string("111011110001111000001001"));
    lambda[13] = bitset&ltnb_msg> (string("110000110101011100101001"));
    lambda[14] = bitset&ltnb_msg> (string("011000110111001110111001"));
    lambda[15] = bitset&ltnb_msg> (string("001100110110000111110001"));
    lambda[16] = bitset&ltnb_msg> (string("000110011011101110110101"));
    lambda[17] = bitset&ltnb_msg> (string("000011100000010111110111"));
    lambda[18] = bitset&ltnb_msg> (string("110000011100110011001110"));
    lambda[19] = bitset&ltnb_msg> (string("011000001110110100000111"));
    lambda[20] = bitset&ltnb_msg> (string("001100000111011010101110"));
    lambda[21] = bitset&ltnb_msg> (string("000110101110001101010111"));
    lambda[22] = bitset&ltnb_msg> (string("000011010111101011100110"));
    lambda[23] = bitset&ltnb_msg> (string("101100100110111000010011"));

    // To acces element (I,J) of matrix lambda use:
    // lambda(I,J) = lambda[I+J*nb_msg]
    // vector x matrix PRODUCT
    for ( unsigned i = 0 ; i < nb_msg ; ++i ){
      c[i] = 0 ;
      for ( unsigned j = 0 ; j < nb_msg ; ++j ) {
        c[i] = c[i] ^ ( m[j] & lambda[nb_msg-j-1][i] ) ;
      }
    }
  }
  else if (m.size() == 128){
    /*
    lambda[0]   = bitset&ltnb_msg> (string("00011101100000001000000010011101000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[1]   = bitset&ltnb_msg> (string("10000000010000000100000011000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[2]   = bitset&ltnb_msg> (string("01000000001000000010000001100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[3]   = bitset&ltnb_msg> (string("00100000000100000001000000110000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[4]   = bitset&ltnb_msg> (string("00010000000010000000100000011000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[5]   = bitset&ltnb_msg> (string("00001000000001000000010000001100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[6]   = bitset&ltnb_msg> (string("00000100000000100000001000000110000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[7]   = bitset&ltnb_msg> (string("00000010000000010000000100000011000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[8]   = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010011101000111011000000010000000"));
    lambda[9]   = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000011000000100000000100000001000000"));
    lambda[10]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001100000010000000010000000100000"));
    lambda[11]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000110000001000000001000000010000"));
    lambda[12]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000011000000100000000100000001000"));
    lambda[13]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001100000010000000010000000100"));
    lambda[14]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000110000001000000001000000010"));
    lambda[15]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000011000000100000000100000001"));
    lambda[16]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000001000000010011101000111011000000000000000000000000000000000000000"));
    lambda[17]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000100000011000000100000000100000000000000000000000000000000000000"));
    lambda[18]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000010000001100000010000000010000000000000000000000000000000000000"));
    lambda[19]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000001000000110000001000000001000000000000000000000000000000000000"));
    lambda[20]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000100000011000000100000000100000000000000000000000000000000000"));
    lambda[21]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000010000001100000010000000010000000000000000000000000000000000"));
    lambda[22]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000001000000110000001000000001000000000000000000000000000000000"));
    lambda[23]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000100000011000000100000000100000000000000000000000000000000"));
    lambda[24]  = bitset&ltnb_msg> (string("00000000000000000000000000000000100000001000000010011101000111010000000000000000000000000000000000000000000000000000000000000000"));
    lambda[25]  = bitset&ltnb_msg> (string("00000000000000000000000000000000010000000100000011000000100000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[26]  = bitset&ltnb_msg> (string("00000000000000000000000000000000001000000010000001100000010000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[27]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000100000001000000110000001000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[28]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000010000000100000011000000100000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[29]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000001000000010000001100000010000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[30]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000100000001000000110000001000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[31]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000010000000100000011000000100000000000000000000000000000000000000000000000000000000000000000"));
    lambda[32]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000111011000000010000000100111010000000000000000000000000000000000000000000000000000000000000000"));
    lambda[33]  = bitset&ltnb_msg> (string("00000000000000000000000000000000100000000100000001000000110000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[34]  = bitset&ltnb_msg> (string("00000000000000000000000000000000010000000010000000100000011000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[35]  = bitset&ltnb_msg> (string("00000000000000000000000000000000001000000001000000010000001100000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[36]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000100000000100000001000000110000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[37]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000010000000010000000100000011000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[38]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000001000000001000000010000001100000000000000000000000000000000000000000000000000000000000000000"));
    lambda[39]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000100000000100000001000000110000000000000000000000000000000000000000000000000000000000000000"));
    lambda[40]  = bitset&ltnb_msg> (string("10011101000111011000000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[41]  = bitset&ltnb_msg> (string("11000000100000000100000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[42]  = bitset&ltnb_msg> (string("01100000010000000010000000100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[43]  = bitset&ltnb_msg> (string("00110000001000000001000000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[44]  = bitset&ltnb_msg> (string("00011000000100000000100000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[45]  = bitset&ltnb_msg> (string("00001100000010000000010000000100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[46]  = bitset&ltnb_msg> (string("00000110000001000000001000000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[47]  = bitset&ltnb_msg> (string("00000011000000100000000100000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[48]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000000100111010001110110000000"));
    lambda[49]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000110000001000000001000000"));
    lambda[50]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000011000000100000000100000"));
    lambda[51]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000001100000010000000010000"));
    lambda[52]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000110000001000000001000"));
    lambda[53]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000011000000100000000100"));
    lambda[54]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000001100000010000000010"));
    lambda[55]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000110000001000000001"));
    lambda[56]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000001000000010000000100111010001110100000000000000000000000000000000"));
    lambda[57]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000100000001000000110000001000000000000000000000000000000000000000"));
    lambda[58]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000010000000100000011000000100000000000000000000000000000000000000"));
    lambda[59]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000001000000010000001100000010000000000000000000000000000000000000"));
    lambda[60]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000100000001000000110000001000000000000000000000000000000000000"));
    lambda[61]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000010000000100000011000000100000000000000000000000000000000000"));
    lambda[62]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000001000000010000001100000010000000000000000000000000000000000"));
    lambda[63]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000100000001000000110000001000000000000000000000000000000000"));
    lambda[64]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000001110110000000100000001001110100000000000000000000000000000000"));
    lambda[65]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000001000000001000000010000001100000000000000000000000000000000000000"));
    lambda[66]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000100000000100000001000000110000000000000000000000000000000000000"));
    lambda[67]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000010000000010000000100000011000000000000000000000000000000000000"));
    lambda[68]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000001000000001000000010000001100000000000000000000000000000000000"));
    lambda[69]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000100000000100000001000000110000000000000000000000000000000000"));
    lambda[70]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000010000000010000000100000011000000000000000000000000000000000"));
    lambda[71]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000001000000001000000010000001100000000000000000000000000000000"));
    lambda[72]  = bitset&ltnb_msg> (string("00000000000000000000000000000000100111010001110110000000100000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[73]  = bitset&ltnb_msg> (string("00000000000000000000000000000000110000001000000001000000010000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[74]  = bitset&ltnb_msg> (string("00000000000000000000000000000000011000000100000000100000001000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[75]  = bitset&ltnb_msg> (string("00000000000000000000000000000000001100000010000000010000000100000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[76]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000110000001000000001000000010000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[77]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000011000000100000000100000001000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[78]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000001100000010000000010000000100000000000000000000000000000000000000000000000000000000000000000"));
    lambda[79]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000110000001000000001000000010000000000000000000000000000000000000000000000000000000000000000"));
    lambda[80]  = bitset&ltnb_msg> (string("10000000100111010001110110000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[81]  = bitset&ltnb_msg> (string("01000000110000001000000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[82]  = bitset&ltnb_msg> (string("00100000011000000100000000100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[83]  = bitset&ltnb_msg> (string("00010000001100000010000000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[84]  = bitset&ltnb_msg> (string("00001000000110000001000000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[85]  = bitset&ltnb_msg> (string("00000100000011000000100000000100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[86]  = bitset&ltnb_msg> (string("00000010000001100000010000000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[87]  = bitset&ltnb_msg> (string("00000001000000110000001000000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[88]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000000100000001001110100011101"));
    lambda[89]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000010000001100000010000000"));
    lambda[90]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000001000000110000001000000"));
    lambda[91]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000000100000011000000100000"));
    lambda[92]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000010000001100000010000"));
    lambda[93]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000001000000110000001000"));
    lambda[94]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000000100000011000000100"));
    lambda[95]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000010000001100000010"));
    lambda[96]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000011101100000001000000010011101"));
    lambda[97]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000000010000000100000011000000"));
    lambda[98]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000001000000010000001100000"));
    lambda[99]  = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000000100000001000000110000"));
    lambda[100] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000000010000000100000011000"));
    lambda[101] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000001000000010000001100"));
    lambda[102] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000000100000001000000110"));
    lambda[103] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010000000010000000100000011"));
    lambda[104] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000001001110100011101100000001000000000000000000000000000000000000000"));
    lambda[105] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000001100000010000000010000000100000000000000000000000000000000000000"));
    lambda[106] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000110000001000000001000000010000000000000000000000000000000000000"));
    lambda[107] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000011000000100000000100000001000000000000000000000000000000000000"));
    lambda[108] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000001100000010000000010000000100000000000000000000000000000000000"));
    lambda[109] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000110000001000000001000000010000000000000000000000000000000000"));
    lambda[110] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000011000000100000000100000001000000000000000000000000000000000"));
    lambda[111] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000000000000000000000000000000000001100000010000000010000000100000000000000000000000000000000"));
    lambda[112] = bitset&ltnb_msg> (string("00000000000000000000000000000000100000001001110100011101100000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[113] = bitset&ltnb_msg> (string("00000000000000000000000000000000010000001100000010000000010000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[114] = bitset&ltnb_msg> (string("00000000000000000000000000000000001000000110000001000000001000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[115] = bitset&ltnb_msg> (string("00000000000000000000000000000000000100000011000000100000000100000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[116] = bitset&ltnb_msg> (string("00000000000000000000000000000000000010000001100000010000000010000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[117] = bitset&ltnb_msg> (string("00000000000000000000000000000000000001000000110000001000000001000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[118] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000100000011000000100000000100000000000000000000000000000000000000000000000000000000000000000"));
    lambda[119] = bitset&ltnb_msg> (string("00000000000000000000000000000000000000010000001100000010000000010000000000000000000000000000000000000000000000000000000000000000"));
    lambda[120] = bitset&ltnb_msg> (string("10000000100000001001110100011101000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[121] = bitset&ltnb_msg> (string("01000000010000001100000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[122] = bitset&ltnb_msg> (string("00100000001000000110000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[123] = bitset&ltnb_msg> (string("00010000000100000011000000100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[124] = bitset&ltnb_msg> (string("00001000000010000001100000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[125] = bitset&ltnb_msg> (string("00000100000001000000110000001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[126] = bitset&ltnb_msg> (string("00000010000000100000011000000100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    lambda[127] = bitset&ltnb_msg> (string("00000001000000010000001100000010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"));
    */
    }

  return c ;
}

/*!
Mixing-Layer Inverse STEP.
*/
template &ltunsigned nb_sbox, unsigned nround>
inline
typename TBBCBUNNY&ltnb_sbox,nround>::msgType
TBBCBUNNY&ltnb_sbox,nround>::mixingLayerInverse (msgType m ){
    unsigned const nb_msg = 24 ;
  bitset&ltnb_msg> lambda[nb_msg] ;
  msgType c ;
  //creazione di lambda
  if (m.size() == 24){
    lambda[0]  = bitset&ltnb_msg> (string("010100111011001100100010"));
    lambda[1]  = bitset&ltnb_msg> (string("001010110000000110010001"));
    lambda[2]  = bitset&ltnb_msg> (string("000101011000000011100101"));
    lambda[3]  = bitset&ltnb_msg> (string("101111001100101100111111"));
    lambda[4]  = bitset&ltnb_msg> (string("111010000110010110110010"));
    lambda[5]  = bitset&ltnb_msg> (string("011101000011001011011001"));
    lambda[6]  = bitset&ltnb_msg> (string("010101001011011110100101"));
    lambda[7]  = bitset&ltnb_msg> (string("100111101000001111111111"));
    lambda[8]  = bitset&ltnb_msg> (string("111110010100101010110010"));
    lambda[9]  = bitset&ltnb_msg> (string("011111001010010101011001"));
    lambda[10] = bitset&ltnb_msg> (string("100010000101100111100001"));
    lambda[11] = bitset&ltnb_msg> (string("010001101111111110111101"));
    lambda[12] = bitset&ltnb_msg> (string("001101111000010011000001"));
    lambda[13] = bitset&ltnb_msg> (string("101011011100100100101101"));
    lambda[14] = bitset&ltnb_msg> (string("111000001110010010111011"));
    lambda[15] = bitset&ltnb_msg> (string("011100000111001001110000"));
    lambda[16] = bitset&ltnb_msg> (string("001110101110101001011000"));
    lambda[17] = bitset&ltnb_msg> (string("000111010111111001001100"));
    lambda[18] = bitset&ltnb_msg> (string("101100101000100001100110"));
    lambda[19] = bitset&ltnb_msg> (string("010110010100111101010011"));
    lambda[20] = bitset&ltnb_msg> (string("001011001010110011100100"));
    lambda[21] = bitset&ltnb_msg> (string("101000000101110100010010"));
    lambda[22] = bitset&ltnb_msg> (string("010100101111011010001001"));
    lambda[23] = bitset&ltnb_msg> (string("001010111010001101101001"));
  }
  else if (m.size() == 128){
      /*
      lambda[0]  = bitset&ltnb_msg> (string("01010011000000000000000000000000000000001111010000000000000000000000000000000000110011100000000000000000000000000000000011101001"));
      lambda[1]  = bitset&ltnb_msg> (string("10100111000000000000000000000000000000000111101000000000000000000000000000000000011001110000000000000000000000000000000011111010"));
      lambda[2]  = bitset&ltnb_msg> (string("11011101000000000000000000000000000000000011110100000000000000000000000000000000101111010000000000000000000000000000000001111101"));
      lambda[3]  = bitset&ltnb_msg> (string("11100000000000000000000000000000000000001001000000000000000000000000000000000000110100000000000000000000000000000000000010110000"));
      lambda[4]  = bitset&ltnb_msg> (string("01110000000000000000000000000000000000000100100000000000000000000000000000000000011010000000000000000000000000000000000001011000"));
      lambda[5]  = bitset&ltnb_msg> (string("00111000000000000000000000000000000000000010010000000000000000000000000000000000001101000000000000000000000000000000000000101100"));
      lambda[6]  = bitset&ltnb_msg> (string("00011100000000000000000000000000000000000001001000000000000000000000000000000000000110100000000000000000000000000000000000010110"));
      lambda[7]  = bitset&ltnb_msg> (string("00001110000000000000000000000000000000000000100100000000000000000000000000000000000011010000000000000000000000000000000000001011"));
      lambda[8]  = bitset&ltnb_msg> (string("11101001000000000000000000000000000000000101001100000000000000000000000000000000111101000000000000000000000000000000000011001110"));
      lambda[9]  = bitset&ltnb_msg> (string("11111010000000000000000000000000000000001010011100000000000000000000000000000000011110100000000000000000000000000000000001100111"));
      lambda[10] = bitset&ltnb_msg> (string("01111101000000000000000000000000000000001101110100000000000000000000000000000000001111010000000000000000000000000000000010111101"));
      lambda[11] = bitset&ltnb_msg> (string("10110000000000000000000000000000000000001110000000000000000000000000000000000000100100000000000000000000000000000000000011010000"));
      lambda[12] = bitset&ltnb_msg> (string("01011000000000000000000000000000000000000111000000000000000000000000000000000000010010000000000000000000000000000000000001101000"));
      lambda[13] = bitset&ltnb_msg> (string("00101100000000000000000000000000000000000011100000000000000000000000000000000000001001000000000000000000000000000000000000110100"));
      lambda[14] = bitset&ltnb_msg> (string("00010110000000000000000000000000000000000001110000000000000000000000000000000000000100100000000000000000000000000000000000011010"));
      lambda[15] = bitset&ltnb_msg> (string("00001011000000000000000000000000000000000000111000000000000000000000000000000000000010010000000000000000000000000000000000001101"));
      lambda[16] = bitset&ltnb_msg> (string("11001110000000000000000000000000000000001110100100000000000000000000000000000000010100110000000000000000000000000000000011110100"));
      lambda[17] = bitset&ltnb_msg> (string("01100111000000000000000000000000000000001111101000000000000000000000000000000000101001110000000000000000000000000000000001111010"));
      lambda[18] = bitset&ltnb_msg> (string("10111101000000000000000000000000000000000111110100000000000000000000000000000000110111010000000000000000000000000000000000111101"));
      lambda[19] = bitset&ltnb_msg> (string("11010000000000000000000000000000000000001011000000000000000000000000000000000000111000000000000000000000000000000000000010010000"));
      lambda[20] = bitset&ltnb_msg> (string("01101000000000000000000000000000000000000101100000000000000000000000000000000000011100000000000000000000000000000000000001001000"));
      lambda[21] = bitset&ltnb_msg> (string("00110100000000000000000000000000000000000010110000000000000000000000000000000000001110000000000000000000000000000000000000100100"));
      lambda[22] = bitset&ltnb_msg> (string("00011010000000000000000000000000000000000001011000000000000000000000000000000000000111000000000000000000000000000000000000010010"));
      lambda[23] = bitset&ltnb_msg> (string("00001101000000000000000000000000000000000000101100000000000000000000000000000000000011100000000000000000000000000000000000001001"));
      lambda[24] = bitset&ltnb_msg> (string("11110100000000000000000000000000000000001100111000000000000000000000000000000000111010010000000000000000000000000000000001010011"));
      lambda[25] = bitset&ltnb_msg> (string("01111010000000000000000000000000000000000110011100000000000000000000000000000000111110100000000000000000000000000000000010100111"));
      lambda[26] = bitset&ltnb_msg> (string("00111101000000000000000000000000000000001011110100000000000000000000000000000000011111010000000000000000000000000000000011011101"));
      lambda[27] = bitset&ltnb_msg> (string("10010000000000000000000000000000000000001101000000000000000000000000000000000000101100000000000000000000000000000000000011100000"));
      lambda[28] = bitset&ltnb_msg> (string("01001000000000000000000000000000000000000110100000000000000000000000000000000000010110000000000000000000000000000000000001110000"));
      lambda[29] = bitset&ltnb_msg> (string("00100100000000000000000000000000000000000011010000000000000000000000000000000000001011000000000000000000000000000000000000111000"));
      lambda[30] = bitset&ltnb_msg> (string("00010010000000000000000000000000000000000001101000000000000000000000000000000000000101100000000000000000000000000000000000011100"));
      lambda[31] = bitset&ltnb_msg> (string("00001001000000000000000000000000000000000000110100000000000000000000000000000000000010110000000000000000000000000000000000001110"));
      lambda[32] = bitset&ltnb_msg> (string("00000000000000000000000011101001010100110000000000000000000000000000000011110100000000000000000000000000000000001100111000000000"));
      lambda[33] = bitset&ltnb_msg> (string("00000000000000000000000011111010101001110000000000000000000000000000000001111010000000000000000000000000000000000110011100000000"));
      lambda[34] = bitset&ltnb_msg> (string("00000000000000000000000001111101110111010000000000000000000000000000000000111101000000000000000000000000000000001011110100000000"));
      lambda[35] = bitset&ltnb_msg> (string("00000000000000000000000010110000111000000000000000000000000000000000000010010000000000000000000000000000000000001101000000000000"));
      lambda[36] = bitset&ltnb_msg> (string("00000000000000000000000001011000011100000000000000000000000000000000000001001000000000000000000000000000000000000110100000000000"));
      lambda[37] = bitset&ltnb_msg> (string("00000000000000000000000000101100001110000000000000000000000000000000000000100100000000000000000000000000000000000011010000000000"));
      lambda[38] = bitset&ltnb_msg> (string("00000000000000000000000000010110000111000000000000000000000000000000000000010010000000000000000000000000000000000001101000000000"));
      lambda[39] = bitset&ltnb_msg> (string("00000000000000000000000000001011000011100000000000000000000000000000000000001001000000000000000000000000000000000000110100000000"));
      lambda[40] = bitset&ltnb_msg> (string("00000000000000000000000011001110111010010000000000000000000000000000000001010011000000000000000000000000000000001111010000000000"));
      lambda[41] = bitset&ltnb_msg> (string("00000000000000000000000001100111111110100000000000000000000000000000000010100111000000000000000000000000000000000111101000000000"));
      lambda[42] = bitset&ltnb_msg> (string("00000000000000000000000010111101011111010000000000000000000000000000000011011101000000000000000000000000000000000011110100000000"));
      lambda[43] = bitset&ltnb_msg> (string("00000000000000000000000011010000101100000000000000000000000000000000000011100000000000000000000000000000000000001001000000000000"));
      lambda[44] = bitset&ltnb_msg> (string("00000000000000000000000001101000010110000000000000000000000000000000000001110000000000000000000000000000000000000100100000000000"));
      lambda[45] = bitset&ltnb_msg> (string("00000000000000000000000000110100001011000000000000000000000000000000000000111000000000000000000000000000000000000010010000000000"));
      lambda[46] = bitset&ltnb_msg> (string("00000000000000000000000000011010000101100000000000000000000000000000000000011100000000000000000000000000000000000001001000000000"));
      lambda[47] = bitset&ltnb_msg> (string("00000000000000000000000000001101000010110000000000000000000000000000000000001110000000000000000000000000000000000000100100000000"));
      lambda[48] = bitset&ltnb_msg> (string("00000000000000000000000011110100110011100000000000000000000000000000000011101001000000000000000000000000000000000101001100000000"));
      lambda[49] = bitset&ltnb_msg> (string("00000000000000000000000001111010011001110000000000000000000000000000000011111010000000000000000000000000000000001010011100000000"));
      lambda[50] = bitset&ltnb_msg> (string("00000000000000000000000000111101101111010000000000000000000000000000000001111101000000000000000000000000000000001101110100000000"));
      lambda[51] = bitset&ltnb_msg> (string("00000000000000000000000010010000110100000000000000000000000000000000000010110000000000000000000000000000000000001110000000000000"));
      lambda[52] = bitset&ltnb_msg> (string("00000000000000000000000001001000011010000000000000000000000000000000000001011000000000000000000000000000000000000111000000000000"));
      lambda[53] = bitset&ltnb_msg> (string("00000000000000000000000000100100001101000000000000000000000000000000000000101100000000000000000000000000000000000011100000000000"));
      lambda[54] = bitset&ltnb_msg> (string("00000000000000000000000000010010000110100000000000000000000000000000000000010110000000000000000000000000000000000001110000000000"));
      lambda[55] = bitset&ltnb_msg> (string("00000000000000000000000000001001000011010000000000000000000000000000000000001011000000000000000000000000000000000000111000000000"));
      lambda[56] = bitset&ltnb_msg> (string("00000000000000000000000001010011111101000000000000000000000000000000000011001110000000000000000000000000000000001110100100000000"));
      lambda[57] = bitset&ltnb_msg> (string("00000000000000000000000010100111011110100000000000000000000000000000000001100111000000000000000000000000000000001111101000000000"));
      lambda[58] = bitset&ltnb_msg> (string("00000000000000000000000011011101001111010000000000000000000000000000000010111101000000000000000000000000000000000111110100000000"));
      lambda[59] = bitset&ltnb_msg> (string("00000000000000000000000011100000100100000000000000000000000000000000000011010000000000000000000000000000000000001011000000000000"));
      lambda[60] = bitset&ltnb_msg> (string("00000000000000000000000001110000010010000000000000000000000000000000000001101000000000000000000000000000000000000101100000000000"));
      lambda[61] = bitset&ltnb_msg> (string("00000000000000000000000000111000001001000000000000000000000000000000000000110100000000000000000000000000000000000010110000000000"));
      lambda[62] = bitset&ltnb_msg> (string("00000000000000000000000000011100000100100000000000000000000000000000000000011010000000000000000000000000000000000001011000000000"));
      lambda[63] = bitset&ltnb_msg> (string("00000000000000000000000000001110000010010000000000000000000000000000000000001101000000000000000000000000000000000000101100000000"));
      lambda[64] = bitset&ltnb_msg> (string("00000000000000001100111000000000000000000000000000000000111010010101001100000000000000000000000000000000111101000000000000000000"));
      lambda[65] = bitset&ltnb_msg> (string("00000000000000000110011100000000000000000000000000000000111110101010011100000000000000000000000000000000011110100000000000000000"));
      lambda[66] = bitset&ltnb_msg> (string("00000000000000001011110100000000000000000000000000000000011111011101110100000000000000000000000000000000001111010000000000000000"));
      lambda[67] = bitset&ltnb_msg> (string("00000000000000001101000000000000000000000000000000000000101100001110000000000000000000000000000000000000100100000000000000000000"));
      lambda[68] = bitset&ltnb_msg> (string("00000000000000000110100000000000000000000000000000000000010110000111000000000000000000000000000000000000010010000000000000000000"));
      lambda[69] = bitset&ltnb_msg> (string("00000000000000000011010000000000000000000000000000000000001011000011100000000000000000000000000000000000001001000000000000000000"));
      lambda[70] = bitset&ltnb_msg> (string("00000000000000000001101000000000000000000000000000000000000101100001110000000000000000000000000000000000000100100000000000000000"));
      lambda[71] = bitset&ltnb_msg> (string("00000000000000000000110100000000000000000000000000000000000010110000111000000000000000000000000000000000000010010000000000000000"));
      lambda[72] = bitset&ltnb_msg> (string("00000000000000001111010000000000000000000000000000000000110011101110100100000000000000000000000000000000010100110000000000000000"));
      lambda[73] = bitset&ltnb_msg> (string("00000000000000000111101000000000000000000000000000000000011001111111101000000000000000000000000000000000101001110000000000000000"));
      lambda[74] = bitset&ltnb_msg> (string("00000000000000000011110100000000000000000000000000000000101111010111110100000000000000000000000000000000110111010000000000000000"));
      lambda[75] = bitset&ltnb_msg> (string("00000000000000001001000000000000000000000000000000000000110100001011000000000000000000000000000000000000111000000000000000000000"));
      lambda[76] = bitset&ltnb_msg> (string("00000000000000000100100000000000000000000000000000000000011010000101100000000000000000000000000000000000011100000000000000000000"));
      lambda[77] = bitset&ltnb_msg> (string("00000000000000000010010000000000000000000000000000000000001101000010110000000000000000000000000000000000001110000000000000000000"));
      lambda[78] = bitset&ltnb_msg> (string("00000000000000000001001000000000000000000000000000000000000110100001011000000000000000000000000000000000000111000000000000000000"));
      lambda[79] = bitset&ltnb_msg> (string("00000000000000000000100100000000000000000000000000000000000011010000101100000000000000000000000000000000000011100000000000000000"));
      lambda[80] = bitset&ltnb_msg> (string("00000000000000000101001100000000000000000000000000000000111101001100111000000000000000000000000000000000111010010000000000000000"));
      lambda[81] = bitset&ltnb_msg> (string("00000000000000001010011100000000000000000000000000000000011110100110011100000000000000000000000000000000111110100000000000000000"));
      lambda[82] = bitset&ltnb_msg> (string("00000000000000001101110100000000000000000000000000000000001111011011110100000000000000000000000000000000011111010000000000000000"));
      lambda[83] = bitset&ltnb_msg> (string("00000000000000001110000000000000000000000000000000000000100100001101000000000000000000000000000000000000101100000000000000000000"));
      lambda[84] = bitset&ltnb_msg> (string("00000000000000000111000000000000000000000000000000000000010010000110100000000000000000000000000000000000010110000000000000000000"));
      lambda[85] = bitset&ltnb_msg> (string("00000000000000000011100000000000000000000000000000000000001001000011010000000000000000000000000000000000001011000000000000000000"));
      lambda[86] = bitset&ltnb_msg> (string("00000000000000000001110000000000000000000000000000000000000100100001101000000000000000000000000000000000000101100000000000000000"));
      lambda[87] = bitset&ltnb_msg> (string("00000000000000000000111000000000000000000000000000000000000010010000110100000000000000000000000000000000000010110000000000000000"));
      lambda[88] = bitset&ltnb_msg> (string("00000000000000001110100100000000000000000000000000000000010100111111010000000000000000000000000000000000110011100000000000000000"));
      lambda[89] = bitset&ltnb_msg> (string("00000000000000001111101000000000000000000000000000000000101001110111101000000000000000000000000000000000011001110000000000000000"));
      lambda[90] = bitset&ltnb_msg> (string("00000000000000000111110100000000000000000000000000000000110111010011110100000000000000000000000000000000101111010000000000000000"));
      lambda[91] = bitset&ltnb_msg> (string("00000000000000001011000000000000000000000000000000000000111000001001000000000000000000000000000000000000110100000000000000000000"));
      lambda[92] = bitset&ltnb_msg> (string("00000000000000000101100000000000000000000000000000000000011100000100100000000000000000000000000000000000011010000000000000000000"));
      lambda[93] = bitset&ltnb_msg> (string("00000000000000000010110000000000000000000000000000000000001110000010010000000000000000000000000000000000001101000000000000000000"));
      lambda[94] = bitset&ltnb_msg> (string("00000000000000000001011000000000000000000000000000000000000111000001001000000000000000000000000000000000000110100000000000000000"));
      lambda[95] = bitset&ltnb_msg> (string("00000000000000000000101100000000000000000000000000000000000011100000100100000000000000000000000000000000000011010000000000000000"));
      lambda[96] = bitset&ltnb_msg> (string("00000000111101000000000000000000000000000000000011001110000000000000000000000000000000001110100101010011000000000000000000000000"));
      lambda[97] = bitset&ltnb_msg> (string("00000000011110100000000000000000000000000000000001100111000000000000000000000000000000001111101010100111000000000000000000000000"));
      lambda[98] = bitset&ltnb_msg> (string("00000000001111010000000000000000000000000000000010111101000000000000000000000000000000000111110111011101000000000000000000000000"));
      lambda[99] = bitset&ltnb_msg> (string("00000000100100000000000000000000000000000000000011010000000000000000000000000000000000001011000011100000000000000000000000000000"));
      lambda[100]= bitset&ltnb_msg> (string("00000000010010000000000000000000000000000000000001101000000000000000000000000000000000000101100001110000000000000000000000000000"));
      lambda[101]= bitset&ltnb_msg> (string("00000000001001000000000000000000000000000000000000110100000000000000000000000000000000000010110000111000000000000000000000000000"));
      lambda[102]= bitset&ltnb_msg> (string("00000000000100100000000000000000000000000000000000011010000000000000000000000000000000000001011000011100000000000000000000000000"));
      lambda[103]= bitset&ltnb_msg> (string("00000000000010010000000000000000000000000000000000001101000000000000000000000000000000000000101100001110000000000000000000000000"));
      lambda[104]= bitset&ltnb_msg> (string("00000000010100110000000000000000000000000000000011110100000000000000000000000000000000001100111011101001000000000000000000000000"));
      lambda[105]= bitset&ltnb_msg> (string("00000000101001110000000000000000000000000000000001111010000000000000000000000000000000000110011111111010000000000000000000000000"));
      lambda[106]= bitset&ltnb_msg> (string("00000000110111010000000000000000000000000000000000111101000000000000000000000000000000001011110101111101000000000000000000000000"));
      lambda[107]= bitset&ltnb_msg> (string("00000000111000000000000000000000000000000000000010010000000000000000000000000000000000001101000010110000000000000000000000000000"));
      lambda[108]= bitset&ltnb_msg> (string("00000000011100000000000000000000000000000000000001001000000000000000000000000000000000000110100001011000000000000000000000000000"));
      lambda[109]= bitset&ltnb_msg> (string("00000000001110000000000000000000000000000000000000100100000000000000000000000000000000000011010000101100000000000000000000000000"));
      lambda[110]= bitset&ltnb_msg> (string("00000000000111000000000000000000000000000000000000010010000000000000000000000000000000000001101000010110000000000000000000000000"));
      lambda[111]= bitset&ltnb_msg> (string("00000000000011100000000000000000000000000000000000001001000000000000000000000000000000000000110100001011000000000000000000000000"));
      lambda[112]= bitset&ltnb_msg> (string("00000000111010010000000000000000000000000000000001010011000000000000000000000000000000001111010011001110000000000000000000000000"));
      lambda[113]= bitset&ltnb_msg> (string("00000000111110100000000000000000000000000000000010100111000000000000000000000000000000000111101001100111000000000000000000000000"));
      lambda[114]= bitset&ltnb_msg> (string("00000000011111010000000000000000000000000000000011011101000000000000000000000000000000000011110110111101000000000000000000000000"));
      lambda[115]= bitset&ltnb_msg> (string("00000000101100000000000000000000000000000000000011100000000000000000000000000000000000001001000011010000000000000000000000000000"));
      lambda[116]= bitset&ltnb_msg> (string("00000000010110000000000000000000000000000000000001110000000000000000000000000000000000000100100001101000000000000000000000000000"));
      lambda[117]= bitset&ltnb_msg> (string("00000000001011000000000000000000000000000000000000111000000000000000000000000000000000000010010000110100000000000000000000000000"));
      lambda[118]= bitset&ltnb_msg> (string("00000000000101100000000000000000000000000000000000011100000000000000000000000000000000000001001000011010000000000000000000000000"));
      lambda[119]= bitset&ltnb_msg> (string("00000000000010110000000000000000000000000000000000001110000000000000000000000000000000000000100100001101000000000000000000000000"));
      lambda[120]= bitset&ltnb_msg> (string("00000000110011100000000000000000000000000000000011101001000000000000000000000000000000000101001111110100000000000000000000000000"));
      lambda[121]= bitset&ltnb_msg> (string("00000000011001110000000000000000000000000000000011111010000000000000000000000000000000001010011101111010000000000000000000000000"));
      lambda[122]= bitset&ltnb_msg> (string("00000000101111010000000000000000000000000000000001111101000000000000000000000000000000001101110100111101000000000000000000000000"));
      lambda[123]= bitset&ltnb_msg> (string("00000000110100000000000000000000000000000000000010110000000000000000000000000000000000001110000010010000000000000000000000000000"));
      lambda[124]= bitset&ltnb_msg> (string("00000000011010000000000000000000000000000000000001011000000000000000000000000000000000000111000001001000000000000000000000000000"));
      lambda[125]= bitset&ltnb_msg> (string("00000000001101000000000000000000000000000000000000101100000000000000000000000000000000000011100000100100000000000000000000000000"));
      lambda[126]= bitset&ltnb_msg> (string("00000000000110100000000000000000000000000000000000010110000000000000000000000000000000000001110000010010000000000000000000000000"));
      lambda[127]= bitset&ltnb_msg> (string("00000000000011010000000000000000000000000000000000001011000000000000000000000000000000000000111000001001000000000000000000000000"));
      */
  }

  // To acces element (I,J) of matrix lambda use:
  // lambda(I,J) = lambda[I+J*nb_msg]
  //vector x matrix PRODUCT
  for ( unsigned i = 0 ; i < nb_msg ; ++i ){
    c[i] = 0 ;
    for ( unsigned j = 0 ; j < nb_msg ; ++j ) {
      c[i] = c[i] ^ ( m[j] & lambda[nb_msg-j-1][i] ) ;
    }
  }
  /*for ( unsigned i = 0 ; i < nb_msg ; ++i ){
    c[i] = 0 ;
    for ( unsigned j = 0 ; j < nb_msg ; ++j ) {
      c[i] = c[i] ^ ( m[j] & lambda[i+j*nb_msg] ) ;
    }
  }*/

  return c ;
}

//////////////////////
//////TBBC SBOX//////
//////////////////////

//! S-Boxes.
/*!
S-box 1.

\f$ x^{62} \f$ over \f$ F_2^6 \f$ where \f$ F \f$ is the field \f$ {0,1} \f$ 
--> Equivalent to Inversion.

This sbox is 4-differential and weakly APN.

EX:

000000 -> 000000

000010 -> 101101 ...

bitset<6> s1_table[2] = {

000000,000001,101101,110110,111011,010010,011011,011110,110000,001010,001001,110001,100000,111110,001111,001110,

011000,110011,000101,111010,101001,111000,110101,100011,010000,110010,011111,000110,101010,100110,000111,011010,

001100,111111,110100,010111,101111,111101,011101,101011,111001,010100,011100,100111,110111,000010,111100,100100,

001000,001011,011001,010001,100010,010110,000011,101100,010101,101000,010011,000100,101110,100101,001101,100001 };

------------------------------------------------------------------------------------------------------------------

S-box 2.

\f$ x^5 \f$ over \f$ F_2^6 \f$ where \f$ F \f$ is the field \f$ {0,1} \f$ .

This sbox is 4-differential, but NO weakly APN.

EX:
000000 -> 000000

000010 -> 100000 ...

bitset<6> s2_table[64] = {

000000,000001,100000,110011,110001,000011,111111,011111,100100,000100,111011,001001,111110,101101,001111,001110,

000111,000101,110110,100110,001000,111001,010111,110100,011110,111101,010000,100001,111010,101010,011010,011000,

001101,101011,010110,100010,101001,111100,011100,011011,110111,110000,010011,000110,111000,001100,110010,010100,

101111,001010,100101,010010,110101,100011,010001,010101,101000,101100,011101,001011,011001,101110,000010,100111};

------------------------------------------------------------------------------------------------------------------

S-box 3.

\f$ x^17 \f$ over \f$ F_2^6 \f$ where \f$ F \f$ is the field \f$ {0,1} \f$ .

This sbox is 4-differential, but NO weakly APN.

EX:

000000 -> 000000

000010 -> 100110 ...

------------------------------------------------------------------------------------------------------------------

S-box 4.

\f$ x^62 + e^2 \f$ over \f$ F_2^6 \f$ where \f$ F \f$ is the field \f$ {0,1} \f$ .

This sbox is 4-differential, and weakly APN.

EX:

000000 -> 000000

000010 ->  ...
*/

template &ltunsigned nb_sbox, unsigned nround>
inline
typename TBBCBUNNY&ltnb_sbox,nround>::sboxType
TBBCBUNNY&ltnb_sbox,nround>::sbox(unsigned nbox, sboxType x) {

  int s_table[4][64] = { {  0,  1, 45, 54, 59, 18, 27, 30, 48, 10,  9, 49, 32, 62, 15, 14,
                           24, 51,  5, 58, 41, 56, 53, 35, 16, 50, 31,  6, 42, 38,  7, 26,
                           12, 63, 52, 23, 47, 61, 29, 43, 57, 20, 28, 39, 55,  2, 60, 36,
                            8, 11, 25, 17, 34, 22,  3, 44, 21, 40, 19,  4, 46, 37, 13, 33  },
                        {   0,  1, 32, 51, 49,  3, 63, 31, 36,  4, 59,  9, 62, 45, 15, 14,
                            7,  5, 54, 38,  8, 57, 23, 52, 30, 61, 16, 33, 58, 42, 26, 24,
                           13, 43, 22, 34, 41, 60, 28, 27, 55, 48, 19,  6, 56, 12, 50, 20,
                           47, 10, 37, 18, 53, 35, 17, 21, 40, 44, 29, 11, 25, 46,  2, 39  },
                        {   0,  1, 38, 54, 37, 18, 43, 13, 20, 50, 25, 46, 42, 58, 15, 14,
                           32, 51,  5,  7, 47, 10, 34, 22, 12, 56,  2, 39, 24, 26, 62, 45,
                           28, 27, 35, 53,  8, 57, 31, 63,  4, 36, 16, 33, 11, 29, 55, 48,
                           41, 60, 21, 17, 23, 52,  3, 49,  9, 59, 30, 61, 44, 40, 19,  6  },
                        {   4,  5, 34, 50, 33, 22, 47,  9, 16, 54, 29, 42, 46, 62, 11, 10,
                           36, 55,  1,  3, 43, 14, 38, 18,  8, 60,  6, 35, 28, 30, 58, 41,
                           24, 31, 39, 49, 12, 61, 27, 59,  0, 32, 20, 37, 15, 25, 51, 52,
                           45, 56, 17, 21, 19, 48,  7, 53, 13, 63, 26, 57, 40, 44, 23,  2   } } ;
  return sboxType ( s_table[nbox][x.to_ulong()] ) ;
}

//! Inverse of the S-Boxes
template &ltunsigned nb_sbox, unsigned nround>
inline
typename TBBCBUNNY&ltnb_sbox,nround>::sboxType
TBBCBUNNY&ltnb_sbox,nround>::sboxInverse(unsigned nbox, sboxType x) {
  static int sInv_table[4][64] = {   {  0,  1, 45, 54, 59, 18, 27, 30, 48, 10,  9, 49, 32, 62, 15, 14,
                                       24, 51,  5, 58, 41, 56, 53, 35, 16, 50, 31,  6, 42, 38,  7, 26,
                                       12, 63, 52, 23, 47, 61, 29, 43, 57, 20, 28, 39, 55,  2, 60, 36,
                                        8, 11, 25, 17, 34, 22,  3, 44, 21, 40, 19,  4, 46, 37, 13, 33  },
                                     {  0,  1, 62,  5,  9, 17, 43, 16, 20, 11, 49, 59, 45, 32, 15, 14,
                                       26, 54, 51, 42, 47, 55, 34, 22, 31, 60, 30, 39, 38, 58, 24,  7,
                                        2, 27, 35, 53,  8, 50, 19, 63, 56, 36, 29, 33, 57, 13, 61, 48,
                                       41,  4, 46,  3, 23, 52, 18, 40, 44, 21, 28, 10, 37, 25,  12, 6  },
                                     {  0,  1, 26, 54, 40, 18, 63, 19, 36, 56, 21, 44, 24,  7, 15, 14,
                                       42, 51,  5, 62,  8, 50, 23, 52, 28, 10, 29, 33, 32, 45, 58, 38,
                                       16, 43, 22, 34, 41,  4,  2, 27, 61, 48, 12,  6, 60, 31, 11, 20,
                                       47, 55,  9, 17, 53, 35,  3, 46, 25, 37, 13, 57, 49, 59, 30, 39  },
                                     { 40, 18, 63, 19,  0,  1, 26, 54, 24,  7, 15, 14, 36, 56, 21, 44,
                                        8, 50, 23, 52, 42, 51,  5, 62, 32, 45, 58, 38, 28, 10, 29, 33,
                                       41,  4,  2, 27, 16, 43, 22, 34, 60, 31, 11, 20, 61, 48, 12,  6,
                                       53, 35,  3, 46, 47, 55,  9, 17, 49, 59, 30, 39, 25, 37, 13, 57  } } ;
  return sboxType ( sInv_table[nbox][x.to_ulong()] );
}
</code>
</pre>

<br><br><hr><br>

<h4 id="myfunctions_h">myFunctions.h</h4>

<pre>
<code class="cpp">
/**************************/
/* Emanuele Bellini, 2012 */
/**************************/

#ifndef MY_FUNCTIONS_H
#define MY_FUNCTIONS_H


using namespace std ;

#include &ltstdint.h>

static uint8_t charToNum[128] = {
// works on LINUX compiler
// 0, 10, 11, 12, 13, 14, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 0
// 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 16
// 0, 10, 11, 12, 13, 14, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 32
// 0,  1,  2,  3,  4,  5,  6, 7, 8, 9, 0, 0, 0, 0, 0, 0, // 48
// 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 64
// 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 80
// 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 96
// 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0

// works on MAC compiler
 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 0
 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 16
 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 32
 0,  1,  2,  3,  4,  5,  6, 7, 8, 9, 0, 0, 0, 0, 0, 0, // 48
 0, 10, 11, 12, 13, 14, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 64
 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 80
 0, 10, 11, 12, 13, 14, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, // 96
 0,  0,  0,  0,  0,  0,  0, 0, 0, 0, 0, 0, 0, 0, 0, 0

} ;

static char numToChar[16] = { '0', '1', '2', '3', '4', '5', '6', '7',
                              '8', '9', 'a', 'b', 'c', 'd', 'e', 'f' } ;

//! Function to copy a string to a vector c of unsigned char.
/*!
  Note: it converts two string characters in one unsigned char.
- INPUT: a string s, and a pointer c[] to an array of characters that will be modified.
*/
void
stringToUcharB( string const & s, //! string to be converted
                uint8_t * c       //! converted number
              ) 
{
  for ( unsigned i = 0 ; i < s.length() ; i += 2 ){
    *c++ = (charToNum[s[i]&0x3F]<<4) | charToNum[s[i+1]&0x3F]  ;
  }
}

void stringToUchar (string s, unsigned char c[])
{
    unsigned d ;

    for (unsigned i = 0 ; i < s.length() ; i = i + 2){
        switch( s[i] ){
        case '0': d = 0 ;
            break ;
        case '1':  d = 1 * 16 ;
            break ;
        case '2':  d = 2 * 16 ;
            break ;
        case '3':  d = 3 * 16 ;
            break ;
        case '4':  d = 4 * 16 ;
            break ;
        case '5':  d = 5 * 16 ;
            break ;
        case '6':  d = 6 * 16 ;
            break ;
        case '7':  d = 7 * 16 ;
            break ;
        case '8':  d = 8 * 16 ;
            break ;
        case '9':  d = 9 * 16 ;
            break ;
        case 'a':  d = 10 * 16 ;
            break ;
        case 'b':  d = 11 * 16 ;
            break ;
        case 'c':  d = 12 * 16 ;
            break ;
        case 'd':  d = 13 * 16 ;
            break ;
        case 'e':  d = 14 * 16 ;
            break ;
        case 'f':  d = 15 * 16 ;
            break ;
      }
      switch( s[i+1] ){
        case '0': d = d + 0 ;
            break ;
        case '1':  d = d + 1 ;
            break ;
        case '2':  d = d + 2 ;
            break ;
        case '3':  d = d + 3 ;
            break ;
        case '4':  d = d + 4 ;
            break ;
        case '5':  d = d + 5 ;
            break ;
        case '6':  d = d + 6 ;
            break ;
        case '7':  d = d + 7 ;
            break ;
        case '8':  d = d + 8 ;
            break ;
        case '9':  d = d + 9 ;
            break ;
        case 'a':  d = d + 10 ;
            break ;
        case 'b':  d = d + 11 ;
            break ;
        case 'c':  d = d + 12 ;
            break ;
        case 'd':  d = d + 13 ;
            break ;
        case 'e':  d = d + 14 ;
            break ;
        case 'f':  d = d + 15 ;
            break ;
      }
        c[i / 2] = d ;
    }
}


//!To rotate a bitset to the left by m bits.
/*!
- INPUT: a bitset b, an integer m indicating how many bits to the left are requested to be shifted.

- OUTPUT: the bitset rotated.
*/
template &ltstd::size_t N>
inline
std::bitset&ltN>
rotLeft(std::bitset&ltN>& b, unsigned m)
{
    b = b << m | b >> (N-m);
    return b ;
}


//!Moves nbits bits from position pos1 to pos2.
/*!
Note 1: Does not check for errors.

Note 2: Remember the rightmost bit has index zero.

- INPUT: a bitset b, two integer pos1 and pos2 indicating the positions to be exchanged, and an integer nbits indicating how many bits must be moved.

- OUTPUT: the new bitset.
*/
template &ltstd::size_t N>
inline
std::bitset&ltN>
MoveBits(std::bitset&ltN>& b, unsigned pos1, unsigned pos2, unsigned nbits)
{
    bool tmp ;
    for (unsigned i = 0 ; i < nbits ; ++i){
        tmp = b[pos1+i] ;
        b[pos1+i] = b[pos2+i] ;
        b[pos2+i] = tmp ;
    }
    return b ;
}



//!To convert an hexadecimal string to a bitset&lt128> element.
/*!
- INPUT: a string s containing hexadecimal characters.

- OUTPUT: a bitset equivalent to the value in the string.
*/
inline
bitset&lt128> hexToBitset128(string c){
    //unsigned l = c.length() ;
    bitset &lt128> b ;
    string tmp ;
    for (unsigned i = 0 ; i < c.length() ; ++i){
      switch( c[i] ){
        case '0':  tmp.append("0000") ;
            break ;
        case '1':  tmp.append("0001") ;
            break ;
        case '2':  tmp.append("0010") ;
            break ;
        case '3':  tmp.append("0011") ;
            break ;
        case '4':  tmp.append("0100") ;
            break ;
        case '5':  tmp.append("0101") ;
            break ;
        case '6':  tmp.append("0110") ;
            break ;
        case '7':  tmp.append("0111") ;
            break ;
        case '8':  tmp.append("1000") ;
            break ;
        case '9':  tmp.append("1001") ;
            break ;
        case 'a':  tmp.append("1010") ;
            break ;
        case 'b':  tmp.append("1011") ;
            break ;
        case 'c':  tmp.append("1100") ;
            break ;
        case 'd':  tmp.append("1101") ;
            break ;
        case 'e':  tmp.append("1110") ;
            break ;
        case 'f':  tmp.append("1111") ;
            break ;
      }
    }
    b = bitset&lt128> (tmp) ;
    return b ;
}


//!To convert an hexadecimal string to a bitset&ltN> element.
/*!
- INPUT: a bitset b.

- OUTPUT: a string of hexadecimal characters equivalent to the value in the bitset.
*/
template &ltstd::size_t N>
inline
string bitsetToHex(std::bitset&ltN> b){
  //string s = b.to_string();
  string hex ;

  int i = N%4 ;
    switch (i) {
    case 1: hex.append(1,numToChar[b[N-1]]) ; break ;
    case 2: hex.append(1,numToChar[b[N-2]+2*b[N-1]]) ; break ;
    case 3: hex.append(1,numToChar[b[N-3]+2*b[N-2]+4*b[N-1]]) ; break ;
  }
  for ( i = N-1; i >= 3 ; i -= 4 ){
    hex.append(1,numToChar[8*b[i] + 4*b[i-1] + 2*b[i-2] + b[i-3]]) ;
  }
  return hex ;
}


//!To convert a string of hexadecimal entries to T (works for T = bitset&ltN>).
/*!
- INPUT: a string s containing hexadecimal characters.

- OUTPUT: a bitset equivalent to the value in the string.
*/
template &lttypename T>
T
hexTo( string const & c ) {
  T b ;
  unsigned k = 4*c.length() ;
  for (unsigned i = 0 ; i < c.length() ; ++i ){
    k -= 4 ;
    unsigned n = charToNum[(int)c[i]] ;
    b[k+0] = n & 0x01 ; n >>= 1 ;
    b[k+1] = n & 0x01 ; n >>= 1 ;
    b[k+2] = n & 0x01 ; n >>= 1 ;
    b[k+3] = n & 0x01 ;
  }
  return b ;
}


/*!
To convert a bitset<128> element to an hexadecimal string.
*/
inline
string bitset128ToHex(bitset<128> b){
    string s = b.to_string();
    string hex ;
    bitset<4> oct ;
    for (unsigned i = 0 ; i < s.length() ; i = i + 4){
        oct[0] = b[s.length()-4-i] ;
        oct[1] = b[s.length()-3-i] ;
        oct[2] = b[s.length()-2-i] ;
        oct[3] = b[s.length()-1-i] ;
        if      (oct == bitset<4> (string("0000")) )  hex.append("0") ;
        else if (oct == bitset<4> (string("0001")) )  hex.append("1") ;
        else if (oct == bitset<4> (string("0010")) )  hex.append("2") ;
        else if (oct == bitset<4> (string("0011")) )  hex.append("3") ;
        else if (oct == bitset<4> (string("0100")) )  hex.append("4") ;
        else if (oct == bitset<4> (string("0101")) )  hex.append("5") ;
        else if (oct == bitset<4> (string("0110")) )  hex.append("6") ;
        else if (oct == bitset<4> (string("0111")) )  hex.append("7") ;
        else if (oct == bitset<4> (string("1000")) )  hex.append("8") ;
        else if (oct == bitset<4> (string("1001")) )  hex.append("9") ;
        else if (oct == bitset<4> (string("1010")) )  hex.append("a") ;
        else if (oct == bitset<4> (string("1011")) )  hex.append("b") ;
        else if (oct == bitset<4> (string("1100")) )  hex.append("c") ;
        else if (oct == bitset<4> (string("1101")) )  hex.append("d") ;
        else if (oct == bitset<4> (string("1110")) )  hex.append("e") ;
        else if (oct == bitset<4> (string("1111")) )  hex.append("f") ;
    }
    return hex ;
}

/*!
Function used to put an unsigned char into a string.

Ex: ucharToString(0x0a) returns "0a" as a string.
*/
template &ltclass T>
inline std::string ucharToString (const T& t)
{
    std::stringstream ss ;
    std::string str ;
    ss << hex << (int)t ;
    if ( t <= 0x0f && t>=0x00 ) str = "0" ;
    str.append(ss.str()) ;

    return str ;
}

/*!
Multiplication in \f$ F_2^8 \f$.

- INPUT: two unsigned char a and b to be multipied.

- OUTPUT: the product of a * b in \f$ F_2^8 \f$ as an unsigned char.
*/
unsigned char gmul(unsigned char a, unsigned char b) {
    unsigned char p = 0;
    unsigned char counter;
    unsigned char hi_bit_set;
    for(counter = 0; counter < 8; counter++) {
        if((b & 1) == 1)
            p ^= a;
        hi_bit_set = (a & 0x80);
        a <<= 1;
        if(hi_bit_set == 0x80)
            a ^= 0x1b;
        b >>= 1;
    }
    return p;
}

/*!
Mix a single column.

- INPUT: unsigned char pointer to a vector of 4 bytes written as hexadecimal unsigned char.

- OUTPUT: the unsigned char vector modified.
*/
void gmix_column(unsigned char *r) {
        unsigned char a[4] ;
    unsigned char c ;
    for(c = 0 ; c < 4 ; ++c) {
        a[c] = r[c];
    }
    r[0] = gmul(a[0],2) ^ gmul(a[3],1) ^ gmul(a[2],1) ^ gmul(a[1],3) ;
    r[1] = gmul(a[1],2) ^ gmul(a[0],1) ^ gmul(a[3],1) ^ gmul(a[2],3) ;
    r[2] = gmul(a[2],2) ^ gmul(a[1],1) ^ gmul(a[0],1) ^ gmul(a[3],3) ;
    r[3] = gmul(a[3],2) ^ gmul(a[2],1) ^ gmul(a[1],1) ^ gmul(a[0],3) ;
}

/*!
Does the invers of mixing a single column.

- INPUT: unsigned char pointer to a vector of 4 bytes written as hexadecimal unsigned char.

- OUTPUT: the unsigned char vector modified.
*/
inline
void gmix_columnInv(unsigned char *r) {
        unsigned char a[4];
        unsigned char c;
        for(c=0; c<4; c++) {
                a[c] = r[c];
                }
        r[0] = gmul(a[0],14) ^ gmul(a[3],9) ^ gmul(a[2],13) ^ gmul(a[1],11);
        r[1] = gmul(a[1],14) ^ gmul(a[0],9) ^ gmul(a[3],13) ^ gmul(a[2],11);
        r[2] = gmul(a[2],14) ^ gmul(a[1],9) ^ gmul(a[0],13) ^ gmul(a[3],11);
        r[3] = gmul(a[3],14) ^ gmul(a[2],9) ^ gmul(a[1],13) ^ gmul(a[0],11);
}

#endif
</code>
</pre>

<script>
var chapter = 'programming' ;
var x = document.getElementById("temp-content") ;
document.getElementById("main").innerHTML = x.innerHTML ;
</script>

<!--
-->

