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
 
$new_version    = '4.7.1';
$updateFunction = 'BS470to471Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS470to471Update(){
global $db, $user, $eqdkp;
  $currentgame = strtolower($eqdkp->config['default_game']);
  $bzone = null;

  switch($currentgame){
    case 'wow':
      $bzone = array (
				'ruby_sanctum_10' => array(
				  'halion_10',
				  'halion_10_hm',
				),
				'ruby_sanctum_25' => array(
					'halion_25',
					'halion_25_hm',
				),
	    );
    	break;
		case 'lotro':
		  $bzone = array (
				'barad_guldur' => array (
				  'durchest',
					'cargaraf_and_morgaraf',
				  'the_lieutenant_of_dol_guldur',
				),
				'sammath_gul' => array (
				    'urchir',
				    'alagossir',
				    'gorothul',
				    'demafaer',
				),
				'warg_pens' => array (
				    'athgrat',
				    'kranklob',
				),
				'sword_hall' => array (
				    'carchrien',
				    'durkar',
				    'urcheron',
				),
				'dungeons_of_dol_guldur' => array (
				    'the_warden',
				),
				'lumul_nar' => array (
				  'frost-tail',
				  'ergoth',
				),
				'nala_dum' => array (
				    'spit-tail',
				    'caerlug',
				),
				'halls_of_crafting' => array (
				    'ambal',
				    'bashkuga',
				    'thaguzg',
				),
			);
			break;
		case 'runesofmagic':
			$bzone = array(
				 'heart_of_the_ocean' => array (
				    'bloodthirsty_claw',
				    'teeth_of_the_reef',
				    'jiasha',
				    'geba',
				    'medusa',
				),
				'heart_of_the_ocean_easy' => array (
				    'bloodthirsty_claw_easy',
				    'teeth_of_the_reef_easy',
				    'jiasha_easy',
				    'geba_easy',
				    'medusa_easy',
				),
				'the_origin' => array (
				    'life_leecher',
				    'razor_lurker',
				    'lorlin_taburen',
				    'tree_falynum',
				),
				'hall_of_survivors' => array (
					'andriol',
					'glamo',
					'guldamor',
					'vrantal',
					'zygro',
					'mantarick_sydaphex',
					'andaphelmor',
				),
				'hall_of_survivors_easy' => array (
				    'andriol_easy',
				    'glamo_easy',
				    'guldamor_easy',
				    'vrantal_easy',
				    'zygro_easy',
				    'mantarick_sydaphex_easy',
				    'andaphelmor_easy',
				),
				'cave_of_the_water_dragon' => array (
				    'lytfir',
				),
				'lair_of_the_demon_dragon' => array (
				    'gestero',
				),
				'zurhidon_stronghold' => array (
				    'charionys',
				    'lady_hansis',
				    'balothar',
				    'new_messenger',
				),
				'hall_of_the_demon_lord' => array (
				    'naos',
				    'yash',
				)
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
    
    //add new rom boss to kingdom_ruins_high
    if($currentgame = 'runesofmagic'){
			if (strcmp($user->lang['ooze_boss']['long'], $user->lang['ooze_boss']['short'])){
	      $bossstring = "''". str_replace("'", "''", $user->lang['ooze_boss']['long']) . "'', ''" .  str_replace("'", "''", $user->lang['ooze_boss']['short']) . "''";
	    }else{
	      $bossstring = "''". str_replace("'", "''", $user->lang['ooze_boss']['long']) . "''";
	    }
	    $mybssql->update_parse_boss(array(), 'ooze_boss', $bossstring);
		}
  }
}
?>
