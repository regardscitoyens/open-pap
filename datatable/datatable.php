<?php

$source = $_GET['source'];
if (!$source) $source = 0;
$files = array('data.json', 'ifverso_livres.json', 'ifverso_traductions.json');

?>
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
p{
  text-align: justify;
  color: #8A8683;
  font-family: 'Open Sans',sans-serif;
  font-size: 1em;
  font-weight: 400;
}
th{color: #008AC9;}
</style>
<body>
<?php if ($source == 1) : ?>
<p>Vous trouverez ci-dessous des livres traduits qui ont été recensés par l'Institut français dans le cadre de son projet IFVerso (version de travail)</p>
<p>Ces bases comprennent plus de 8 000 titres traduits du français dans certaines langues étrangères (arabe, chinois, espagnol, anglais). Elles couvrent des périodes variées et ne sont pas nécessairement exhaustives.</p>
<?php else : if ($source == 2) : ?>
<p>Vous trouverez ci-dessous les traducteurs de livres qui ont été recensés par l'Institut français dans le cadre de son projet IFVerso (version de travail)</p>
<p>Ces bases comprennent plus de 8 000 titres traduits du français dans certaines langues étrangères (arabe, chinois, espagnol, anglais). Elles couvrent des périodes variées et ne sont pas nécessairement exhaustives.</p>
<?php else : ?>
<p>Vous trouverez ci-dessous la liste exhaustive des titres soutenus par l'Institut français entre 2008 et 2014.</p>
<?php endif; ?>
<?php endif; ?>

<div id="dt_example">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
<?php if ($source == 1) : ?>
  <th width="60px">Année</th>
  <th width="500px">Titre</th>
  <th width="300px">Auteur</th>
  <th width="500px">Titre de la Traduction</th>
  <th width="150px">Langue de traduction</th>
  <th width="150px">Éditeur(s)</th>
  <th width="120px">Pays</th>
  <th width="120px">Genre</th>
<?php else : if ($source == 2) : ?>
  <th width="60px">Année</th>
  <th width="300px">Auteur</th>
  <th width="500px">Titre</th>
  <th width="500px">Titre de la Traduction</th>
  <th width="150px">Langue de traduction</th>
  <th width="300px">Traducteur(s)</th>
  <th width="150px">Éditeur(s)</th>
  <th width="120px">Pays</th>
<?php else : ?>
			<th width="60px">Année</th>
			<th width="120px">Pays</th>
			<th width="300px">Auteur</th>
			<th width="500px">Titre</th>
			<th width="150px">Éditeur français</th>
			<th width="150px">Éditeur local</th>
			<th width="60px">Montant accordé</th>
			<th width="200px">Genre</th>
			<th width="150px">Langue</th>
<?php endif; ?>
<?php endif; ?>
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
		"sAjaxSource": '../openpap/data/<?php echo $files[$source]; ?>',
                "oLanguage": {
                    "sUrl": "js/datatables.french.json"
                }
	} );
} );
</script>
</div>
</body> </html>
