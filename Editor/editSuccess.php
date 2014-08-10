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
}


</style>
</head>
<body>
<div id="allcontent" style="padding-top:10px;">
  <a class="editLink" id="returnToPanel" style="" href="../editor.php">
  <div>
    <p class="title">Return To<br>Admin Panel</p>
  </div></a>
_PAGE;

session_start();
require_once '../login.php';

  if (!$loggedin) { header("Location: editorLogin.php");}

$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());

mysql_select_db($db_database, $db_server) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());

if (isset($_POST['delete']) && isset($_POST['id'])) {
  $id = get_post('id');

  if(isset($_POST['photo'])) {  //if a photo exists, delete it
    $pic = get_post('photo');
    unlink("..".$PIC_PATH.$pic);
  }
  $query ="DELETE FROM success WHERE id='$id'";

  if (!mysql_query($query, $db_server))
   echo "DELETE failed: $query<br>" . 
   mysql_errno() . " " . mysql_error() . "<br><br>";
}

if (isset($_POST['name']) &&
    isset($_POST['bio']))
{
  $id = toString(time()-1387656329);
  $name = get_post('name');
  $pic = $name.$id.".".pathinfo($dir, PATHINFO_EXTENSION); //filename: name+id.jpg
  $bio = get_post('bio');

$query = "INSERT INTO success VALUES($id, '$name', '$pic', '$bio')";
 //isset($_FILES['pic']) &&
move_uploaded_file($_FILES['pic']['tmp_name'], "..".$PIC_PATH_SUCCESS.$pic); //file path adds '.' to move up in dir tree
if (!mysql_query($query, $db_server))
    echo "INSERT failed: $query<br>" . 
    mysql_errno() . " " . mysql_error() . "<br><br>";
  
}

echo <<<_END
<table>
  <form action="editSuccess.php" method="post" enctype="multipart/form-data">
<tr><td>  <label for="name">Name <input type="text" id="name" name="name">       </td></tr>
<tr><td>  <label for="pic">Photo</label> <input type="file" id="pic" name="pic">  </td></tr>
<tr><td>  <label for="bio">Bio</label> <textarea type="text" id="bio" name="bio" cols="60" rows="15"></textarea></td></tr>
<tr><td>    <input type="submit" value="Add Doggie">  </td></tr>
  </form>
  </table>
_END;


$query = "SELECT * FROM success";
$result = mysql_query($query);
if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());

$rows = mysql_num_rows($result);

for($j=0; $j<$rows; ++$j) {
  $row = mysql_fetch_row($result);
  echo <<<_END
  <br><br>
<table class="DATA">
  
  <tr><td class="label"> ID </td> <td class="value"> $row[0] </td></tr>
 <tr><td class="label">  Name </td> <td class="value"> $row[1] </td></tr>
 <tr><td class="label">  Photo </td> <td class="value"> $row[2] </td></tr>
 <tr><td class="label">  Bio </td> <td class="value"> $row[3] </td></tr>

<tr><td></td><td>
  <form action="editSuccess.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="id" value="$row[0]">
  <input type="hidden" name="photo" value="$row[2]">
  <input type="submit" value="Remove Doggie"></td></tr></form>
  </table>
_END;
}

mysql_close($db_server);




function get_post($var) {
  //return mysql_real_escape_string($_POST[$var]);
  return lineBreaksEncode($_POST[$var]);
}

function lineBreaksEncode($string) {
// turns the HTML into markup
  $tags = array("<br>", "<p>", "</p>", "<strong>", "</strong>", "<em>", "</em>");
  $replacement = array("LINE_BREAK", "P_START", "P_END", "B_START", "B_END", "I_START", "I_END");
  $newstring = $string;
  
  for($i=0; $i<7; $i++){
    if (strpos($string, $tags[$i]) !== false) {
      $newstring = str_replace($tags[$i], $replacement[$i], $newstring);
    }
  }
  return sanitize($newstring);
}


function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
}

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}

?>
</div>
</body>
</html>