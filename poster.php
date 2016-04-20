<?
header("Content-type: image/jpeg"); 
function createImage($scale,$line1,$line2,$logo1,$logo2,$logo3,$tagline1){
	// sets some variables for this image
	$imgURL='images/cameronBackground.jpg';
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
		$tagline1bbox = imagettfbbox($taglineFontSize, 0, $taglineFont, $tagline1);
		$tagline1width=$tagline1bbox[2]-$tagline1bbox[0];
		$tagline1startX=980-$tagline1width;
 
		imagettftext ($im2, $taglineFontSize, 0, $tagline1startX, 480, $taglineColor, $taglineFont, $tagline1);			
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
$line1=stripslashes($_GET['line1']);
$line2=stripslashes($_GET['line2']);
$logo1=stripslashes($_GET['logo1']);
$logo2=stripslashes($_GET['logo2']);
$logo3=stripslashes($_GET['logo3']);
$tagline1=stripslashes($_GET['tagline1']);
$size=$_GET['size'];
if($size==1){
	$scale=0.25;
}else if($size==2){
	$scale=0.5;
}else if($size==3){
	$scale=0.75;
}else{
	$scale=0.75;
}	
createImage($scale,$line1,$line2,$logo1,$logo2,$logo3,$tagline1);

?>