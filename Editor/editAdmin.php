<?php
require_once '../login.php';

if (!$loggedin) {
	$redirect = <<<_REDIRECT
You must <a href="./editorLogin.php">Login</a>
_REDIRECT;
die($redirect);
}


$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());

mysql_select_db($db_database, $db_server) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());



$queryDisp = "SELECT * FROM admin WHERE user='admin'";
$result = mysql_query($queryDisp);
if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());

$rows = mysql_num_rows($result);

$adminData = mysql_fetch_row($result);
$currentPass = $adminData[1];
$currentEmail = $adminData[2];


if (isset($_POST['input'])) {
	$table = $_POST['table'];

	if($table=='password') { 
	//if they changed the password
		echo "change password";
		if($_POST['password'] == $_POST['passwordCheck']) { 
		// if the password matches the retype
			echo "passwords match";
			$newPass = $_POST['password'];
			$query = "UPDATE admin SET pass='$newPass' WHERE pass='$currentPass'";
			$result = mysql_query($query); 
		}
	}

	if($table == 'email') {
		$newEmail = $_POST['email'];
		$query = "UPDATE admin SET email='$newEmail' WHERE email='$currentEmail'";
		$currentEmail = $newEmail;
		$result = mysql_query($query); 
	}
	
}

//}

echo <<<_PAGE
<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/normalize.css">
  <script language="javascript" src="../js/modernizr.dexterfoundation.js"></script>
<style>
input, textarea {
	width: 100%;
  float:right;
}
tr { background-color:#ccc; } 

.value {
  width: 200px;
}
.button {
  width: 150px;
}
td {
    padding: 10px;
}
table{
  width: 300px;
  margin: 20px;
}
.label, label {
  font-style: italic; 
  font-size: 10pt;
}

</style>
</head>


<body>	
<div id="allcontent" style="">
  <a class="editLink" id="returnToPanel" style="" href="../editor.php">
  <div>
    <p class="title">Return To<br>Admin Panel</p>
  </div></a>
<table>
<form action="editAdmin.php" method="post">
<tr><td> <label for="password">Change Password</label> <input type="text" id="password" name="password">       </td></tr>
<br>
<tr><td> <label for="password">Retype</label> <input type="text" id="password" name="passwordCheck">       </td></tr>
                <input type="hidden" name="table" value="password">
                <input type="hidden" name="input" value="yes">
<tr><td>    <input type="submit" class="button" value="Change Password"> </form> </td></tr>


<form action="editAdmin.php" method="post">
<tr><td><p>Current Email:  $currentEmail</p></td></tr>
<tr><td>  <label for="email">Change Email</email>  <input type="text" id="email" name="email">       </td></tr>             
 <tr><td>     <input type="hidden" name="table" value="email">
               <input type="hidden" name="input" value="yes">
    <input type="submit" class="button" value="Change Email"> </form> </td></tr>



</table>

</div>
</body>
</html>
_PAGE;




?>



