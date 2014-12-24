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
 
$new_version    = '4.8.1';
$updateFunction = 'BS480to481Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS480to481Update(){
global $db, $user, $eqdkp, $pm;
  $currentgame = strtolower($eqdkp->config['default_game']);
  $bzone = null;

  switch($currentgame){
    case 'wow':
      $bzone = array (
				'blackwing_descent_10_hc' => array(
						'magmaw_10_hc',
						'omnotron_defense_system_10_hc',
						'maloriak_10_hc',
						'atramedes_10_hc',
						'chimaeron_10_hc',
						'nefarian_10_hc',
					),
					'blackwing_descent_25_hc' => array(
						'magmaw_25_hc',
						'omnotron_defense_system_25_hc',
						'maloriak_25_hc',
						'atramedes_25_hc',
						'chimaeron_25_hc',
						'nefarian_25_hc',
					),
					'bastion_of_twilight_10_hc' => array(
						'valiona_theralion_10_hc',
						'wyrmbreaker_10_hc',
						'twilight_council_10_hc',
						'chogall_10_hc',
						'sinestra_10_hc',
					),
					'bastion_of_twilight_25_hc' => array(
						'valiona_theralion_25_hc',
						'wyrmbreaker_25_hc',
						'twilight_council_25_hc',
						'chogall_25_hc',
						'sinestra_25_hc',
					),
					'throne_of_four_winds_10_hc' => array(
						'conclave_of_wind_10_hc',
						'alakir_10_hc',
					),
					'throne_of_four_winds_25_hc' => array(
						'conclave_of_wind_25_hc',
						'alakir_25_hc',
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