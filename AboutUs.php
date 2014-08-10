<?php
require_once 'login.php';
require_once 'sponsors.php';

echo <<<_ABOUT
<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">
  <script language="javascript" src="js/modernizr.dexterfoundation.js"></script>


  <title>The Dexter Foundation</title>
</head>
<body>
<div class="background">
  <div id="allcontent">
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
      
      <li  class="CURRENT_PAGE">
        <a href="AboutUs.php">About Us</a>
        <p id="about" class="paw"></p>
      </li>

      <li onmouseover="visible('adoption')" onmouseout="invisible('adoption')" >
        <a style="position: relative; top:-15px;" href="AdoptionApplication.php">Adoption<br>Application</a>
        <p id="adoption" class="paw" style="position: relative; top:-10px;"></p>
      </li>

      <li onmouseover="visible('inNeed')" onmouseout="invisible('inNeed')" title="Petfinder.com">
        <a href="http://www.adoptapet.com/shelter75425-pets.html" target="_blank">Dogs in Need</a>
        <p id="inNeed" class="paw"></p>
      </li>

      <li onmouseover="visible('success')" onmouseout="invisible('success')">
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

  <article class="aboutUs">
  

    


_ABOUT;
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());
    
   ///////////////////////////////////////////  
     //
     //    gathering articles data
     //
     
    $queryArticle3 = "SELECT * FROM articles WHERE location='3'";
    $resultArticle3 = mysql_query($queryArticle3);
    if (!$resultArticle3) die("Database access failed". mysql_errno() . ": " . mysql_error());
    $article3 = array();
    $article3 = mysql_fetch_row($resultArticle3);
    $article3Headline = lineBreaksDecode($article3[1]);
    $article3Body = lineBreaksDecode($article3[2]);
       
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

// //$article1[1] is the title of article1
   

 ///////////////////////////////////////////////////////////// 
echo <<<_PAGE

<div class="title">{$article3Headline}</div>
<div class="about">
  <p>
  {$article3Body}
  </p>

_PAGE;

 mysql_close($db_server);   
    ?>

</div>
  </article>

</div>
<div class="footer_background">
  <footer>
    <?php
  echo $sponsors;
  ?>
  </footer>
  </div><!-- END .footer_background -->
      <script type="text/javascript" src="js/scripts.js"></script>
</div><!-- END .background -->
</body>
</html>