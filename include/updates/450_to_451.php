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
 
$new_version    = '4.5.1';
$updateFunction = 'BS450to451Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS450to451Update(){
global $db, $user;
  $game_arr = explode('_', $eqdkp->config['default_game']);
  $currentgame = $game_arr[0];
  if($currentgame = "WoW"){
    include(dirname(__FILE__).'/../bssql.class.php');
    $mybssql = new BSSQL();
    $bzone = array (
      'ulduar_10' => array (
        'leviathan_10_hm',
        'deconstructor_10_hm',
        'iron_council_10_hm',
        'auriaya_10_hm',
        'hodir_10_hm',
        'thorim_10_hm',
        'freya_10_hm',
        'mimiron_10_hm',
        'vezax_10_hm',     
        'yoggsaron_10_hm',
      ),
      'vault_of_archavon_10' => array(
        'emalon_10'
      ),
      'ulduar_25' => array (
        'leviathan_25_hm',
        'deconstructor_25_hm',
        'iron_council_25_hm',
        'auriaya_25_hm',
        'hodir_25_hm',
        'thorim_25_hm',
        'freya_25_hm',
        'mimiron_25_hm',
        'vezax_25_hm',     
        'yoggsaron_25_hm',
      ),
      'vault_of_archavon_25' => array(
        'emalon_25'
      ),
    );
    foreach ($bzone as $zone => $bosses){ 
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
