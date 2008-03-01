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
  'eyecandy' => '0',
);

$defaults['bossloot'] = array(
  'item_minqual' => '-1',
  'item_lang' => 'none',
  'show_ndl' => '0',
  'show_wl' => '0',
  'get_itemstats' => '0',
  'eyecandy' => '0',
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
