<?php

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
} 

$defaults['bossbase'] = array(
  'bossInfo' => 'rnote',
  'zoneInfo' => 'rname',
  'nameDelim' => ',',
  'noteDelim' => ',',
  'tables' => '',
  'source' => 'database'
);

$defaults['bosscounter'] = array(
  'dynZone' => '0',
  'dynBoss' => '0',
  'linkurl' => 'bossloot',
  'linklength' => 'short',
);

$defaults['bossloot'] = array(
  'item_minqual' => '3',
  'item_lang' => 'none',
  'show_ndl' => '1',
  'show_wl' => '1',
  'get_itemstats' => '1',
  'eyecandy' => '1',
);

$defaults['bossprogress'] = array(
  'dynZone' => '0',
  'dynBoss' => '0',
  'zhiType' => '0',
  'style' => '0',
  'showSB' => '0',
  'linkurl' => 'bossloot',
  'linklength' => 'long',
);
?>
