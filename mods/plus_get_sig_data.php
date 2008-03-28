<?php
/******************************
 * EQdkp Bosscounter 2.2
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * bosscounter.php
 * 28.05.06 Corgan
 * 31.05.06 Corgan 2.1
 * 07.11.06 Corgan change to fetch Data from Bossprogress
 * 18.04.07 sz3 2.2
 ********************************************************/

if ( !defined('EQDKP_INC') )
{
    die('Do not access this file directly.');
}

function plus_get_sig_data(){
// new mgs class
require_once(dirname(__FILE__).'/../include/bsmgs.class.php');
$mybsmgs = new BSMGS();
if (!$mybsmgs->game_supported('bossbase')){
  return false;
}else{
  # Get configuration data from the database
  ####################################################
  require_once(dirname(__FILE__).'/../include/bcsql.class.php');
  $mybcsql = new BCSQL();

  $bb_conf = $mybcsql->get_config('bossbase');
  $bc_conf = $mybcsql->get_config('bosscounter');
  $sbzone = $mybcsql->get_bzone();

  # Get data
  ####################################################
  $data = $mybcsql->get_data($bb_conf, $sbzone);
  //sizeof($data[$zone]['bosses'])
  //$data[$zone]['zk'] > 0)
  return $data;
}
}
?>
