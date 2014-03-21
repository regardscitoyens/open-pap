<?php
include('../openpap/data_access.php');

header('content-type: text/plain');

$pays = array();
if (($handle = fopen("data/pays2code.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $pays[$data[0]] = $data[1];
  }
}

$csv = array();
$element = 20;
if (isset($_GET['by_editor']) && $_GET['by_editor']) {
  $element = 5;
}

$q = (isset($_GET['q'])) ? $_GET['q'] : 0;

$csv = select_data(1,$element, $q);

echo "FULLNAME,AIDESACCORDEES,NAME\n";
foreach($csv as $k => $v) {
  echo "$k,".$v.",".$pays[$k]."\n";
}