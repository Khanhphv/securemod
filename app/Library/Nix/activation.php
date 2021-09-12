<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once 'functions.php';
require_once 'license.php';
//Usage:
//activation.php?phash=&code=&hwid=

//hash	- SHA1 hash of product's public key
//code  - activation code
//hwid  - hardware id
/// activation.php?hash=h0VtLhEdJmbC8gG9SpYpA1JnW6U=&hwid=5LdRYuVEZ0KuRDkI07NhkA==&code=456
//Valid HWIDs for testing: wATJ063UzaPC6Bpfhl4JmP+i5qg=, 5LdRYuVEZ0KuRDkI07NhkA==

//Activation error codes
$ACT_BAD = "BAD";
$ACT_BANNED = "BANNED";
$ACT_USED = "USED";
$ACT_EXPIRED = "EXPIRED";
$DEACT_OK = "OK";
$DEACT_ERROR = "ERROR";
$DEACT_UNKNOWN = "UNKNOWN";

if (empty($_GET["code"]) || empty($_GET["hwid"]) || empty($_GET["hash"]))
    die($ACT_BAD);

if ($_GET["hash"] != 'h0VtLhEdJmbC8gG9SpYpA1JnW6U=') {
	die($ACT_BAD);
}


$ipaddress = get_client_ip();
$code = $_GET["code"];
$hwid = $_GET["hwid"];

// Call to API to get $res
//$serverResponse = file_get_contents("https://hackgame.mobi/api/check-key/".$code."/".$hwid."/3/".$ipaddress);
//echo $serverResponse;

$sn_data = array("hardwareid" => $hwid, 'expiredate' => '2019-03-15');

$l = new License();
$l->name = $ipaddress;
$l->email = date("d-m-Y H-i", time())."@".$code.".com";
$l->CreateSerialNumber($sn_data);

$res = $l->sn;

switch ($res)
{
	case $ACT_BAD:
	case $ACT_USED:
	case $ACT_BANNED:
	case $ACT_EXPIRED:
		echo $res;
		break;
	default:
		echo "OK\n" . $res;
}
