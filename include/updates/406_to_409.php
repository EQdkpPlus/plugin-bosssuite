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
 
$new_version = '4.0.9';

$updateDESC = array(
);

$updateSQL = array(
);


function PerformMyUpdate(){
  global $db, $table_prefix, $eqdkp;
    $sql = "SELECT * FROM ".$table_prefix."bs_config WHERE config_name='bp_boss_image_type';";
  $result = $db->query($sql); 
  $cnrs = $db->fetch_record();
  if(false == $cnrs){
    $imagetype = 'gif';
    if($currentgame == 'LOTRO')
      $imagetype = 'jpg';
    $db->query("INSERT INTO ".$table_prefix."bs_config VALUES ('bp_boss_image_type', '".$imagetype."')");	
  }  
}
?>
