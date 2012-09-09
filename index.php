<?php
/**
 * Author:  Isuru Ratnayake
 * Link:    http://isuru.ratnayake.info
 *
 *
 * here is example on how to use A6elks calss found in 46elks/46elks.php location.
 *
 * Thanks for downloading, I've provided this as part of the MIT licensing agreement so that you are pretty much
 * free to do whatever you want with it.
 *
 */
 
include "./config.php";
include "46elks/46elks.php";

$A6elka = new A6elks($A6elks_username,$A6elks_password);


//allocate sweden sms only phone number
$response = $A6elka->Allocate_Number('se','http://mydomain.com/sms/index.php');

//allocate sweden phone number with sms and voice
$response = $A6elka->Allocate_Number('se','http://mydpmain.com/sms/index.php','http://mydomain.com/voice/index.php');

//deallocate number
$response = $A6elka->Deallocation('46elka unique key for phone number');

//modify numbet
$response = $A6elka->Modification('46elka unique key for phone number','http://mydpmain.com/sms/index.php','http://mydomain.com/voice/index.php');

//send sms
$response = $A6elka->SendSMS("your 46elka phone number,'your phone number need to recive sms','message you need to send');