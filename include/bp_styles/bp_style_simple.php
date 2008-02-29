<?php
/******************************
 * EQdkp Bossprogress2
 * by sz3
 *  
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * bp_functions.php

 ******************************/

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
} 

 
function bp_html_get_zhi($zhi_type, $location, $loc_completed){
global $user, $eqdkp;

  $game_arr = explode('_', $eqdkp->config['default_game']);
	$basepath = 'games/'.$game_arr[0].'/images/';
	$zone_basepath = $basepath . 'zones/';
  $lang_basepath = $zone_basepath . 'lang/'.$user->lang['lang'].'/';
	// 0 = jitter, 1 = sw, 2 = none
	switch ($zhi_type) {
	case 0:
		$eimg = $zone_basepath . 'normal/' . $location . '.jpg';
		$simg = $zone_basepath . 'photo/' . $location . '.jpg';
		$limg = $lang_basepath.$location.'.png';
		break;
	case 1:
  	$eimg = $zone_basepath . 'normal/' . $location . '.jpg';
		$simg = $zone_basepath . 'sw/' . $location . '.jpg';
		$limg = $lang_basepath.$location.'.png';
		break;
	case 2:
		$eimg = $zone_basepath . 'normal/' . $location . '.jpg';
		$simg = $zone_basepath . 'normal/' . $location . '.jpg';
		$limg = $lang_basepath.$location.'.png';
	 	break;
	default:
		$eimg = $zone_basepath . 'normal/' . $location . '.jpg';
		$simg = $zone_basepath . 'photo/' . $location . '.jpg';
		break;
	}
  
  $header1 = '<tr width="800"><td colspan="4" class="row1">';
  if ( !file_exists(dirname(__file__).'/../../'.$eimg))
    $eimg = 'games/default/images/zones/default.jpg';
  if ( !file_exists(dirname(__file__).'/../../'.$simg))
    $simg = 'games/default/images/zones/default.jpg';

  if ($eimg != $simg){
    $header2 = '<div style="background-image:url('.$simg.'); position:relative; top:0px; z-index: 0; width:800px; height:100px;">';
    $header3 = '<div style="background-image:url('.$eimg.'); position:absolute; top:0px; z-index: 5; width:'. $loc_completed . '%; height:100px;">';
    $header5 = '</div></div></div>';
  }else{
    $header2 = '<div style="background-image:url('.$simg.'); position:relative; top:0px; z-index: 0; width:800px; height:100px;">';
    $header3 = '';
    $header5 = '</div></div>';
  }
  
  if ( !file_exists(dirname(__file__).'/../../'.$limg)){
    $header4 = '<div style="position:absolute; font-size:3em; top:5px; z-index: 10; width:800px; height:100%;">'.$user->lang[$location]['long'];
  }else{
    $header4 = '<div style="background-image:url('.$limg.'); position:absolute; top:5px; z-index: 10; width:800px; height:100%; background-repeat: no-repeat;">';
  }
   
  $header6 = '</td></tr>';   
      
  return $header1.$header2.$header3.$header4.$header5.$header6."\n";
}



function bp_html_get_zsb($location, $loc_killed, $loc_completed, $totalbosscount, $zfvd, $zlvd, $zvc){
global $user;
	($loc_completed == '100') ? $bar_class = "positive" : $bar_class = "negative";
	return '<tr><td align="center" colspan="4" class="row2"><span class="' . $bar_class . '">'
			. $user->lang[$location]['long'] . ' -- ' . $user->lang['firstvisit'] . bp_date2text($zfvd)
			. ' -- ' . $user->lang['lastvisit'] . bp_date2text($zlvd) . ' -- ' . $user->lang['status']
			. $loc_killed . '/' . $totalbosscount. ' (' . $loc_completed . '%)</span></td></tr>';
}

function bp_html_get_bossinfo_simple($rowid, $bosslink, $firstkill, $lastkill, $count) {
global $user;
	$firstkill_date = bp_date2text($firstkill);
	$lastkill_date = bp_date2text($lastkill);
	$bossinfo = '<tr class="row' . ($rowid +1) . '">';
	$bossinfo .= '<td align="left">Name: ' .$bosslink .'</td>';
	$bossinfo .= '<td align="left">' . $user->lang['firstkill'] . $firstkill_date . '</td>';
	$bossinfo .= '<td align="left">' . $user->lang['lastkill'] . $lastkill_date . '</td>';
	$bossinfo .= '<td align="left">' . $user->lang['bosskillcount'] . $count . '</td></tr>';
	return $bossinfo;
}

function bp_html_get_zoneinfo_bps($conf, $data, $sbzone){
// new link class
require_once(dirname(__FILE__).'/../bslink.class.php');
$mybslink = new BSLINK($conf['linkurl'], $conf['linklength']);
foreach ($sbzone as $zone => $bosses){
    if ((!$conf['dynZone']) or ($data[$zone]['zk'] > 0)){
        $loc_completed = round($data[$zone]['zk'] / count($bosses) * 100);
        $bpout .= bp_html_get_zhi($conf['zhiType'], $zone, $loc_completed);
        if($conf['showSB'])
            $bpout .= bp_html_get_zsb($zone, $data[$zone]['zk'], $loc_completed, count($bosses),$data[$zone]['fvd'],$data[$zone]['lvd'],$data[$zone]['kc']);
        $bi = 1; //row number 1/2
        $printed = 0;

        foreach($bosses as $boss){
        if ((!$conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)) {
            $bpout .= bp_html_get_bossinfo_simple($bi, $mybslink->get_boss_link($boss), $data[$zone]['bosses'][$boss]['fkd'], $data[$zone]['bosses'][$boss]['lkd'], $data[$zone]['bosses'][$boss]['kc']);

            $bi = 1 - $bi;
            $printed++;
        }
        }
        $bpout .= '<tr height="5"><td colspan="4"></td></tr>';
    }
}
return $bpout;
}

function bp_date2text($date) {
global $user;
	if (($date == BS_MAX_DATE) or ($date == BS_MIN_DATE)) {
		return $user->lang['never'];
	} else {
		return strftime($user->lang['dateFormat'], $date);
	}
}
?>
