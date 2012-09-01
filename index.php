<?php
include "./config.php";
include "46elks/46elks.php";

$A6elka = new A6elks($A6elks_username,$A6elks_password);
//allocate sweeden sms only phone number
$response = $A6elka->Allocate_Number('se','http://mydpmain.com/sms/index.php');

