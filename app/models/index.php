<!DOCTYPE html>
<html lang="en">
<head>
  <title>Healthspenditure | HOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style2.css">
  <script src="jquery-2.1.4.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
</head>

<body>

  <div class="wrapper">
	<div class="navbar transparent navbar-inverse">
		  <img class="logo" src="images/logo2.png">
	</div>
  <div style="background-color: rgba(0,0,0,.5);">
  <div class="text-center header">
			<h1>Spend your money wisely for your health</h1>
			<h3>Know the right foods you should eat</h3>
			<h3>Find delicious recipes safe for you</h3>
  </div>
<div class="controller-wrapper">
  <form action="index.php" method="post">
    <input type ="text" class="hidden" name="illnessValue" id="illnessValue">
    <input type ="text" class="hidden" name="marketValue" id="marketValue">
    <input type ="text" class="hidden" name="autoValue" id="autoValue">
    <div class="form-inline text-center">
  	   <div class="dropdown illness">
  	   <button class="I_design dropdown-toggle" type="button" data-toggle="dropdown" id="illness">Select your illness
  	 		 <span class="caret"></span>
  	   </button>
  	 			 <ul class="dropdown-menu illness">
  	   				 <li><a>Highblood</a></li>
  	   				 <li><a>Diabetes</a></li>
               <li><a>Cholesterol</a></li>
               <li><a>Anemia</a></li>
               <li><a>Diarrhea</a></li>
               <li><a>Heart_Disease</a></li>
               <li><a>Stress</a></li>
               <li><a>Goiter</a></li>
  	 			</ul>
  	   </div>
  	   <div class="dropdown market">
  	 <button class="I_design dropdown-toggle" type="button" data-toggle="dropdown" id="market">Select market
  	 		 <span class="caret"></span>
  	 	</button>
  	 			 <ul class="dropdown-menu market">
  	   				 <li><a>SM Supermarket</a></li>
  	   				 <li><a>Meadows Grocery</a></li>
  	 			</ul>
  	   </div>
        <button type="submit" class="btn btn-default btn-lg" id="gobtn" name="gobtn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
     </div>
    <div class="checkbox highlight4 text-center center-block">
      <label><input type="checkbox" value="" name="auto" id="auto">Automatically Search Nearby Market</label>
    </div>
  </form>
</div>
<div class="mobile-info text-center hide">
    <button class="I_design" style="width:50%;">Mobile Application Soon...</button>
</div>
<script>
  $(function(){

  $(".dropdown-menu.illness li a").click(function(){

    $("#illness:first-child").text($(this).text());
    $("#illness:first-child").val($(this).text());
    $("#illness:first-child").append(' <span class="caret"></span>');
    $("#illnessValue").val($(this).text());
  
  });

  $(".dropdown-menu.market li a").click(function(){

    $("#market:first-child").text($(this).text());
    $("#market:first-child").val($(this).text());
    $("#market:first-child").append(' <span class="caret"></span>');
    $("#marketValue").val($(this).text());
  });
 $("#auto").click(function(){
  if ($('#auto').prop('checked')) {
    $("#autoValue").val('true');
    $("#market").prop('disabled',true);
    $("#market").removeClass("I_design").addClass("disabledbtn");
    $('#auto').prop('unchecked')
  }
  else{
     $("#autoValue").val('false');
      $("#market").prop('disabled',false);
  $("#market").removeClass("disabledbtn").addClass("I_design");
    $('#auto').prop('checked')
  }
});
  });
</script>

<?php 

 if(isset($_POST['gobtn']))
  {
   
    $con = mysql_connect("localhost","username","password"); // Change connection here
    if(!$con){
      die("can not connect:" . mysql_error()); 
    }
    mysql_select_db("databasename",$con); // Database name 
    
  
  $sql = "SELECT * FROM decision";
  $insertData = "INSERT INTO `decision` (illness, market, autox) VALUES ('$_POST[illnessValue]', '$_POST[marketValue]', '$_POST[autoValue]')";
  $result = mysql_query($sql,$con); 
   if(mysql_num_rows($result) == 0) 
   {
      mysql_query($insertData,$con);
   }
   else
    {
      $sql = "TRUNCATE TABLE `decision`";
     mysql_query($sql);
     mysql_query($insertData,$con);
   }
   header("Location: Page1.php");
  exit();
     mysql_close($con);

  }
  ?>
</div>
</div>
<div class="middle">
  <div class='text-center how-it-works'>
      <h4>HOW HEALTHSPENDITURE WORKS</h4>
      <p>Healthspenditure is a web application that helps you cure your illness in a simple way.<br> 
        Providing healthy foods you need and prices for ingredients helping you to budget your money.<br> 
        With Healthspenditure, we can spend our money wisely and have a longer and better life.
      </p>
  </div>
  <div class="row text-center">
    <div class="col-md-4">
      <div class="icon-holder">
        <span class="glyphicon glyphicon-list-alt"></span>
      </div>
      <div class="content">
        <div class="content-header">
          <h4>Recommended Foods</h4>
        </div>
        Automatically list top 10 recommended and non-recommended foods for your illness together with the price.
      </div>
    </div>
    <div class="col-md-4">
      <div class="icon-holder">
        <span class="glyphicon glyphicon-map-marker"></span>
      </div>
      <div class="content">
        <div class="content-header">
          <h4>Market Location</h4>
        </div>
        Display nearby markets on your current location or specific market where you can buy foods automatically for you.
      </div>
    </div>
    <div class="col-md-4">
      <div class="icon-holder">
        <span class="glyphicon glyphicon-pencil"></span>
      </div>
      <div class="content">
        <div class="content-header">
          <h4>Available Recipes</h4>
        </div>
        Suggest foods that helps cure your illness providing the ingredients and steps on how to cook it.
      </div>
    </div>
  </div>
  <div class="about">
      <div class="content-holder">
        <h2>ABOUT US</h2>
        <p>The Developers are Jerico Rillo, Raga Czarina Pangcoga, Ernest John Jashuel Callo, John Russel Alfonso, and Omega Mina.<br/>
          The Healthspenditure web application was developed during the DLSU Hackercup 2015 happened on November 21-22, 2015.
        </p>
        <p>Healthspenditure is currently in its beta phase. You can help us improve this app by providing suggestions and leaving us a feedback. CHEERS!</p>
      </div>
  </div>
  <div class="footer">
    All rights reserved &copy; 2016
  </div>
</div>

</body>
  <script>
  $(function(){
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
          $(".controller-wrapper").addClass("hide");
          $(".mobile-info").addClass("show");
      }
      else{
          $(".controller-wrapper").addClass("show");
          $(".mobile-info").addClass("hide");
      }
  });  
</script>
</html>
