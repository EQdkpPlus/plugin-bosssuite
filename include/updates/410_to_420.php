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
 
$new_version    = '4.2.0';
$updateFunction = 'BS410to420Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS410to420Update(){
global $db, $user, $eqdkp;
  $game_arr = explode('_', $eqdkp->config['default_game']);
  $currentgame = $game_arr[0];
  if($currentgame == "WoW"){
    include(dirname(__FILE__).'/../bssql.class.php');
    $mybssql = new BSSQL();
    $bzone = array (
    	'naxx_10' => array (
    		'anubrekhan_10',
    		'faerlina_10',
    		'maexxna_10',
    		'noth_10',
    		'heigan_10',
    		'loatheb_10',
    		'patchwerk_10',
    		'grobbulus_10',
    		'gluth_10',
    		'thaddius_10',
    		'razuvious_10',
    		'gothik_10',
    		'horsemen_10',
    		'sapphiron_10',
    		'kelthuzad_10'		
    	),
    	'vault_of_archavon_10' => array(
        'archavon_10'
      ),
    	'eye_of_eternity_10' => array(
        'malygos_10'
      ),
      'obsidian_sanctum_10' => array(
        'sartharion_0d_10',
        'sartharion_1d_10',
        'sartharion_2d_10',
        'sartharion_3d_10'
      ),
      'naxx_25' => array (
    		'anubrekhan_25',
    		'faerlina_25',
    		'maexxna_25',
    		'noth_25',
    		'heigan_25',
    		'loatheb_25',
    		'patchwerk_25',
    		'grobbulus_25',
    		'gluth_25',
    		'thaddius_25',
    		'razuvious_25',
    		'gothik_25',
        'horsemen_25',
    		'sapphiron_25',
    		'kelthuzad_25'		
    	),
    	'vault_of_archavon_25' => array(
        'archavon_25'
      ),
    	'eye_of_eternity_25' => array(
        'malygos_25'
      ),
      'obsidian_sanctum_25' => array(
        'sartharion_0d_25',
        'sartharion_1d_25',
        'sartharion_2d_25',
        'sartharion_3d_25'
      )
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
