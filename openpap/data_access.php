<?php

function select_data($element_id, $nb_id = 20, $q = '') {
  if (($handle = fopen("../openpap/data/data.csv", "r")) !== FALSE) {
    $i = 0;
    $elemnts = array();
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if (!$q || (($str = join(',', $data)) && preg_match('/'.$q.'/i', $str))) {
	$data[20] = $i++;
	if (!isset($elements[$data[$element_id]])) {
	  $elements[$data[$element_id]] = array($data[$nb_id] => 1);
	}else{
	  $elements[$data[$element_id]][$data[$nb_id]] = 1;
	}
      }
    }
  }
  $byelements = array();
  foreach($elements as $k => $v) {
    $byelements[$k] = count($v);
  }
  return $byelements;
}
