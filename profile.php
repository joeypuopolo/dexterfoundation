<?php
    require_once 'login.php';
    require_once 'sponsors.php';

if ($loggedin) {
  
} 
echo <<<_PAGEPROFILE
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
<div class="background">

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
        <a href="index.php#contactUs">Contact Us</a>
        <p id="contact" class="paw"></p>
      </li>
    </ul>

  </nav>
  

  </header>
 <div id="missionStatementImage">
    <img id="missionStatement" src="img/missionStatement.png" alt="We are dedicated to rescuing dogs in the Southern California Area and placing them in a loving, forever home."> 
  </div>




_PAGEPROFILE;


   
     
     if (!isset($_GET['id'])) {
       goHome();
       
     } else {
    
     //[id, names1, age2, headline3, subhead4, pic5, bio6]
    $id = $_GET['id'];
    $query = "SELECT * FROM dogs WHERE id='$id'";


    $db_server = mysql_connect($db_hostname, $db_username, $db_password);

    if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());

    mysql_select_db($db_database) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());


    $result = mysql_query($query);
    if (!$result) die("Database access failed". mysql_errno() . ": " . mysql_error());
    $dog = mysql_fetch_row($result);
    $dog[6] = lineBreaksDecode($dog[6]);
    if(!$dog[1]){
      goHome();
    } else {
    echo <<<_END
      <div class='doggieBio' style="float:left;">
      
      <div class="bioImg">
        <p class="name">
          $dog[1]
        </p>
        <h4>$dog[4]</h4>
        <img style="width:250px;" src="$PIC_PATH$dog[5]">
      </div>
      <!-- END .bioImg-->
      <div class="title" style="text-align: center; display: block;">$dog[3]</div>
      
         <p class="entry">
          $dog[6] 
        </p>
      
      

      </div>
      <!-- END .doggieBio -->
      


_END;
    }
  }

  function goHome() {
  // shows the page with no content except for a link to return home
    echo <<<_END
    <a href="index.php">
         <div class='doggieBio' style="float:left;" id='RETURN_HOME'>
         <div class="title">Return Home</div>
         </div></a>
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
   
    <div id="lowerColumns">
     
      <div class="column">
        <div class="title">
          Foster Homes Needed
        </div>
        <!-- END .title -->
          <p>
            So many dogs are finding their way into shelters. Sadly, due to overcrowding, many never make it out. We can only save as many dogs as we have available foster homes. Can you save a dog's life by giving it a warm, loving home for a few days or weeks? We pay all of the dog's expenses. Your kindness will be repaid with lots of love and affection! As a foster parent, you will NOT be required to bring the dog to weekly adoption events. We want fostering to be easy and rewarding! Every new foster home is a dog's life saved!
          </p>
        </div>
        <!-- END .column -->
        <div class="column">
          <div class="title">
            The Adoption Process
          </div>
          <!-- END .title -->
          <p>
            First and foremost, complete the application <a href="AdoptionApplication.php">here.</a>
            <br>
            We then schedule a quick and easy home check. We are only adopting out to the Southern California area. We save new dogs each week, so we often have dogs that we have yet to post online.
          </p>
        </div>
        <!-- END .column -->

    </div>
    <!-- END #lowerColumns -->


    <a class="applicationButtonOnProfile" href="http://dexterfoundation.com/AdoptionApplication.php">
      <p>  
      I want to save this dog! 
      <br>
      Take me to the application!
      </p>
    </a>
    <div class="video">
      <iframe width="710" height="429" src="//www.youtube.com/embed/ounP-yYcxC0" frameborder="0" allowfullscreen></iframe>
    </div>






  </div>
  <!-- END #allcontent -->
  <div class="footer_background">
  <footer>
    <?php
  echo $sponsors;
  ?>
  </footer>
  </div>
  <!-- END .footer_background -->
    <script type="text/javascript" src="js/scripts.js"></script>

</div>
<!-- END .background -->
</body>
</html>