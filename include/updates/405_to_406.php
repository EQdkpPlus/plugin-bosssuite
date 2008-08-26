<?php
/******************************
 * EQdkp BossSuite
 * (c) 2005 - 2007
 * sz3
 * ---------------------------
 * $Id: $
 ******************************/
if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}
 
$new_version = '4.0.6';

$updateDESC = array(
);

$updateSQL = array(
);


function PerformMyUpdate(){
  global $db, $table_prefix, $eqdkp;
  
  //Check column count
  $sql = "SELECT * FROM ".$table_prefix."bs_config;";
  $result = $db->query($sql); 
  $cnrs = $db->fetch_record();
  if (count($cnrs > 2)) {
    $game_arr = explode('_', $eqdkp->config['default_game']);
    $currentgame = $game_arr[0];
    
    $imagetype = 'gif';
    if($currentgame == 'LOTRO')
      $imagetype = 'jpg';
  
    $db->query("DELETE FROM ".$table_prefix."bs_config WHERE game_id != '".$currentgame."'");
    $db->query("DELETE FROM ".$table_prefix."bs_data_zone WHERE game_id != '".$currentgame."'");
    $db->query("DELETE FROM ".$table_prefix."bs_data_boss WHERE game_id != '".$currentgame."'");
    $db->query("DELETE FROM ".$table_prefix."bs_cache_zone WHERE game_id != '".$currentgame."'");
    $db->query("DELETE FROM ".$table_prefix."bs_cache_boss WHERE game_id != '".$currentgame."'");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bb_bossInfo' WHERE config_name='bossInfo' AND plugin_id='bossbase';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bb_zoneInfo' WHERE config_name='zoneInfo' AND plugin_id='bossbase';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bb_nameDelim' WHERE config_name='nameDelim' AND plugin_id='bossbase';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bb_bossInfo' WHERE config_name='bossInfo' AND plugin_id='bossbase';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bb_noteDelim' WHERE config_name='noteDelim' AND plugin_id='bossbase';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bb_tables' WHERE config_name='tables' AND plugin_id='bossbase';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bb_source' WHERE config_name='source' AND plugin_id='bossbase';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bc_dynZone' WHERE config_name='dynZone' AND plugin_id='bosscounter';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bc_dynBoss' WHERE config_name='dynBoss' AND plugin_id='bosscounter';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bc_linkurl' WHERE config_name='linkurl' AND plugin_id='bosscounter';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bc_linklength' WHERE config_name='linklength' AND plugin_id='bosscounter';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bc_zonelength' WHERE config_name='zonelength' AND plugin_id='bosscounter';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bc_eyecandy' WHERE config_name='eyecandy' AND plugin_id='bosscounter';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bl_item_minqual' WHERE config_name='item_minqual' AND plugin_id='bossloot';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bl_item_lang' WHERE config_name='item_lang' AND plugin_id='bossloot';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bl_show_ndl' WHERE config_name='show_ndl' AND plugin_id='bossloot';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bl_show_wl' WHERE config_name='show_wl' AND plugin_id='bossloot';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bl_get_itemstats' WHERE config_name='get_itemstats' AND plugin_id='bossloot';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bl_eyecandy' WHERE config_name='eyecandy' AND plugin_id='bossloot';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bp_dynZone' WHERE config_name='dynZone' AND plugin_id='bossprogress';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bp_dynBoss' WHERE config_name='dynBoss' AND plugin_id='bossprogress';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bp_zhiType' WHERE config_name='zhiType' AND plugin_id='bossprogress';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bp_style' WHERE config_name='style' AND plugin_id='bossprogress';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bp_showSB' WHERE config_name='showSB' AND plugin_id='bossprogress';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bp_linkurl' WHERE config_name='linkurl' AND plugin_id='bossprogress';");
    $db->query("UPDATE ".$table_prefix."bs_config SET config_name='bp_linklength' WHERE config_name='linklength' AND plugin_id='bossprogress';");
    $db->query("ALTER TABLE ".$table_prefix."bs_config DROP game_id;");
    $db->query("ALTER TABLE ".$table_prefix."bs_config DROP plugin_id;");
    $db->query("ALTER TABLE ".$table_prefix."bs_data_zone DROP game_id;");
    $db->query("ALTER TABLE ".$table_prefix."bs_data_boss DROP game_id;");
    $db->query("ALTER TABLE ".$table_prefix."bs_cache_zone DROP game_id;");
    $db->query("ALTER TABLE ".$table_prefix."bs_cache_boss DROP game_id;");  
    $db->query("INSERT INTO ".$table_prefix."bs_config VALUES ('bb_current_game', '".$currentgame."')");
    $db->query("INSERT INTO ".$table_prefix."bs_config VALUES ('bp_boss_image_type', '".$imagetype."')");	
  }  
}
?>
