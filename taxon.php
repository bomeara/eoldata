<?php
 	include('languagecodes.php');	
	/* Database connection information */
	include('/Library/WebServer/Sites/eoldata.org/dblogin.php');
	$hasid = false;
	if (isset($_GET['id'])) {
		$id = mysql_real_escape_string($_GET['id']);
		$findrecordsql = "SELECT * FROM eoldata_main WHERE id='".$id."'";
		$findrecordresult = mysql_query($findrecordsql, $dblink);
		if (mysql_num_rows($findrecordresult) == 1) {
			while ($row = mysql_fetch_assoc($findrecordresult)) {
				echo("<!DOCTYPE html>
<html>
<head>
<title>".$row['eolTaxon']."</title>
</head>

<body>
");
				echo("<h1>".$row['eolTaxon']."</h1>");
				echo("<br />Link to <a href='http://eol.org/pages/".$row['eolID']."'>EOL page</a>");
				echo("<br />IUCN status: ".$row['iucnStatus']);
				echo("<br />Richness score (range 0-100, describes amount of data available): ".$row['richnessScore']); 
				echo("<br />Length of EOL page (number of characters): ".$row['pageLength']);
				echo("<br />Number of references: ".$row['numberReferences']);
				echo("<br />Number of languages: ".$row['numberLanguages']);
				if($row['numberLanguages']>0) {
					echo("<ul>\n");
					$languages = explode("_", $row['languageCounts']);
					for ($i=0; $i<$row['numberLanguages']; $i++) {
						$languageNamesAndCounts = explode(".", $languages[$i]);
						$twoCharLanguage = $languageNamesAndCounts[0];
						echo("<li>".$languageCodes[$twoCharLanguage].": ".$languageNamesAndCounts[1]." word(s)</li>\n");
					}					
					echo("</ul>");
				}
				echo("<br />Number of data providers: ".$row['numberProviders']);
				if($row['numberProviders']>0) {
					echo("<ul>\n");
					$providers = explode("_", $row['providerIDs']);
					for ($i=0; $i<$row['numberProviders']; $i++) {
						$providerInfo = explode(".",$providers[$i]);
						echo("<li>".$providerInfo[0]."</li>\n");
					}
					echo("</ul>\n");
				}
				echo("<br />Number of data object kinds: ".$row['numberDataObjects']);
                                if($row['numberDataObjects']>0) {
                                        echo("<ul>\n");
                                        $dataobjects = explode("_", $row['DataObjectKinds']);
                                        for ($i=0; $i<$row['numberDataObjects']; $i++) {
                                                $dataObjectInfo = explode(".",$dataobjects[$i]);
                                                echo("<li>".$dataObjectInfo[0].": ".$dataObjectInfo[1]."</li>\n");
                                        }
                                        echo("</ul>\n");
                                }
				echo("</body></html>");
			}
		} else {
			echo("Multiple records: ".mysql_num_rows($findrecordresult));
		}
	} else {
		echo("ID is not set");
	}
?>
