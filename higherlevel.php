<?php
 	include('languagecodes.php');	
	/* Database connection information */
	include('/Library/WebServer/Sites/eoldata.org/dblogin.php');
	$hastaxon = false;
	if (isset($_GET['taxon'])) {
		$taxon = mysql_real_escape_string($_GET['taxon']);
		$findrecordsql = "SELECT * FROM eoldata_main WHERE higherTaxonomy LIKE '%".$taxon."%'";
		$findrecordresult = mysql_query($findrecordsql, $dblink);
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=".$taxon.".csv");
header("Pragma: no-cache");
header("Expires: 0");
		echo "eolTaxon,eolID,richnessScore,numberReferences,numberLanguages,languageCounts,numberProviders,providerIDs,numberDataObjects,DataObjectKinds,iucnStatus,pageLength,higherTaxonomy"."\n";
		if (mysql_num_rows($findrecordresult) >= 1) {
			while ($row = mysql_fetch_assoc($findrecordresult)) {
				echo '"'.$row['eolTaxon'].'","'.$row['eolID'].'","'.$row['richnessScore'].'","'.$row['numberReferences'].'","'.$row['numberLanguages'].'","'.$row['languageCounts'].'","'.$row['numberProviders'].'","'.$row['providerIDs'].'","'.$row['numberDataObjects'].'","'.$row['DataObjectKinds'].'","'.$row['iucnStatus'].'","'.$row['pageLength'].'","'.$row['higherTaxonomy'].'"',"\n";
			}
		}
	} else {
		echo("taxon is not set");
	}
?>
