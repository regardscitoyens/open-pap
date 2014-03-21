<?php
include('data_access.php');

$langues = select_data(8);
$genres = select_data(7);

echo "<div id='langues'><h3>Langues</h3><div class='table'><table>";
foreach($langues as $l => $nb) {
  if ($l) {
    echo "<tr><td>$l</td><td>$nb</td></tr>";
  }
}
echo "</table></div></div>";
echo "<div id='genres'><h3>Genres</h3><div class='table'><table>";
foreach($genres as $g => $nb) {
  if ($g) {
    echo "<tr><td>$g</td><td>$nb</td></tr>";
  }
}
echo "</table></div></div>";
