<html>
  <head>

     <link rel="stylesheet" type="text/css" href="style.css" />
     <title>USER PROFILE DATA USAGE</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <script src='/scripts/jquery-1.7.1.js'></script>
  </head>
  <body onLoad="init()">
  <div id="loading" style="position:fixed; width:100%; text-align:center; top:7%; left:40%;"><img src="/images/loading.gif" border=0"></div>
<script>
var ld=(document.all);

var ns4=document.layers;
var ns6=document.getElementById&&!document.all;
var ie4=document.all;

if (ns4)
	ld=document.loading;
else if (ns6)
	ld=document.getElementById("loading").style;
else if (ie4)
	ld=document.all.loading.style;

function init()
{
if(ns4){ld.visibility="hidden";}
else if (ns6||ie4) ld.display="none";
}
</script>
  

    <font face="arial">
    <a name="Top">
    <h1>Active Directory User Data Usage</h1><br />
    
<?php

// open this directory
$c = $_POST["destination"];
print("Opened directory: <b>$c</b> <br /><br /><br />");
print("Click here to go <a href=\"index.php\">Back</a></h3>
    <a href=\"#Bot\">Bottom</a> of Page</h3><br /><br />");

$myDirectory = opendir($c);
$over_1000 = 0;
$over_500 = 0;
$error = 0;
$size_t = 0;
$dir_num = 0;





// get each entry
while($entryName = readdir($myDirectory)) {
$dirArray[] = $entryName;
}

// close directory
closedir($myDirectory);


//	count elements in array
$indexCount	= count($dirArray);


// sort 'em
sort($dirArray);

// print 'em



print("<TABLE id=\"myTable\" border=1 cellpadding=5 cellspacing=0 class=whitelinks>\n");
print("<TR><TH>Filename</TH><th>Filetype</th><th>Filesize (MB)</th><th>Status</th></TR>\n");
// loop through the array of files and print them all

for($index=0; $index < $indexCount; $index++) {
	
        if (substr("$dirArray[$index]", 0, 1) != ".")
        { // don't list hidden files
        //echo $dirArray[$index];
        
        if(is_dir($c. "\\" . $dirArray[$index]))
		{
		$dir_num++;
        
		print("<TR \" 
  onMouseOver=\"this.className='highlight'\" onMouseOut=\"this.className='normal'\"><TD><font color=#0054FF><b>$dirArray[$index]</b></font></td>");
  
		print("<td>");
		print("FOLDER");
		//print(filetype($dirArray[$index]));
		print("</td>");
		print("<td>");
		//if ( is_object ( $obj ) )
		//{
		try
    {

    $obj = new COM ( 'scripting.filesystemobject' );
		$dir = $c. "\\" . $dirArray[$index];
		$ref = $obj->getfolder ($dir );
		$size = $ref->size ;
		$size_mb = (round($size/1048576, 2));
		
		$size_t += $size_mb;
    
    if($size_mb >= 1000)
    {
      $over_1000++;
      print ("<font color=#FF0000>"." <u><b>".$size_mb."</b></u></font>");
      print("<td><img src=\"/images/warning.png\"</img></td>");
     }
    else if($size_mb >= 500)
    {
      $over_500++;
      print ("<font color=#FF5900>"." <u>".$size_mb."</u></font>");
      print("<td><img src=\"/images/warning.png\"</img></td>");}
    else
		{print (" ".$size_mb ."");
		 print("<td><img src=\"/images/tick.png\"</img></td>");}
		}
		catch (com_exception $e)
		{
		$error++;
		print "<b> Error Occured:</b> CHECK MANUALLY";
		print ("<td><img src=\"/images/error.png\"</img></td>");
		//echo "<br>";
		//echo $e->getMessage(); a:
		}

		//$obj == null;}
		print("</td>");
		print("</TR>\n");
		}
		}
	
}?>
   <form action="exporttoexcel.php" method="post"   
onsubmit='$("#datatodisplay").val( $("<div>").append( $("#myTable").eq(0).clone() ).html() )'>
<?php


$size_t = round($size_t / 1024, 2); //Converts Total Size to GB's and 2 Decimal places
print("</TABLE>\n");
print("</span>");
?>    <div id="results" style="position:fixed; width:100%; text-align:center; top:10%; left:65%">
<?php
Print ("<table class=\"gridtable\" WIDTH=\"400\"><tr><td><b>TOTAL FOLDERS:</b> $dir_num</td><td><b>TOTAL USAGE: </b>$size_t GB</tr>");
print("<tr ><td><font color=#FF5900><b>OVER 500MB:</b> $over_500</font></td><td><font color=#FF0000><b>OVER 1000MB:</b> $over_1000</font></td><tr><td><b><u>ERRORS:</u></b> $error</td></tr></table>");

?>
</div>
<br />
<a name="Bot"><br />
<input type="hidden" id="datatodisplay" name="datatodisplay">  
        <input type="image" src="/images/floppy.png" value="Export to Excel">
        </form>

Back to <a href="#Top">Top</a> <br /><br />
Need <a href="help.php" target="_blank">HELP</a>?
<br />
<?php include('footer.html'); ?>