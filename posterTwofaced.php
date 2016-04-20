<?
header("Content-type: image/jpeg"); 
function createImage($scale,$leftImage,$left1,$left2,$leftText,$rightImage,$right1,$right2,$rightText){
	// sets some variables for this image
	if($leftImage==1){
		$imgURLleft='images/davidLeft.jpg';
	}else if($leftImage==2){
		$imgURLleft='images/gordonLeft.jpg';
	}else if($leftImage==3){
		$imgURLleft='images/cleggLeft.jpg';
	}else if($leftImage==4){
		$imgURLleft='images/blairLeft.jpg';
	}else if($leftImage==5){
		$imgURLleft='images/thatcherLeft.jpg';
	}else{
		$imgURLleft='images/davidLeft.jpg';
	}
	if($rightImage==1){
		$imgURLright='images/davidRight.jpg';
	}else if($rightImage==2){
		$imgURLright='images/gordonRight.jpg';
	}else if($rightImage==3){
		$imgURLright='images/cleggRight.jpg';
	}else if($rightImage==4){
		$imgURLright='images/blairRight.jpg';
	}else if($rightImage==5){
		$imgURLright='images/thatcherRight.jpg';
	}else{
		$imgURLright='images/davidRight.jpg';
	}
	$imw = 940;
	$imh = 400;
	$imLeft = imagecreatefromjpeg($imgURLleft);
	$imRight = imagecreatefromjpeg($imgURLright);
	if($imgURLleft){
		$im2 = imagecreatetruecolor(940, 400);
		imagecopyresampled($im2, $imLeft, 0,0, 0, 0, 470, 400, 470, 400);
		imagecopyresampled($im2, $imRight, 470,0, 0, 0, 470, 400, 470, 400);

		$textBoxW=270;

	    $lineFont = 'Fradm.TTF';
        $bigFontSize  = 31;
		$smallFontSize  = 18;
		$bigFont = 'ariblk.ttf';
        $smallFont = 'arialbd.ttf';
        $leftColour = imagecolorallocate ($im2, 255, 255, 255);
        $rightColour = imagecolorallocate ($im2, 137, 136, 141);
        $lineSpacing = 22;
		//left side text
        imagettftext ($im2, $bigFontSize, 0, 19, 177, $leftColour, $bigFont, $left1);
        imagettftext ($im2, $bigFontSize, 0, 19, 217, $leftColour, $bigFont, $left2);
  		$extraLines=0;
 		$tooBig=0;
 		$linebbox = imagettfbbox($smallFontSize, 0, $smallFont, $leftText);
  		$leftWidth=$linebbox[2]-$linebbox[0];
 		if($leftWidth>$textBoxW)$tooBig=1;
 		while($tooBig==1){
 			$splitFound=0;
 			$lineStart=$leftText;
 			while($splitFound==0){
 				$splitPos=strrpos($lineStart," ");
 				$lineStart=substr($lineStart,0,$splitPos);
	    		$linebbox = imagettfbbox($smallFontSize, 0, $smallFont, $lineStart);
  				$lineStartwidth=$linebbox[2]-$linebbox[0];
 				if($lineStartwidth<=$textBoxW){
 					$splitFound=1;
 					$leftText=substr($leftText,$splitPos+1);
 				}
 	  		}
			imagettftext ($im2, $smallFontSize, 0, 19, 260+($lineSpacing*$extraLines), $leftColour, $smallFont, $lineStart);			
  			$extraLines++;
  			$linebbox = imagettfbbox($smallFontSize, 0, $smallFont, $leftText);
  			$leftWidth=$linebbox[2]-$linebbox[0];
  			if($leftWidth<=$textBoxW)$tooBig=0;
  		}
  		imagettftext ($im2, $smallFontSize, 0, 19, 260+($lineSpacing*$extraLines), $leftColour, $smallFont, $leftText);			
		//right side text

 		$linebbox = imagettfbbox($bigFontSize, 0, $bigFont, $right1);
  		$right1Width=$linebbox[2]-$linebbox[0];
        imagettftext ($im2, $bigFontSize, 0, 921-$right1Width, 177, $rightColour, $bigFont, $right1);
        
        $linebbox = imagettfbbox($bigFontSize, 0, $bigFont, $right2);
  		$right2Width=$linebbox[2]-$linebbox[0];
        imagettftext ($im2, $bigFontSize, 0, 921-$right2Width, 217, $rightColour, $bigFont, $right2);
  		
  		$extraLines=0;
 		$tooBig=0;
 		$linebbox = imagettfbbox($smallFontSize, 0, $smallFont, $rightText);
  		$rightWidth=$linebbox[2]-$linebbox[0];
 		if($rightWidth>$textBoxW)$tooBig=1;
 		while($tooBig==1){
 			$splitFound=0;
 			$lineStart=$rightText;
 			while($splitFound==0){
 				$splitPos=strrpos($lineStart," ");
 				$lineStart=substr($lineStart,0,$splitPos);
	    		$linebbox = imagettfbbox($smallFontSize, 0, $smallFont, $lineStart);
  				$lineStartwidth=$linebbox[2]-$linebbox[0];
 				if($lineStartwidth<=$textBoxW){
 					$splitFound=1;
 					$rightText=substr($rightText,$splitPos+1);
 				}
 	  		}
			imagettftext ($im2, $smallFontSize, 0, 921-$lineStartwidth, 260+($lineSpacing*$extraLines), $rightColour, $smallFont, $lineStart);			
  			$extraLines++;
  			$linebbox = imagettfbbox($smallFontSize, 0, $smallFont, $rightText);
  			$rightWidth=$linebbox[2]-$linebbox[0];
  			if($rightWidth<=$textBoxW)$tooBig=0;
  		}
  		imagettftext ($im2, $smallFontSize, 0, 921-$rightWidth, 260+($lineSpacing*$extraLines), $rightColour, $smallFont, $rightText);			


		// To finish up, we replace the old image which is referenced.
		$im = $im2;
		// now to resize to requested scale		
		$im2 = imagecreatetruecolor($scale*$imw, $scale*$imh);
		// Resize
		imagecopyresampled($im2, $im, 0,0,0,0, $scale*$imw, $scale*$imh, $imw, $imh);		
		$im = $im2;
		imagejpeg($im);
		return $im;
		imagedestroy($im);
	}else{
		return "0";
	}
}
$leftImage=$_GET['leftImage'];
$left1=stripslashes($_GET['left1']);
$left2=stripslashes($_GET['left2']);
$leftText=stripslashes($_GET['leftText']);
$rightImage=$_GET['rightImage'];
$right1=stripslashes($_GET['right1']);
$right2=stripslashes($_GET['right2']);
$rightText=stripslashes($_GET['rightText']);
$size=$_GET['size'];
if($size==1){
	$scale=0.25;
}else if($size==2){
	$scale=0.5;
}else if($size==3){
	$scale=1;
}else{
	$scale=1;
}	
createImage($scale,$leftImage,$left1,$left2,$leftText,$rightImage,$right1,$right2,$rightText);

?>