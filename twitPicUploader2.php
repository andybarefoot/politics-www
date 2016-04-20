<?php
require_once '../../includes/db-cameron.php';
require_once '../../includes/dbactions.php';

class twitpic
{
  /* 
   * variable declarations
   */
  var $post_url='http://twitpic.com/api/upload';
  var $post_tweet_url='http://twitpic.com/api/uploadAndPost';
  var $url='';
  var $post_data='';
  var $result='';
  var $tweet='';
  var $return='';
 
/*
* @param1 is the array of data which is to be uploaded
* @param2 if passed true will display result in the XML format, default is false
* @param3 if passed true will update status twitter,default is false
*/
 
  function __construct($data,$return=false,$tweet=false)
  {
    $this->post_data=$data;
    if(empty($this->post_data) || !is_array($this->post_data)) //validates the data
      $this->throw_error(0);
    $this->display=$return;
    $this->tweet=$tweet;
 
  }
 
  function post()
  {
    $this->url=($this->tweet)?$this->post_tweet_url:$this->post_url; //assigns URL for curl request based on the nature of request by user
    $this->makeCurl();
  }
  private function makeCurl()
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, $this->url);
    curl_setopt($curl, CURLOPT_POST, 3);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $this->post_data);
    $this->result = curl_exec($curl);
    curl_close($curl);
    if($this->display)
    {
//      header ("content-type: text/xml");
//      echo $this->result ;
//$login_xml = new SimpleXMLElement($this->result);
//if (isset($login_xml->error)) {
//	print_r($login_xml);
//} else {
//print_r($login_xml);
//} 

    }
 
  }
  private function throw_error($code) //handles few errors, you can add more
 
  {
    switch($code)
    {
      case 0:
        echo 'Think, you forgot to pass the data';
        break;
      default:
        echo 'Something just broke !!';
        break;
    }
    exit;
  }
} //class ends here
 
?><?
function createImage($scale,$line1,$line2,$logo1,$logo2,$logo3,$tagline1,$poster){
	// sets some variables for this image
	$imgURL='http://www.andybarefoot.com/politics/images/cameronBackground.jpg';
	$textBoxW=648;
	//fetch original image
	$im = imagecreatefromjpeg($imgURL);
	if($im){
		// Get the image width and height.
		$imw = imagesx($im);
		$imh = imagesy($im);
		// Make another image to place the trimmed version in.
		$im2 = imagecreatetruecolor($imw, $imh);
		// Create some colors
		$trans_colour = imagecolorallocatealpha($im2, 0, 0, 0, 127);
		$black = imagecolorallocate($im2, 0, 0, 0);
		$white = imagecolorallocate($im2, 255, 255, 255);
		$grey = imagecolorallocate($im2, 128, 128, 128);
		// Resize
		imagecopyresampled($im2, $im, 0,0, 0, 0, $imw, $imh, $imw, $imh);
		// add text
	    $lineFontSize  = 32;
		$lineFont = 'Fradm.TTF';
        $lineColor = imagecolorallocate ($im2, 9, 75, 159);        
        $lineSpacing=46;
        $logoFontSize  = 17;
		$logoFont = 'Fradmit.TTF';
        $logoColor = imagecolorallocate ($im2, 255, 255, 255);
        $taglineFontSize  = 16;
		$taglineFont = 'Fradm.TTF';
        $taglineColor = imagecolorallocate ($im2, 0, 151, 218);
        $tooBig=0;
        $linebbox = imagettfbbox($lineFontSize, 0, $lineFont, $line1);
  		$line1width=$linebbox[2]-$linebbox[0];
 		if($line1width>$textBoxW)$tooBig=1;
 		while($tooBig==1){
 			$splitFound=0;
 			$lineStart=$line1;
 			while($splitFound==0){
 				$splitPos=strrpos($lineStart," ");
 				$lineStart=substr($lineStart,0,$splitPos);
	    		$linebbox = imagettfbbox($lineFontSize, 0, $lineFont, $lineStart);
  				$lineStartwidth=$linebbox[2]-$linebbox[0];
 				if($lineStartwidth<=$textBoxW){
 					$splitFound=1;
 					$line1=substr($line1,$splitPos+1);
 				}
 	  		}
			imagettftext ($im2, $lineFontSize, 0, 356, 217+($lineSpacing*$extraLines), $lineColor, $lineFont, $lineStart);			
  			$extraLines++;
  			$linebbox = imagettfbbox($lineFontSize, 0, $lineFont, $line1);
  			$line1width=$linebbox[2]-$linebbox[0];
  			if($line1width<=$textBoxW)$tooBig=0;
  		}
 		imagettftext ($im2, $lineFontSize, 0, 356, 217+($lineSpacing*$extraLines), $lineColor, $lineFont, $line1);
 		$linebbox = imagettfbbox($lineFontSize, 0, $lineFont, $line2);
  		$line2width=$linebbox[2]-$linebbox[0];
 		if($line2width>$textBoxW)$tooBig=1;
 		while($tooBig==1){
 			$splitFound=0;
 			$lineStart=$line2;
 			while($splitFound==0){
 				$splitPos=strrpos($lineStart," ");
 				$lineStart=substr($lineStart,0,$splitPos);
	    		$linebbox = imagettfbbox($lineFontSize, 0, $lineFont, $lineStart);
  				$lineStartwidth=$linebbox[2]-$linebbox[0];
 				if($lineStartwidth<=648){
 					$splitFound=1;
 					$line2=substr($line2,$splitPos+1);
 				}
 	  		}
			imagettftext ($im2, $lineFontSize, 0, 356, 263+($lineSpacing*$extraLines), $lineColor, $lineFont, $lineStart);			
  			$extraLines++;
  			$linebbox = imagettfbbox($lineFontSize, 0, $lineFont, $line2);
  			$line2width=$linebbox[2]-$linebbox[0];
  			if($line2width<=648)$tooBig=0;
  		}
  		imagettftext ($im2, $lineFontSize, 0, 356, 263+($lineSpacing*$extraLines), $lineColor, $lineFont, $line2);			

		$logo1bbox = imagettfbbox($logoFontSize, 0, $logoFont, $logo1);
		$logo1width=$logo1bbox[2]-$logo1bbox[0];
		$logo1startX=920-$logo1width;
 
		imagettftext ($im2, $logoFontSize, 0, $logo1startX, 401, $logoColor, $logoFont, $logo1);			
		imagettftext ($im2, $logoFontSize, 0, 882, 423, $logoColor, $logoFont, $logo2);			
		imagettftext ($im2, $logoFontSize, 0, 870, 443, $logoColor, $logoFont, $logo3);			
		imagettftext ($im2, $taglineFontSize, 0, 572, 480, $taglineColor, $taglineFont, $tagline1);			
		// To finish up, we replace the old image which is referenced.
		$im = $im2;
		// now to resize to requested scale		
		$im2 = imagecreatetruecolor($scale*$imw, $scale*$imh);
		// Resize
		imagecopyresampled($im2, $im, 0,0,0,0, $scale*$imw, $scale*$imh, $imw, $imh);		
		$im = $im2;
		$tempImageName='dynamicImages/'.$poster.'.jpg';
		imagejpeg($im, $tempImageName);
		return $im;
		imagedestroy($im);
	}else{
		return "0";
	}
}


if($_POST['poster']){
	$poster=intval($_POST['poster']);
	$username=$_POST['username'];
	$password=$_POST['password'];
	$message=stripslashes($_POST['message']);
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
	$scale=0.5;
	createImage($scale,$line1,$line2,$logo1,$logo2,$logo3,$tagline1,$poster);
	$file='dynamicImages/'.$poster.'.jpg';
	$postfields = array();
 	$postfields['username'] = $username;
 	$postfields['password'] = $password;
	$postfields['message'] = $message.' - made here http://bit.ly/7b4vAk';
	$postfields['media'] = "@$file"; //Be sure to prefix @, else it wont upload
 
	$t=new twitpic($postfields,true,true);
	$t->post();
	unlink($file);
	$header='Location: http://twitter.com/'.$username;
	header( $header );		
}

?>