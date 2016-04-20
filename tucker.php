<?
require_once '../../includes/db-cameron.php';
require_once '../../includes/dbactions.php';

if($_GET['quote1']){
	$quote1=intval($_GET['quote1']);
}else{
	$quote1=0;
}
if($_GET['quote2']){
	$quote2=intval($_GET['quote2']);
}else{
	$quote2=0;
}
if($_GET['quote3']){
	$quote3=intval($_GET['quote3']);
}else{
	$quote3=0;
}

$sline1=0;
$sline2=0;
$slogo1=0;
$slogo2=0;
$slogo3=0;
$stagline1=0;
$size=3;
$scale=1;

$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron`;";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$resultCount=$resultsCount[0][0];
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Make your own Malcolm Tucker poster</title>

<SCRIPT LANGUAGE="JavaScript">
<!--
sline1=0;
sline2=0;
slogo1=0;
slogo2=0;
slogo3=0;
stagline1=0;

function tuckerise(){
	sline1=Math.floor(83*Math.random());
	sline2=Math.floor(0*Math.random());
	slogo1=Math.floor(0*Math.random());
	slogo2=Math.floor(0*Math.random());
	slogo3=Math.floor(5*Math.random());
	stagline1=Math.floor(39*Math.random());
	imgStr='posterTucker.php?line1='+sline1+'&line2='+sline2+'&logo1='+slogo1+'&logo2='+slogo2+'&logo3='+slogo3+'&tagline1='+stagline1+'&size=3';
	document.getElementById("poster").src=imgStr;
}
//-->
</SCRIPT>
	<style>
/*  
Sticky Footer Solution
by Steve Hatcher 
http://stever.ca
http://www.cssstickyfooter.com
*/
		html, body, #wrap {
			height: 100%;
		}
		body > #wrap {
			height: auto;
			min-height: 100%;
		}
		#main {
			padding-bottom: 30px;
		}
		#footer {
			position: relative;
			margin-top: -30px;
			height: 30px;
			clear:both;
		} 
		.clearfix:after {
			content: ".";
			display: block;
			height: 0;
			clear: both;
			visibility: hidden;
		}
		.clearfix {
			display: inline-block;
		}
		* html .clearfix {
			height: 1%;
		}
		.clearfix {
			display: block;
		}
		body {
 			margin: 0;
 			color: #094B9f;
   			background: #fff;
   			text-align: center;
    		font-size:100%;
    		line-height:1.125em;
    		font-size:0.875em;
    		font-family: Helvetica, Arial, sans-serif;
		}
		a {
			color: #094B9f;
		}
		input{
    		font-size:1.3em;
		}
		h1 {
    		color: #fff;
 		}
		h2 {
   			margin-bottom:0;
 		}
		h3 {
    		margin:0;
    		font-size:0.75em;
 		}
 		#header{
    		color: #ffffff;
    		background: #f11712;
    		height: 60px;
    		padding:20px;
 		}
 		#footer{
    		background: #f11712;
    		color: #fff;
    		padding-top: 8px;
 		}
 		#footer a{
 			color: #fff;
 		}
 		#content{
    		padding:20px;
 		}
 		table{
 			margin-top: 20px;
 			margin-left: auto;
 			margin-right: auto;
  			text-align: left;
  			padding: 2px;
  		}
 		td{
 			background: #ffffff;
  			padding: 3px;
  		}
 		 		
	</style>	
	</head>
	<body>
<div id="wrap">	
<div id="main" class="clearfix">
	<div id="header">
	<h1>Make your own Malcolm Tucker poster</h1>
	WARNING: Contains industrial strength swearing
	</div>
	<div id="content">
<?
if($_GET['quote1']){
	print ("<img id=\"poster\" src=\"posterTucker.php?line1=".$quote1."&line2=0&logo1=0&logo2=0&logo3=".$quote2."&tagline1=".$quote3."&size=3\" alt=\"Malcolm Tucker poster\" width=\"768\" height=\"384\">");
}else{
	print ("<img id=\"poster\" src=\"cameronOrig.jpg\" alt=\"Malcolm Tucker poster\" width=\"768\" height=\"384\">");
}
?>
	<br />
	<br />
	Malcolm Tucker is the sweary spin doctor from The Thick of It and In The Loop.<br/>
	Click the "Tuckerise" button below to see one of his (possibly extremely rude) Tucker-isms displayed on the poster.<br/>
	If you don't like swearing please don't click the button.<br/>
	Certainly don't keep repeatedly clicking it until the "Tucker's Law" one comes up. You really aren't going to like that one.
	<br/>
	<br/>
	<form name="posterForm" action="tucker.php" method="POST" >
	<input type="button" value="Tuckerise" onClick="tuckerise();">
	 </form><br/><br/>
	<table>
	<tr>
	<td align="center" colspan="4">More "Make your own" posters:</td>
	</tr>
	<tr>
	<td><a href="cameron.php"><img src="images/cameron-poster-button.jpg" /></a></td>
<!--	<td><a href="tucker.php"><img src="images/tucker-poster-button.jpg" /></a></td> -->
	<td><a href="tombstone.php"><img src="images/tombstone-poster-button.jpg" /></a></td>
	<td><a href="twofaced.php"><img src="images/twofaced-poster-button.jpg" /></a></td>
	<td><a href="tory.php"><img src="images/tory-poster-button.jpg" /></a></td>
	</tr>
	</table>
		</div>
</div>
</div>
<div id="footer">Built by <a href="http://www.andybarefoot.com" target="_blank">Andy Barefoot</a> <a href="http://twitter.com/andybarefoot" target="_blank"><img src="images/twitter-icon.png" border="0" /></a> who <a href="http://www.voteforachange.co.uk/" target="_blank">doesn't support Labour or the Conservatives</a>. &nbsp;&nbsp;&nbsp;<a href="http://www.voteforachange.co.uk/" target="_blank"><img src="vote-for-a-change.png" border="0"></a></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12511578-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>