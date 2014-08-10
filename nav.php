  <?php
  //this must go inside of the allcontent div
  //manually give each page a variable called "$current_page"
  $navHeader = <<<_NAVHEADER
  <aside>  
    {$DONATE}
  </aside>
  
  <header>
    <img src="img/logo.png" alt="The Dexter Foundation: Serving Los Angeles County and Southern California">
  
  

    <nav>
      <ul>
        <li class="Home">
        <a href="http://{$_SERVER['SERVER_NAME']}">Home</a>
        <p id="home" class="paw"></p>
        </li>
        
        <li class="About">
          <a href="AboutUs.php">About Us</a>
          <p id="about" class="paw"></p>
        </li>

        <li class="Adoption">
          <a style="position: relative; top:-15px;" href="AdoptionApplication.php">Adoption Application</a>
          <p id="adoption" class="paw" style="position: relative; top:-10px;"></p>
        </li>

        <li class="Petfinder">
          <a href="http://www.adoptapet.com/shelter75425-pets.html" target="_blank">Dogs in Need</a>
          <p id="inNeed" class="paw"></p>
        </li>

        <li class="Success">
          <a href="SuccessStories.php">Success Stories</a>
          <p id="success" class="paw"></p>
        </li>

        <li class="Contact">
          <a href="http://{$_SERVER['SERVER_NAME']}#contactUs">Contact Us</a>
          <p id="contact" class="paw"></p>
        </li>
      </ul>

    </nav>
  

  </header>
  <div id="missionStatementImage">
    <img id="missionStatement" src="img/missionStatement.png" alt="We are dedicated to rescuing dogs in the Southern California Area and placing them in a loving, forever home."> 
  </div>
_NAVHEADER;
  ?>