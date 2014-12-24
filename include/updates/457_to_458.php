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
 
$new_version    = '4.5.8';
$updateFunction = 'BS457to458Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS457to458Update(){
global $db, $user, $eqdkp;
  $game_arr = explode('_', $eqdkp->config['default_game']);
  $currentgame = $game_arr[0];
  if($currentgame == "WoW"){
    include(dirname(__FILE__).'/../bssql.class.php');
    $mybssql = new BSSQL();
    $bzone = array (
        'totgc_10' => array(
          'tribute_s_10_hm',
          'tribute_ms_10_hm',
          'tribute_ins_10_hm'
        ),
        'totgc_25' => array(
          'tribute_s_25_hm',
          'tribute_ms_25_hm',
          'tribute_ins_25_hm'
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
