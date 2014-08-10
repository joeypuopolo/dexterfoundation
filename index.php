<?php
require_once 'login.php';
require_once 'sponsors.php';
    echo <<<_PAGE
<!doctype html>
<html>
<head>
  <meta name="description" content="The Dexter Foundation: Serving Los Angeles County and Southern California. We are dedicated to rescuing dogs in the Southern California Area and placing them in a loving, forever home.">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">
  <script language="javascript" src="js/modernizr.dexterfoundation.js"></script>


  <title>The Dexter Foundation</title>
</head>
<body>
_PAGE;


 

   
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());
   
    
    $query = "SELECT * FROM dogs";

    
    
    $result = mysql_query($query);
    if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());
    $rows = mysql_num_rows($result);

    
    $doggies = array();
    $headlines = array();
    $names = array();
    $pics = array();
    
    for ($j = 0; $j < $rows; ++$j) {
    //captures info about each dog in an array. Each 'dog' array is put into a container array called $doggies
      $row = mysql_fetch_row($result);
      
      $headlines[] = $row[3];
      $names[] = $row[1];
      $pics[] = $PIC_PATH.$row[5];
      $doggies[] = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]); 
      //[id, names1, age2, headline3, subhead4, pic5, bio6]
    }
     $doggieLength = count($doggies);
     if ($doggieLength < 1) {
        $doggieLength = 1;
     }

     // 
     //  $rowHeight = height of allcontent
     //  $displayHeight = height of the doggieDisplay
     // 
     $rowHeight = (ceil(($doggieLength / 4))*400)+900;
     $displayHeight = $rowHeight-900+60; // adds the padding to it
     // 
     // 1080px just looks pretty, that's all, but it must be in both variables
     // 


 ///////////////////////////////////////////  
     //
     //    gathering contact info data
     //
     
     $queryPhone = "SELECT * FROM phone";
     //  $db_server = mysql_connect($db_hostname, $db_username, $db_password);
     //  if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());
     //mysql_select_db($db_database) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());
    $resultPhone = mysql_query($queryPhone);
    if (!$resultPhone) die("Database access failed". mysql_errno() . ": " . mysql_error());
    
    $rowsPhone = mysql_num_rows($resultPhone);
    
    $phone = mysql_fetch_row($resultPhone);

    
     
     $queryEmail = "SELECT * FROM email";
     $resultEmail = mysql_query($queryEmail);
    if (!$resultEmail) die("Database access failed". mysql_errno() . ": " . mysql_error());
    
    $rowsEmail = mysql_num_rows($resultEmail);
    
    $email = mysql_fetch_row($resultEmail);

     
    
     
     $queryFax = "SELECT * FROM fax";
     $resultFax = mysql_query($queryFax);
    if (!$resultFax) die("Database access failed". mysql_errno() . ": " . mysql_error());
    
    $rowsFax = mysql_num_rows($resultFax);
    
    $fax = mysql_fetch_row($resultFax);

     
     
      $queryAddress = "SELECT * FROM address";
     $resultAddress = mysql_query($queryAddress);
    if (!$resultAddress) die("Database access failed". mysql_errno() . ": " . mysql_error());
    
    $rowsAddress = mysql_num_rows($resultAddress);
    
     $address = mysql_fetch_row($resultAddress);

 ///////////////////////////////////////////////////////////// 


///////////////////////////////////////////  
     //
     //    gathering articles data
     //
     
    $queryArticle1 = "SELECT * FROM articles WHERE location='1'";
    $resultArticle1 = mysql_query($queryArticle1);
    if (!$resultArticle1) die("Database access failed". mysql_errno() . ": " . mysql_error());
    $article1 = array();
    $article1 = mysql_fetch_row($resultArticle1);
    $article1Headline = lineBreaksDecode($article1[1]);
    $article1Body = lineBreaksDecode($article1[2]);

    $queryArticle2 = "SELECT * FROM articles WHERE location='2'";
    $resultArticle2 = mysql_query($queryArticle2);
    if (!$resultArticle2) die("Database access failed". mysql_errno() . ": " . mysql_error());
    $article2 = array();
    $article2 = mysql_fetch_row($resultArticle2); 
    $article2Headline = lineBreaksDecode($article2[1]);
    $article2Body = lineBreaksDecode($article2[2]);
      

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

echo <<<_PAGE2

 <!-- <div id="allcontent" style="height:{$rowHeight}px;"> -->
  <div id="allcontent">
  <aside>  
    {$DONATE}
  </aside>
  <header class="extendfull">
    <img src="img/logo.png" alt="The Dexter Foundation: Serving Los Angeles County and Southern California">
  
  

  <nav>
    <ul>
      <li class="CURRENT_PAGE">
      <a href="http://{$_SERVER['SERVER_NAME']}">Home</a>
      <p id="home" class="paw"></p>
      </li>
      
      <li onmouseover="visible('about')" onmouseout="invisible('about')">
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
 <div id="missionStatementImage">
    <img id="missionStatement" src="img/missionStatement.png" alt="We are dedicated to rescuing dogs in the Southern California Area and placing them in a loving, forever home."> 
  </div>

  <div id="doggieDisplay" style="height:{$displayHeight}px;">
    <div class='profile'>
_PAGE2;
     
     
    
    for($j=0; $j<$doggieLength; $j+=4){
    //creates the layout for the doggie display table
    // the various counter variables throughout the loops control the amount of doggies per row
      
 
      for($i=$j; $i<$j+4; $i++){
      //writes out the headlines in the table
        $id = 'profile.php?id='.$doggies[$i][0]; //sets up the GET link
      $headline = $headlines[$i];
        if ($i==0) {
          echo "<div class='row'>";
       
        }
        if (($i % 4)==0 && ($i!=0)) {

          echo "</div> <div class='row'>";
        }
        
        $headline = lineBreaksDecode($headline);
        $pic = "<img style=\"width:200px;\" src=\"".lineBreaksDecode($pics[$i])."\">";
        $names[$i] = lineBreaksDecode($names[$i]);
        $link = "<a href=\"$id\" target=\"_blank\">";

        if (is_null($doggies[$i][0])) {
        //in case there is no doggie for this, the link will do nothing
        //if $id == null, then echo #
            
            $pic="";
            $link = "<a href=\"\" style=\"pointer-events: none; cursor: default;\">";
        }

          echo <<<_END
            {$link}
            <div class='shortBio'>
            <div class='_HEADLINE'>$headline</div>
            <div class='_IMG'>$pic</div>
            <div class='_NAME'><p>$names[$i]</p></div>
          </div></a>

_END;
      }

      }    
 mysql_close($db_server);
echo <<<_END

</div>
</div>
</div>

  <div id="lowerColumns_home">
  

     <div id="column_home_left" class="column_home"><div class="title">{$article1Headline}</div><br>
        <p>
        {$article1Body}
        </p>
    </div>

    <div id="column_home_center" class="column_home"><div class="title">{$article2Headline}</div><br>
      <p>
        {$article2Body}
      </p>
    </div>
   
 
    <div id="contactUs" class="column_home">
    <div class="title">Contact Us</div><br>
   <br>
   <div>The Dexter Foundation <br>
  <div id="contactInfo">
  {$address[0]} <br> {$address[1]}</div></div> <br>
  <div>Phone <br> <div id="contactInfo">{$phone[0]}</div></div> <br>
  <div>Fax <br> <div id="contactInfo">{$fax[0]}</div> </div> <br>
  <div>Email <br> <div id="contactInfo">{$email[0]}</div></div>
    </div>
  
  </div>

  </div>


  <footer>

  $sponsors

  </footer>
    <script type="text/javascript" src="js/scripts.js"></script>
    
</body>
</html>
_END;

     
 ?>
