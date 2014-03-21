<?php

$lines = array();
if (($handle = fopen("data/data.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $data[6] = sprintf('%.02f', $data[6]);
    $lines[] = $data;
  }
}

$json = array('aaData' => $lines);
echo json_encode($json);