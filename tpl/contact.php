<?php
error_reporting(0);

if (isset($_POST['submit']))
{
  //print_r($_POST);exit;
  $strFirestName = stripslashes(trim($_POST["txtName"]));
  $strEmail    = stripslashes(trim($_POST["txtEmail"]));
  $intPhoneNo    = stripslashes(trim($_POST["txtPhone"]));
  $strCompany    = stripslashes(trim($_POST["txtCompany"]));
  $strMessage    = stripslashes(trim($_POST["txtMessage"]));
  if($strFirestName == ""){ 
    $strErrorMessage .= "<span>Please enter Name.</span>";
  }

  if($strEmail == ""){
    $strErrorMessage .= "<span>Please enter Email.</span>";
  }
  else{
    if(preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})+$/",$strEmail) == 0){
      $strErrorMessage .= "<span>Enter valid Email Id.</span>";
    }
  }
  /*if($intPhoneNo == "") {
    $strErrorMessage .= "Please enter company phone number.<br>";
  }*/

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
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Company Address :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##COMPANY##</td>
    </tr>
    <tr>
    <td width="124" align="right" valign="middle" '.$css_lefttd.'>Company Phone Number :</td>
    <td width="348" align="left" valign="middle" '.$css_righttd.'>##PHONE##</td>
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
    $mailcontent = str_replace("##MESSAGE##", stripcslashes($_POST["txtMessage"]), $mailcontent); 
    $Subject = $_POST["txtName"] ." contacted on fourtech.com today";
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Additional headers
    $headers .= 'From: Info <info@fourtechengineering.in>' . "\r\n";
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
 <?php if($strErrorMessage !="") echo "<div class='divmessage error-messages' style='padding-bottom: 10px;' ><div class='container'><span>Error!</span>",$strErrorMessage."</div></div>"; ?>
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

<section id="contact-page" style="padding-bottom: 0">
  <div class="container">
    <div class="center">        
      <h2>Drop Your Message
      </h2>
    </div> 
    <div class="row contact-wrap"> 
      <div class="status alert alert-success" style="display: none"></div>

        <form id="frmContact" class="contact-form" method="post" action="<?php echo fnLinkBuilder("contact")?>">   

        <div class="col-sm-5 col-sm-offset-1">
          <div class="form-group contact-form" >
            <label>Name *
            </label>
            <input type="text" name="txtName" class="required form-control" id="txtName" value="<?php if($strErrorMessage !="") echo $strFirestName; ?>"/>
          </div>
          <div class="form-group">
            <label>Email *
            </label>
            <input type="text" name="txtEmail"  class="required form-control" id="txtEmail" value="<?php if($strErrorMessage !="") echo $strEmail; ?>"/>
          </div>
          <div class="form-group">
            <label>Company Phone Number
            </label>
            <input type="number" name="txtPhone"  class="required form-control" id="txtPhone" value="<?php if($strErrorMessage !="") echo $intPhoneNo; ?>"/>
          </div>                                  
        </div>
        <div class="col-sm-5">
          <div class="form-group">
            <label>Company address
            </label>
            <input type="text" name="txtCompany" id="txtCompany" class="form-control" value="<?php if($strErrorMessage !="") echo $strCompany; ?>"/>
          </div>
          <div class="form-group">
            <label>Message
            </label>
            
            <textarea name="txtMessage" id="txtMessage" class="form-control" rows="8"> 
                <?php if($strErrorMessage !="") echo $strMessage; ?>
              </textarea>
            </textarea>
          </div>                        
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message
            </button>
          </div>
        </div>
      </form>

    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<section id="contact-info" class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" style="padding-bottom: 0">
  <div class="center">                
    <h2>How to Reach Us?
    </h2>
  </div>
  <div class="gmap-area">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 text-center">
          <div class="gmap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3780.4453567369783!2d73.82046221489468!3d18.644000687337183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2b814ecf1eff9%3A0xfa2719273af1506d!2sFour+Tech+Engineers+Private+Limited!5e0!3m2!1sen!2sin!4v1460382047718" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-sm-7 map-content">
          <ul class="row">
            <li class="col-sm-8">
              <address>
                <h5>Office
                </h5>
                <p> Four-Tech Engineering Private Limited,
                  <br>
                  Plot no.66, F-II Block, MIDC,
                  <br>Pimpri, PUNE- 411 018( Maharashtra) INDIA
                </p>
                <p>
                  <strong>Phone:
                  </strong> 022-27475038 
                  <br>
                  <strong>Email:
                  </strong> info@fourtechengineering.in
                </p>
              </address>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>  

     
<!--/#contact-page-->

</div>


