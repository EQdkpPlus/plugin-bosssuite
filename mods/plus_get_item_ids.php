<?php
/******************************
 * EQdkp Bosscounter 2.2
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * bosscounter.php
 * 18.04.07 sz3 2.2
 ********************************************************/

if ( !defined('EQDKP_INC') )
{
    die('Do not access this file directly.');
}

function plus_get_item_ids(){
  require_once(dirname(__FILE__).'/../include/blmgs.class.php');
  $myblmgs = new BLMGS();
  
  require_once(dirname(__FILE__).'/../include/blsql.class.php');
  $myblsql = new BLSQL();
  $bl_conf = $myblsql->get_config('bossloot');
  $bzone = $myblsql->get_bzone();
  
  $id_list = array();
  
  foreach($bzone as $zoneid => $bosslist){
    foreach($bosslist as $bossid){
      $loottable = $myblmgs->bl_get_loottable($bl_conf['item_lang'], $bossid, $bl_conf['item_minqual']);
      foreach($loottable as $id => $name){
        $id_list[$id] = $name;
      }
    }
  }
  return $id_list;
}
?>
