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

// new mgs class
require_once(dirname(__FILE__).'/../include/bsmgs.class.php');
$mybsmgs = new BSMGS();
if (!$mybsmgs->game_supported('bossbase')){
  function bl_note2link($raidnote,$raidname=''){
    return $raidnote;
  }
}else{
  if (!$mybsmgs->game_supported('bossbase')){
      message_die("GAME NOT SUPPORTED");
  }
  // sql class
  require_once(dirname(__FILE__).'/../include/bssql.class.php');
  $mybssql = new BSSQL();
  
  //get config
  $bb_conf = $mybssql->get_config('bossbase');
  $bb_delim = array (
    'rnote' => '/'.$bb_conf['noteDelim'].'/',
  	'rname' => '/'.$bb_conf['nameDelim'].'/'
  );
  
  $bossInfo = $bb_conf['bossInfo'];
  $zoneInfo = $bb_conf['zoneInfo'];
  $bb_pboss = $mybssql->get_parse_boss();
  $bb_pzone = $mybssql->get_parse_zone();
  $bzone = $mybssql->get_bzone();
  
  function bl_note2link($rnote, $rname=""){
  global $mybsmgs, $bb_conf, $mybssql, $bossInfo, $zoneInfo, $bb_pboss, $bb_pzone, $bb_delim, $bzone, $eqdkp_root_path, $SID;  
  
  	if ($rnote == '')
  		return $rnote;
    
    if (!$mybsmgs->game_supported('bossbase')){
      return $rnote;
    }
  
  	if($bb_conf['depmatch']){
    	if ($bb_delim[$zoneInfo] != "//"){
    		$zone_element = preg_split($bb_delim[$zoneInfo], $rname, -1, PREG_SPLIT_NO_EMPTY);
    	} else {
    		$zone_element = array($rname);
    	}
    	
      $sbzone = array();
    	foreach ($zone_element as $raid){
    	  foreach($bzone as $zone => $bosses){
    	    $zparseList = preg_split("/\',[ ]*\'/", stripslashes(trim($bb_pzone['pz_'.$zone], "\' ")));
    	    if ($mybssql->in_array_nocase(stripslashes(trim($raid)), $zparseList)) {
    	      $sbzone[$zone] = $bosses;
    	    }	
    	  }
      }
    }else{
      $sbzone = $bzone;
    }
  
  	if ($bb_delim[$bossInfo] != "//"){
  		$boss_element = preg_split($bb_delim[$bossInfo], $rnote, -1, PREG_SPLIT_NO_EMPTY);
  	} else {
  		$boss_element = array($rnote);
  	}
    $count = sizeof($boss_element);
    
    if($count == 0)
      return $rnote;
    
  	foreach ($boss_element as $raid){
      foreach ($sbzone as $zone => $bosses){
  		  $boss_found = $false;
        foreach ($bosses as $boss){
        	$bparseList = preg_split("/\',[ ]*\'/", stripslashes(trim($bb_pboss['pb_'.$boss], "\' ")));
    			if ($mybssql->in_array_nocase(stripslashes(trim($raid)), $bparseList)) {
            $bl = '<a href="'.$eqdkp_root_path.'plugins/bosssuite/bossloot.php'.$SID.'&amp;bossid='.$boss.'">'.$raid.'</a>';
            if($count == 1){
              $rnote = str_replace(trim($raid), $bl, $rnote);
            }else{
              $matchme = "/(".$bb_conf['noteDelim'].")(".preg_quote($raid).")/";
              $rnote = preg_replace($matchme, "\\1$bl", $rnote);
              
              $matchme = "/(".preg_quote($raid).")(".$bb_conf['noteDelim'].")/";
              $rnote = preg_replace($matchme, "$bl\\2", $rnote);
            }
            $boss_found = true;
            break;
    			}		
    		}//end for bosses
    	  if($boss_found)
          break;
      }//end for zones
    }
    return $rnote;	
  }
}
?>