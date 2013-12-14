<?php

	$months = array(
      'Gen',
      'Feb',
      'Mar',
      'Apr',
      'Mag',
      'Gui',
      'Lug',
      'Ago',
      'Set',
      'Ott',
      'Nov',
      'Dic'
    );
    $weekday = array(
      'Lunedì',
      'Martedì',
      'Mercoledì',
      'Giovedì',
      'Venerdì',
      'Sabato',
      'Domenica'
    );
    $id_months = intval(strftime("%m", strtotime($data_event))) - 1;
	$id_weekday = intval(strftime("%w", strtotime($data_event))) - 1;
    $trans_months = htmlentities(utf8_decode($months[$id_months]));
	$trans_weekday = htmlentities(utf8_decode($weekday[$id_weekday]));
    $pretty_date_M = $trans_months;
	$pretty_date_w = $trans_weekday;
	
?>