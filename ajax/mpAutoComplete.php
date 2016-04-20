<?
require_once '../../../includes/db-politics.php';
require_once '../../../includes/dbactions.php';

if($_GET['str']){
	$resultStr="";
	$str=$_GET['str'];
	$sqlStmt="SELECT constit_id, constit_name, constit_mp_surname, constit_mp_name FROM `constituencies` WHERE constit_mp_surname LIKE '%$str%' OR constit_mp_name LIKE '%$str%' OR CONCAT(constit_mp_name, ' ', constit_mp_surname) LIKE '%$str%' ORDER BY LOCATE('$str',CONCAT(constit_mp_name, constit_mp_surname)) ASC LIMIT 0,10;";
	$resultsMP=getData($sqlStmt);
	if($resultsMP){
		foreach($resultsMP as $resultMP){
			$resultStr.=$resultMP[0];
			$resultStr.="|";
			$resultStr.=$resultMP[1];
			$resultStr.="|";
			$resultStr.=$resultMP[2];
			$resultStr.="|";
			$resultStr.=$resultMP[3];
			$resultStr.="||";
		}
	}
	print $resultStr;
}
?>
