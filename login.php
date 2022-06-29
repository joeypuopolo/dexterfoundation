<?php
session_start();
require_once 'donate_button.php';

$db_hostname = '#####';
$db_database = '#####';
$db_username = '#####';
$db_password = '#####';


$PIC_PATH = "/img/doggies/";
$PIC_PATH_SUCCESS = "/img/success/";
$LEASE_PATH = "/leases/";

$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());

mysql_select_db($db_database, $db_server) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());



$queryDisp = "SELECT * FROM admin WHERE user='admin'";
$result = mysql_query($queryDisp);
if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());
$rows = mysql_num_rows($result);
$adminData = mysql_fetch_row($result);

$MAIN_EMAIL = $adminData[2];
// $MAIN_EMAIL = '#####';
$DEFAULT_EMAIL = '#####@#####.com';

function toString($var) {
  return (string)$var;
}

function queryMysql($query) {
	$result = mysql_query($query) or die(mysql_error());
	return $result;
}
function destroySession() {
	$_SESSION = array();
	if(session_id() != "" || isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-2592000, '/');
	session_destroy();
}
if(isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$loggedin = TRUE;
} else {
	$loggedin = FALSE;
	$user = "guest";
}
?>
