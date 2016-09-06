<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'login failed';
    exit;
} else {
    $uname = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];
    if ($uname != 'optima' || $pass != '7389105089') {
        echo 'login failed';
        exit;
    }
}

require_once "../../config_local.php";
require_once "../../class/classloader.php";
require_once "../../class/functions.php";
$db=new db_mysql($db_host,$db_user,$db_pass,$db_name);
$db->connect();

header("Content-type: text/xml");

if (isset($_GET['command'])){

	$username = 'optima';
	$password = '7389105089';
	$acc = getget('account');
	$txn_id = getget('txn_id');
	$sum = intval(getget('sum'));
	$comment = '';
  $txn_date = date("Y-m-d H:i:s");
	if ($_GET['command']=='check'){
		$result = check_account($acc, $db);
		if ($result==0) $comment = 'OK';
		die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>'.$result.'</result><comment>'.$comment.'</comment></response>');
	}
	if ($_GET['command']=='pay'){
		$prv_txn = generateRandomString(10, 1);
		$result = check_account($acc, $db);

		if ($result!='0'){
			$dblogarray = array("txn_id" => $txn_id, "account" => $acc, "sum" => $sum, "osmp_txn_id" => $prv_txn, "result" => 'no account', "service" => 'Optima' );
			$db->insert("ttransactlog", $dblogarray);
			die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>'.$result.'</result><comment>'.$comment.'</comment></response>');
		}

		$transact = $db->select_one('ttransact',"txn_id like '".$txn_id."'");
		if ($transact){

			$result = $transact['status'];
			$comment = 'Повторный платеж';
			$dblogarray = array("txn_id" => $txn_id, "account" => $acc, "sum" => $sum, "osmp_txn_id" => $prv_txn, "result" => 'double payment', "service" => 'Optima');
			$db->insert("ttransactlog", $dblogarray);
			die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><prv_txn>'.$prv_txn.'</prv_txn>
<sum>'.$transact['money'].'</sum><result>'.$result.'</result><comment>'.$comment.'</comment></response>');
		}

		$dbarray = array("txn_id" => $txn_id, "account" => $acc, "money" => $sum, "method" => '1', "status" => '0', "service" => 'Optima');
		$doneFlag = $db->insert("ttransact", $dbarray);

		$dblogarray = array("txn_id" => $txn_id, "account" => $acc, "sum" => $sum, "osmp_txn_id" => $prv_txn, "result" => 'success', "service" => 'Optima');
		$db->insert("ttransactlog", $dblogarray);
		die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><prv_txn>'.$prv_txn.'</prv_txn>
<sum>'.$sum.'</sum><result>0</result><comment>OK</comment></response>');
	}
}
function check_account($acc, $db){
	$result = "0";
	if (strlen(trim($acc))>0) {
		
		$count = $db->select_count('tuser',"user_account like '".$acc."'");
		if ($count==0){
			$result = "5";
		}
	}
	else {$result = "4";}
	return $result;
}

?>