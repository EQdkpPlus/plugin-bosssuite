<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id$
 ******************************/

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
  'zonelength' => 'short',
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
  'bp_si_style' => 'normal',
  'bp_ei_style' => 'normal',
  'bp_ztext_style' => 'text',
);
?>
