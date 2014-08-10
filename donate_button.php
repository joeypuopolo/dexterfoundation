<?php
$DONATE = <<<_DONATE
<div id="MakeADonation">
     <!-- donation button -->  
      <form method="post" style="margin:0;" target="_blank" action="https://www.paypal.com/cgi-bin/webscr">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="ricarda.franco@yahoo.com">
        <input type="hidden" name="item_name" value="Support Southern California Dog Rescue">
        <input type="hidden" name="return" value="">
        <input type="hidden" name="cancel_return" value="">
        <input type="hidden" name="image_url" value="">
        <input type="hidden" name="bn" value="yahoo-sitebuilder">
        <input type="hidden" name="pal" value="C3MGKKUCCAB9J">
        <input type="hidden" name="mrb" value="R-5AJ59462NH120001H">
        <input type="image" src="img/donateButton.png" border="0">
      </form>
    </div>
_DONATE;
    ?>