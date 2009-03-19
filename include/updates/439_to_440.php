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
 
$new_version    = '4.4.0';
$updateFunction = 'BS439to440Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS439to440Update(){
global $db, $user;
  $game_arr = explode('_', $eqdkp->config['default_game']);
  $currentgame = $game_arr[0];
  if($currentgame = "WoW"){
    include(dirname(__FILE__).'/../bssql.class.php');
    $mybssql = new BSSQL();
    $bzone = array (
      'ulduar_10' => array (
        'hodir_10',
        'thorim_10',
        'iron_council_10',
        'freya_10',
        'ignis_10',
        'leviathan_10',
        'vezax_10',
        'razorscale_10',
        'deconstructor_10',
        'kologarn_10',
        'auriaya_10',
        'mimiron_10',
        'yoggsaron_10',
        'algalon_10',
      ),
      'ulduar_25' => array (
        'hodir_25',
        'thorim_25',
        'iron_council_25',
        'freya_25',
        'ignis_25',
        'leviathan_25',
        'vezax_25',
        'razorscale_25',
        'deconstructor_25',
        'kologarn_25',
        'auriaya_25',
        'mimiron_25',
        'yoggsaron_25',
        'algalon_25',
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
  }
}
?>
