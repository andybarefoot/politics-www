<?
require_once '../../includes/db-cameron.php';
require_once '../../includes/dbactions.php';

$sqlStmt="SELECT vfac.vfac_posterID, cameron.cameron_line1, cameron.cameron_line2, cameron.cameron_logo1, cameron.cameron_logo2, cameron.cameron_logo3, cameron.cameron_tagline1 FROM `cameron`,`vfac` WHERE vfac.vfac_posterID = cameron.cameron_id ORDER BY vfac.vfac_posterID ASC;";
$resultsEntries=getData($sqlStmt);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>VFAC Entries</title>
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
			padding-bottom: 30px;
		}
		#footer {
			position: relative;
			margin-top: -30px;
			height: 30px;
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
		input[type="text"] {
			width: 800px;
		}
		h1 {
    		color: #fff;
 		}
		h2 {
   			margin-bottom:0;
 		}
		h3 {
    		margin:0;
    		font-size:0.75em;
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
 			margin-top: 20px;
 			margin-left: auto;
 			margin-right: auto;
  			text-align: left;
  			background: #0097DA;
  		}
 		td{
 			padding: 5px;
  			background: #fff;
  		}
  		.bigger{
    		font-size:1.2em;
 			line-height:1.3em;
    	}
 		 		
	</style>	
	<body>
<?	
if($resultsEntries){
	for($i=0;$i<count($resultsEntries);$i++){
		 $j=$i+1;
		 print "<table>";
		 print "<tr>";
		 print "<td> ".$j.": Poster ID - ";
		 print $resultsEntries[$i][0];
		 print "</td>";
		 print "<td><a href=\"/voteforachange.php?poster=".$resultsEntries[$i][0]."\" target=\"_blank\">Preview</a></td>";
		 print "</tr>";
		 print "<tr>";
		 print "<td width='350' class='bigger'>";
		 print urldecode($resultsEntries[$i][1]);
		 print "<br />";
		 print urldecode($resultsEntries[$i][2]);
		 print "</td>";
		 print "<td width='150' rowspan='2'>";
		 print urldecode($resultsEntries[$i][3]);
		 print "<br />";
		 print urldecode($resultsEntries[$i][4]);
		 print "<br />";
		 print urldecode($resultsEntries[$i][5]);
		 print "</td>";
		 print "</tr>";
		 print "<tr>";
		 print "<td>";
		 print urldecode($resultsEntries[$i][6]);
		 print "</td>";
		 print "</tr>";
		 print "</table>";
	}
}

?>
	</body>
</html>