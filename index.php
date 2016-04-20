<?
require_once '../../includes/db-cameron.php';
require_once '../../includes/dbactions.php';

if($_GET['poster']){
	$poster=intval($_GET['poster']);
	$sqlStmt="SELECT * FROM `cameron` WHERE cameron_id=$poster;";
	$resultsPosters=getData($sqlStmt);
	if($resultsPosters){
		$resultsPoster=$resultsPosters[0];
		$line1=urldecode($resultsPoster['cameron_line1']);
		$line2=urldecode($resultsPoster['cameron_line2']);
		$logo1=urldecode($resultsPoster['cameron_logo1']);
		$logo2=urldecode($resultsPoster['cameron_logo2']);
		$logo3=urldecode($resultsPoster['cameron_logo3']);
		$tagline1=urldecode($resultsPoster['cameron_tagline1']);
	}
}else{
	if($_POST['line1']){
		$line1=stripslashes($_POST['line1']);
	}else if($_GET['line1']){
		$line1=stripslashes($_GET['line1']);
	}else{
		$line1="We can't go on like this.";
	}
	if($_POST['line2']){
		$line2=stripslashes($_POST['line2']);
	}else if($_GET['line2']){
		$line2=stripslashes($_GET['line2']);
	}else{
		$line2="The Conservatives will do things very very slightly differently.";
	}
	if($_POST['logo1']){
		$logo1=stripslashes($_POST['logo1']);
	}else if($_GET['logo1']){
		$logo1=stripslashes($_GET['logo1']);
	}else{
		$logo1="NOT";
	}
	if($_POST['logo2']){
		$logo2=stripslashes($_POST['logo2']);
	}else if($_GET['logo2']){
		$logo2=stripslashes($_GET['logo2']);
	}else{
		$logo2="QUITE";
	}
	if($_POST['logo3']){
		$logo3=stripslashes($_POST['logo3']);
	}else if($_GET['logo3']){
		$logo3=stripslashes($_GET['logo3']);
	}else{
		$logo3="LABOUR";
	}
	if($_POST['tagline1']){
		$tagline1=stripslashes($_POST['tagline1']);
	}else if($_GET['tagline1']){
		$tagline1=stripslashes($_GET['tagline1']);
	}else{
		$tagline1="The Conservatives. A change, but only just.";
	}
}
$sline1=urlencode($line1);
$sline2=urlencode($line2);
$slogo1=urlencode($logo1);
$slogo2=urlencode($logo2);
$slogo3=urlencode($logo3);
$stagline1=urlencode($tagline1);

if($_POST['line1']){
	$sqlStmt="INSERT INTO `cameron` (`cameron_id`,`cameron_line1`,`cameron_line2`,`cameron_logo1`,`cameron_logo2`,`cameron_logo3`,`cameron_tagline1`)VALUES (NULL,'$sline1','$sline2','$slogo1','$slogo2','$slogo3','$stagline1');";
	$poster=insertDataReturnID($sqlStmt);
}

if($_POST['size']){
	$size=$_POST['size'];
}else{
	$size=3;
}
if($size==1){
	$scale=0.25;
}else if($size==2){
	$scale=0.5;
}else if($size==3){
	$scale=0.75;
}else{
	$scale=0.75;
}	


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
			padding-bottom: 40px;
		}
		#footer {
			position: relative;
			margin-top: -40px;
			height: 40px;
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
		.lineText {
			width: 500px;
		}
		.logoText {
			width: 100px;
		}
		#nameField{
			width: 70px;
		}
		#passField{
			width: 70px;
		}
		#messField{
			width: 150px;
		}
		h1 {
    		color: #fff;
 		}
		h2 {
   			margin-bottom:0;
 		}
		h3 {
    		margin:0;
    		font-size:0.80em;
 		}
 		h3 strong {
    		font-size:1.4em;
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
 			margin-left: auto;
 			margin-right: auto;
  			text-align: left;
  		}
 		 		
	</style>	
	<body>
<div id="wrap">	
<div id="main" class="clearfix">
	<div id="header">
	<h1>Make your own David Cameron poster</h1>
	</div>
	<div id="content">
	<img src="http://www.andybarefoot.com/politics/poster.php?line1=<? print $sline1; ?>&line2=<? print $sline2; ?>&logo1=<? print $slogo1; ?>&logo2=<? print $slogo2; ?>&logo3=<? print $slogo3; ?>&tagline1=<? print $stagline1; ?>&size=<? print $size; ?>" alt="David Cameron poster" width="<? print round($scale*1024);?>" height="<? print round($scale*512);?>">
	<h3>
<?
if($poster){
?>
<strong>Direct link:</strong> http://www.andybarefoot.com/politics/index.php?poster=<? print $poster; ?> <strong>|| Post your generated poster to <a href="http://www.facebook.com/sharer.php?u=http://www.andybarefoot.com/politics/index.php?poster=<? print $poster; ?>&t=My own David Cameron poster" target="_blank">Facebook</a></strong><br /><form name="twitPicForm" action="twitPicUploader2.php" Method="POST" target="_blank"><strong>Post to Twitter - </strong> Username:<input id="nameField" type="text" name="username"> Password: <input id="passField" type="password" name="password"> Tweet: "[image link] - <input id="messField" type="text" name="message" value="My David Cameron poster" maxlength=80=> - made here http://bit.ly/7b4vAk"<input type="hidden" name="poster" value="<? print $poster; ?>"> <input type="submit" value="Tweet!"></form><br/>

<?
}
?>
	Send your best posters to <a href="http://mydavidcameron.com" target="_blank">MyDavidCameron.com</a> where they have plenty of brilliant photoshopped versions. Save or drag the poster to your desktop.
	</h3><h2>Submit the form to create your own poster.</h2>
	<form name="posterForm" action="index.php" method="POST" >
	<table>
	<tr>
	<td>Line 1:</td>
	<td><input type="text" class="lineText" name="line1" value="<? print $line1; ?>"></td>
	<td>Logo 1:</td>
	<td><input type="text" class="logoText" name="logo1" value="<? print $logo1; ?>"></td>
	</tr>
	<tr>
	<td>Line 2:</td>
	<td><input type="text" class="lineText" name="line2" value="<? print $line2; ?>"></td>
	<td>Logo 2:</td>
	<td><input type="text" class="logoText" name="logo2" value="<? print $logo2; ?>"></td>
	</tr>
	<tr>
	<td>Tagline:</td>
	<td><input type="text" class="lineText" name="tagline1" value="<? print $tagline1; ?>"></td>
	<td>Logo 3:</td>
	<td><input type="text" class="logoText" name="logo3" value="<? print $logo3; ?>"></td>
	</tr>
	<tr>
	<td>Size:</td>
	<td><input type="radio" name="size" value="1" <? if($size==1)print "checked"?>> Small <input type="radio" name="size" value="2" <? if($size==2)print "checked"?>> Medium <input type="radio" name="size" value="3" <? if($size==3)print "checked"?>> Large </td>
	<td></td>
	<td><input type="submit" value="Generate"></td>
	</tr>
	</table>
	</form>
	<br/>
	<b><? print $resultCount;?></b> posters generated so far.<br/><br/>
	<table>
	<tr>
	<td align="center" colspan="4">More "Make your own" posters:</td>
	</tr>
	<tr>
<!--	<td><a href="index.php"><img src="images/cameron-poster-button.jpg" /></a></td> -->
	<td><a href="tucker.php"><img src="images/tucker-poster-button.jpg" /></a></td>
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