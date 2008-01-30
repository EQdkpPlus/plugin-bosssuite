<?php
/******************************
* EQdkp BossLoot
* by sz3
*
* Copyright 2006
* Licensed under the GNU GPL.  See COPYING for full terms.
* ------------------
* extfunc.php
* 01.05.07 sz3
******************************/

function bl_note2link($rnote){
global $SID, $db, $eqdkp_root_path, $pm, $user, $table_prefix;
	if ($rnote == '')
		return $rnote;

	if ( !$pm->check(PLUGIN_INSTALLED, 'bossbase') )
	{
    	return $rnote;
	}

	include_once($eqdkp_root_path . 'plugins/bossbase/include/extfunc.php');
	$bb_pboss = bb_get_parse_boss();
	$bb_conf = bb_get_parse_config();

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
			$bl='<a href="'.$eqdkp_root_path.'plugins/bossloot/bossloot.php'.$SID.'&amp;bossid='.$bossid.'">'.$boss.'</a>';
		else $bl=$boss;				

		$rnote = str_replace(trim($boss), $bl, $rnote);
	}
																								
    return $rnote;
}

?>
