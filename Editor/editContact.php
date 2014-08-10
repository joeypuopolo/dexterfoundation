<?php
require_once '../login.php';

if (!$loggedin) {
  $redirect = <<<_REDIRECT
You must <a href="./editorLogin.php">Login</a>
_REDIRECT;
die($redirect);
}

echo <<<_PAGE
<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/normalize.css">
  <script language="javascript" src="../js/modernizr.dexterfoundation.js"></script>

<style>
input, textarea {
  float:right;
}
tr { background-color:#ccc; } 

.value {
  width: 200px;
}
.button {
  width: 110px;
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
<div id="allcontent" style="">
  <a class="editLink" id="returnToPanel" style="" href="../editor.php">
  <div>
    <p class="title">Return To<br>Admin Panel</p>
  </div></a>


<body>
<p>
  Note:
  Delete old contact info <em>before</em> inputting new.
</p>
_PAGE;

  

 if (!$loggedin) { header("Location: editorLogin.php");}
//
//  DATABASE CONNECT
//
  $db_server = mysql_connect($db_hostname, $db_username, $db_password);

  if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());

  mysql_select_db($db_database, $db_server) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());


  

/////////////////////////////
//
//Edit values
//
//////////////////////////////


if (isset($_POST['delete']) && isset($_POST['id'])) {
  $id = $_POST['id'];
  $table = $_POST['table'];
  $query ="DELETE FROM $table WHERE $table='$id'";


  if (!mysql_query($query, $db_server))
   echo "DELETE failed: $query<br>" . 
   mysql_errno() . " " . mysql_error() . "<br><br>";
}

if (isset($_POST['input'])) {

  $table = $_POST['table'];

      if ($table=="address") {
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $queryAddress = "INSERT INTO address VALUES('$address1', '$address2')";
        $stateaddress = 'disabled';

        if (!mysql_query($queryAddress, $db_server))
          echo "INSERT failed: $query<br>" . 
          mysql_errno() . " " . mysql_error() . "<br><br>";
  
      } else {
        $data = $_POST[$table];
        $query = "INSERT INTO $table VALUES('$data')";

        
        
        if (!mysql_query($query, $db_server))
          echo "INSERT failed: $query<br>" . 
          mysql_errno() . " " . mysql_error() . "<br><br>";
      }  
}

echo <<<_END
<table>

<form action="editContact.php" method="post">
<tr><td> <label for="phone"> Phone</label> <input type="text" id="phone" name="phone">       </td></tr>
                <input type="hidden" name="table" value="phone">
                <input type="hidden" name="input" value="yes">
<tr><td>    <input type="submit" class="button" value="Add Phone"> </form> </td></tr>


<form action="editContact.php" method="post">
<tr><td>  <label for="fax">Fax</fax>  <input type="text" id="fax" name="fax">       </td></tr>             
               <input type="hidden" name="table" value="fax">
               <input type="hidden" name="input" value="yes">
<tr><td>    <input type="submit" class="button" value="Add Fax"> </form> </td></tr>


<form action="editContact.php" method="post">
<tr><td>  <label for="email">Email</label> <input type="text" id="email" name="email">    </td></tr>
                  <input type="hidden" name="table" value="email">
                  <input type="hidden" name="input" value="yes">
<tr><td>    <input type="submit" class="button" value="Add Email"> </form> </td></tr>


<form action="editContact.php" method="post">
<tr><td>  <label for="address">Address</label> <input type="text" id="address" name="address1">   
                  <br>
                  <input type="text" id="address" name="address2"> </td></tr>
                  <input type="hidden" name="table" value="address">
                  <input type="hidden" name="input" value="yes">
<tr><td>    <input type="submit" class="button" value="Add Address"> </form> </td></tr>


</table>
<br><br><br>
_END;


/////////////////////////////
//
//Current values
//
//////////////////////////////

//PHONE
$queryPhone = "SELECT * FROM phone";
$resultPhone = mysql_query($queryPhone);
if (!$resultPhone) die("Database access failed". mysql_errno() . ": " . mysql_error());
$phones = mysql_num_rows($resultPhone);

for($j=0; $j<$phones; ++$j) {
  $phone = mysql_fetch_row($resultPhone);
  echo <<<_END
<table>
 <!-- 

Phone info

 -->
 <br>
 <form action="editContact.php" method="post">
 <tr><td class="label">  Phone </td></tr>
 <tr> <td class="value"> $phone[0] </td></tr>

  <tr><td>
  <input type="hidden" name="delete" value="yes">
    <input type="hidden" name="table" value="phone">
  <input type="hidden" name="id" value="$phone[0]">
  <input type="submit" class="button" value="Remove"></form> </td></tr>
 </table>
_END;
}

//FAX
$queryFax = "SELECT * FROM fax";
$resultFax = mysql_query($queryFax);
if (!$resultFax) die("Database access failed". mysql_errno() . ": " . mysql_error());
$faxes = mysql_num_rows($resultFax);

for($j=0; $j<$faxes; ++$j) {
  $fax = mysql_fetch_row($resultFax);
  echo <<<_END
<!-- 

Fax info

 -->
 <br>
 <table>
<form action="editContact.php" method="post">
  <tr><td class="label">  Fax </td></tr> 
   <tr>  <td class="value"> $fax[0] </td></tr>

 <tr><td>
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="table" value="fax">
  <input type="hidden" name="id" value="$fax[0]">
 <input type="submit" class="button" value="Remove"></form> </td></tr>
 </table>
_END;
}

//EMAIL
$queryEmail = "SELECT * FROM email";
$resultEmail = mysql_query($queryEmail);
if (!$resultEmail) die("Database access failed". mysql_errno() . ": " . mysql_error());
$emails = mysql_num_rows($resultEmail);

for($j=0; $j<$emails; ++$j) {
  $email = mysql_fetch_row($resultEmail);
  echo <<<_END
<!-- 

Email info

 -->
 <br>
 <table>
 <form action="editContact.php" method="post">
  <tr><td class="label">  Email </td></tr>
  <tr> <td class="value"> $email[0] </td></tr>
 
  <tr> <td>
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="table" value="email">
  <input type="hidden" name="id" value="$email[0]">
  <input type="submit" class="button" value="Remove"></form> </td></tr>
 </table>
_END;
}

//ADDRESS
$queryAddress = "SELECT * FROM address";
$resultAddress = mysql_query($queryAddress);
if (!$resultAddress) die("Database access failed". mysql_errno() . ": " . mysql_error());
$addresses = mysql_num_rows($resultAddress);

for($j=0; $j<$addresses; ++$j) {
  $address = mysql_fetch_row($resultAddress);
  echo <<<_END
<!-- 

Address info

 -->
 <br>
 <table>
  <form action="editContact.php" method="post">
  <tr><td class="label">  Address </td> </tr>
 <tr> <td class="value"> $address[0] </td></tr>
 <tr> <td class="value"> $address[1] </td></tr>
  
 
 <tr> <td>  <input type="hidden" name="delete" value="yes">  
  <input type="hidden" name="table" value="address">
  <input type="hidden" name="id" value="$address[0]">
 <input type="submit" class="button" value="Remove"></form> </td></tr>
  </table>
_END;
}

mysql_close($db_server);
?>
</div>
</body>
</html>