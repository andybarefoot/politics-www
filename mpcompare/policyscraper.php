<?

include_once '../../../includes/db-politics.php';
include_once '../../../includes/dbactions.php';

// Function for making a GET request using cURL
function curlGet($url) {
	$ch = curl_init();	// Initialising cURL session
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	// Returning transfer as a string
	curl_setopt($ch, CURLOPT_URL, $url);	// Setting URL
	$results = curl_exec($ch);	// Executing cURL session
	return $results;	// Return the results
}

function returnXPathObject($item) {
	$xmlPageDom = new DomDocument();	// Instantiating a new DomDocument object
	@$xmlPageDom->loadHTML($item);	// Loading the HTML from downloaded page
	$xmlPageXPath = new DOMXPath($xmlPageDom);	// Instantiating new XPath DOM object
	return $xmlPageXPath;	// Returning XPath object
}

function getAllMPs(){
	$pageContent = curlGet('http://www.publicwhip.org.uk/mps.php');
	$pageXPath = returnXPathObject($pageContent);	// Instantiating new XPath DOM object
	$foundMatches = $pageXPath->query("//div[@id='main']/table/tr[@class='odd' or @class='even']");	// Querying for href attributes of pagination
	foreach ($foundMatches as $match){
	    $cells = $pageXPath->query("td", $match);
		for ($i = 0; $i < $cells->length; $i++) {
			if($i==0){
				$name = $pageXPath->query("a", $cells->item($i));
				$nameStr = $name->item(0)->nodeValue;
				print $nameStr."<br/>";
				$url = $pageXPath->query("a/@href", $cells->item($i));
				$urlStr = $url->item(0)->nodeValue;
				print $urlStr."<br/>";
			}
			if($i==1){
				$const = $pageXPath->query("a", $cells->item($i));
				$constStr = $const->item(0)->nodeValue;
				print $constStr."<br/>";
				$curl = $pageXPath->query("a/@href", $cells->item($i));
				$curlStr = $curl->item(0)->nodeValue;
				print $curlStr."<br/>";
			}
			if($i==2){
				$party = $cells->item($i)->nodeValue;
				print $party."<br/><br/>";
				if($party=="Con"){
					$partyID = 1;
				} else if($party=="DUP"){
					$partyID = 2;
				} else if($party=="Green"){
					$partyID = 3;
				} else if($party=="Independent"){
					$partyID = 4;
				} else if($party=="Lab"){
					$partyID = 5;
				} else if($party=="LDem"){
					$partyID = 6;
				} else if($party=="PC"){
					$partyID = 7;
				} else if($party=="SDLP"){
					$partyID = 8;
				} else if($party=="SF"){
					$partyID = 9;
				} else if($party=="SNP"){
					$partyID = 10;
				} else if($party=="Speaker"){
					$partyID = 11;
				} else if($party=="UKIP"){
					$partyID = 12;
				} else if($party=="UUP"){
					$partyID = 13;
				} else {
					$partyID = 0;
				} 
			}
		}
		$nameStr = mysql_real_escape_string($nameStr);
		$constStr = mysql_real_escape_string($constStr);
		$urlStr = "http://www.publicwhip.org.uk/".$urlStr;
		$curlStr = "http://www.publicwhip.org.uk/".$curlStr;
		$sqlStmt="INSERT INTO `mps` (`mpID`, `mpName`, `mpNameURL`, `mpConst`, `mpConstURL`, `mpPartyID`, `mpParty`) VALUES (NULL, '$nameStr', '$urlStr', '$constStr', '$curlStr', '$partyID', '$party');";
		$thisMP=insertDataReturnID($sqlStmt);
	}
}
function getPolicyComp($mpID, $mpUrl){
	$pageContent = curlGet($mpUrl);
	$pageXPath = returnXPathObject($pageContent);	// Instantiating new XPath DOM object
	$foundMatches = $pageXPath->query("//table[@class='mps']/tr[@class='odd' or @class='even']");	// Querying for href attributes of pagination
	$x=0;
	foreach ($foundMatches as $match){
		$x++;
		print $x." : ";
	    $cells = $pageXPath->query("td", $match);
		for ($i = 0; $i < $cells->length; $i++) {
			if($i==0){
				$percent = $pageXPath->query("b/a", $cells->item($i));
				$percentStr = $percent->item(0)->nodeValue;
				$percentInt = intval($percentStr);
				print $percentInt." : ";
			}
			if($i==1){
				$name = $pageXPath->query("a", $cells->item($i));
				$nameStr = $name->item(0)->nodeValue;
				print $nameStr." : ";
				$url = $pageXPath->query("a/@href", $cells->item($i));
				$urlStr = $url->item(0)->nodeValue;
				$urlID = intval(substr($urlStr, strpos($urlStr, "=") + 1)); 
				print $urlID."<br/>";
			}
		}
		$nameStr = mysql_real_escape_string($nameStr);
		$urlStr = "http://www.publicwhip.org.uk/".$urlStr;
		$sqlStmt="SELECT * FROM `policies` WHERE `policyExtID` ='$urlID';";
		$existResults=getData($sqlStmt);
		if(count($existResults)>=1){
			$sqlStmt="UPDATE `policies` SET `policyName` = '$nameStr', `policyURL` = '$urlStr' WHERE `policies`.`policyExtID` = '$urlID';";
			updateData($sqlStmt);
		}else{
			$sqlStmt="INSERT INTO `policies` (`policyID`, `policyExtID`, `policyName`, `policyURL`) VALUES (NULL, '$urlID', '$nameStr', '$urlStr');";
			$thisPolicy=insertDataReturnID($sqlStmt);
		}
		$sqlStmt="SELECT * FROM `policySupport` WHERE `policyID` ='$urlID' AND `mpID` ='$mpID';";
		$existResults=getData($sqlStmt);
		if(count($existResults)>=1){
			$sqlStmt="UPDATE `policySupport` SET `percentage` = '$percentInt' WHERE `policyID` = '$urlID' AND `mpID` = '$mpID';";
			updateData($sqlStmt);
		}else{
			$sqlStmt="INSERT INTO `policySupport` (`supportID`, `policyID`, `mpID`, `percentage`) VALUES (NULL, '$urlID', '$mpID', '$percentInt');";
			$thisPolicy=insertDataReturnID($sqlStmt);
		}
	}
	print "<br/>";
}
function getPolicyRatings(){
	$sqlStmt="SELECT * FROM `mps` ORDER BY `mpID` ASC LIMIT 600,100";
	$mpResults=getData($sqlStmt);
	foreach($mpResults as $mp){
		$mpID=$mp['mpID'];
		$mpUrl=$mp['mpNameURL'];
		getPolicyComp($mpID, $mpUrl);
	}
}

// getPolicyRatings();

//			$sqlStmt="UPDATE `policyCategories` SET `categoryName` = 'Equal Rights' WHERE `categoryID` = '11';";
//			updateData($sqlStmt);

	$sqlStmt="SELECT `policyExtID` FROM `policies` ORDER BY `policyCat` ASC, `policyID` ASC";
	$existResults=getData($sqlStmt);
		if(count($existResults)>=1){
			foreach($existResults as $result){
				print $result['policyExtID'].",";
			}
		}

?>