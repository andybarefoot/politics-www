<?

include_once '../../../includes/db-politics.php';
include_once '../../../includes/dbactions.php';

$sqlStmt="SELECT * FROM `policySupport`, `mps` WHERE `policySupport`.`policyID` = '1049' AND `policySupport`.`mpID` = `mps`.`mpID` ORDER BY `policySupport`.`percentage` ASC, `mps`.`mpID` ASC";
$data=getData($sqlStmt);

print json_encode($data);

?>