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
 
$new_version    = '4.8.2';
$updateFunction = 'BS481to482Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS481to482Update(){
global $db, $user, $eqdkp, $pm;
  $currentgame = strtolower($eqdkp->config['default_game']);
  $bzone = null;

  switch($currentgame){
    case 'wow':
      include(dirname(__FILE__).'/../bssql.class.php');
    	$mybssql = new BSSQL();
      $bzone = array (
				'firelands_10_hc' => array(
						'shannox_10_hc',
						'bethtilac_10_hc',
						'lord_rhyolith_10_hc',
						'alysrazar_10_hc',
						'baloroc_10_hc',
						'majordomo_staghelm_10_hc',
						'ragnaros_fl_10_hc',
					),
					'firelands_25_hc' => array(
						'shannox_25_hc',
						'bethtilac_25_hc',
						'lord_rhyolith_25_hc',
						'alysrazar_25_hc',
						'baloroc_25_hc',
						'majordomo_staghelm_25_hc',
						'ragnaros_fl_25_hc',
					),
					'firelands_10' => array(
						'shannox_10',
						'bethtilac_10',
						'lord_rhyolith_10',
						'alysrazar_10',
						'baloroc_10',
						'majordomo_staghelm_10',
						'ragnaros_fl_10',
					),
					'firelands_25' => array(
						'shannox_25',
						'bethtilac_25',
						'lord_rhyolith_25',
						'alysrazar_25',
						'baloroc_25',
						'majordomo_staghelm_25',
						'ragnaros_fl_25',
					),
			);

			//new tol barad boss
			//10    
			if (strcmp($user->lang['occuthar_10']['long'], $user->lang['occuthar_10']['short'])){
			  $bossstring = "''". str_replace("'", "''", $user->lang['occuthar_10']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['occuthar_10']['short']) . "''";
			}else{  
			  $bossstring = "''". str_replace("'", "''", $user->lang['occuthar_10']['long']) . "''";
			}       
			$mybssql->update_parse_boss(array(), 'occuthar_10', $bossstring);
			        
			//25    
			if (strcmp($user->lang['occuthar_25']['long'], $user->lang['occuthar_25']['short'])){
			  $bossstring = "''". str_replace("'", "''", $user->lang['occuthar_25']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['occuthar_25']['short']) . "''";
			}else{  
			  $bossstring = "''". str_replace("'", "''", $user->lang['occuthar_25']['long']) . "''";
			}       
			$mybssql->update_parse_boss(array(), 'occuthar_25', $bossstring);
			        
			break;
	}
	
  if($bzone != null){
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