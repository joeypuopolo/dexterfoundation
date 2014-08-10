<?php
require_once 'login.php';
require_once 'sponsors.php';

echo <<<_SUCCESS
<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">
  <script language="javascript" src="js/modernizr.dexterfoundation.js"></script>

    <style>

    article .happyDoggie:nth-child(even) div img {
      float: right;
      width: 200px;
      box-shadow: 10px 10px 20px #0093c8;
    }
    article .happyDoggie:nth-child(odd) div img {
      float: left;
      width: 200px;
      box-shadow: 10px 10px 20px #0093c8;
    }
    .happyDoggie #par {
      height: 200px;
      width: 925px;
      font-size: 15pt;

    }
    .happyDoggie #par strong{
      font-family: "wellfleetregular";
      font-size: 2em;
      text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
      display: block;
    }
    article .happyDoggie:nth-child(even) #par {
      float: left;
    }
    article .happyDoggie:nth-child(odd) #par {
      float: right;
    }
    .happyDoggie {
      margin-right: auto;
      margin-left: auto;
      height: 200px;
      width: 90%;
      display: block;
      padding: 70px 0px;
    }

  
  </style>





  <title>The Dexter Foundation</title>
</head>
<body>

_SUCCESS;
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());
    
   ///////////////////////////////////////////  
     //
     //    gathering success doggie data
     //
     
    $query = "SELECT * FROM success";
$result = mysql_query($query);
if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());

$rows = mysql_num_rows($result);


$height = (550+(350*$rows));
//calculates height based on how many success doggies there are
echo <<<_PAGE
  <div id="allcontent" style="height:{$height}px;">
<aside>
 {$DONATE}
  </aside>
  <header class="extendfull">
    <img src="img/logo.png" alt="The Dexter Foundation: Serving Los Angeles County and Southern California">
  
  
  <nav>
    <ul>
      <li onmouseover="visible('home')" onmouseout="invisible('home')">
        <a href="http://{$_SERVER['SERVER_NAME']}">Home</a>
        <p id="home" class="paw"></p>
      </li>
      
      <li onmouseover="visible('about')" onmouseout="invisible('about')">
        <a href="AboutUs.php">About Us</a>
        <p id="about" class="paw"></p>
      </li>

      <li onmouseover="visible('adoption')" onmouseout="invisible('adoption')">
        <a style="position: relative; top:-15px;" href="AdoptionApplication.php">Adoption<br>Application</a>
        <p id="adoption" class="paw" style="position: relative; top:-10px;"></p>
      </li>

      <li onmouseover="visible('inNeed')" onmouseout="invisible('inNeed')" title="Petfinder.com">
        <a href="http://www.adoptapet.com/shelter75425-pets.html" target="_blank">Dogs in Need</a>
        <p id="inNeed" class="paw"></p>
      </li>

      <li class="CURRENT_PAGE"> 
        <a href="SuccessStories.php">Success Stories</a>
        <p id="success" class="paw"></p>
      </li>

      <li onmouseover="visible('contact')" onmouseout="invisible('contact')">
        <a href="http://{$_SERVER['SERVER_NAME']}#contactUs">Contact Us</a>
        <p id="contact" class="paw"></p>
      </li>
    </ul>

  </nav>

  </header>
  <article>
    <img id="missionStatement" src="img/missionStatement.png" alt="We are dedicated to rescuing dogs in the Southern California Area and placing them in a loving, forever home."> 
  </article>
  <article class="success">
_PAGE;




for($j=0; $j<$rows; ++$j) {
  $row = mysql_fetch_row($result);
  $row[$j] = lineBreaksDecode($row[$j]);

  echo <<<_END
  <div class="happyDoggie">
    <div id="par">
      <strong>$row[1]</strong> $row[3]
    </div>
    <div>
      <img src="{$PIC_PATH_SUCCESS}{$row[2]}">
    </div>
  </div>

_END;
}
       
function lineBreaksDecode($string) {
//returns the markup to HTML
  $tags = array("<br>", "<p>", "</p>", "<strong>", "</strong>", "<em>", "</em>");
  $replacement = array("LINE_BREAK", "P_START", "P_END", "B_START", "B_END", "I_START", "I_END");
  $newstring = $string;
  
  for($i=0; $i<7; $i++){
    if (strpos($string, $replacement[$i]) !== false) {
      $newstring = str_replace($replacement[$i], $tags[$i], $newstring);
    }
  }
  return $newstring;
}


?>
   
  </article>

 
  </div>
  <footer class="extendfull">
    <?php
  echo $sponsors;
  ?>
  </footer>
      <script type="text/javascript" src="js/scripts.js"></script>

</body>
</html>