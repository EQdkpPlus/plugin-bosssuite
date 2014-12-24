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
 
$new_version    = '4.8.3';
$updateFunction = 'BS482to483Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS482to483Update(){
global $db, $user, $eqdkp, $pm;
  $currentgame = strtolower($eqdkp->config['default_game']);
  $bzone = null;

  switch($currentgame){
    case 'wow':
      include(dirname(__FILE__).'/../bssql.class.php');
    	$mybssql = new BSSQL();
      $bzone = array (
				'dragon_soul_10_hc' => array(
						'morchok_10_hc',
						'zonozz_10_hc',
						'yorsahj_10_hc',
						'hagara_10_hc',
						'ultraxion_10_hc',
						'blackhorn_10_hc',
						'spine_of_deathwing_10_hc',
						'madness_of_deathwing_10_hc'
					),
					'dragon_soul_25_hc' => array(
						'morchok_25_hc',
						'zonozz_25_hc',
						'yorsahj_25_hc',
						'hagara_25_hc',
						'ultraxion_25_hc',
						'blackhorn_25_hc',
						'spine_of_deathwing_25_hc',
						'madness_of_deathwing_25_hc'
					),
					'dragon_soul_10' => array(
						'morchok_10',
						'zonozz_10',
						'yorsahj_10',
						'hagara_10',
						'ultraxion_10',
						'blackhorn_10',
						'spine_of_deathwing_10',
						'madness_of_deathwing_10'
					),
					'dragon_soul_25' => array(
						'morchok_25',
						'zonozz_25',
						'yorsahj_25',
						'hagara_25',
						'ultraxion_25',
						'blackhorn_25',
						'spine_of_deathwing_25',
						'madness_of_deathwing_25'
					),
	    );
			//new tol barad boss
			//10    
			if (strcmp($user->lang['alizabal_10']['long'], $user->lang['alizabal_10']['short'])){
			  $bossstring = "''". str_replace("'", "''", $user->lang['alizabal_10']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['alizabal_10']['short']) . "''";
			}else{  
			  $bossstring = "''". str_replace("'", "''", $user->lang['alizabal_10']['long']) . "''";
			}       
			$mybssql->update_parse_boss(array(), 'alizabal_10', $bossstring);
			        
			//25    
			if (strcmp($user->lang['alizabal_25']['long'], $user->lang['alizabal_25']['short'])){
			  $bossstring = "''". str_replace("'", "''", $user->lang['alizabal_25']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['alizabal_25']['short']) . "''";
			}else{  
			  $bossstring = "''". str_replace("'", "''", $user->lang['alizabal_25']['long']) . "''";
			}       
			$mybssql->update_parse_boss(array(), 'alizabal_25', $bossstring);

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