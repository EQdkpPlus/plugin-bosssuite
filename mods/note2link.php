<?php
/******************************
* EQdkp BossLoot
* by sz3
*
* Copyright 2006
* Licensed under the GNU GPL.  See COPYING for full terms.
* ------------------
* note2link.php
* 01.05.07 sz3
******************************/
if (!defined('EQDKP_INC')) {
	die('You cannot access this file directly.');
}

function bl_note2link($rnote){
global $SID, $eqdkp_root_path, $pm;
	if ($rnote == '')
		return $rnote;

	if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') )
	{
    	return $rnote;
	}
	
  // new mgs class
  require_once(dirname(__FILE__).'/../include/bsmgs.class.php');
  $mybsmgs = new BSMGS();
  
  if (!$mybsmgs->game_supported('bossbase')){
    return $rnote;
  }

  // sql class
  require_once(dirname(__FILE__).'/../include/bssql.class.php');
  $mybssql = new BSSQL();

	$bb_pboss = $mybssql->get_parse_boss();
	$bb_conf = $mybssql->get_config('bossbase');

	$delim = '/'.$bb_conf['noteDelim'].'/';
	if ($delim != "//"){
 		$elements = preg_split($delim, $rnote, -1, PREG_SPLIT_NO_EMPTY);
 	} else {
 		$elements = array($rnote);
 	}
 	
	foreach ($elements as $boss){	
		$bossid = "";
		foreach($bb_pboss as $name => $value){
			if(isset($value) && !(strpos($value, trim(stripslashes($boss))) === false)){
				$bossid = substr($name, 3);
				break;
			}
		}
		
		if ($bossid != "")
			$bl='<a href="'.$eqdkp_root_path.'plugins/bosssuite/bossloot.php'.$SID.'&amp;bossid='.$bossid.'">'.$boss.'</a>';
		else $bl=$boss;				

		$rnote = str_replace(trim($boss), $bl, $rnote);
	}
																								
    return $rnote;
}

?>
