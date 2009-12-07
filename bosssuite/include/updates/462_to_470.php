<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date: 2009-09-23 18:01:14 +0200 (Mi, 23 Sep 2009) $
 * -----------------------------------------------------------------------
 * @author      $Author: sz3 $
 * @copyright   2006-2008 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev: 5927 $
 *
 * $Id: 458_to_461.php 5927 2009-09-23 16:01:14Z sz3 $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}
 
$new_version    = '4.7.0';
$updateFunction = 'BS462to470Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS462to470Update(){
global $db, $user;
  $game_arr = explode('_', $eqdkp->config['default_game']);
  $currentgame = $game_arr[0];
  if(strtolower($currentgame) == "wow"){
    include(dirname(__FILE__).'/../bssql.class.php');
    $mybssql = new BSSQL();
    $bzone = array (
      'icecrown_10' => array(
        'marrowgar_10',
        'marrowgar_10_hm',
        'deathwhisper_10',
        'deathwhisper_10_hm',    
        'gunship_battle_10',
        'gunship_battle_10_hm',
        'deathbringer_10',
        'deathbringer_10_hm',
        'festergut_10',
        'festergut_10_hm',
        'rotface_10',
        'rotface_10_hm',
        'putricide_10',
        'putricide_10_hm',
        'blood_prince_council_10',
        'blood_prince_council_10_hm',
        'lanathel_10',
        'lanathel_10_hm',
        'dreamwalker_rescue_10',
        'dreamwalker_rescue_10_hm',
        'sindragosa_10',
        'sindragosa_10_hm',
        'lichking_10',
        'lichking_10_hm',
      ),
      'icecrown_25' => array(
        'marrowgar_25',
        'marrowgar_25_hm',
        'deathwhisper_25',
        'deathwhisper_25_hm',    
        'gunship_battle_25',
        'gunship_battle_25_hm',
        'deathbringer_25',
        'deathbringer_25_hm',
        'festergut_25',
        'festergut_25_hm',
        'rotface_25',
        'rotface_25_hm',
        'putricide_25',
        'putricide_25_hm',
        'blood_prince_council_25',
        'blood_prince_council_25_hm',
        'lanathel_25',
        'lanathel_25_hm',
        'dreamwalker_rescue_25',
        'dreamwalker_rescue_25_hm',
        'sindragosa_25',
        'sindragosa_25_hm',
        'lichking_25',
        'lichking_25_hm',
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
    if (strcmp($user->lang['toravon_10']['long'], $user->lang['toravon_10']['short'])){
      $bossstring = "''". str_replace("'", "''", $user->lang['toravon_10']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['toravon_10']['short']) . "''";
    }else{
      $bossstring = "''". str_replace("'", "''", $user->lang['toravon_10']['long']) . "''";
    }   
    $mybssql->update_parse_boss(array(), 'toravon_10', $bossstring);
    
    //25
    if (strcmp($user->lang['toravon_25']['long'], $user->lang['toravon_25']['short'])){
      $bossstring = "''". str_replace("'", "''", $user->lang['toravon_25']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['toravon_25']['short']) . "''";
    }else{
      $bossstring = "''". str_replace("'", "''", $user->lang['toravon_25']['long']) . "''";
    }   
    $mybssql->update_parse_boss(array(), 'toravon_25', $bossstring);

  }
}
?>
