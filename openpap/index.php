<!DOCTYPE HTML>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
	<title>OpenPAP : Plonger dans les données d'aides à la publication de l'Institut français</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<!-- <link rel="stylesheet" href="css/style.min.css" type="text/css" media="screen"> -->
	<!--[if IE]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.stellar.min.js"></script>
	<script type="text/javascript" src="js/waypoints.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>

	<div class="menu">
		<div class="container clearfix">

			<div id="logo" class="grid_3">
				<img src="images/logo.png">
			</div>

			<div id="nav" class="grid_9 omega">
				<ul class="navigation">
					<li data-slide="1">Accueil</li>
					<li data-slide="2">À travers le monde</li>
					<li data-slide="3">Genre et langues</li>
					<li data-slide="4">Les données</li>
				</ul>
			</div>

		</div>
	</div>


	<div class="slide fondif" id="slide1" data-slide="1" data-stellar-background-ratio="0.5">
		<div class="container clearfix">

			<div id="content" class="grid_12">
				<h1>Le Programme d'Aide à la Publication</h1>
			        <p>L’Institut français soutient le travail et l’implication d’éditeurs étrangers qui mènent une politique de publication d'ouvrages traduits du français, rendant ainsi possible l’accès d’un public non francophone à la création et la pensée françaises contemporaines.</p>
			        <p>Depuis 25 ans, les Programmes d'Aide à la Publication (PAP) ont permis de contribuer à la traduction de près de 20&nbsp;000 titres d’auteurs français dans 80 pays.</p>
			        <p>Ce soutien à l’écrit est l’un des outils majeurs dans le développement de l’influence de la littérature et de la pensée françaises à travers le monde.</p>
				<p>Les PAP ont soutenus plus de 2&nbsp;558 ouvrages depuis 2008. Ils ont permis à 1&nbsp;144 éditeurs étrangers de publier des titres traduits du français dans 63 pays 1&nbsp;294 auteurs français et francophones ont été traduits dans 54 langues.</p>
			</div>
			<div id="decorative" class="grid_5 omega">
				<a class="internallink" data-slide="2" href="#slide2">En savoir plus sur les titres aidés</a>
			</div>

		</div>
	</div>



	<div class="slide" id="slide2" data-slide="2" data-stellar-background-ratio="0.5">
		<div class="container clearfix">
			<div id="content" class="grid_12">
				<h2>À travers le monde</h2>
                                <p>Répartition géographique des aides à la cession de droits accordées entre 2008 et 2013 par l'Institut français pour la traduction d'œuvres d'auteurs français ou francophones.</p>
			        <div id="map-container">
			        <form id="map-search">
			        <input name="q" id="q" type="text" class="inputtext" placeholder="année, auteur, titre, éditeur, ..."/><input type="submit" value="Rechercher"/>
			        </form>
			        <iframe id="cartogram" scrolling="no" style="border: 0px; margin: auto;" width="700" height="560" data-src="../cartogram/cartogram.php" src="images/cartogram.jpg"></iframe>
				<script>
				  $('#map-search').submit(function() {
				      url = '../cartogram/cartogram.php?q='+$('#q').val();
				      if (!$('#cartogram').attr('src').match(/jpg/)) {
					$('#cartogram').attr('src', url);
				      }else{
					$('#cartogram').attr('data-src', url);
				      }
				      return false;
				  });
                                  $(window).scroll(function() {
				      	var windowpos = $(window).scrollTop();
					if ( ($('#cartogram').attr('src').match(/jpg/)) && (windowpos >= $('#slide2').position().top - 100) && (windowpos <= $('#slide2').position().top + 100)) {
					  $('#cartogram').attr('src', $('#cartogram').attr('data-src'));
					}
				  });
				</script>
				</div>
			</div>

		</div>
	</div>



	<div class="slide fondif" id="slide3" data-slide="3" data-stellar-background-ratio="0.5">
		<div class="container clearfix">
			<div id="content" class="grid_12">
				<h2>Genres et langues</h2>
                          <div id="grouptable">
			  <?php include("grouptable.php"); ?>
                          </div>
<script>
$('.tocartogram').click(function(e){
    $('#q').val($(this).attr('data-q'));
    $('#map-search').submit();
    setTimeout(function(){goToByScroll('2');}, 100);
    return false;
  });
$("#langues").prepend("<div id=\"loupe\"></div>");
$(".tags a").mouseover(function(e) {
    text = $(this).attr("alt");
    $("#loupe").css("display", "block");
    $("#loupe").text(text);
  });
$(".tags a").mousemove(function(e) {
    milieu = $("#loupe").width() / 2;
    $("#loupe").css({left: e.clientX - milieu, top: e.clientY}); 
  }); 
$(".tags").mouseout(function() {
    $("#loupe").css("display", "none");
  }); 
</script>
			</div>

		</div>
	</div>

   

	<div class="slide" id="slide4" data-slide="4" data-stellar-background-ratio="0.5">
	   <div class="container clearfix">  
	      <div id="content" class="grid_12">
	         <h2>Les données</h2>
                 <p>Vous trouverez ci-dessous la liste exhaustive des titres soutenus par l'Institut français entre 2008 et 2013.</p>
		        <div style="text-align: center;">
			        <iframe scrolling="no" style="border: 0px; margin: auto;" width="100%" height="800" src="../datatable/datatable.php"></iframe>
			</div>
              </div>
	   </div>  
	</div>
	
	<div class="slide" id="slide5" data-slide="5" data-stellar-background-ratio="0.5">
		<div class="container clearfix">
			<div id="content" class="grid_9">
				<h2>Credits</h2>
                                <p>Le projet OpenPAP est un projet du <a href="http://www.institutfrancais.com/fr/livre-et-promotion-des-savoirs-0">département Livre et Promotion des savoirs</a> de l'<a href="http://www.institutfrancais.com/">Institut français</a>. Il a été réalisé techniquement par Regards Citoyens.</p>
                                <p>Les données utilisées pour réaliser ce travail sont <a href="data/data.csv">librement téléchargeable< sous la licence ODBL</a>.</p>
                                <p><a href="http://jalxob.com/cool-kitten/">Cool kitten</a>, <a href="https://datatables.net/">DataTables</a>, <a href="https://github.com/shawnbot/d3-cartogram/">cartogram.js</a>, <a href="http://d3js.org/">d3.js</a>, <a href="http://github.com/mbostock/topojson" target="_blank">TopoJSON</a>, <a href="http://www.geonames.org" target="_blank">geonames.org</a> et <a href="http://colorbrewer2.org" target="_blank">colorbrewer</a> ont été utilisés.</p>
                                <p>Les logiciels développés pour ce projet sont des logiciels libres téléchargeables sur <a href="https://github.com/regardscitoyens/open-pap">github</a>.</p>
			</div>

		</div>
	</div>

</body>
</html>
