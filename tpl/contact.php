<?php
error_reporting(0);
require_once 'lib/recaptchalib.php';
//require_once 'lib/solvemedialib.php';
# was there a reCAPTCHA response?
$publickey = "6LfyIssSAAAAAEd5qo3_XdDNa8TGONJ4REuD6aiG";
$privatekey = "6LfyIssSAAAAAMblwAkySPBUMQGoKLaTugCJJ3Km";
$strCaptchaHtml = recaptcha_get_html($publickey, $error);
//print_r($_POST); exit;
 if (isset($_POST['btnSubmit']))
 {
	//print_r($_POST);
	$strFirestName = stripslashes(trim($_POST["txtName"]));
	$strEmail	   = stripslashes(trim($_POST["txtEmail"]));
	$intPhoneNo	   = stripslashes(trim($_POST["txtPhone"]));
	$strCompany    = stripslashes(trim($_POST["txtCompany"]));
	$strWebsite	   = stripslashes(trim($_POST["txtWebsite"]));
	$strMessage	   = stripslashes(trim($_POST["txtMessage"]));
	$strinterest   = stripslashes(trim($_POST["cmbIntrest"]));
	/*re-captcha
	$privkey="mH3jEDJyvGIZLK3kJhgzJXs9X6HhakVK";
	$hashkey="fNjEbztVY93AODU6FaEzUg4j-Nt0SeAw";
	$solvemedia_response = solvemedia_check_answer($privkey,
	$_SERVER["REMOTE_ADDR"],
	$_POST["adcopy_challenge"],
	$_POST["adcopy_response"],
	$hashkey);
	if (!$solvemedia_response->is_valid) {
	 	 $strErrorMessage .= $solvemedia_response->error;
	}
	 */
	/*end of re-captcha*/
	if($strFirestName == "")
	{ $strErrorMessage .= "Please enter Name.<br>";}
	if($strEmail == "")
	{$strErrorMessage .= "Please enter Email.<br>";}
	else{
		if(preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})+$/",$strEmail) == 0)
		{
			$strErrorMessage .= "Enter valid Email Id.<br>";
		}
	}
	if($intPhoneNo == "")
	{$strErrorMessage .= "Please enter phone number.<br>";}
  	if($_POST["recaptcha_response_field"])
	{
		$resp = recaptcha_check_answer ($privatekey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);
		
		if ($resp->is_valid) {
		// nothing to do for correct captcha
		} else {
				# set the error code so that we can display it
				$strErrorMessage .= "Incorrect captcha, please re-enter.<br>";
		}
	}
	else
	{
		 $strErrorMessage .= "Please Enter Captcha.<br>" ;
	}
	//print $strErrorMessage; exit; 
	if($strErrorMessage == "")
	{
		$css_lefttd = ' style="color:#0072bb; font-size:13px; font-family:Arial, Helvetica, sans-serif"';
		$css_righttd = ' style="color:#3b3b3b; font-size:13px; font-family:Arial, Helvetica, sans-serif"';
		$mailcontent ='<table width="450" border="0" cellpadding="8" cellspacing="0" style="border:1px solid #cccccc">
  <tr>
    <td colspan="2" bgcolor="#ffffff" align="right" style="color:#0072bb; font-size:13px; font-family:Arial, Helvetica, sans-serif">
    	<img src="http://www.fourtech.com/images/fourtech_logo.png" width="70px" />
    </td>
  </tr>
  <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Name :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##NAME##</td>
  </tr>
  <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Email :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##EMAIL##</td>
  </tr>
  <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Phone Number :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##PHONE##</td>
  </tr>
  <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Company Name :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##COMPANY##</td>
  </tr>
  <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Website :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##WEBSITE##</td>
  </tr>
  <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Interest :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##INTREST##</td>
  </tr>
  <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Message :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##MESSAGE##</td>
  </tr>
  <tr><td width="124" align="right" valign="middle" '.$css_lefttd.'></td><td width="348" align="left" valign="middle" '.$css_righttd.'></td></tr>
  <tr><td width="124" align="right" valign="middle" '.$css_lefttd.'></td><td width="348" align="left" valign="middle" '.$css_righttd.'></td></tr>
</table>';
			 
			 
			 $mailcontent = str_replace("##NAME##", stripcslashes($_POST["txtName"]), $mailcontent); 
			 $mailcontent = str_replace("##EMAIL##", stripcslashes($_POST["txtEmail"]), $mailcontent); 
			 $mailcontent = str_replace("##PHONE##", stripcslashes($_POST["txtPhone"]), $mailcontent); 
			 $mailcontent = str_replace("##COMPANY##", stripcslashes($_POST["txtCompany"]), $mailcontent); 		 
			 $mailcontent = str_replace("##WEBSITE##", stripcslashes($_POST["txtWebsite"]), $mailcontent); 
			 $mailcontent = str_replace("##INTREST##", stripcslashes($_POST["cmbIntrest"]), $mailcontent); 
			 /*$mailcontent = str_replace("##BUDGET##", stripcslashes($_POST["cmbBudget"]), $mailcontent); */
			 $mailcontent = str_replace("##MESSAGE##", stripcslashes($_POST["txtMessage"]), $mailcontent); 
		
			 $Subject = $_POST["txtName"] ." contacted on fourtech.com today";
		
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
			// Additional headers
			$headers .= 'From: Info <info@fourtech.co.in>' . "\r\n";
			$to = "champprasannagmail.com";
			mail($to, $Subject, $mailcontent, $headers);
		

	$mailcontent = "<HTML>
	<HEAD>

	<TITLE> New Document </TITLE>
	</HEAD>
	<BODY $css_righttd>
	<p>Hello ##NAME##,</p>
	
		<p>Thanks very much for contacting us at Four-Tech. We will get back to you within one business day.</p>

		<p>Meanwhile, we would appreciate,if you could send us any additional details about your requirements on champprasanna@gmail.com, so that our next interaction can be more contextual.</p>
		
	<p>Best Luck,<br>
	Team Four-Tech<br>
	Four-Tech India Pvt.Ltd.<br>
	http://www.fourtech.com/<br>
	India:25669874<br>
	<p>
	 </BODY>
	</HTML>";
		$mailcontent = str_replace("##NAME##", stripcslashes($_POST["txtName"]), $mailcontent); 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Prasanna <champprasanna@gmail.com>' . "\r\n";
		$to = $_POST["txtEmail"];
		$Subject = "Thank you for contacting Four-Tech ";
	
		mail($to, $Subject, $mailcontent, $headers);
		 $_SESSION['message'] = "mess";
	 }
}
?>

<div id="maincontent"> 
      <!--Contact us page start-->
      <h1 class="page-title">Contact US</h1>
      <div class="text-right contact-img mobile-resln"><img src="images/contact_img.jpg" /></div>
      <div class="content-block">
        <div class="col-md-7">
          <?php if($strErrorMessage !="") echo "<div class='divmessage' style='padding-bottom: 10px;' >Error!<br>",$strErrorMessage."</div>"; ?>
          <?php 
if($_SESSION['message'] == "mess") {
echo "<div  id='id_message' class='divmessage' style='padding-bottom: 10px;' >Thank you. We will get back to you in 24 hours.</div>"; ?>
          <script type="text/javascript">
setTimeout('fnHidePopUp()', 7000);

function fnHidePopUp()
{ 
	document.getElementById('id_message').style.display = "none";
	window.location.href = <?php echo SITE_NAME ?>"?action=contact";
}
</script>
          <?php
}
unset($_SESSION['message']);
unset($_POST);
?>
          <h2 class="sec-title">Request for proposal / quote / information</h2>
          <form id="frmContact" method="post" action="<?php echo fnLinkBuilder("contact")?>">
            <ul class="contact-form">
              <li>
                <label for="name">Name:</label>
                <div class="input-field ast">
                  <input type="text" name="txtName" class="required" id="txtName" value="<?php if($strErrorMessage !="") echo $strFirestName; ?>"/>
                </div>
              </li>
              <li>
                <label for="email">email:</label>
                <div class="input-field ast">
                  <input type="text" name="txtEmail"  class="required email" id="txtEmail" value="<?php if($strErrorMessage !="") echo $strEmail; ?>"/>
                </div>
              </li>
              <li>
                <label for="phone">Phone Number:</label>
                <div class="input-field ast">
                  <input type="text" name="txtPhone"  class="required" id="txtPhone" value="<?php if($strErrorMessage !="") echo $intPhoneNo; ?>"/>
                </div>
              </li>
              <li>
                <label for="company">Company Name:</label>
                <div class="input-field">
                  <input type="text" name="txtCompany" id="txtCompany" value="<?php if($strErrorMessage !="") echo $strCompany; ?>"/>
                </div>
              </li>
              <li>
                <label for="website">Website:</label>
                <div class="input-field">
                  <input type="text" name="txtWebsite" id="txtWebsite" value="<?php if($strErrorMessage !="") echo $strWebsite; ?>"/>
                </div>
              </li>              
              <li>
                <label for="message">Message:</label>
                <div>
                  <textarea name="txtMessage" id="txtMessage" > <?php if($strErrorMessage !="") echo $strMessage; ?>
                  </textarea>
                </div>
              </li>
              <li>
                <div><?php print ($strCaptchaHtml); ?></div>
              </li>
              <li>
                <input type="submit" name="btnSubmit" class="blue-btn" value="Submit" style="width:100px; margin-right:10px" />
                <input type="button" class="lightgray-btn" value="reset"  onclick="reset();" style="width:100px"/>
              </li>
            </ul>
          </form>
        </div>
        <div class="col-md-5">
          <div class="text-right contact-img"><img src="images/contact_img.jpg" /></div>
          <ul class="address-list">
          	<li>
              <div class="col-sm-4">
                <div class="addr-map"><span class="us-map">&nbsp;</span>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="addr-are">
                  <h3>India Office</h3>
                  <p>pimpari MIDC</p>
                  <p><span class="tel-icon">&nbsp;</span>25668995</p>
                </div>
              </div>
            </li>
            
            <li>
              <div class="col-sm-6">
                <div class="inquiry">
                <h3>Business inquiries:</h3>
                <a class="msgicon" href="mailto:info@fourtech.co.in">info@fourtech.co.in</a></div> </div>
             
            </li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
      <!--Contact us page end--> 
    </div>
</div>