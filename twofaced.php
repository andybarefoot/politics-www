<?
require_once '../../includes/db-cameron.php';
require_once '../../includes/dbactions.php';

if($_GET['poster']){
	$poster=intval($_GET['poster']);
	$sqlStmt="SELECT * FROM `twofaced` WHERE twofaced_id=$poster;";
	$resultsPosters=getData($sqlStmt);
	if($resultsPosters){
		$resultsPoster=$resultsPosters[0];
		$leftImage=$resultsPoster['twofaced_left_image'];
		$left1=urldecode($resultsPoster['twofaced_left1']);
		$left2=urldecode($resultsPoster['twofaced_left2']);
		$leftText=urldecode($resultsPoster['twofaced_lefttext']);
		$rightImage=$resultsPoster['twofaced_right_image'];
		$right1=urldecode($resultsPoster['twofaced_right1']);
		$right2=urldecode($resultsPoster['twofaced_right2']);
		$rightText=urldecode($resultsPoster['twofaced_righttext']);
	}
}else{
	if($_POST['leftImage']){
		$leftImage=intval($_POST['leftImage']);
	}else{
		$leftImage=1;
	}
	if($_POST['left1']){
		$left1=stripslashes($_POST['left1']);
	}else{
		$left1="DAVID";
	}
	if($_POST['left2']){
		$left2=stripslashes($_POST['left2']);
	}else{
		$left2="CAMERA ON";
	}
	if($_POST['leftText']){
		$leftText=stripslashes($_POST['leftText']);
	}else{
		$leftText="\"WE ARE COMMITTED TO THE NHS\"";
	}
	if($_POST['rightImage']){
		$rightImage=intval($_POST['rightImage']);
	}else{
		$rightImage=1;
	}
	if($_POST['right1']){
		$right1=stripslashes($_POST['right1']);
	}else{
		$right1="DAVID";
	}
	if($_POST['right2']){
		$right2=stripslashes($_POST['right2']);
	}else{
		$right2="CAMERA OFF";
	}
	if($_POST['rightText']){
		$rightText=stripslashes($_POST['rightText']);
	}else{
		$rightText="WANTS TO SCRAP YOUR RIGHT TO SEE A CANCER SPECIALIST WITHIN TWO WEEKS";
	}
}

$sleft1=urlencode($left1);
$sleft2=urlencode($left2);
$sleftText=urlencode($leftText);
$sright1=urlencode($right1);
$sright2=urlencode($right2);
$srightText=urlencode($rightText);

if($_POST['left1']){
	$sqlStmt="INSERT INTO `twofaced` (`twofaced_id`,`twofaced_left_image`,`twofaced_left1`,`twofaced_left2`,`twofaced_lefttext`,`twofaced_right_image`,`twofaced_right1`,`twofaced_right2`,`twofaced_righttext`)VALUES (NULL,'$leftImage','$sleft1','$sleft2','$sleftText','$rightImage','$sright1','$sright2','$rightText');";
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
	$scale=1;
}else{
	$scale=1;
}	


$sqlStmt="SELECT count(*) AS totalPosters FROM `twofaced`;";
$resultsCount=getData($sqlStmt);
if($resultsCount){
	$resultCount=$resultsCount[0][0];
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Make your own Labour Two-Faced poster</title>
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
 			color: #000;
   			background: #fff;
   			text-align: center;
    		font-size:100%;
    		line-height:1.125em;
    		font-size:0.875em;
    		font-family: Helvetica, Arial, sans-serif;
		}
		a {
			color: #000;
		}
		.lineText {
			width: 300px;
		}
		.logoText {
			width: 100px;
		}
		textarea{
			width: 300px;
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
    		background: #000;
    		height: 60px;
    		padding:20px;
 		}
 		#footer{
    		background: #000;
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
	<script type="text/javascript">
	function setMenus(){
		document.posterForm.leftImage.selectedIndex=<? print $leftImage; ?>-1;
		document.posterForm.rightImage.selectedIndex=<? print $rightImage; ?>-1;
	}
	</script>
		
	<body onLoad="setMenus();">
<div id="wrap">	
<div id="main" class="clearfix">
	<div id="header">
	<h1>Make your own Labour Two-Faced poster</h1>
	</div>
	<div id="content">
	<img src="http://www.andybarefoot.com/politics/posterTwofaced.php?leftImage=<? print $leftImage; ?>&left1=<? print $sleft1; ?>&left2=<? print $sleft2; ?>&leftText=<? print $sleftText; ?>&rightImage=<? print $rightImage; ?>&right1=<? print $sright1; ?>&right2=<? print $right2; ?>&rightText=<? print $rightText; ?>&size=<? print $size; ?>" alt="David Cameron poster" width="<? print round($scale*940);?>" height="<? print round($scale*400);?>">
	<h3>
<?
if($poster){
?>
<strong>Direct link:</strong> http://www.andybarefoot.com/politics/twofaced.php?poster=<? print $poster; ?> <strong>|| Post your generated poster to <a href="http://www.facebook.com/sharer.php?u=http://www.andybarefoot.com/politics/twofaced.php?poster=<? print $poster; ?>&t=My own Labour Two-Faced poster" target="_blank">Facebook</a></strong><!-- <br /><form name="twitPicForm" action="twitPicUploader2.php" Method="POST" target="_blank"><strong>Post to Twitter - </strong> Username:<input id="nameField" type="text" name="username"> Password: <input id="passField" type="password" name="password"> Tweet: "[image link] - <input id="messField" type="text" name="message" value="My David Cameron poster" maxlength=80=> - made here http://bit.ly/7b4vAk"<input type="hidden" name="poster" value="<? print $poster; ?>"> <input type="submit" value="Tweet!"></form>--><br/>

<?
}
?>
	</h3><h2>Submit the form to create your own poster.</h2>
	<form name="posterForm" action="twofaced.php" method="POST" >
	<table>
	<tr>
	<td>Left Image:</td>
	<td><select name="leftImage">
		<option value="1">David Cameron</option>
		<option value="2">Gordon Brown</option>
		<option value="3">Nick Clegg</option>
		<option value="4">Tony Blair</option>
		<option value="5">Margaret Thatcher</option>
		</select></td>
	<td>Right Image:</td>
	<td><select name="rightImage">
		<option value="1">David Cameron</option>
		<option value="2">Gordon Brown</option>
		<option value="3">Nick Clegg</option>
		<option value="4">Tony Blair</option>
		<option value="5">Margaret Thatcher</option>
		</select></td>
	</tr>
	<tr>
	<td>Left line 1:</td>
	<td><input type="text" class="lineText" name="left1" value="<? print $left1; ?>"></td>
	<td>Right line 1:</td>
	<td><input type="text" class="lineText" name="right1" value="<? print $right1; ?>"></td>
	</tr>
	<tr>
	<td>Left line 2:</td>
	<td><input type="text" class="lineText" name="left2" value="<? print $left2; ?>"></td>
	<td>Right line 2:</td>
	<td><input type="text" class="lineText" name="right2" value="<? print $right2; ?>"></td>
	</tr>
	<tr>
	<td>Left text:</td>
	<td><textarea name="leftText"><? print $leftText; ?></textarea></td>
	<td>Right text:</td>
	<td><textarea name="rightText"><? print $rightText; ?></textarea></td>
	</tr>
	<tr>
	<td colspan="4" align="center"><input type="submit" value="Generate"></td>
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
	<td><a href="cameron.php"><img src="images/cameron-poster-button.jpg" /></a></td>
	<td><a href="tucker.php"><img src="images/tucker-poster-button.jpg" /></a></td>
	<td><a href="tombstone.php"><img src="images/tombstone-poster-button.jpg" /></a></td>
<!--	<td><a href="twofaced.php"><img src="images/twofaced-poster-button.jpg" /></a></td> -->
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