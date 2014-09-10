<?php
$lespays = array('AFRIQUE DU SUD','ALBANIE','ALGÉRIE','ALLEMAGNE','AMERIQUE LATINE','ARGENTINE','ARMÉNIE','AUTRICHE','BIÉLORUSSIE','BRÉSIL','BULGARIE','CAMBODGE','CAMEROUN','CANADA','CHILI','CHINE','COLOMBIE','CORÉE DU SUD','CROATIE','DANEMARK','ÉGYPTE','ESPAGNE','ESTONIE','ÉTATS-UNIS','ÉTHIOPIE','FINLANDE','GÉORGIE','GRÈCE','HONGRIE','INDE','INDONÉSIE','IRAN','ISLANDE','ISRAËL','ITALIE','JAPON','LETTONIE','LIBAN','LITUANIE','MACÉDOINE','MAROC','MEXIQUE','MOLDAVIE','MONGOLIE','NICARAGUA','NORVÈGE','POLOGNE','PORTUGAL','RÉPUBLIQUE TCHÈQUE','ROUMANIE','RUSSIE','SERBIE','SLOVAQUIE','SLOVÉNIE','SUÈDE','SUISSE','SYRIE','TAIWAN','THAÏLANDE','TUNISIE','TURQUIE','UKRAINE','URUGUAY','VENEZUELA','VIETNAM');

$pays = $_GET['pays'];
if (!$pays) $pays = $lespays[0];

if (($handle = fopen("data/data.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    if ($data[1] == $pays) {
      $editeursfra[$data[4]]++;
      $editeursetr[$data[5]]++;
      $annees[$data[0]]++;
      $auteurs[$data[2]]++;
    }
  }
}
arsort($editeursfra);
arsort($editeursetr);
arsort($auteurs);
ksort($annees);
?>

<select id="selectparpays">
<?php foreach ($lespays as $p) {
if ($p == $pays) {$checked = ' SELECTED="true"';} else {$checked = '';}
echo '<option'.$checked.'>'.$p.'</option>';
} ?>
</select> : Synthèse des aides à la cession de droits du programme d’aide à la publication
				    <div style="float: clear">
				    <div id="editeursetr" class="grid_6" style="float: right; margin-top: -20px;">
				    <h3>Les éditeurs locaux bénéficiaires</h3>
<ul><?php $cpt = 0 ; 
foreach (array_keys($editeursetr) as $editeur) {
  echo '<li>'.$editeur.' ('.$editeursetr[$editeur].')</li>';
  $cpt++; if ($cpt > 10) break;
}
?></ul>
				    </div>
				    <div id="editeursfr" class="grid_6" style="float: none">
				    <h3>Les éditeurs français bénéficiaires</h3>
<ul><?php $cpt = 0 ; 
foreach (array_keys($editeursfra) as $editeur) {
  echo '<li>'.$editeur.' ('.$editeursfra[$editeur].')</li>';
  $cpt++; if ($cpt > 10) break;
}
?></ul>
				    </div>
				    </div>
				    <div style="float: clear">
				    <div id="editeursfr" class="grid_6" style="float: right; margin-top: -20px;">	
				    <h3>Le nombre de titres aidés par an</h3>
				    <div id="graph" style="width:100%;height:200px;background-color: white; margin:20px">
				    </div>
<script>
		var data = [ <?php 
$strdata = '';
foreach(array_keys($annees) as $a) {
  $strdata .= '['.$a.','.$annees[$a].'],';
}
 echo preg_replace('/.$/', '', $strdata);
 ?> ];

		$.plot("#graph", [ data ], {
			series: {
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			}
		});

</script>
</div>
				    <div id="auteurs" class="grid_6" style="float: none">
				    <h3>Les auteurs francophones traduits</h3>
<ul><?php 
function human_auteur($str) {
  if (preg_match('/(.*)( et |, )(.*)/', $str, $match)) {
    return human_auteur($match[1]).$match[2].human_auteur($match[3]);
  } 
  return preg_replace('/[\(\)]/', '', preg_replace('/^(.*)[  ]([^  ]+ \(de\)|[^  ]*[^\)]) *$/', '$2 $1', preg_replace('/\. /', '.', $str)));
}

$cpt = 0 ; 
foreach (array_keys($auteurs) as $auteur) {
  echo '<li>'.human_auteur($auteur).' ('.$auteurs[$auteur].')</li>';
  $cpt++; if ($cpt > 10) break;
}
?></ul>
				    </div>
				    </div>
<script>
var oldpays;
selectupdater = function(){pays=$("#selectparpays").val().replace(/ /g, '+'); if (pays == oldpays) {return ;} $("#parpays").load("parpays.php?pays="+pays); oldpays = pays;};
$("#selectparpays").change(selectupdater);
selectupdater();
</script>