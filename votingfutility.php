<?
require_once '../../includes/db-politics.php';
require_once '../../includes/dbactions.php';

$sqlStmt="SELECT * FROM `parties` ORDER BY party_id ASC;";
$resultsParties=getData($sqlStmt);

if($_POST['constitID']){
	$constitID=intval($_POST['constitID']);
	$sqlStmt="SELECT * FROM `constituencies`,`parties` WHERE constit_party=party_id AND constit_id=$constitID;";
	$resultsConstits=getData($sqlStmt);
	if($resultsConstits){
		$constitArray=$resultsConstits[0];
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Will your vote count?</title>
	
<SCRIPT LANGUAGE="JavaScript">
<!--

var ajaxMPURL = "/politics/ajax/mpAutoComplete.php?";	
var ajaxConstitURL = "/politics/ajax/constitAutoComplete.php?";	
autoPopArray = new Array();

function populateMP(id){
	name=autoPopArray[id][3];
	surname=autoPopArray[id][2];
	constit=autoPopArray[id][1];
	constitID=autoPopArray[id][0];
	document.voteForm.mpAuto.value=name+" "+surname;
	document.voteForm.constitAuto.value=constit;
	document.voteForm.constitID.value=constitID; 
	document.voteForm.mpAuto.style.color="#000"; 
	document.voteForm.constitAuto.style.color="#000"; 
}

function populateConstit(id){
	name=autoPopArray[id][3];
	surname=autoPopArray[id][2];
	constit=autoPopArray[id][1];
	document.voteForm.mpAuto.value=name+" "+surname;
	document.voteForm.constitAuto.value=constit;
	document.voteForm.constitID.value=constitID; 
	document.voteForm.mpAuto.style.color="#000"; 
	document.voteForm.constitAuto.style.color="#000"; 
}

function textFocus(field,defaultStr){
	if(field.value==defaultStr){
		field.value="";
	}
	field.style.color="#000"; 
}

function textBlur(field,defaultStr){
	if(field.value==""){
		field.value=defaultStr;
		field.style.color="#ccc"; 
	}
	setTimeout( "hideAutoComplete();", 500);
}

function hideAutoComplete(){
	autoResultsDiv=document.getElementById("autoMPResultsDiv");
	autoResultsDiv.style.visibility="collapse";
	autoResultsDiv=document.getElementById("autoConstitResultsDiv");
	autoResultsDiv.style.visibility="collapse";
}

function autoComplete(sender,ev,filters){
    var suggestionID=0;
    if ((ev.keyCode>=48 && ev.keyCode<=57)||(ev.keyCode>=65&&ev.keyCode<=90)||(ev.keyCode==8)){
        var httpreq = getHTTPObject();
        var parms="str="+sender.value;
        if(filters=="mp")httpreq.open("GET",ajaxMPURL+parms, true);
        if(filters=="constit")httpreq.open("GET",ajaxConstitURL+parms, true);
        var original_text = sender.value;
        httpreq.onreadystatechange=function(){
            if(httpreq.readyState==4){
            	var response = httpreq.responseText;
 //               suggestionID = response.substring(0, response.indexOf(':'));
 //               var suggestion = response.substring(response.indexOf(':')+1);
 //               var txtAuto = document.getElementById(filters+"Auto");
 //               if((suggestion)&&(txtAuto.value==original_text)){
 //                   if(document.getSelection){
 //                       var initial_len=txtAuto.value.length;
 //                       txtAuto.value += suggestion;
 //                       txtAuto.selectionStart = initial_len;
 //                       txtAuto.selectionEnd = txtAuto.value.length;
 //                   }else if( document.selection ){
 //                       var sel = document.selection.createRange();
 //                       sel.text=suggestion;
 //                       sel.move=("character",-suggestion.length);
 //                       sel.findText(suggestion);
 //                       sel.select();
 //                   } 
 //               }
               
            	htmlStr='<td>&nbsp;</td><td>';            	
            	responseArray=response.split("||");
                autoPopArray.length=0;
                if(responseArray.length<=1){
                	htmlStr+='No matches found';
                }else{
	                if(filters=="mp"){
    	            	autoResultsDiv=document.getElementById("autoMPResultsDiv");
	    	        	for(i=0; i<responseArray.length-1; i++){
						 	mpArray=responseArray[i].split("|");
	    	    	    	autoPopArray.push(mpArray);
	    	        		htmlStr+='<a href="javascript:populateMP('+i+')">';            	
	        	    		htmlStr+=mpArray[3];            	
		            		htmlStr+=' ';            	
		            		htmlStr+=mpArray[2];            	
	    	        		htmlStr+='</a><br />';            	
						} 
                	}
	                if(filters=="constit"){
    	            	autoResultsDiv=document.getElementById("autoConstitResultsDiv");
        	    		for(i=0; i<responseArray.length-1; i++){
						    mpArray=responseArray[i].split("|");
	    	    	    	autoPopArray.push(mpArray);
	    	        		htmlStr+='<a href="javascript:populateConstit('+i+')">';            	
	            			htmlStr+=mpArray[1];            	            	
		            		htmlStr+='</a><br />';            	
						}
					}
				} 
            	htmlStr+='</td>';            	
            	autoResultsDiv.innerHTML=htmlStr;            	
            	autoResultsDiv.style.visibility="visible";
            }
        }
        httpreq.send(null);
    }
    if (ev.keyCode==13 && sender.value.length>0){
        addFilter(sender.value,filters,suggestionID);
        sender.value="";
    }
}
	
function getHTTPObject() {
  var xmlhttp;
  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
  @else
  xmlhttp = false;
  @end @*/
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      xmlhttp = false;
    }
  }
  return xmlhttp;
}

function checkVoteForm(){
	if(document.voteForm.constitID.value==0){
		alert("Please provide your MP or Constituency");
		return false;
	}else{
		return true;
	}
}

//-->
</SCRIPT>	
	<style>
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
		input[type="text"] {
			width: 800px;
			color: #ccc;
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
 		#content{
    		padding:20px;
 		}
 		table{
 			margin-left: auto;
 			margin-right: auto;
  			text-align: left;
  		}
  		#autoMPResultsDiv{
  			visibility:collapse;
  		}
  		#autoConstitResultsDiv{
  			visibility:collapse;
  		}
 		 		
	</style>	
	
	
	
	</head>
	<body>
	<div id="header">
	<h1>Will your vote count?</h1>
	</div>
	<div id="content">
	<p>See whether your vote in the 2010 UK General Election is likely to affect the result.</p>
	<form name="voteForm" action="#" method="POST" onSubmit="return checkVoteForm()">
	<table border="0">
	<tr>
	<td colspan="2"><p>Choose your current MP or your constituency.</p></td>
	<tr>
	<tr>
	<td>Current MP:</td>
	<td><input type="text" id="mpAuto" name="mpAuto" value="Start typing, name will auto complete" onfocus="textFocus(this,'Start typing, name will auto complete');" onBlur="textBlur(this,'Start typing, name will auto complete');" onkeyup="autoComplete(this,event,'mp');"></td>
	</tr>
	<tr id="autoMPResultsDiv">
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>or</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>Constituency:</td>
	<td><input type="text" id="constitAuto" name="constitAuto" value="Start typing, name will auto complete" onfocus="textFocus(this,'Start typing, name will auto complete');" onBlur="textBlur(this,'Start typing, name will auto complete');" onkeyup="autoComplete(this,event,'constit');"></td>
	</tr>
	<tr id="autoConstitResultsDiv">
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td colspan="2"><p>Which party would you like to vote for in 2010?</p></td>
	<tr>
	<td>Preferred party:</td>
	<td><select name="party">
<?
if($resultsParties){
	foreach($resultsParties as $resultsParty){
		print '<option name="'.$resultsParty[1].'" value="'.$resultsParty[0].'">'.$resultsParty[1].'</option>';
	}
}
?>
	</select></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;<input type="hidden" name="constitID" value="0"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Will my vote count?"></td>
	</tr>
	</table>
	</form>
<?
if($constitArray){
?>
	<table width="800">
	<tr>
	<td width="200">&nbsp;</td>
	<td>&nbsp;<br /><br /><br /><br /></td>
	</tr>
	<tr>
	<td width="200">Constituency:</td>
	<td><? print $constitArray['constit_name']; ?></td>
	</tr>
	<tr>
	<td>Current party:</td>
	<td><? print $constitArray['party_name']; ?></td>
	</tr>
	<tr>
	<td>Current MP:</td>
	<td><? print $constitArray['constit_mp_name'].' '.$constitArray['constit_mp_surname']; ?></td>
	</tr>
	<tr>
	<td>Majority at last election:</td>
	<td><? print $constitArray['constit_majority']; ?></td>
	</tr>
	<tr>
	<td colspan="2"><br /><br /><br /><br /><b>Will my vote make a difference?</b><br />[Example text] This seat has been held by Labour for at least the last 3 elections and in 2005 they had a 12,564 vote majority. I'm afraid the chance of your vote resulting in a victory for the Green Party is very slim.<br /><br />If you believe that we need a new voting system in the UK so that EVERYONE's vote means something then please support the Parliamentary Reform Party.</td>
	</tr>
	</table>
<?
}
?>
</div>



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