<?
require_once '../../includes/db-cameron.php';
require_once '../../includes/dbactions.php';

function findexts ($filename){
	$filename = strtolower($filename) ;
	$exts = split("[/\\.]", $filename) ;
	$n = count($exts)-1;
	$exts = $exts[$n];
	return $exts;
}

$fileError="null";
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
		$colour=$resultsPoster['cameron_colour'];
		$photo=$resultsPoster['cameron_photo'];
	}
}else{
	if($_POST['line1']){
		$line1=stripslashes($_POST['line1']);
	}else{
		$line1="I've never voted Tory before,";
	}
	if($_POST['line2']){
		$line2=stripslashes($_POST['line2']);
	}else{
		$line2="but I like their plans to help families.";
	}
	if($_POST['logo1']){
		$logo1=stripslashes($_POST['logo1']);
	}else{
		$logo1="BLANK";
	}
	if($_POST['logo2']){
		$logo2=stripslashes($_POST['logo2']);
	}else{
		$logo2="BLANK";
	}
	if($_POST['logo3']){
		$logo3=stripslashes($_POST['logo3']);
	}else{
		$logo3="BLANK";
	}
	if($_POST['tagline1']){
		$tagline1=stripslashes($_POST['tagline1']);
	}else{
		$tagline1="Conservatives";
	}
	if($_POST['photo']){
		$photo=intval($_POST['photo']);
	}else{
		$photo=3;
	}
	if($_POST['userPhotoID']){
		$userPhotoID=stripslashes($_POST['userPhotoID']);
	}else{
		$userPhotoID=0;
	}
	if($_POST['colour']){
		$colour=intval($_POST['colour']);
	}else{
		$colour=1;
	}
	if($_POST['textPosition']){
		$textPosition=intval($_POST['textPosition']);
	}else{
		$textPosition=1;
	}
	if($_FILES['userPhoto']){
		$allowedExtensions = array("jpg","jpeg","gif","png");
		if($_FILES['userPhoto']['tmp_name'] > ''){
			if(!in_array(end(explode(".",strtolower($_FILES['userPhoto']['name']))),$allowedExtensions)){
				$userPhoto="void";
				$fileError="Incorrect file type. Must be JPG, PNG or GIF.";
			}else if($_FILES['userPhoto']['size']>100000){
				$userPhoto="void";
				$fileError="File too large. Must be under 100kb.";
			}else{
				$ext = findexts ($_FILES['userPhoto']['name']) ;
				$newFileName=time().".".$ext;
				$target_path = "uploadedImages/".$newFileName;
				if(move_uploaded_file($_FILES['userPhoto']['tmp_name'], $target_path)) {
    				$userPhoto=$newFileName;
    				$photo=4;
				} else{
					$userPhoto="void";
					$fileError="Could not upload file";
				}
			}
		}else{
			$userPhoto="null";
		}
	}else{
		$userPhoto="null";
	}
}

if(($userPhotoID!=0)&&(($userPhoto=="null")||($userPhoto=="void"))){
	$userPhoto=$userPhotoID;
}

if($colour<1)$colour=1;
if($colour>3)$colour=1;
if($textPosition<1)$textPosition=1;
if($textPosition>4)$textPosition=1;

if($photo==3){
	$photoWidth=1000;
	$photoHeight=500;
}else{
	$photoWidth=940;
	$photoHeight=470;
}
$sline1=urlencode($line1);
$sline2=urlencode($line2);
$slogo1=urlencode($logo1);
$slogo2=urlencode($logo2);
$slogo3=urlencode($logo3);
$stagline1=urlencode($tagline1);
$sphoto=$photo;
$stextPosition=$textPosition;
$scolour=$colour;

if($_POST['line1']){
	$sqlStmt="INSERT INTO `cameron` (`cameron_id`,`cameron_line1`,`cameron_line2`,`cameron_logo1`,`cameron_logo2`,`cameron_logo3`,`cameron_tagline1`,`cameron_photo`,`cameron_file`,`cameron_colour`)VALUES (NULL,'$sline1','$sline2','$slogo1','$slogo2','$slogo3','$stagline1','$sphoto','$userPhoto','$scolour');";
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
		<title>Make your own Never Voted Tory poster</title>
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
 			margin-top: 5px;
 			margin-left: auto;
 			margin-right: auto;
  			text-align: left;
  		}
 		 		
	</style>	
	<body>
<div id="wrap">	
<div id="main" class="clearfix">
	<div id="header">
	<h1>Make your own Never Voted Tory poster</h1>
	</div>
	<div id="content">
	<img src="http://www.andybarefoot.com/politics/posterTory.php?textPos=<? print $stextPosition; ?>&colour=<? print $scolour; ?>&photo=<? print $sphoto; ?>&userImg=<? print $userPhoto; ?>&line1=<? print $sline1; ?>&line2=<? print $sline2; ?>&logo1=<? print $slogo1; ?>&logo2=<? print $slogo2; ?>&logo3=<? print $slogo3; ?>&tagline1=<? print $stagline1; ?>&size=<? print $size; ?>" alt="David Cameron poster">
	<h3>
<?
if(($poster)&&($photo!=4)){
?>
<strong>Direct link:</strong> http://www.andybarefoot.com/politics/tory.php?poster=<? print $poster; ?> <strong>|| Post your generated poster to <a href="http://www.facebook.com/sharer.php?u=http://www.andybarefoot.com/politics/tory.php?poster=<? print $poster; ?>&t=My own Never Voted Tory poster" target="_blank">Facebook</a></strong><br />
<?
}
if($poster){
?>
	<form name="twitPicForm" action="twitPicUploaderTory.php" Method="POST" target="_blank"><strong>Post to Twitter - </strong> Username:<input id="nameField" type="text" name="username"> Password: <input id="passField" type="password" name="password"> Tweet: "[image link] - <input id="messField" type="text" name="message" value="I've never voted Tory" maxlength=80=> - made here http://bit.ly/9F4peF #ivenevervotedtory"<input type="hidden" name="poster" value="<? print $poster; ?>"> <input type="submit" value="Tweet!"></form><br/>
<?
}
?>
	Send your best posters to <a href="http://mydavidcameron.com/tory/" target="_blank">MyDavidCameron.com</a> where they will show the best versions. Save or drag the poster to your desktop.
	</h3><h2>Submit the form to create your own poster.</h2>
	<form name="posterForm" action="tory.php" method="POST" enctype="multipart/form-data">
	<table>
	<tr>
	<td colspan="2">Chooses one of the original Conservative photographs: <select name="photo">
<?
if($photo==4){
?>	
	<option value="4" selected>[Uploaded Image]</option>
<?
}
?>
	<option value="3"<? if($photo==3)print " selected ";?>>Caring mother: She has family values!</option>
	<option value="1"<? if($photo==1)print " selected ";?>>Feisty student: She's from an ethnic minority!</option>
	<option value="2"<? if($photo==2)print " selected ";?>>Factory man: He's working class!</option>
	</select></td>
	</tr>
<?
if($fileError!='null'){
	print('<tr><td colspan="2"><font color="#f00">'.$fileError.'</font></td></tr>');
}
?>
	<tr>
	<td colspan="2">Or upload one of your own*: <input type="file" name="userPhoto"><input type="hidden" name="userPhotoID" value="<? print $userPhoto; ?>"></td>
	</tr>
	<tr>
	<td>Line 1:</td>
	<td><input type="text" class="lineText" name="line1" value="<? print $line1; ?>"></td>
	</tr>
	<tr>
	<td>Line 2:</td>
	<td><input type="text" class="lineText" name="line2" value="<? print $line2; ?>"></td>
	</tr>
	<tr>
	<td>Tagline:</td>
	<td><input type="text" class="lineText" name="tagline1" value="<? print $tagline1; ?>"></td>
	</tr>
	<tr>
	<td colspan="2">Colour: <input type="radio" name="colour" value="1" <? if($colour==1)print " checked ";?>> Conservative Blue <input type="radio" name="colour" value="2"<? if($colour==2)print " checked ";?>> Labour Red <input type="radio" name="colour" value="3"<? if($colour==3)print " checked ";?>> Liberal Democrat Yellow</td>
	</tr>
	<tr>
	<td colspan="2">Text position (own image): <input type="radio" name="textPosition" value="1" <? if($textPosition==1)print " checked ";?>> Top Left <input type="radio" name="textPosition" value="2"<? if($textPosition==2)print " checked ";?>> Bottom Left <input type="radio" name="textPosition" value="3"<? if($textPosition==3)print " checked ";?>> Top Right <input type="radio" name="textPosition" value="4"<? if($textPosition==4)print " checked ";?>> Bottom Right</td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" value="Generate"></td>
	</tr>
	</table>
	</form>
	<br/>
	*By uploading an image you certify that you own the rights to distribute the image<br>
	and that the image is not pornographic or otherwise offensive.
	<br>
	<br>
	<b><? print $resultCount;?></b> posters generated so far.<br/><br/>
	<table>
	<tr>
	<td align="center" colspan="4">More "Make your own" posters:</td>
	</tr>
	<tr>
	<td><a href="cameron.php"><img src="images/cameron-poster-button.jpg" /></a></td>
	<td><a href="tucker.php"><img src="images/tucker-poster-button.jpg" /></a></td>
	<td><a href="tombstone.php"><img src="images/tombstone-poster-button.jpg" /></a></td>
	<td><a href="twofaced.php"><img src="images/twofaced-poster-button.jpg" /></a></td>
<!--	<td><a href="tory.php"><img src="images/tory-poster-button.jpg" /></a></td> -->
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