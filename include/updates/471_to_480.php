<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date $
 * -----------------------------------------------------------------------
 * @author      $Author $
 * @copyright   2006-2011 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev $
 *
 * $Id $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}
 
$new_version    = '4.8.0';
$updateFunction = 'BS471to480Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS471to480Update(){
global $db, $user, $eqdkp, $pm;
  $currentgame = strtolower($eqdkp->config['default_game']);
  $bzone = null;

  switch($currentgame){
    case 'wow':
      $bzone = array (
				'blackwing_descent_10' => array(
					'magmaw_10',
					'omnotron_defense_system_10',
					'maloriak_10',
					'atramedes_10',
					'chimaeron_10',
					'nefarian_10',
				),
				'blackwing_descent_25' => array(
					'magmaw_25',
					'omnotron_defense_system_25',
					'maloriak_25',
					'atramedes_25',
					'chimaeron_25',
					'nefarian_25',
				),
				'bastion_of_twilight_10' => array(
					'valiona_theralion_10',
					'wyrmbreaker_10',
					'twilight_council_10',
					'chogall_10',
					'sinestra_10',
				),
				'bastion_of_twilight_25' => array(
					'valiona_theralion_25',
					'wyrmbreaker_25',
					'twilight_council_25',
					'chogall_25',
					'sinestra_25',
				),
				'throne_of_four_winds_10' => array(
					'conclave_of_wind_10',
					'alakir_10',
				),
				'throne_of_four_winds_25' => array(
					'conclave_of_wind_25',
					'alakir_25',
				),
				'baradin_hold_10' => array(
					'argaloth_10',
				),
				'baradin_hold_25' => array(
					'argaloth_25',
				),
	    );
    	break;
	}
	
  if($bzone != null){
    include(dirname(__FILE__).'/../bssql.class.php');
    $mybssql = new BSSQL();
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
  }
  
  //rebuild cache
  $pm->do_hooks('/plugins/bosssuite/admin/cache.php');
}
?>