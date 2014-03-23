<?php
include('data_access.php');

$langues = select_data(8);
$genres = select_data(7);

$nbl = 0;
foreach($langues as $l => $nb) {
	$nbl += $nb;
}

echo "<div id='langues'><h3>Langues</h3><div class='tags'>";
foreach($langues as $l => $nb) {
  if ($l) {
    echo " <span class='tag".round($nb/$nbl*100)."'><a href='#' class='tocartogram' alt='$l : $nb traduction(s)' data-slide='2' data-q='$l'>$l</a></span> &nbsp; ";
  }
}
echo "</div></div>";
echo "<div id='genres'><h3>Genres</h3><div class='table'><table>";
foreach($genres as $g => $nb) {
  if ($g) {
    echo "<tr><td><a href='#' class='tocartogram' data-slide='2' data-q='$g'>$g</a></td><td>$nb</td></tr>";
  }
}
echo "</table></div></div>";
