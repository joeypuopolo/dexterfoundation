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
tr:nth-child(even)    { background-color:white; } 
tr:nth-child(odd)    { background-color:#ccc; }




/*.value {
  width: 200px;
}*/
.button {
  width: 110px;
}
td {
    padding: 10px;
}
table{
  width: 500px;
  margin: 20px;
}
.DATA {
  width: 1050px;
}
.label, label {
  font-style: italic; 
  font-size: 10pt;
}
ul li:nth-child(odd){
  background-color:  white;
}
ul li:nth-child(even){
  background-color:  #ccc;
}
ul{
  list-style:   none;
}
li {
  padding: 4px;
}
</style>
</head>
<body>
<div id="allcontent" style="height:100%">
  <a class="editLink" id="returnToPanel" style="" href="../editor.php">
  <div>
    <p class="title">Return To<br>Admin Panel</p>
  </div></a>

_PAGE;


 if (!$loggedin) { header("Location: editorLogin.php");}

$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());

mysql_select_db($db_database, $db_server) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());


if (isset($_POST['delete']) && isset($_POST['location'])) {
  $location = $_POST['location'];
  $query ="DELETE FROM articles WHERE location='$location'";

  if (!mysql_query($query, $db_server))
   echo "DELETE failed: $query<br>" . 
   mysql_errno() . " " . mysql_error() . "<br><br>";
}

if (isset($_POST['location']) &&
    isset($_POST['headline']) &&
  isset($_POST['article'])) {

  $location= $_POST['location'];


  $headline = sanitize(lineBreaksEncode($_POST['headline']));

  $article = sanitize(lineBreaksEncode($_POST['article']));


$query = "INSERT INTO articles VALUES('$location', '$headline', '$article')";

  if (!mysql_query($query, $db_server))
   echo "DELETE failed: $query<br>" . mysql_errno() . " " . mysql_error() . "<br><br>";
  }
 


echo <<<_END
<table>
  <form action="editArticles.php" method="post"><pre>
  <tr><td> <label for="locationID">Location</label> </td><td>

<ul>
<li><input type="radio" id="locationID" name="location" value="1">Homepage, lower left</li>

<li><input type="radio" id="locationID" name="location" value="2">Homepage, lower middle</li>

<li><input type="radio" id="locationID" name="location" value="3">About Us</li>

<li><input type="radio" id="locationID" name="location" value="4">Application, top</li>

<li><input type="radio" id="locationID" name="location" value="5">Success Stories, top</li>
</ul>
  </td></tr>
  <tr><td> <label for="headline"> Headline</label> </td><td> <input type="text" id="headline" name="headline">       </td></tr>
  <tr><td> <label for="article">  Article</label> </td><td>
  <p>You may use the <em>strong</em>, <em>em</em>, <em>br</em>, and <em>p</em> HTML tags.</p>
  <br>
  <textarea type="text" id="article" name="article" cols="50" rows="15"></textarea></td></tr>
  <tr><td> </td><td>   <input type="submit" value="Add Article">  </td></tr>
  </pre></form>
  </table>
_END;


$query = "SELECT * FROM articles";
$result = mysql_query($query);
if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());

$rows = mysql_num_rows($result);

for($j=0; $j<$rows; ++$j) {
  $row = mysql_fetch_row($result);
  
  $desc = NULL;
  if($row[0]=="1") $desc = "Homepage, lower left";
  if($row[0]=="2") $desc = "Homepage, lower middle";
  if($row[0]=="3") $desc = "About Us";
  if($row[0]=="4") $desc = "Application, top";
  if($row[0]=="5") $desc = "Success Stories, top";
  echo <<<_END
  <br><br>
<table class="DATA">

  <tr><td class="label"> Location </td> <td class="value"> $desc </td></tr>
 <tr><td class="label">  Headline </td> <td class="value"> $row[1] </td></tr>
 <tr><td class="label">  Article </td> <td class="value"> $row[2] </td></tr>

  <tr><td>
  <form action="editArticles.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="location" value="$row[0]">
 </td> <td> <input type="submit" value="Remove Article"></td></tr></form>
  </table>
_END;
}

mysql_close($db_server);

function lineBreaksEncode($string) {
  //return str_replace("<br>", "LINE_BREAK", $string);
  $tags = array("<br>", "<p>", "</p>", "<strong>", "</strong>", "<em>", "</em>");
  $replacement = array("LINE_BREAK", "P_START", "P_END", "B_START", "B_END", "I_START", "I_END");
  $newstring = $string;
  
  for($i=0; $i<7; $i++){
    if (strpos($string, $tags[$i]) !== false) {
      $newstring = str_replace($tags[$i], $replacement[$i], $newstring);
    }
  }
  return $newstring;
}

// if (strpos($a,'are') !== false) {
//     echo 'true';
// }


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