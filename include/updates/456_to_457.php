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

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}
 
$new_version    = '4.5.7';
$updateFunction = 'BS456to457Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS456to457Update(){
global $db, $user;
  $game_arr = explode('_', $eqdkp->config['default_game']);
  $currentgame = $game_arr[0];
  if($currentgame = "WoW"){
    include(dirname(__FILE__).'/../bssql.class.php');
    $mybssql = new BSSQL();
    $bzone = array (
      'totc_10' => array(
          'beasts_of_northrend_10',
          'lord_jaraxxus_10',
          'faction_champions_10',
          'twin_valkyr_10',
          'anubarak_10'
        ),
        'totgc_10' => array(
          'beasts_of_northrend_10_hm',
          'lord_jaraxxus_10_hm',
          'faction_champions_10_hm',
          'twin_valkyr_10_hm',
          'anubarak_10_hm'
        ),
        'totc_25' => array(
          'beasts_of_northrend_25',
          'lord_jaraxxus_25',
          'faction_champions_25',
          'twin_valkyr_25',
          'anubarak_25'
        ),
        'totgc_25' => array(
          'beasts_of_northrend_25_hm',
          'lord_jaraxxus_25_hm',
          'faction_champions_25_hm',
          'twin_valkyr_25_hm',
          'anubarak_25_hm'
        ),
    );
    foreach ($bzone as $zone => $bosses){
      if (strcmp($user->lang[$zone]['long'], $user->lang[$zone]['short'])){
        $zonestring = "''". str_replace("'", "''", $user->lang[$zone]['long']) . "'', ''" .  str_replace("'", "''", $user->lang[$zone]['short']) . "''";
      }else{
        $zonestring = "''". str_replace("'", "''", $user->lang[$zone]['long']) . "''";
    	}   
      $mybssql->update_parse_zone(array(), $zone, $zonestring);   
      foreach ($bosses as $boss){
       if (strcmp($user->lang[$boss]['long'], $user->lang[$boss]['short'])){
		     $bossstring = "''". str_replace("'", "''", $user->lang[$boss]['long']) . "'', ''" .  str_replace("'", "''", $user->lang[$boss]['short']) . "''";
	     }else{
		     $bossstring = "''". str_replace("'", "''", $user->lang[$boss]['long']) . "''";
	     }   
       $mybssql->update_parse_boss(array(), $boss, $bossstring);
      }
    }
    
    //new archavon boss
    //10
    if (strcmp($user->lang['koralon_10']['long'], $user->lang['koralon_10']['short'])){
      $bossstring = "''". str_replace("'", "''", $user->lang['koralon_10']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['koralon_10']['short']) . "''";
    }else{
      $bossstring = "''". str_replace("'", "''", $user->lang['koralon_10']['long']) . "''";
    }   
    $mybssql->update_parse_boss(array(), 'koralon_10', $bossstring);
    
    //25
    if (strcmp($user->lang['koralon_25']['long'], $user->lang['koralon_25']['short'])){
      $bossstring = "''". str_replace("'", "''", $user->lang['koralon_25']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['koralon_25']['short']) . "''";
    }else{
      $bossstring = "''". str_replace("'", "''", $user->lang['koralon_25']['long']) . "''";
    }   
    $mybssql->update_parse_boss(array(), 'koralon_25', $bossstring);
  }
}
?>
