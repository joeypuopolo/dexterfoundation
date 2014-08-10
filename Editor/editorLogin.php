<?php
session_start();
require_once '../login.php';


if(isset($_POST['login'])) {
	$status = "checking password...";
	$db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());
    
  
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $query = "SELECT * FROM admin WHERE user='$user' and pass='$pass'";
    
    $result = mysql_query($query);
    if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());
    
    if(mysql_num_rows($result) != 0 ) {
		$_SESSION["LAST_ACTIVITY"] = time();
    	$_SESSION['user'] = $user;
    	$_SESSION['pass'] = $pass;
	}
    
    // $userData = mysql_fetch_row($result);
    // if($userData[1]==$_POST['password']) {
    // 		$AdminLoggedIn = TRUE;

    // 		$_SESSION["LAST_ACTIVITY"] = time();
    // 		$_SESSION['user'] = $user;
    // 		$_SESSION['pass'] = $pass;
    		
    // } else { $status = "Cant confirm password";}
}
echo <<<_PAGE
<html>
<head>

  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/normalize.css">
  <script language="javascript" src="../js/modernizr.dexterfoundation.js"></script>

<style>
	
	html {
		color: white;
	}
	input, textarea {
  float:right;
  width: 100%;
}

table {
  margin: 20px; 
  width: 500px;
}
tr:nth-child(even)    { background-color:white; } 
tr:nth-child(odd)    { background-color:#ccc; }
td {
    padding: 10px;
}
.DATA {
  width: 1050px;
}

.label, label {
  font-style: italic; 
  font-size: 10pt;
}
.button {
  width: 110px;
  background-color: #FF8D27;
  border: 2px solid white;
  color: white;
}
.button:hover{
	background-color: #F7611E;
}
.editLink {
	margin: 200px 500px;
}
.editLink:hover {
	background-color: #FF8D27;
}
#CONFIRMED:hover {
	background-color: #F7611E;
}

</style>

</head>

<body>
<div id="allcontent" style="height: 100%">

_PAGE;


if($_SESSION['user']=='admin') {
	echo <<<_LOGGEDIN
	<a class="editLink" id="CONFIRMED" href="../editor.php">
	  <div>
	    <p class="title">Continue To<br>Admin Panel</p>
	  </div>
	</a>
_LOGGEDIN;
} else {
	if(isset($_POST['login'])){ $tryagain = "Incorrect!";}
echo <<<_LOGIN
	
		<div class="editLink" id="inputs">
		$tryagain
		<form method='post' action="editorLogin.php">
			<label for="user">Username</label>
			<br>
			<input type="text" id="user" name="username">
			<br><br>
			<label for="password">Password</label>
			<br>
			<input type="password" id="password" name="password">
			<br><input type="hidden" name="login">
			<br>
			<input class="button" type="submit" value="Login">
			</form>
		</div>
_LOGIN;

}




?>
	<!-- </div> -->



</div>

</body>
</html>