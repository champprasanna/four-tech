  <?php 
   include("includes/config.php"); 
   include("includes/functions.php");
   include("tpl/header.php");
  ?>
  <!-- Wrapper start -->

    <!-- Begin page maincontent -->
    <?php
	 	include("tpl/$strAction.php");
	 ?>
    <!-- Wrapper End -->
    <div class="clearfix"></div>
    <!--Footer Start-->
    <?php 
	 	include("tpl/footer.php");
	 ?>
    <!--Footer End--> 

  <!-- End page maincontent --> 
  


<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script type="text/javascript" src="js/jquery-1.10.2.js"></script> 
<script type="text/javascript" src="js/jquery.validate.min.js"></script> 

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="js/jquery.is otope.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>

<script>
 //GoogleAnalyticsObject
 
</script>
<?php include("includes/jsincluder.php"); ?>
</body>
</html>