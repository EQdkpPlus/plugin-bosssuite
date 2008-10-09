<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2006-2008 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev$
 *
 * $Id$
 */

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
