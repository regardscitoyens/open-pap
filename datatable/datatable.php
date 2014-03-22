<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<title>Test Datatable</title>
</head>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">
	@import "css/page.css";
	@import "css/table.css";
</style>
<style>
#example_length {
	display: none;
}
th{color: #008AC9;}
</style>
<body>
<div id="dt_example">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th width="60px">Année</th>
			<th width="120px">Pays</th>
			<th width="300px">Auteur</th>
			<th width="500px">Titre</th>
			<th width="150px">Éditeur français</th>
			<th width="150px">Éditeur local</th>
			<th width="60px">Montant accordé</th>
			<th width="200px">Genre</th>
			<th width="150px">Langue</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
	<tfoot>
	</tfoot>
</table>
<script language="javascript">
$(document).ready(function() {
	$('#example').dataTable( {
		"bProcessing": true,
		"sAjaxSource": '../openpap/data/data.json',
                "oLanguage": {
                    "sUrl": "js/datatables.french.json"
                }
	} );
} );
</script>
</div>
</body> </html>
