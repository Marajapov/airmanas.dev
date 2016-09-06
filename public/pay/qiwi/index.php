<?php

$this_username = 'qiwi';
$this_password = '7789105089';
$service_name = 'Qiwi';

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'login failed';
    exit;
} else {
    $uname = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];
    if ($uname != $this_username || $pass != $this_password) {
        echo 'login failed';
        exit;
    }
}

require_once "../../config.php";
require_once "../../class/classloader.php";
require_once "../../class/functions.php";
require_once "../../class/pay_functions.php";
require_once "../../class/getPNR.php";
require_once "../../class/sms_functions.php";
require_once "../../class/flight_payment_functions.php";
$db=new db_mysql($db_host,$db_user,$db_pass,$db_name);
$db->connect();

header("Content-type: text/xml");

if (isset($_GET['command'])){

	$acc = $txn_id = $sum = 0;
	if (isset($_GET['account'])) $acc = getget('account');
	if (isset($_GET['txn_id'])) $txn_id = getget('txn_id');
	if (isset($_GET['sum'])) $sum = intval(getget('sum'));
	$comment = '';
  	$txn_date = date("Y-m-d H:i:s");
	
	if ($_GET['command']=='check'){
		$result = check_account($acc, $txn_id);
	}
	if ($_GET['command']=='pay'){
		$prv_txn = generateRandomString(10, 1);
		$result = check_pay_account($acc, $txn_id,$sum, $prv_txn, $service_name );
	}
}

?>