<?
require_once '../../includes/db-cameron.php';
require_once '../../includes/dbactions.php';

$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron`;";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countAll=$resultsCount[0][0];
}

$searchStr='%posh%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$posh=round(100*$countSearch/$countAll,2);

$searchStr='%eton%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$eton=round(100*$countSearch/$countAll,2);

$searchStr='%toff%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$toff=round(100*$countSearch/$countAll,2);

$searchStr='%nhs%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$nhs=round(100*$countSearch/$countAll,2);

$searchStr='%war%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$war=round(100*$countSearch/$countAll,2);

$searchStr='%expense%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$expense=round(100*$countSearch/$countAll,2);

$searchStr='%bank%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$bank=round(100*$countSearch/$countAll,2);

$searchStr='%tie%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$tie=round(100*$countSearch/$countAll,2);

$searchStr='%airbrush%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$airbrush=round(100*$countSearch/$countAll,2);

$searchStr='%face%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$face=round(100*$countSearch/$countAll,2);

$searchStr='%labour%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$labour=round(100*$countSearch/$countAll,2);

$searchStr='%conservative%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$conservative=round(100*$countSearch/$countAll,2);

$searchStr='%tory%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$tory=round(100*$countSearch/$countAll,2);

$searchStr='%lib dem%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$libdem=round(100*$countSearch/$countAll,2);

$searchStr='%shit%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$shit=round(100*$countSearch/$countAll,2);

$searchStr='%cock%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$cock=round(100*$countSearch/$countAll,2);

$searchStr='%fuck%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$fuck=round(100*$countSearch/$countAll,2);

$searchStr='%cunt%';
$sqlStmt="SELECT count(*) AS totalPosters FROM `cameron` WHERE cameron_line1 LIKE '$searchStr' OR cameron_line2 LIKE '$searchStr' OR cameron_logo1 LIKE '$searchStr' OR cameron_logo2 LIKE '$searchStr' OR cameron_logo3 LIKE '$searchStr' OR cameron_tagline1 LIKE '$searchStr';";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$countSearch=$resultsCount[0][0];
}
$cunt=round(100*$countSearch/$countAll,2);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Make your own David Cameron poster</title>
	</head>
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
		input[type="text"] {
			width: 800px;
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
    		background: #0097DA;
    		height: 60px;
    		padding:20px;
 		}
 		#footer{
    		background: #0097DA;
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
  			background: #0097DA;
  		}
 		td{
 			padding: 1px;
  			background: #fff;
  		}
 		 		
	</style>	
	<body>
<div id="wrap">	
<div id="main" class="clearfix">
	<div id="header">
	<h1>Make your own David Cameron poster</h1>
	</div>
	<div id="content">
	<h2>Some stats on the posters generated so far:</h2>
	<table>
	<tr>
	<td colspan="2" align="center"><b>Parties</b></td>
	<td colspan="2" align="center"><b>Issues</b></td>
	</tr>
	<tr>
	<td width="100"><b>Keyword</b></td>
	<td width="120"><b>% of all posters</b></td>
	<td width="100"><b>Keyword</b></td>
	<td width="120"><b>% of all posters</b></td>
	</tr>
	<tr>
	<td>Conservative</td>
	<td><? print $conservative; ?>%</td>
	<td>NHS</td>
	<td><? print $nhs; ?>%</td>
	</tr>
	<tr>
	<td>Tory</td>
	<td><? print $tory; ?>%</td>
	<td>War</td>
	<td><? print $war; ?>%</td>
	</tr>
	<tr>
	<td>Labour</td>
	<td><? print $labour; ?>%</td>
	<td>Expense</td>
	<td><? print $expense; ?>%</td>
	</tr>
	<tr>
	<td>Lib Dem</td>
	<td><? print $libdem; ?>%</td>
	<td>Bank</td>
	<td><? print $bank; ?>%</td>
	</tr>
	</table>
	<table>
	<tr>
	<td colspan="2" align="center"><b>Image</b></td>
	<td colspan="2" align="center"><b>Background</b></td>
	</tr>
	<tr>
	<td width="100"><b>Keyword</b></td>
	<td width="120"><b>% of all posters</b></td>
	<td width="100"><b>Keyword</b></td>
	<td width="120"><b>% of all posters</b></td>
	</tr>
	<tr>
	<td>Airbrush</td>
	<td><? print $airbrush; ?>%</td>
	<td>Posh</td>
	<td><? print $posh; ?>%</td>
	</tr>
	<tr>
	<td>Face</td>
	<td><? print $face; ?>%</td>
	<td>Eton</td>
	<td><? print $eton; ?>%</td>
	</tr>
	<tr>
	<td>Tie</td>
	<td><? print $tie; ?>%</td>
	<td>Toff</td>
	<td><? print $toff; ?>%</td>
	</tr>
	</table>
	<table>
	<tr>
	<td colspan="2" align="center"><b>Malcolm Tucker</b></td>
	</tr>
	<tr>
	<td width="100"><b>Keyword</b></td>
	<td width="120"><b>% of all posters</b></td>
	</tr>
	<tr>
	<td>C**K</td>
	<td><? print $cock; ?>%</td>
	</tr>
	<tr>
	<td>S***</td>
	<td><? print $shit; ?>%</td>
	</tr>
	<tr>
	<td>F***</td>
	<td><? print $fuck; ?>%</td>
	</tr>
	<tr>
	<td>C***</td>
	<td><? print $cunt; ?>%</td>
	</tr>
	</table>
	<h2>Back to the <a href="index.php">poster</a>.</h2>
	</div>
</div>
</div>
<div id="footer">Built by <a href="http://www.andybarefoot.com" target="_blank">Andy Barefoot</a> who <? //<a href="http://parliamentaryreformparty.org.uk/" target="_blank"> ?>doesn't support Labour or the Conservatives<?//</a>?>.</div>
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