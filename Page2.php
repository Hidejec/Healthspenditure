<?php 
	$con = mysql_connect("localhost","root","");
	if(!$con){
		die("can not connect:" . mysql_error()); 
	}
	mysql_select_db("Healthspenditure",$con);
	$illnessquery = mysql_query("SELECT illness FROM decision",$con);
	$marketquery = mysql_query("SELECT market FROM decision",$con);
	$autoxquery = mysql_query("SELECT autox FROM decision",$con);
	
	$illness; $market;  $autox;
	while ($row = mysql_fetch_array($illnessquery, MYSQL_ASSOC)) {
	    $illness =  $row['illness'];  
	}
	while ($row = mysql_fetch_array($marketquery, MYSQL_ASSOC)) {
	    $market =  $row['market'];  
	}
	while ($row = mysql_fetch_array($autoxquery, MYSQL_ASSOC)) {
	    $autox =  $row['autox'];  
	}
   	$recommendedquery = mysql_query("SELECT $illness FROM recommended",$con);
	$recommendedfoods = array();
	while ($row = mysql_fetch_array($recommendedquery, MYSQL_ASSOC)) {
	    $recommendedfoods[] =  $row[$illness];  
	}
	$price = array();
   	for($x = 0 ; $x<count($recommendedfoods);$x++){
 		$pricequery = mysql_query("SELECT DISTINCT price FROM the_market WHERE comodity LIKE '%{$recommendedfoods[$x]}%'",$con);
		while ($row = mysql_fetch_array($pricequery, MYSQL_ASSOC)) {
			$price[] =  $row['price']; 
		}
	}
	$notrecommendedquery = mysql_query("SELECT $illness FROM not_recommended",$con);
	$notrecommendedfoods = array();
	while ($row = mysql_fetch_array($notrecommendedquery, MYSQL_ASSOC)) {
	    $notrecommendedfoods[] =  $row[$illness];  
	}
	mysql_close($con);
	set_error_handler('exceptions_error_handler');
	function exceptions_error_handler($severity, $message, $filename, $lineno) {
  		if (error_reporting() == 0) {
    		return;
  		}
  		if (error_reporting() & $severity) {
    		throw new ErrorException($message, 0, $severity, $filename, $lineno);
  		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Healthspenditure</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bootstrap/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="style3.css">
  <script src="jquery.js"></script>
  <script src="/bootstrap/bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<div class="navbar transparent navbar-inverse navbar-fixed-top">
		<img class="logo" src="images/logo2.png">
	</div>
	<div class="navbar_nextprev">
			<span class="next">Next</span>
			<span class="prev">Previous&nbsp&nbsp&nbsp| </span>
	</div>

	<div class="lagayan_title center-block container-fluid">
		<center><h1>SIMPLE CHICKEN SOUP</h1></center>
	</div>

	<div class="ingredients container-fluid">
		<h3>Ingredients</h3>
		<p>Carcass and bones from one 4- to 5-pound roast chicken (or a mild-flavored rotisserie chicken) <br>
			4 cups low-sodium chicken broth <br>
			2 medium carrots, sliced into 1/4-inch-thick rounds <br>
			2 celery stalks, sliced into 1/4-inch-thick slices <br>
			1 medium onion, chopped <br>
			1 bay leaf <br>
			1/2 cup white rice <br>
			2 tablespoons chopped parsley
		</p>
		<br>
		<h3>Directions</h3>
		<p>Put the bones and carcass from a leftover chicken (they can be in pieces) in a large pot. Cover with the broth and 4 cups water. Bring to a boil over medium-high heat, reduce to a simmer and cook for 20 minutes. Skim any foam or fat from the broth with a ladle as necessary. <br>

		Remove the bones and carcass with tongs or a slotted spoon; set aside to cool. Add the carrots, celery, onion and bay leaf to the broth, bring back to a simmer and cook until the vegetables are about half cooked (they will still have resistance when tested with a knife but be somewhat pliable when bent), about 10 minutes. Stir in the rice (to keep it from sticking to the bottom), and cook until the grains are just al dente, 10 to 12 minutes. <br>

		Meanwhile, when the carcass and bones are cool enough to handle, pick off the meat, and shred it into bite-size pieces. <br>

		When the rice is done, add the meat to the broth and simmer until warmed through, about 1 minute. Stir in the parsley, and season with 1/2 teaspoon salt or more to taste. Serve hot.
		</p>
	</div>
</body>
</html>
  