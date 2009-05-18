<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date: 2009-05-14 23:20:40 +0200 (Do, 14 Mai 2009) $
 * -----------------------------------------------------------------------
 * @author      $Author: sz3 $
 * @copyright   2006-2008 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev: 4864 $
 *
 * $Id: 450_to_451.php 4864 2009-05-14 21:20:40Z sz3 $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}
 
$new_version    = '4.5.3';
$updateFunction = 'BS452to453Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS452to453Update(){
global $db, $user;
  $game_arr = explode('_', $eqdkp->config['default_game']);
  $currentgame = $game_arr[0];
  if($currentgame = "WoW"){
    $sql = "DELETE FROM __bs_data_boss WHERE boss_id='auriaya_10_hm' OR boss_id='auriaya_25_hm'";
    $db->query($sql);
  }
}
?>
