<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id$
 ******************************/
 
if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
} 

 
function bp_html_get_zhi($bp_conf, $location, $loc_completed){
global $user, $eqdkp;

  $game_arr = explode('_', $eqdkp->config['default_game']);
  
  $simg = 'games/'.$game_arr[0].'/images/zones/'.$bp_conf['si_style'].'/'.$location.'.jpg';
  $eimg = 'games/'.$game_arr[0].'/images/zones/'.$bp_conf['ei_style'].'/'.$location.'.jpg';
   
  $header1 = '<tr width="100%"><td colspan="4">';

  //Images  
  if ( !file_exists(dirname(__file__).'/../../'.$eimg))
    $eimg = 'games/default/images/zones/default.jpg';
  if ( !file_exists(dirname(__file__).'/../../'.$simg))
    $simg = 'games/default/images/zones/default.jpg';

  if ($eimg != $simg){
    if ($loc_completed == 0){
      $ssize = getImageSize($simg);
      $header2 = '<div style="background-image:url('.$simg.'); position:relative; top:0px; z-index: 0; width:'.$ssize[0].'px; height:'.$ssize[1].'px;">';
      $header3 = '';
      $header5 = '</div></div>';
    } elseif ($loc_completed == 100){
      $esize = getImageSize($eimg);
      $header2 = '';
      $header3 = '<div style="background-image:url('.$eimg.'); position:relative; top:0px; z-index: 5; width:100%; height:'.$esize[1].'px;">';
      $header5 = '</div></div>';
    } else {
      $ssize = getImageSize($simg);
      $esize = getImageSize($eimg);
      $header2 = '<div style="background-image:url('.$simg.'); position:relative; top:0px; z-index: 0; width:'.$ssize[0].'px; height:'.$ssize[1].'px;">';
      $header3 = '<div style="background-image:url('.$eimg.'); position:absolute; top:0px; z-index: 5; width:'. $loc_completed . '%; height:'.$esize[1].'px;">';
      $header5 = '</div></div></div>';
    }
  }else{
    $ssize = getImageSize($simg);
    $header2 = '<div style="background-image:url('.$simg.'); position:relative; top:0px; z-index: 0; width:'.$ssize[0].'px; height:'.$ssize[1].'px;">';
    $header3 = '';
    $header5 = '</div></div>';
  }
  
  //Language
  if ( 'png' == $bp_conf['ztext_style'] ){
    $limg = 'games/'.$game_arr[0].'/images/zones/lang/'.$user->lang['lang'].'/'.$location.'.png';
    if (!file_exists(dirname(__file__).'/../../'.$limg)){
      $header4 = '<div style="position:absolute; font-size:3em; top:5px; z-index: 10; width:800px; height:100%;">FB'.$user->lang[$location]['long'];
    }else{
      $header4 = '<div style="background-image:url('.$limg.'); position:absolute; top:5px; z-index: 10; width:800px; height:100%; background-repeat: no-repeat;">';
    }
  } elseif ( 'text' == $bp_conf['ztext_style'] ){
    $header4 = '<div style="position:absolute; font-size:3em; top:5px; z-index: 10; width:800px; height:100%;">'.$user->lang[$location]['long'];
  } elseif ( 'none' ==  $bp_conf['ztext_style'] ){
    $header4 = '';
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



function bp_html_get_boss_image_td($bossname, $bosscount, $imagetype) {
global $eqdkp;
  if ($bosscount == 0)
  	$bossname .= "_b";
  $game_arr = explode('_', $eqdkp->config['default_game']);

  if (file_exists('games/'.$game_arr[0].'/images/bosses/small/' . $bossname . ".".$imagetype)) {
  	return '<td width="60" height="60" align="center"><img src="games/'.$game_arr[0].'/images/bosses/small/' . $bossname . '.'.$imagetype.'" align="center" border="0" alt="' . $bossname . '" /></td>';
  } else {
  	return '<td width="60" height="60" align="center"><img src="games/default/images/bosses/small/unknown.gif" height="60" border="0" alt= "' . $bossname . '" /></td>';
  }
}

function bp_html_get_bossinfo($rowid, $bossname, $bosslink, $firstkill, $lastkill, $count, $imagetype) {
global $user;
	$firstkill_date = bp_date2text($firstkill);
	$lastkill_date = bp_date2text($lastkill);
	if (($rowid % 2)) {
		$bossinfo = '<tr class="row' . ($rowid +1) . '">';
		$bossinfo .= bp_html_get_boss_image_td($bossname, $count, $imagetype);
		$bossinfo .= '<td align="left">' . $user->lang['bs_al_name'] . ': ' . $bosslink . '<br />';
		$bossinfo .= $user->lang['firstkill'] . $firstkill_date . '<br />';
		$bossinfo .= $user->lang['lastkill'] . $lastkill_date . '<br />';
		$bossinfo .= $user->lang['bosskillcount'] . $count;
		$bossinfo .= '</td>' . "\n";
	} else {
		$bossinfo .= '<td align="right">' . $user->lang['bs_al_name'] . ': ' . $bosslink . '<br />';
		$bossinfo .= $user->lang['firstkill'] . $firstkill_date . '<br />';
		$bossinfo .= $user->lang['lastkill'] . $lastkill_date . '<br />';
		$bossinfo .= $user->lang['bosskillcount'] . $count . '</td>';
		$bossinfo .= bp_html_get_boss_image_td($bossname, $count, $imagetype);
		$bossinfo .= '</tr>' . "\n";
	}

	return $bossinfo;
}

function bp_html_get_zoneinfo_bp($conf, $data, $sbzone){
// new link class
require_once(dirname(__FILE__).'/../bslink.class.php');
$mybslink = new BSLINK($conf['linkurl'], $conf['linklength']);

foreach ($sbzone as $zone => $bosses){
    if ((!$conf['dynZone']) or ($data[$zone]['zk'] > 0)){
        $loc_completed = round($data[$zone]['zk'] / count($bosses) * 100);
        $bpout .= bp_html_get_zhi($conf, $zone, $loc_completed);
        if($conf['showSB'])
            $bpout .= bp_html_get_zsb($zone, $data[$zone]['zk'], $loc_completed, count($bosses),$data[$zone]['fvd'],$data[$zone]['lvd'],$data[$zone]['kc']);
        $bi = 1; //row number 1/2
        $printed = 0;

        foreach($bosses as $boss){
        if ((!$conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)) {
            $bpout .= bp_html_get_bossinfo($bi, $boss, $mybslink->get_boss_link($boss), $data[$zone]['bosses'][$boss]['fkd'], $data[$zone]['bosses'][$boss]['lkd'], $data[$zone]['bosses'][$boss]['kc'], $conf['boss_image_type']);
            $bi = 1 - $bi;
            $printed++;
        }
        }
        if (($printed > 0) && ($printed % 2)){
            $bpout .= '<td></td><td width=60px></td></tr>';
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
