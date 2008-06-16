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
  'bb_bossInfo' => 'rnote',
  'bb_zoneInfo' => 'rname',
  'bb_nameDelim' => ',',
  'bb_noteDelim' => ',',
  'bb_tables' => '',
  'bb_source' => 'database'
);

$defaults['bosscounter'] = array(
  'bc_dynZone' => '0',
  'bc_dynBoss' => '0',
  'bc_linkurl' => 'bossloot',
  'bc_linklength' => 'short',
  'bc_zonelength' => 'short',
  'bc_eyecandy' => '0',
);

$defaults['bossloot'] = array(
  'bl_item_minqual' => '3',
  'bl_item_lang' => 'none',
  'bl_show_ndl' => '1',
  'bl_show_wl' => '1',
  'bl_get_itemstats' => '1',
  'bl_eyecandy' => '0',
);

$defaults['bossprogress'] = array(
  'bp_dynZone' => '0',
  'bp_dynBoss' => '0',
  'bp_zhiType' => '0',
  'bp_style' => '0',
  'bp_showSB' => '0',
  'bp_linkurl' => 'bossloot',
  'bp_linklength' => 'long',
  'bp_si_style' => 'sepia',
  'bp_ei_style' => 'normal',
  'bp_ztext_style' => 'png',
  'bp_boss_image_type' => 'gif',
);
?>
