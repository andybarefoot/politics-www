<?

include_once '../../../includes/db-politics.php';
include_once '../../../includes/dbactions.php';

$mpStr = $_GET["mps"];
$policyStr = $_GET["policies"];
$mpsCheck = explode(",", $mpStr);
$policiesCheck = explode(",", $policyStr);
if($mpsCheck[0]=="")$mpStr="0";
if($policiesCheck[0]=="")$policyStr="0";
foreach($mpsCheck AS $mpCheck){
	if(intval($mpCheck)!=$mpCheck)$mpStr="0";
}
foreach($policiesCheck AS $policyCheck){
	if(intval($policyCheck)!=$policyCheck)$policyStr="0";
}

$sqlStmt="SELECT * FROM `mps` WHERE `mpID` IN (".$mpStr.") ORDER BY `mpID` ASC";
$mps=getData($sqlStmt);

$sqlStmt="SELECT * FROM `mps` WHERE `mpID` NOT IN (".$mpStr.") ORDER BY `mpID` ASC";
$moreMps=getData($sqlStmt);

$sqlStmt="SELECT * FROM `policies` WHERE `policyExtID` IN (".$policyStr.") ORDER BY `policyExtID` ASC";
$policies=getData($sqlStmt);

$sqlStmt="SELECT * FROM `policies` WHERE `policyExtID` NOT IN (".$policyStr.") ORDER BY `policyExtID` ASC";
$morePolicies=getData($sqlStmt);

$sqlStmt="SELECT * FROM `policySupport` WHERE `mpID` IN (".$mpStr.") AND `policyID` IN (".$policyStr.") ORDER BY `policyID` ASC, `mpID` ASC";
$data=getData($sqlStmt);

$i=0;
$byPolicy = array();
foreach($policies AS $policy){
	$thisPolicy = array();
	$thisPolicy['policyID'] = $policy['policyID'];
	$thisPolicy['policyExtID'] = $policy['policyExtID'];
	$thisPolicy['policyName'] = $policy['policyName'];
	$thisPolicy['policyURL'] = $policy['policyURL'];
	$thisMPs = array();
	foreach($mps AS $mp){
		$thisMP = array();
//		print $policy['policyExtID']." : ".$policy['policyName']." : ";
//		print $mp['mpID']." : ".$mp['mpName']." : ";
		$thisMP['mpID'] = $mp['mpID'];
		$thisMP['mpURL'] = $mp['mpNameURL'];
		if(($data[$i]['policyID']==$policy['policyExtID']) && ($data[$i]['mpID'] == $mp['mpID'])){
//			print $data[$i]['percentage']."<br />";
			$thisMP['percentage'] = $data[$i]['percentage'];
			$thisMP['percentageStr'] = $data[$i]['percentage']."%";
			$i++;
		}else{
//			print "N/A<br />";
			$thisMP['percentage'] = "NULL";
			$thisMP['percentageStr'] = "N/A";
		}
//		print_r($thisMP);
//		print "<br/>";
		array_push($thisMPs, $thisMP);
	}
	$thisPolicy['mps'] = $thisMPs;
	array_push($byPolicy, $thisPolicy);
}

$allPolicies = array("mpNames"=>$mps, "moreMps"=>$moreMps, "morePolicies"=>$morePolicies, "policies"=>$byPolicy);

print json_encode($allPolicies);

?>