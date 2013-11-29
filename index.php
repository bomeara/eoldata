<html>
<?php include("header1.html"); ?>
EolData
<?php include("header2.html"); ?>
<br /><b>Start typing in search box to dynamically filter</b>, expect a few second delay as it looks over 1.7 million records. It will search in taxon names as well as all the other fields (for example, you can search for endangered species). Search is not case sensitive.
<div id="dynamic">
<table cellpadding="0" cellspacing="0" border="0" class="pretty" id="example">
	<thead>
		<tr>
			<th>EOL Taxon</th>
			<th>IUCN status</th>
			<th>Richness Score</th>
			<th># References</th>
			<th># Languages</th>
			<th># Providers</th>
			<th># Data objects</th>
			<th>Page length</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
                       <th>EOL Taxon</th>
                        <th>IUCN status</th>
                        <th>Richness Score</th>
                        <th># References</th>
                        <th># Languages</th>
                        <th># Providers</th>
                        <th># Data objects</th>
                        <th>Page length</th>
		</tr>
	</tfoot>
</table>
			</div>

<?php include("pageend.html"); ?>
