<?php
	include('/Library/WebServer/Sites/eoldata.org/dblogin.php');
	echo("<table class='dataTable' id='overview'>\n<thead>\n<tr>\n<th>Taxon</th>\n</tr></thead><tbody>");
	$overviewsql="SELECT eolTaxon FROM eoldata_main";
	$overviewresult=mysql_query($overviewsql, $dblink);
 	if (!$overviewresult) {
              die('Invalid query: ' . mysql_error());
        }
	while ($r = mysql_fetch_assoc($overviewresult)) {
		//print_r($r);
		echo("\n<tr><td>".$r['eolTaxon']."</td></tr>");
	}
	echo("</tbody></table>");
?>
