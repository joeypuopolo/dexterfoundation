<?php
include_once 'login.php';
require_once 'sponsors.php';
require_once './PHPMailer/PHPMailerAutoload.php';

// require_once 'application_send.php';




if($_POST['SUBMIT']=="yes") {
//makes sure an application was submitted
$bodytext = <<<BODY

  <br>Contact Information<br></p>

    <form id="applicationForm">
      <table id="contactInformation">
      <tr>  
      <td>Full name</td> <td> {$_POST["name"]}  </td>
      </tr>
      <tr>
      <td>Age</td> <td> {$_POST["age"]} </td>
      </tr>
      <tr>
      <td>Address</td><td>{$_POST["address1"]}<br> <br>

            {$_POST["address2"]}  </td>
      </tr>      
      <tr>      
      <Td>City</td> <td> {$_POST["city"]} </td>
      </tr>
      <tr>
      <td>State</td> <td> {$_POST["state"]} </td>
      </tr>
      <tr>
      <td> Zip</td> <td> {$_POST["zip"]} </td>
      </tr>
      <tr>
      <td>Email</td> 
      <td> {$_POST["email"]} </td>
      </tr>
      <tr>
      <td>Home Phone</td> 
      <td> {$_POST["h_phone"]} </td>
      </tr>
      <tr>
      <td>Cell Phone</td> <td> {$_POST["c_phone"]} </td>
      </tr>
      <tr>
      <td>Work Phone</td> <td> {$_POST["w_phone"]} </td>
      </tr>
      <tr>
      <td>When is the best time to reach you?</td>
      <td> {$_POST["best_time"]} </td>
      </tr>
    </table>



      <p class="title">
        <br><br>Family Information<br>
      </p>

      <table id="familyInformation">
      <tr>
      <td>Living Status</td> <td> {$_POST["marital"]} </td>
      </tr>
      <tr>
      <td>Do you have any other people living in your home?</td>
        <td> {$_POST["other_people"]} </td>
      </tr>    
      <tr>
        <td>Do they approve of adopting this dog?</td>
          <td>
          {$_POST["approval"]}
          </td>
      </tr>  
          
      <tr>
        <td>Does your spouse/significant other approve of you adopting this dog?</td>
          <td> {$_POST["spouseApproval"]} </td>
      </tr>    
      <tr>
          <td>Name of spouse/significant other</td> <td> {$_POST["nameOfSig"]} </td>
      </tr>
      <tr>
          <td>Age of spouse/significant other</td> <td> {$_POST["ageOfSig"]} </td> 
      </tr>
      <tr>
        <td>Do you have children visit your home regularly or living in your home?</td>
        <td> {$_POST["children"]} </td>
      </tr>
      <tr>
        <td>How many children?</td> <td> {$_POST["numberOfChildren"]} </td>
      </tr>
      <tr>
          <td>What are their ages?</td> <td> {$_POST["ageOfChildren"]} </td>
      </tr>
      <tr>
        <td>Please list others in your household who will have contact with the dog, such as main, nanny, etc. If there is nobody else, then please specify. </td>  <td>{$_POST["whoElseHasContact"]} </td>
      </tr>
      <tr>
        <td>Why do you want to adopt a rescued dog? </td> <td> {$_POST["whyAdopt"]} </td>
      </tr>
      <tr>
        <td>What qualities do you like in a rescued dog? </td> <td> {$_POST["likedQualities"]} </td>
      </tr>
      <tr>
        <td>What qualities or traits don&#8217;t you want to find in a rescued dog?</td> <td> {$_POST["unlikedQualities"]} </td>
      </tr>
      <tr>
        <td>Are you committed to caring for this dog for its lifetime? </td> <td> {$_POST["lifetime"]}  </td>
      </tr>
      <tr>    
        <td>Where will the dog stay during the day? </td> <td> {$_POST["duringTheDay"]} </td>
      </tr>
      <tr>
        <td>How long will the dog be left alone during the day?  </td> <td> {$_POST["hrs"]}
        <br><br> {$_POST["days"]} </td>
      </tr>
      <tr>
        <td>Will the dog have access to the house AND yard while left alone? </td> <td>  {$_POST["houseANDyard"]} </td>
      </tr>
      <tr>
        <td>Who will let the dog out?</td>  <td> {$_POST["whoLetOut"]} </td>
      </tr>
      <tr>
        <td>Do you have:</td> 
          <td><em>a dog sitter?</em> <br> {$_POST["sitter"]} <br><br>
          <em>a dog walker?</em> <br> {$_POST["walker"]} <br><br>
          <em>a doggie door?</em> <br> {$_POST["door"]} </td>
      </tr>
      <tr>  
        <td>Where will the dog sleep? </td>  <td> {$_POST["whereSleep"]} </td> 
      </tr>
      <tr>
        <td>Will the dog be allowed on the furniture?</td> <td> {$_POST["onFurniture"]} </td>
      </tr>
      <tr>
        <td>Do you own your own home or rent? </td>  <td> {$_POST["ownRent"]} </td>
      </tr>
      <tr>        
        <td>Does landlord approve of dogs on property?</td> <td> {$_POST["landlordApproval"]} </td>
      </tr>
      <tr>      
        <td>Please give name and number of your <strong>landlord</strong> as they will be contacted to verify that you are allowed to have animals.</td>
        <td> {$_POST["landlordName"]} <br>
        <br> {$_POST["landlordPhone"]} </td>
      </tr>
      <tr>
        <td>Please attach a copy of your lease or notarized statement from your landlord stating the number and size of pets you are allowed to own</td>
        <td> {$_POST["lease"]} </td>
      </tr>
      <tr>
        <td>What kind of home do you have? <br> <em>eg. apartment, condo, home, etc.<em> </td> <td> {$_POST["typeDwelling"]} </td>
      </tr>
      <tr>
        <td>Do you have a fenced in yard?</td> <td> {$_POST["fence"]} </td>
      </tr>
      <tr>
        <td>What kind of fence do you have? <br> <em>eg. chain link, picket, etc.</em></td> <td> {$_POST["fenceType"]} </td> 
      </tr>
      <tr>
        <td>What is the height of the fence?</td> <td> {$_POST["fenceHeight"]} </td>
      </tr>
      <tr>
        <td>How are you going to exercise this dog?</td> <td> {$_POST["howToExercise"]} </td>
      </tr>
      <tr>
        <td>How will you keep this dog from running away or becoming lost?</td> <td> {$_POST["keepFromRunning"]} </td>
      </tr>
      <tr>
      </table>




      <p class="title">
        <br><br>Rescue Dog Information<br>
      </p>

      <table id="rescueDogInfo">
      <tr>
        <td>Are you interested in a specific Dexter Foundation dog(s) listed on our homepage or Petfinder.com?</td>
        <td style="width:300px;"> {$_POST["specificDog"]} </td>
      </tr>
    
      <tr>
        <td>Which dog are you interested in? </td> <td> {$_POST["specificDogName"]} </td>
      </tr>
      <tr>
        <td>Please note, The Dexter Foundation rarely has puppies. But please tell us your preferences.<br>
        What are you interested in?  </td>
        <td> {$_POST["preference"]} </td>     
      </tr>  
      <tr>
        <td>What about age?</td>  <td> {$_POST["agePreference"]} <br>
            {$_POST["preferredAge"]} </td>
      </tr>
      <tr>
          <td>Would you accept a dog with any of the following issues? Check all that apply. </td>
        <td class="checkboxes"><ul>
        <li class="g">Scarring<br>
          {$_POST["scarring"]} </li>
        
        <li class="w">Skin Problems<br>
          {$_POST["skinProblems"]} </li>
        
        <li class="g">Snorting<br>
          {$_POST["snorting"]} </li>
        
        <li class="w">Special Diet<br>
          {$_POST["specialDiet"]} </li>
        
        <li class="g">Allergies<br>
          {$_POST["allergies"]} </li>
        
        <li class="w">Arthritis<br>
          {$_POST["arthritis"]} </li>
        
        <li class="g">Balance Problems<br>
          {$_POST["balanceProblems"]} </li>
        
        <li class="w">Blindness<br>
          {$_POST["blindness"]} </li> 
        
        <li class="g">Deafness<br>
          {$_POST["deafness"]} </li>
        
        <li class="w">Ear Discharge<br>
          {$_POST["earDischarge"]} </li>
        
        <li class="g">Hair Loss<br>
          {$_POST["hairLoss"]} </li>
        
        <li class="w">Heart Disease<br>
          {$_POST["heartDisease"]} </li>
        
        <li class="g">Incontinence<br>
          {$_POST["incontinence"]} </li>
        
        <li class="w">Limping<br>
          {$_POST["limping"]} </li>

        
        <li class="g">Myelinopathy<br>
          {$_POST["myelinopathy"]} </li>
        
        <li class="w">One-eyed<br>
          {$_POST["oneEyed"]} </li>
        
        <li class="g">Spinal Deformity<br>
          {$_POST["spinalDeformity"]}</li>
        
        <li class="w">Three Legged<br>
          {$_POST["threeLegged"]} </li>
        
        <li class="g">Separation Anxiety <br>
          {$_POST["separationAnxiety"]} </li>
          
      </ul>
        </td>
      </tr>
      <tr>
        <td>Would you adopt two dogs that have come from the same home & need to stay together? </td> <td> {$_POST["stayTogether"]} </td>
      </tr>
      <tr>
        <td>Should any of the following apply to your new pet? <br> Check any that should.</td>
          <td> {$_POST["dogfriendly"]} <br>
               {$_POST["catfriendly"]} <br>
               {$_POST["whateverfriendly"]} </td>
      </tr>
      </table>

        <p class="title">
          <br><br>Previous Pet History<br>
        </p>
        <table id="petHistory">
          <tr>
            <td>Have you ever owned a dog before?</td> <td> {$_POST["everOwnedDog"]} </td>
          </tr>
          <tr>
            <td>Tells us about your previously owned dogs. List the breed, and the number of years they were with you.</td> 
            <td> {$_POST["dogHistory"]} </td>
          </tr>
          <tr>
            <td>Do you have any dogs in your home currently?</td> <td> {$_POST["currentDogs"]}</td>
          </tr>
          <tr>
            <td>Please list their breed, age, and sex.</td>  <td> {$_POST["currentDogDesc"]} </td>
          </tr>
          <tr>
            <td>Are they spayed/neutered?</td> <td> {$_POST["fixed"]} </td>
          </tr>
          <tr>
            <td>Please explain why they're not spayed/neutered.</td> {$_POST["whyNotFixed"]} </td>
          </tr>
          <tr>
            <td>What other types of pets do you own that currently live in your house? </td> <td> {$_POST["otherPets"]} </td>
          </tr>
          <tr>
            <td>Are all your current pets up to date on their annual vaccinations? </td> <td> {$_POST["otherPetsVacc"]} </td>
          </tr>
          <tr>
            <td>In addition to the pets identified above, what other pets have you owned in the last 5 years?</td>  <td> {$_POST["petsInLast5Yrs"]} </td>
          </tr>
          <tr>
            <td>Have you owned any other pets more than 5 years ago?</td> <td> {$_POST["pastPets"]} </td>
          </tr>
          <tr>
            <td>Please describe specifically how long ago you owned these pets, and describe the animals. </td> <td> {$_POST["petsBeforeLast5Yrs"]} </td>
          </tr>
          <tr>
            <td>Why do you no longer have these pets? </td> <td> {$_POST["whereAreYourPets"]} </td>
          </tr>
          <tr>
            <td>Do you have any experience with formal obedience training of dogs? </td> <td> {$_POST["formalObedienceTraining"]} </td>
          </tr>
          <tr>
            <td>Please explain the methods of training and where you learned how to train a dog.</td> <td> {$_POST["explainTrainingMethods"]} </td>
          <tr>
            <td>Have you filled out an adoption application with any other rescue organization? </td> <td> {$_POST["previousApp"]} </td>
          </tr>
          <tr>
            <td>To whom did you apply and when? </td> <td> {$_POST["whoAndWhenApply"]} </td>
          </tr>
          <tr>
            <td>Have you adopted a dog from Rescue in the past? </td> <td> {$_POST["pastRescue"]} </td>
          </tr>
          <tr>
            <td>From whom and when did you adopt? Please list their name and contact number if applicable.</td>  <td> {$_POST["petsInLast5Yrs"]} </td>
          </tr>
          <tr>
            <td>How did you hear about the Dexter Foundation?</td>
            <td>
              {$_POST["howDidYouHear"]}
              <br>   <br>
              {$_POST["howDidYouHearOTHER"]}
            </td>
          </tr>
          </table>

        <p class="title">
         <br><br>References<br>
        </p>

        Please provide us with two personal references. <br><br>

        <table id="references">
          <tr>
            <td>Name
            <br> {$_POST["reference1NAME"]} </td>
            <td>Phone
            <br> {$_POST["reference1PHONE"]} </td>
          </tr>
          <tr>
            <td>Name
            <br> {$_POST["reference2NAME"]} </td>
            <td>Phone
            <br> {$_POST["reference2PHONE"]} </td>
          </tr>

        </table>
        

        <!-- </table>   -->
        
          <p class="title">
            <br><br>Release for Veterinary Reference<br> 
          </p>

        <table id="vetRelease" style="width:100%;">
        <tr>
          <td>My current veterinarian is:</td> <td> {$_POST["currentVet"]} </td>
        </tr>
        <tr>
          <td>Address:</td> <td> {$_POST["currentVetAddress"]} </td>
        </tr>
        <tr>
          <td>Telephone:</td> <td> {$_POST["currentVetPhone"]}</td>
        </tr>
        </table>
        <p style="background-color:#ccc; padding:10px;">
          I, {$_POST["FULL_NAME"]}, hereby give permission for any veterinarian providing service to me/my animals to release medical information on any/all of my animals to the Dexter Foundation, Inc. <br>
          This release is not limited to the veterinarian named above.  Please let your vet know we will be calling for a vet reference.
        <br><br>
         {$_POST["signature"]} I check this box to provide my electronic signature.
        </p>
        <br>
        <br>
        <br>
          <p>
          Applicants without a current vet must list the vet they plan to use.
          </p>
        <table id="plannedVet">
          <tr>
            <td>My planned vet is:</td> <td> {$_POST["planVet"]}</td>
          </tr>
          <tr>
            <td>Address:</td> <td> {$_POST["plannedVetAddress"]}</td>
          </tr>
          <tr>
            <td>Telephone:</td> <td> {$_POST["plannedVetPhone"]}</td>
          </tr>
        </table>
                


        
      </div>  

BODY;





  $MAIN_EMAIL = "contactus@dexterfoundation.com";

  $lease = $_FILES['lease']['name'];
  $leaseAttachment = $LEASE_PATH.date("m.d.Y")."_".$lease;
  move_uploaded_file($_FILES['lease']['tmp_name'], $LEASE_PATH.date("m.d.Y")."_".$lease);

  $email = new PHPMailer();
  $email->From      = $DEFAULT_EMAIL;
  $email->FromName  = 'Dexter';
  $email->Subject   = 'Adoption Application';
  $email->Body      = $bodytext;
  $email->AddAddress( $MAIN_EMAIL );
  // $email->AddAddress( "jwyvp5@gmail.com" );
  $email->WordWrap = 50;                           // set word wrap to 50 characters
  $email->IsHTML(true);                               // set email format to HTML

  $file_to_attach = $leaseAttachment;

  $email->AddAttachment($leaseAttachment);

    //return $email->Send();
  if(!$email->Send()){
      echo "Message could not be sent. <p>";
      echo "Mailer Error: " . $email->ErrorInfo;
      exit;
    } else {
      $CONFIRM = "<script>window.onload=function(){alert(\"Application Submitted!\");}</script>";
      //$HIDDEN = "\"display: none;\"";
      // $CONFIRM = "<div style=\"position: relative; top: 170px; left: 370px; font-size: 39pt;\" class=\"title\"> Application Submitted!! </div>";
    }
 
}


echo <<<_APPLICATION
<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/applicationStyle.css">
  <script language="javascript" src="js/modernizr.dexterfoundation.js"></script>
  {$CONFIRM}



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
      
      <li onmouseover="visible('about')" onmouseout="invisible('about')">
        <a href="AboutUs.php">About Us</a>
        <p id="about" class="paw"></p>
      </li>

      <li class="CURRENT_PAGE">
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

  <article>
    
  </article>

_APPLICATION;
   
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to MySQL: " . mysql_errno() . ": " . mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: ". mysql_errno() . ": " . mysql_error());
    
   ///////////////////////////////////////////  
     //
     //    gathering articles data
     //
     
    $queryArticle4 = "SELECT * FROM articles WHERE location='4'";
    $resultArticle4 = mysql_query($queryArticle4);
    if (!$resultArticle4) die("Database access failed". mysql_errno() . ": " . mysql_error());
    $article4 = array();
    $article4 = mysql_fetch_row($resultArticle4);
    $article4 = lineBreaksDecode($article4[2]);
    
// //$article4[2] is the body of article4
   
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
 ///////////////////////////////////////////////////////////// 
echo <<<_PAGE

  <div id='mainForm' style={$HIDDEN}><br><br>
    <p class="title heading">
      Adoption Application
    </p>
    <div id="application_heading">
      <p style="
        font-size: 17pt;
        padding-top: 10px;
      "> 
        P.O. Box 7000-373
        <br>
        Redondo Beach, CA 90277
        <br>
        Phone:  310-283-8947
        <br>
        Fax:  310-375-5505
        <br>
        Email: <a href="mailto:{$MAIN_EMAIL}">{$MAIN_EMAIL}</a>
      </p>
      <p id="article4"> 
        {$article4}
      </p>
    </div>
    <!-- END #application_heading -->
_PAGE;
    


?>
    <p class="title heading">
      Contact Information
    </p>

    <form id="applicationForm" action="AdoptionApplication.php" method="POST" enctype="multipart/form-data">
      <table id="contactInformation">
      <tr>  
      <td>Full name</td> <td><input type="text" name="name" maxlength="30">  </td>
      </tr>
      <tr>
      <td>Age</td> <td><input type="text" name="age" maxlength="3" > </td>
      </tr>
      <tr>
      <td>Address</td><td><input type="text" name="address1" maxlength="30" ><br> <br>

            <input type="text" name="address2" maxlength="30" >  </td>
      </tr>      
      <tr>      
      <Td>City</td> <td><input type="text" name="city" maxlength="30" > </td>
      </tr>
      <tr>
      <td>State</td> <td><input type="text" name="state" maxlength="2"> </td>
      </tr>
      <tr>
      <td>Zip</td> <td><input type="text" name="zip" maxlength="5" ></td>
      </tr>
      <tr>
        <td>
          Email
        </td>
        <td>
          <input id="EMAIL_ONE" style="margin-bottom:10px;" type="email" name="email" placeholder="Please enter email carefully" />
          <br/>
          <br/>
          <input id="EMAIL_TWO" type="email" name="email" placeholder="Once more to verify please" />
        </td>
      </tr>
      <tr>
      <td>Home Phone</td> 
      <td><input type='tel' onfocus="email_validate()" placeholder="eg: 999-999-9999" name="h_phone" maxlength="13" pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number (eg: 999-999-9999)'> </td>
      </tr>
      <tr>
      <td>Cell Phone</td> <td><input onfocus="email_validate()" type='tel' placeholder="eg: 999-999-9999" name="c_phone" maxlength="13" pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number (eg: 999-999-9999)'> </td>
      </tr>
      <tr>
      <td>Work Phone</td> <td><input onfocus="email_validate()" type='tel' placeholder="eg: 999-999-9999" name="w_phone" maxlength="13" pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number (eg: 999-999-9999)'> </td>
      </tr>
      <tr>
      <td>When is the best time to reach you?</td> <td><textarea rows="5" cols="30" name="best_time"></textarea></td>
      </tr>
    </table>



      <p class="title heading">
        Family Information
      </p>

      <table id="familyInformation">
      <tr>
      <td>Living Status</td>
      <td>
      <label><li>Single: <input type="radio" name="marital" value="single"></li></label>
      <br>
      <label><li>Married/Living with partner: <input type="radio" name="marital" value="married" ></li></label></td>
      </tr>
      <tr>
      <td>Do you have any other people living in your home?</td>
        <td><label><li>Yes:<input type="radio" name="other_people" value="yes"> <br></li></label>
          <label><li>No:<input type="radio" name="other_people" value="no" ></li></label></td>
      </tr>    
      <tr>
        <td>Do they approve of adopting this dog?</td>
          <td>
          <label><li>Yes:<input type="radio" name="approval" value="yes"></li></label><br>
          <label><li>No:<input type="radio" name="approval" value="no" ></li></label>
          </td>
      </tr>  
          
      <tr>
        <td>Does your spouse/significant other approve of you adopting this dog?</td>
          <td><label><li>Yes:<input type="radio" name="spouseApproval" value="yes"></li></label><br>
          <label><li>No:<input type="radio" name="spouseApproval" value="no" ></li></label></td>
      </tr>    
      <tr>
          <td>Name of spouse/significant other</td> <td><input type="text" name="nameOfSig"> </td>
      </tr>
      <tr>
          <td>Age of spouse/significant other</td> <td><input type="text" name="ageOfSig" maxlength="3" ></td> 
      </tr>
      <tr>
        <td>Do you have children visit your home regularly or living in your home?</td>
        <td><label><li>Yes:<input type="radio" name="children" value="yes"> </li></label><br>
        <label><li>No:<input type="radio" name="children" value="no" ></li></label> </td>
      </tr>
      <tr>
        <td>How many children?</td> <td><input type="text" name="numberOfChildren" maxlength="2" > </td>
      </tr>
      <tr>
          <td>What are their ages?</td> <td><textarea type="text" name="ageOfChildren"></textarea> </td>
      </tr>
      <tr>
        <td>Please list others in your household who will have contact with the dog, such as main, nanny, etc. If there is nobody else, then please specify. </td>  <td><input type="text" name="whoElseHasContact" maxlength="30" > </td>
      </tr>
      <tr>
        <td>Why do you want to adopt a rescued dog? </td> <td><textarea name="whyAdopt" rows="5" cols="20"></textarea> </td>
      </tr>
      <tr>
        <td>What qualities do you like in a rescued dog? </td> <td><textarea name="likedQualities" rows="5" cols="20"></textarea> </td>
      </tr>
      <tr>
        <td>What qualities or traits don&#8217;t you want to find in a rescued dog?</td> <td><textarea name="unlikedQualities" rows="5" cols="20"></textarea> </td>
      </tr>
      <tr>
        <td>Are you committed to caring for this dog for its lifetime? </td> 
        <td><label><li>Yes:<input type="radio" name="lifetime" value="yes"></li></label> <br>
        <label><li>No:<input type="radio" name="lifetime" value="no" >  </li></label> </td>
      </tr>
      <tr>    
        <td>Where will the dog stay during the day? </td>
         <td><input type="text" name="duringTheDay" maxlength="30" > </td>
      </tr>
      <tr>
        <td>How long will the dog be left alone during the day?  </td>
         <td> Hours:<input type="text" name="hrs" maxlength="30" >
        <br><br>Days <br>per Week:<input type="text" maxlength="30" name="days" > </td>
      </tr>
      <tr>
        <td>Will the dog have access to the house AND yard while left alone? </td> 
        <td> <label><li> Yes:<input type="radio" name="houseANDyard" value="yes"> </li></label>
        <br>
        <label><li>No:<input type="radio" name="houseANDyard" value="no" > </li></label></td>
      </tr>
      <tr>
        <td>Who will let the dog out?</td>  <td><input type="text" name="whoLetOut" maxlength="15" ></td>
      </tr>
      <tr>
        <td>Do you have:</td> 
          <td><em>a dog sitter?</em> 
          <br> 
          <label><li>Yes:<input type="radio" name="sitter" value="yes"></li></label> 
          <br>
          <label><li>No:<input type="radio" name="sitter" value="no" ></li></label>
          <br>
          <br>
          <em>a dog walker?</em>
          <br>
          <label><li>Yes:<input type="radio" name="walker" value="yes"></li></label>
          <br>
          <label><li>No:<input type="radio" name="walker" value="no" ></li></label>
          <br>
          <br>
          <em>a doggie door?</em>
          <br>
          <label><li>Yes:<input type="radio" name="door" value="yes"> </li></label>
          <br>
          <label><li>No:<input type="radio" name="door" value="no" ></li></label></td>
      </tr>
      <tr>  
        <td>Where will the dog sleep? </td>  <td><input type="text" name="whereSleep" maxlength="15" > </td> 
      </tr>
      <tr>
        <td>Will the dog be allowed on the furniture?</td>
        <td><label><li>Yes:<input type="radio" name="onFurniture" value="yes"></li></label>
        <br>
        <label><li>No:<input type="radio" name="onFurniture" value="no" ></li></label></td>
      </tr>
      <tr>
        <td>Do you own your own home or rent? </td> 
        <td><label><li>Own:<input type="radio" name="ownRent" value="own"></li></label>
        <br>
        <label><li>Rent:<input type="radio" name="ownRent" value="rent" ></li></label></td>
      </tr>
      <tr>        
        <td>Does landlord approve of dogs on property?</td>
        <td><label><li>Yes:<input type="radio" name="landlordApproval" value="yes"></li></label>
        <br>
        <label><li>No:<input type="radio" name="landlordApproval" value="no" ></li></label></td>
      </tr>
      <tr>      
        <td>Please give name and number of your <strong>landlord</strong> as they will be contacted to verify that you are allowed to have animals.</td>
        <td>Name: <input type="text" name="landlordName" > <br>
        <br>Phone: <input type="text" name="landlordPhone" > </td>
      </tr>
      <tr>
        <td>Please attach a copy of your lease or notarized statement from your landlord stating the number and size of pets you are allowed to own</td>
        <td><input type="file" name="lease"></td>
      </tr>
      <tr>
        <td>What kind of home do you have? <br> <em>eg. apartment, condo, home, etc.<em> </td> <td> <input type="text" title="eg. apartment, condo, home, etc." name="typeDwelling" > </td>
      </tr>
      <tr>
        <td>Do you have a fenced in yard?</td>
        <td><label><li>Yes:<input type="radio" name="fence" value="yes"></li></label>
        <br>
        <label><li>No:<input type="radio" name="fence" value="no" ></li></label></td>
      </tr>
      <tr>
        <td>What kind of fence do you have? <br> <em>eg. chain link, picket, etc.</em></td>
        <td><input type="text" name="fenceType" title="eg. chain link, picket, etc."> </td> 
      </tr>
      <tr>
        <td>What is the height of the fence?</td>
        <td> <input type="text" name="fenceHeight" > </td>
      </tr>
      <tr>
        <td>How are you going to exercise this dog?</td>
        <td><input type="text" name="howToExercise" > </td>
      </tr>
      <tr>
        <td>How will you keep this dog from running away or becoming lost?</td>
        <td> <input type="text" name="keepFromRunning" > </td>
      </tr>
      <tr>
      </table>




      <p class="title heading">
        Rescue Dog Information
      </p>

      <table id="rescueDogInfo">
      <tr>
        <td>Are you interested in a specific Dexter Foundation dog(s) listed on our homepage or Petfinder.com?</td>
        <td style="width:300px;"><label><li>Yes: <input type="radio" name="specificDog" value="yes"></li></label>
        <br>
        <label><li>No: <input type="radio" name="specificDog" value="no" > </li></label></td>
      </tr>
    
      <tr>
        <td>Which dog are you interested in? </td>
        <td><input type="text" name="specificDogName" > </td>
      </tr>
      <tr>
        <td>Please note, The Dexter Foundation rarely has puppies. But please tell us your preferences.<br>
        What are you interested in?  </td>
        <td><label><li>Male: <input type="radio" name="preference" value="male"></li></label>
        <br>
        <label><li>Female:<input type="radio" name="preference" value="female"></li></label>
        <br>
        <label><li>No Preference: <input type="radio" name="preference" value="none" ></li></label></td>     
      </tr>  
      <tr>
        <td>What about age?</td>
        <td><label><li>Older Dog:<input type="radio" name="agePreference" value="older"></li></label>
        <br> 
        <label><li>No Age Preference:<input type="radio" name="agePreference" value="none"></li></label>
        <br>
        <br>
        <label><li>Preferred Age: <input type="radio" name="agePreference" value="preferredAgeRange:" ></li></label>
        <br>
        <input style="float:left;" type="text" name="preferredAge" ></td>
      </tr>


      <tr>
        <td>Would you accept a dog with any of the following issues? Check all that apply. </td>
        <td>
          <div class="checkboxes">
            <div class="radioElement" id="g">Scarring<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="scarring" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="scarring" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Skin Problems<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="skinProblems" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="skinProblems" value="no" ></li></label></div>
        
        <div class="radioElement" id="g">Snorting<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="snorting" value="yes"></li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="snorting" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Special Diet<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="specialDiet" value="yes"></li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="specialDiet" value="no" ></li></label></div>
        
        <div class="radioElement" id="g">Allergies<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="allergies" value="yes"></li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="allergies" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Arthritis<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="arthritis" value="yes"></li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="arthritis" value="no" ></li></label></div>
        
        <div class="radioElement" id="g">Balance Problems<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="balanceProblems" value="yes"></li></label> 
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="balanceProblems" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Blindness<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="blindness" value="yes"></li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="blindness" value="no" ></li></label></div> 
        
        <div class="radioElement" id="g">Deafness<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="deafness" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="deafness" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Ear Discharge<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="earDischarge" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="earDischarge" value="no" ></li></label></div>
        
        <div class="radioElement" id="g">Hair Loss<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="hairLoss" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="hairLoss" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Heart Disease<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="heartDisease" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="heartDisease" value="no" ></li></label></div>
        
        <div class="radioElement" id="g">Incontinence<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="incontinence" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="incontinence" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Limping<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="limping" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="limping" value="no" ></li></label></div>

        
        <div class="radioElement" id="g">Myelinopathy<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="myelinopathy" value="yes"></li></label> 
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="myelinopathy" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">One-eyed<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="oneEyed" value="yes"></li></label> 
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="oneEyed" value="no" ></li></label></div>
        
        <div class="radioElement" id="g">Spinal Deformity<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="spinalDeformity" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="spinalDeformity" value="no" ></li></label></div>
        
        <div class="radioElement" id="w">Three Legged<br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="threeLegged" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="threeLegged" value="no" ></li></label></div>
        
        <div class="radioElement" id="g">Separation Anxiety <br>
          <label><li style="border: none;"><em>Yes:</em><input type="radio" name="separationAnxiety" value="yes"> </li></label>
          <br>
          <label><li style="border: none;"><em>No:</em><input type="radio" name="separationAnxiety" value="no" ></li></label></div>
          
      </div>
        </td>
      </tr>



      <tr>
        <td>Would you adopt two dogs that have come from the same home & need to stay together? </td>
        <td><label><li>Yes:<input type="radio" name="stayTogether" value="yes"></li></label>
        <br>
        <label><li>No:<input type="radio" name="stayTogether" value="no" ></li></label> </td>
      </tr>
      <tr>
        <td>Should any of the following apply to your new pet? <br> Check any that should.</td>
          <td> <label><li>Dog Friendly <input type="checkbox" name="friendly" value="dog"></li></label>
          <br>
          <label><li>Cat friendly <input type="checkbox" name="friendly" value="cat"></li></label>
          <br>
          <label><li>Doesn't Matter<input type="checkbox" name="friendly" value="doesNotMatter"> </li></label></td>
      </tr>
      </table>

        <p class="title heading">
          Previous Pet History
        </p>
        <table id="petHistory">
          <tr>
            <td>Have you ever owned a dog before?</td>
            <td><label><li>Yes:<input type="radio" name="everOwnedDog" value="yes"></li></label>
            <br> <label><li>No:<input type="radio" name="everOwnedDog" value="no" ></li></label></td>
          </tr>
          <tr>
            <td>Tells us about your previously owned dogs. List the breed, and the number of years they were with you.</td> 
            <td><textarea rows="10" cols="20" name="dogHistory"></textarea> </td>
          </tr>
          <tr>
            <td>Do you have any dogs in your home currently?</td>
            <td><label><li>Yes:<input type="radio" name="currentDogs" value="yes"></li></label>
            <br>
            <label><li>No:<input type="radio" name="currentDogs" value="no" ></li></label></td>
          </tr>
          <tr>
            <td>Please list their breed, age, and sex.</td> 
            <td><textarea rows="10" cols="20" name="currentDogDesc"></textarea></td>
          </tr>
          <tr>
            <td>Are they spayed/neutered?</td>
            <td><label><li>Yes:<input type="radio" name="fixed" value="yes"> </li></label>
            <br>
            <label><li>No:<input type="radio" name="fixed" value="no" ></li></label></td>
          </tr>
          <tr>
            <td>Please explain why they're not spayed/neutered.</td>
            <td><textarea rows="10" cols="20" name="whyNotFixed"></textarea> </td>
          </tr>
          <tr>
            <td>What other types of pets do you own that currently live in your house? </td>
            <td><textarea rows="10" cols="20" name="otherPets"></textarea> </td>
          </tr>
          <tr>
            <td>Are all your current pets up to date on their annual vaccinations? </td>
            <td><label><li>Yes:<input type="radio" name="otherPetsVacc" value="yes"> </li></label>
            <br> 
            <label><li>No:<input type="radio" name="otherPetsVacc" value="no" ></li></label> </td>
          </tr>
          <tr>
            <td>In addition to the pets identified above, what other pets have you owned in the last 5 years?</td> 
            <td><textarea rows="10" cols="20" name="petsInLast5Yrs"></textarea> </td>
          </tr>
          <tr>
            <td>Have you owned any other pets more than 5 years ago?</td>
            <td><label><li>Yes:<input type="radio" name="pastPets" value="yes"> </li></label>
            <br>
            <label><li>No:<input type="radio" name="pastPets" value="no" > </li></label></td>
          </tr>
          <tr>
            <td>Please describe specifically how long ago you owned these pets, and describe the animals. </td>
            <td><textarea rows="10" cols="20" name="petsBeforeLast5Yrs"></textarea> </td>
          </tr>
          <tr>
            <td>Why do you no longer have these pets? </td> <td><textarea rows="10" cols="20" name="whereAreYourPets"></textarea> </td>
          </tr>
          <tr>
            <td>Do you have any experience with formal obedience training of dogs? </td>
            <td><label><li>Yes: <input type="radio" name="formalObedienceTraining" value="yes"> </li></label>
            <br>
            <label><li>No:<input type="radio" name="formalObedienceTraining" value="no" ></li></label> </td>
          </tr>
          <tr>
            <td>Please explain the methods of training and where you learned how to train a dog.</td>
            <td><textarea rows="10" cols="20" name="explainTrainingMethods"></textarea> </td>
          <tr>
            <td>Have you filled out an adoption application with any other rescue organization? </td>
            <td><label><li>Yes:<input type="radio" name="previousApp" value="yes"></li></label>
            <br> 
            <label><li>No:<input type="radio" name="previousApp" value="no" > </li></label></td>
          </tr>
          <tr>
            <td>To whom did you apply and when? </td> 
            <td><textarea rows="10" cols="20" name="whoAndWhenApply"></textarea> </td>
          </tr>
          <tr>
            <td>Have you adopted a dog from Rescue in the past? </td> 
            <td><label><li>Yes:<input type="radio" name="pastRescue" value="yes"> </li></label>
            <br><label><li>No:<input type="radio" name="pastRescue" value="no" > </li></label></td>
          </tr>
          <tr>
            <td>From whom and when did you adopt? Please list their name and contact number if applicable.</td> 
            <td><textarea rows="10" cols="20" name="petsInLast5Yrs"></textarea> </td>
          </tr>
          <tr>
            <td>How did you hear about the Dexter Foundation?</td>
            <td>
              <label><li>My Veterinarian<input type="radio" name="howDidYouHear" value="vetrinarian"></li></label>
              <br>
              <label><li>American Kennel Club<input type="radio" name="howDidYouHear" value="AKC"></li></label>
              <br>   
             <label><li>Humane Society<input type="radio" name="howDidYouHear" value="humaneSociety"></li></label>
              <br> 
              <label><li>Internet<input type="radio" name="howDidYouHear" value="internet"></li></label>
              <br>
              <label><li>Friend<input type="radio" name="howDidYouHear" value="friend"></li></label>
              <br> <br>
              <label><li>Other (please specify)<input type="radio" name="howDidYouHear" value="other" ></li></label>
              <br>   <br>
              <input type="text" name="howDidYouHearOTHER" style="float:left">
            </td>
          </tr>
          </table>

        <p class="title heading">
         References
        </p>

        <table id="references">
          <tr>
            <td>
              We would like to contact two personal references.<br/> Please provide their name and phone number.
            </td>
            <td style="width: 400px; background-color:#ccc;">
              <div>
                <p>
                  First Reference
                  </p>
                  <input type="text" class="referenceName" name="reference1NAME" placeholder="First Reference Name"/>
                  <br/>
                  <input type="text" class="referencePhone" name="reference1PHONE" placeholder="First Reference Phone Number"/>
                
              </div>
              <div>
                <p>
                  Second Reference
                  </p>
                  <input type="text" class="referenceName" name="reference2NAME" placeholder="Second Reference Name"/>
                  <br/>
                  <input type="text" class="referencePhone" name="reference2PHONE" placeholder="Second Reference Phone Number"/>
                
              </div>
            </td>
          </tr>

        </table>
        

        <!-- </table>   -->
        
          <p class="title heading">
            Release for Veterinary Reference
          </p>

        <table id="vetRelease" style="width:100%;">
        <tr>
          <td>My current veterinarian is:</td> <td><input type="text"  placeholder="Name of Current Veterinarian" name="currentVet"></td>
        </tr>
        <tr>
          <td>Address:</td> <td><input type="text" placeholder="Address of Current Veterinarian" name="currentVetAddress"></td>
        </tr>
        <tr>
          <td>Telephone:</td> <td><input type="text" placeholder="Telephone of Current Veterinarian" name="currentVetPhone"></td>
        </tr>
        </table>
        <div id="signRelease">
          I, <input type="text" name="FULL_NAME" placeholder="Full Name" style="float:none;" />, hereby give permission for any veterinarian providing service to me/my animals to release medical information on any/all of my animals to the Dexter Foundation, Inc. <br>
          This release is not limited to the veterinarian named above.  Please let your vet know we will be calling for a vet reference.
          <br />
          <br />
          <label>
            <li>
              <input type="radio" name="signature" value="NOT_SIGNED" style="float:none;" />
              I do not agree to the terms above.
            </li>
          </label>
          <br />
          <label>
            <li>
              <input type="radio" name="signature" value="SIGNED" style="float:none;" />
              I check this box to provide my electronic signature.
            </li>
          </label>
        </div>
        <br>
        <br>
        <br>
          <p style="color: white; font-style: oblique;">
          
          </p>
        <table id="plannedVet">
          <tr>
            <td>
              If you do not currently have a veterinarian, please<br/> provide us details about who you plan to use.
            </td>
            <td style="background-color:#ccc; width:400px;">
              <p>
                Planned Veterinarian
              </p>
              <input type="text" placeholder="Name of Planned Veterinarian" name="planVet"/>
              <br/>
              <p>
                Address
              </p>
              <input type="text" placeholder="Address of Planned Veterinarian" name="plannedVetAddress"/>
              <br/>
              <p>
                Telephone
              </p>
              <input type="text" placeholder="Telephone of Planned Veterinarian" name="plannedVetPhone"/>
              <br/>
            </td>
          </tr>
        </table>
        <input type="hidden" value="yes" name="SUBMIT"/>
        <input id="submitButton" value="Send Application" type="submit"/>


      </div>  <!-- ends the application div -->

  </form>      
 
  <!-- </div> -->
  <div class="footer_background" style="border:none;">
    <footer>
    <?php
  // echo $sponsors;
  ?>

  </footer>
  </div><!-- END .footer_background -->
      <script type="text/javascript" src="js/scripts.js"></script>
      


      <script>
     
        
      </script>
</div> <!-- END .background -->
</div> <!-- END #allcontent -->
</body>
</html>

