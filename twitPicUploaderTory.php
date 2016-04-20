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

function createImage($scale,$line1,$line2,$logo1,$logo2,$logo3,$tagline1,$photo,$userImg,$textPos,$poster,$userImg,$colour){
	// sets some variables for this image
	if($photo==0){
		$imgURL='uploadedImages/'.$userImg;
	}else if($photo==3){
	//	$imgURL='images/tory3Orig.jpg';
		$imgURL='images/tory3Background.jpg';
	}else if($photo==2){
	//	$imgURL='images/tory2Orig.jpg';
		$imgURL='images/tory2Background.jpg';
	}else{
	//	$imgURL='images/toryOrig.jpg';
		$imgURL='images/toryBackground.jpg';
	}	
	if($colour==2){
		$treeURL='images/rose.png';
	} else if($colour==3){
		$treeURL='images/bird.png';
	}else{
		$treeURL='images/treeBlue.png';
	}
	$lqURL='images/lq.png';
	$rqURL='images/rq.png';
	$textPadLeft=22;
	$textPadRight=10;
	$textPadTop=19;
	$textPadBottom=19;
	//fetch original image
	$im = imagecreatefromjpeg($imgURL);
	$imTree = imagecreatefrompng($treeURL);
	$imLq = imagecreatefrompng($lqURL);
	$imRq = imagecreatefrompng($rqURL);
	if($im){
		// Get the image width and height.
		$imw = imagesx($im);
		$imh = imagesy($im);
		$imratio=$imw/$imh;
		if($imratio>3){
			$imw = $imh*3;
			$imh = $imh;
		}else if($imratio<0.75){
			$imw = $imw;
			$imh = $imw*1.33;
		}
		if($imratio>1){
			if($imw<700){
				$resize=700/$imw;
			}else if($imw>1000){
				$resize=1000/$imw;
			}else{
				$resize=1;
			}
		}else{
			if($imw<700){
				$resize=700/$imw;
			}else if($imw>800){
				$resize=800/$imw;
			}else{
				$resize=1;
			}
		}
		$nimw = $imw*$resize;
		$nimh = $imh*$resize;
		$imwTree = imagesx($imTree);
		$imhTree = imagesy($imTree);
		$imwLq = imagesx($imLq);
		$imhLq = imagesy($imLq);
		$imwRq = imagesx($imRq);
		$imhRq = imagesy($imRq);
		// Make another image to place the trimmed version in.
		$im2 = imagecreatetruecolor($nimw, $nimh);
		if($photo==0){
			$textBoxW=540;
			$textBoxW2=440;
			if($textPos==1){
				$taglineTop=$nimh-48;
				$textLeft=52;
				$textTop=100;
			}else if($textPos==3){
				$taglineTop=$nimh-48;
				$textLeft=$nimw-($textBoxW+52);
				$textTop=100;
			}else if($textPos==4){
				$taglineTop=0;
				$textLeft=$nimw-($textBoxW+52);
				$textTop=$nimh-(200);
			}else{
				$taglineTop=0;
				$textLeft=52;
				$textTop=$nimh-(200);
			}
		    $lineFontSize  = 32;
	        $lineSpacing=42;
		    $line2FontSize  = 30;
	        $line2Spacing = 40;
	        $logoFontSize  = 34;
	        $taglineFontSize  = 18;
		}else if($photo==3){
			$taglineTop=0;
			$textBoxW=620;
			$textBoxW2=520;
			$textLeft=72;
			$textTop=280;
		    $lineFontSize  = 36;
	        $lineSpacing=46;
		    $line2FontSize  = 34;
	        $line2Spacing = 44;
	        $logoFontSize  = 34;
	        $taglineFontSize  = 18;
		}else if($photo==2){
			$taglineTop=$nimh-48;
			$textBoxW=540;
			$textBoxW2=440;
			$textLeft=52;
			$textTop=140;
		    $lineFontSize  = 32;
	        $lineSpacing=42;
		    $line2FontSize  = 30;
	        $line2Spacing = 40;
	        $logoFontSize  = 34;
	        $taglineFontSize  = 18;
		}else{
			$taglineTop=0;
			$textBoxW=590;
			$textBoxW2=490;
			$textLeft=72;
			$textTop=310;
		    $lineFontSize  = 36;
	        $lineSpacing=46;
		    $line2FontSize  = 34;
	        $line2Spacing = 44;
	        $logoFontSize  = 34;
	        $taglineFontSize  = 18;
		}	
		// Create some colors
		$trans_colour = imagecolorallocatealpha($im2, 0, 0, 0, 127);
		$black = imagecolorallocate($im2, 0, 0, 0);
		$white = imagecolorallocate($im2, 255, 255, 255);
		$grey = imagecolorallocate($im2, 128, 128, 128);
		if($colour==2){
			$blue= imagecolorallocate($im2, 220, 41, 30);
		} else if($colour==3){
			$blue= imagecolorallocate($im2, 251, 212, 75);
		}else{
			$blue= imagecolorallocate($im2, 0, 132, 181);
		}
		
		// Resize
		imagecopyresampled($im2, $im, 0,0, 0, 0, $nimw, $nimh, $imw, $imh);
		// add text
		$lineFont = 'Fradm.TTF';
        $lineColor = imagecolorallocate ($im2, 255, 255, 255);        
		$line2Font = 'Frabk.TTF';
        $line2Color = imagecolorallocate ($im2, 255, 255, 255);        
		$logoFont = 'Fradmit.TTF';
        $logoColor = imagecolorallocate ($im2, 26, 24, 25);
		$taglineFont = 'Fradm.TTF';
        $taglineColor = imagecolorallocate ($im2, 255, 255, 255);
 		imagefilledrectangle($im2, $textLeft-$textPadLeft, $textTop-($lineFontSize+$textPadTop), $textLeft+$textBoxW+$textPadRight, $textTop-$lineFontSize, $blue);
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
			imagefilledrectangle($im2, $textLeft-$textPadLeft, $textTop+($lineSpacing*$extraLines)-($lineFontSize), $textLeft+$textBoxW+$textPadRight, $textTop+$textPadBottom, $blue);
			imagettftext ($im2, $lineFontSize, 0, $textLeft, $textTop+($lineSpacing*$extraLines), $lineColor, $lineFont, $lineStart);			
  			$extraLines++;
  			$linebbox = imagettfbbox($lineFontSize, 0, $lineFont, $line1);
  			$line1width=$linebbox[2]-$linebbox[0];
  			if($line1width<=$textBoxW)$tooBig=0;
  		}
		$boxEndX=$textLeft+$textBoxW+$textPadRight;
		$boxEndY=$textTop+($lineSpacing*$extraLines)+$textPadBottom;
 		if($boxEndY<($textTop+75))$boxEndY=$textTop+75;
 		imagefilledrectangle($im2, $textLeft-$textPadLeft, $textTop+($lineSpacing*$extraLines)-($lineFontSize), $boxEndX, $boxEndY, $blue);
 		imagettftext ($im2, $lineFontSize, 0, $textLeft, $textTop+($lineSpacing*$extraLines), $lineColor, $lineFont, $line1);
  		$startLine2=$textTop+($lineSpacing*($extraLines+1));
  		$extraLines=0;
 		$linebbox = imagettfbbox($line2FontSize, 0, $line2Font, $line2);
  		$line2width=$linebbox[2]-$linebbox[0];
 		if($line2width>$textBoxW2)$tooBig=1;
 		while($tooBig==1){
 			$splitFound=0;
 			$lineStart=$line2;
 			while($splitFound==0){
 				$splitPos=strrpos($lineStart," ");
 				$lineStart=substr($lineStart,0,$splitPos);
	    		$linebbox = imagettfbbox($line2FontSize, 0, $line2Font, $lineStart);
  				$lineStartwidth=$linebbox[2]-$linebbox[0];
 				if($lineStartwidth<=$textBoxW2){
 					$splitFound=1;
 					$line2=substr($line2,$splitPos+1);
 				}
 	  		}
			imagefilledrectangle($im2, $textLeft-$textPadLeft, $startLine2+($line2Spacing*$extraLines)-($line2FontSize), $textLeft+$textBoxW+$textPadRight, $startLine2+$textPadBottom+($line2Spacing*$extraLines), $blue);
			imagettftext ($im2, $line2FontSize, 0, $textLeft, $startLine2+($line2Spacing*$extraLines), $line2Color, $line2Font, $lineStart);			
  			$extraLines++;
  			$linebbox = imagettfbbox($line2FontSize, 0, $line2Font, $line2);
  			$line2width=$linebbox[2]-$linebbox[0];
  			if($line2width<=$textBoxW2)$tooBig=0;
  		}
		
		$boxEndX=$textLeft+$line2width+$textPadRight+15;
		$boxEndY=$startLine2+($line2Spacing*$extraLines)+$textPadBottom;
 		if($boxEndX<400)$boxEndX=400;
 		if($boxEndY<($textTop+100))$boxEndY=$textTop+100;
		imagefilledrectangle($im2, $textLeft-$textPadLeft, $startLine2+($line2Spacing*$extraLines)-($line2FontSize), $boxEndX, $boxEndY, $blue);
  		imagettftext ($im2, $line2FontSize, 0, $textLeft, $startLine2+($line2Spacing*$extraLines), $line2Color, $line2Font, $line2);			

		$logo1bbox = imagettfbbox($logoFontSize, 0, $logoFont, $logo1);
		$logo1width=$logo1bbox[2]-$logo1bbox[0];
		$logo1startX=920-$logo1width;
 
//		imagettftext ($im2, $logoFontSize, 0, $logo1startX, 401, $logoColor, $logoFont, $logo1);			
//		imagettftext ($im2, $logoFontSize, 0, 882, 423, $logoColor, $logoFont, $logo2);			
//		imagettftext ($im2, $logoFontSize, 0, 870, 443, $logoColor, $logoFont, $logo3);			

		$tagline1bbox = imagettfbbox($taglineFontSize, 0, $taglineFont, $tagline1);
		$tagline1width=$tagline1bbox[2]-$tagline1bbox[0];
		$tagline1startX=$nimw-($tagline1width+20);
		imagefilledrectangle($im2, $tagline1startX-48, $taglineTop, $nimw, $taglineTop+48, $blue);
		imagettftext ($im2, $taglineFontSize, 0, $tagline1startX, $taglineTop+32, $taglineColor, $taglineFont, $tagline1);			
		imagecopyresampled($im2, $imTree, $tagline1startX-40,$taglineTop+7, 0, 0, $imwTree, $imhTree, $imwTree, $imhTree);
		imagecopyresampled($im2, $imLq, $textLeft-($textPadLeft+20),$textTop-($lineFontSize+$textPadTop+15), 0, 0, $imwLq, $imhLq, $imwLq, $imhLq);
		imagecopyresampled($im2, $imRq, $boxEndX-15, $boxEndY-($line2FontSize+$textPadBottom), 0, 0, $imwRq, $imhRq, $imwRq, $imhRq);
		// To finish up, we replace the old image which is referenced.
		$im = $im2;
		// now to resize to requested scale		
		$im2 = imagecreatetruecolor($scale*$nimw, $scale*$nimh);
		// Resize
		imagecopyresampled($im2, $im, 0,0,0,0, $scale*$nimw, $scale*$nimh, $nimw, $nimh);		
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
		$photo=$resultsPoster['cameron_photo'];
		$userImg=$resultsPoster['cameron_file'];
		$colour=$resultsPoster['cameron_colour'];
		if($photo==4)$photo=0;
	}
	$scale=0.5;
	createImage($scale,$line1,$line2,$logo1,$logo2,$logo3,$tagline1,$photo,$userImg,$textPos,$poster,$userImg,$colour);
	$file='dynamicImages/'.$poster.'.jpg';
	$postfields = array();
 	$postfields['username'] = $username;
 	$postfields['password'] = $password;
	$postfields['message'] = $message.' - made here http://bit.ly/9F4peF #ivenevervotedtory';
	$postfields['media'] = "@$file"; //Be sure to prefix @, else it wont upload
 
	$t=new twitpic($postfields,true,true);
	$t->post();
	unlink($file);
	$header='Location: http://twitter.com/'.$username;
	header( $header );		
}

?>