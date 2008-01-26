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
function bp_html_get_zhi($zhi_type, $location, $loc_completed){
global $user, $eqdkp;

  $game_arr = explode('_', $eqdkp->config['default_game']);
	$basepath = 'games/'.$game_arr[0].'/bossprogress/images/';
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
  if ( !file_exists(dirname(__file__).'/../'.$eimg))
    $eimg = 'images/bossprogress/bp_style/zones/default.jpg';
  if ( !file_exists(dirname(__file__).'/../'.$simg))
    $simg = 'images/bossprogress/bp_style/zones/default.jpg';

  if ($eimg != $simg){
    $header2 = '<div style="background-image:url('.$simg.'); position:relative; top:0px; z-index: 0; width:800px; height:100px;">';
    $header3 = '<div style="background-image:url('.$eimg.'); position:absolute; top:0px; z-index: 5; width:'. $loc_completed . '%; height:100px;">';
    $header5 = '</div></div></div>';
  }else{
    $header2 = '<div style="background-image:url('.$simg.'); position:relative; top:0px; z-index: 0; width:800px; height:100px;">';
    $header3 = '';
    $header5 = '</div></div>';
  }
  
  if ( !file_exists(dirname(__file__).'/../'.$limg)){
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



function bp_html_get_boss_image_td($bossname, $bosscount) {
if ($bosscount == 0)
	$bossname .= "_b";

if (file_exists("games/WoW/bossprogress/images/bosses/" . $bossname . ".gif")) {
	return '<td width="60" height="60" align="center"><img src="games/WoW/bossprogress/images/bosses/' . $bossname . '.gif" height="60" border="0" alt="' . $bossname . '" /></td>';
} else {
	return '<td width="60" height="60" align="center"><img src="games/WoW/bossprogress/images/bosses/turkey.gif" height="60" border="0" alt= "' . $bossname . '" /></td>';
}
}

function bp_html_get_bosslink($bossid){
global $eqdkp, $pm, $user, $SID;
	if ( $pm->check(PLUGIN_INSTALLED, 'bossloot') )
		return '<a href="' . $eqdkp->config['server_path'] . 'plugins/bossloot/bossloot.php'.$SID.'&amp;bossid='.$bossid.'">'.$user->lang[$bossid]['long'].'</a><br />';
	
	return '<a href="' . $user->lang['baseurl'] . $user->lang[$bossid]['id'] . '" target="bossinfo">' . $user->lang[$bossid]['long'] . '</a><br />';

}

function bp_html_get_bossinfo($rowid, $bossname, $firstkill, $lastkill, $count) {
global $user;
	$firstkill_date = bp_date2text($firstkill);
	$lastkill_date = bp_date2text($lastkill);
	if (($rowid % 2)) {
		$bossinfo = '<tr class="row' . ($rowid +1) . '">';
		$bossinfo .= bp_html_get_boss_image_td($bossname, $count);
		$bossinfo .= '<td align="left">Name: ' . bp_html_get_bosslink($bossname);
		$bossinfo .= $user->lang['firstkill'] . $firstkill_date . '<br />';
		$bossinfo .= $user->lang['lastkill'] . $lastkill_date . '<br />';
		$bossinfo .= $user->lang['bosskillcount'] . $count;
		$bossinfo .= '</td>' . "\n";
	} else {
		$bossinfo .= '<td align="right">Name: ' . bp_html_get_bosslink($bossname);
		$bossinfo .= $user->lang['firstkill'] . $firstkill_date . '<br />';
		$bossinfo .= $user->lang['lastkill'] . $lastkill_date . '<br />';
		$bossinfo .= $user->lang['bosskillcount'] . $count . '</td>';
		$bossinfo .= bp_html_get_boss_image_td($bossname, $count);
		$bossinfo .= '</tr>' . "\n";
	}

	return $bossinfo;
}



function bp_html_get_bossinfo_simple($rowid, $bossname, $firstkill, $lastkill, $count) {
global $user;
	$firstkill_date = bp_date2text($firstkill);
	$lastkill_date = bp_date2text($lastkill);
	$bossinfo = '<tr class="row' . ($rowid +1) . '">';
	$bossinfo .= '<td align="left">Name: ' . bp_html_get_bosslink($bossname).'</td>';
	$bossinfo .= '<td align="left">' . $user->lang['firstkill'] . $firstkill_date . '</td>';
	$bossinfo .= '<td align="left">' . $user->lang['lastkill'] . $lastkill_date . '</td>';
	$bossinfo .= '<td align="left">' . $user->lang['bosskillcount'] . $count . '</td></tr>';
	return $bossinfo;
}


function bp_html_get_zoneinfo_rp2r($conf, $data, $sbzone){
global $user;
$zonei = 1;
foreach ($sbzone as $zone => $bosses){
    $zonei = 1 - $zonei;
    $loc_killed = 0;
    foreach ($data[$zone][bosses] as $boss){
        if ($boss[kc] > 0)
            $loc_killed++;
    }
    if ($zonei == 0){
        $bpout .= '<tr><td width="50%" valign="top"><table width="100%">' . "\n";
    }else{
        $bpout .= '<td width="50%" valign="top"><table width="100%">' . "\n";
    }
    $bpout .= "\t" . '<tr><th colspan="3">'.$user->lang[$zone]['long'].'</th></tr>'. "\n";
    if ((!$conf['dynZone']) or ($loc_killed > 0)){
        $loc_completed = round($loc_killed / count($bosses) * 100);
		$bpout .= '<tr><td class="row1"></td><td class="row2"><dl style="width:197px; height:20px"><dd style="width:197px; height:20px"><div style="width:' . $loc_completed . '%; height:18px"><strong>' . $loc_completed . '%</strong></div></dd></dl></td>';
		$bpout .= '<td class="row2">'.$loc_killed .'/'. count($bosses) . '('. $loc_completed .'%)</td></tr>';
        
        $bi = 1; //row number 1/2
        $printed = 0;

        foreach($bosses as $boss){
        if ((!$conf['dynBoss']) or ($data[$zone][bosses][$boss][kc] > 0)) {
            $rowid = $bi + 1;
            if ($data[$zone][bosses][$boss][kc] > 0){
                $bpout .= "\t" . '<tr><td style="width: 25px; height: 19px" align="center" class="row1"><img src="images/bossprogress/rp/checkmark.gif" width="20" height="15" border="0" /><td class="row'. (($printed%2)+1) .'" colspan="2">'.bp_html_get_bosslink($boss).'</td></tr>'."\n";
            }else{
                $bpout .= "\t" . '<tr><td style="width: 25px; height: 19px" align="center" class="row1">&nbsp;</td><td class="row'. $rowid .'" colspan="2">'.bp_html_get_bosslink($boss).'</td></tr>'."\n";
            $bi = 1 - $bi;
            }
            $printed++;
        }
        }
		for($i = 1; $i <= (8 - $printed); $i++){
			$bpout .= '<tr><td style="width: 25px; height: 19px" align="center" class="row1">&nbsp;</td><td class="row'. ((($printed+$i-1)%2)+1) .'" colspan="2">&nbsp;</td></tr>'."\n";
		}
    if ($loc_completed == 100){
        $bpout .= '<img style="position:absolute; margin:25px 0px 0px 90px" src="images/bossprogress/rp/completed.gif" /></table></td>'."\n";
    }else{
    	$bpout .= '</table></td>'."\n";
    }
	if ($zonei == 0){
		$bpout .= '' . "\n";
    }else{
        $bpout .= '</tr>' . "\n";
    }
	}						 
}
return $bpout;
}


function bp_html_get_zoneinfo_rp3r($conf, $data, $sbzone){
global $user;
$zonei = 0;
foreach ($sbzone as $zone => $bosses){
    $loc_killed = 0;
    foreach ($data[$zone][bosses] as $boss){
        if ($boss[kc] > 0)
            $loc_killed++;
    }
    switch(($zonei%3)){
	case 0: $bpout .= '<tr><td width="33%" valign="top"><table width="100%">' . "\n";
			break;
    case 1: $bpout .= '<td width="33%" valign="top"><table width="100%">' . "\n";
			break;
	case 2: $bpout .= '<td width="33%" valign="top"><table width="100%">' . "\n";
			break;
    }
    $bpout .= "\t" . '<tr><th colspan=3>'.$user->lang[$zone]['long'].'</th></tr>'. "\n";
    $printed = 0;

	if ((!$conf['dynZone']) or ($loc_killed > 0)){
        $loc_completed = round($loc_killed / count($bosses) * 100);
		$bpout .= '<tr><td class="row1"></td><td class="row2"><dl style="width:197px; height:20px"><dd style="width:197px; height:20px"><div style="width:' . $loc_completed . '%; height:18px"><strong>' . $loc_completed . '%</strong></div></dd></dl></td>';
		$bpout .= '<td class="row2">'.$loc_killed .'/'. count($bosses) . '('. $loc_completed .'%)</td></tr>';
        foreach($bosses as $boss){
        	if ((!$conf['dynBoss']) or ($data[$zone][bosses][$boss][kc] > 0)) {
            	$rowid = ($printed%2)+1;
				if ($data[$zone][bosses][$boss][kc] > 0){
                	$bpout .= "\t" . '<tr><td style="width: 25px; height: 18px" align="center" class="row1"><img src="images/bossprogress/rp/checkmark.gif" width="20" height="15" border="0" /><td class="row'. $rowid .'" colspan="2">'.bp_html_get_bosslink($boss).'</td></tr>'."\n";
           		}else{
                	$bpout .= "\t" . '<tr><td style="width: 25px; height: 18px" align="center" class="row1">&nbsp;</td><td class="row'. $rowid . '" colspan="2">'.bp_html_get_bosslink($boss).'</td></tr>'."\n";
            	}
            	$printed++;
        	}	
        }
		//Additional lines.
		if ($printed < 8){
			for($i = 1; $i <= (8 - $printed); $i++){
				$rowid = (($printed+$i-1)%2)+1;
				$bpout .= '<tr><td style="width: 25px; height: 18px" align="center" class="row1" colspan="1">&nbsp;</td><td class="row'. $rowid .'" colspan="2">&nbsp;</td></tr>'."\n";
			}
			$printed += 8-$printed;
		}
	}
    if ($loc_completed == 100){
        $bpout .= "\t".'<img style="position:absolute; margin:' . (9*$printed-20) . 'px 0px 0px 25px" src="images/bossprogress/rp/completed.gif" />'. "\n" .'</table></td>'."\n";
    }else{
    	$bpout .= '</table></td>'."\n";
    }
    switch(($zonei%3)){
	case 0: $bpout .= "\n";
			break;
    case 1: $bpout .= "\n";
			break;
	case 2: $bpout .= '</tr>' . "\n";
			break;
    }
	$zonei++;
}
return $bpout;
}



function bp_html_get_zoneinfo_bp($conf, $data, $sbzone){
foreach ($sbzone as $zone => $bosses){
    $loc_killed = 0;
    foreach ($data[$zone][bosses] as $boss){
        if ($boss[kc] > 0)
            $loc_killed++;
    }

    if ((!$conf['dynZone']) or ($loc_killed > 0)){
        $loc_completed = round($loc_killed / count($bosses) * 100);
        $bpout .= bp_html_get_zhi($conf['zhiType'], $zone, $loc_completed);
        if($conf['showSB'])
            $bpout .= bp_html_get_zsb($zone, $loc_killed, $loc_completed, count($bosses),$data[$zone][fvd],$data[$zone][lvd],$data[$zone][kc]);
        $bi = 1; //row number 1/2
        $printed = 0;

        foreach($bosses as $boss){
        if ((!$conf['dynBoss']) or ($data[$zone][bosses][$boss][kc] > 0)) {
            $bpout .= bp_html_get_bossinfo($bi, $boss, $data[$zone][bosses][$boss][fkd], $data[$zone][bosses][$boss][lkd], $data[$zone][bosses][$boss][kc]);
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

function bp_html_get_zoneinfo_bps($conf, $data, $sbzone){
foreach ($sbzone as $zone => $bosses){
    $loc_killed = 0;
    foreach ($data[$zone][bosses] as $boss){
        if ($boss[kc] > 0)
            $loc_killed++;
    }

    if ((!$conf['dynZone']) or ($loc_killed > 0)){
        $loc_completed = round($loc_killed / count($bosses) * 100);
        $bpout .= bp_html_get_zhi($conf['zhiType'], $zone, $loc_completed);
        if($conf['showSB'])
            $bpout .= bp_html_get_zsb($zone, $loc_killed, $loc_completed, count($bosses),$data[$zone][fvd],$data[$zone][lvd],$data[$zone][kc]);
        $bi = 1; //row number 1/2
        $printed = 0;

        foreach($bosses as $boss){
        if ((!$conf['dynBoss']) or ($data[$zone][bosses][$boss][kc] > 0)) {
            $bpout .= bp_html_get_bossinfo_simple($bi, $boss, $data[$zone][bosses][$boss][fkd], $data[$zone][bosses][$boss][lkd], $data[$zone][bosses][$boss][kc]);

            $bi = 1 - $bi;
            $printed++;
        }
        }
        $bpout .= '<tr height="5"><td colspan="4"></td></tr>';
    }
}
return $bpout;
}


# Developer Output
####################################################
function bp_html_dev_out($bzone){
global $user;
$devout = "";
    foreach($bzone as $location => $bosses){
        $sfile = "zoneimages/" . $location . ".jpg";
        $nfile = "language/" . $user->lang['lang'] . "/images/zones/normal/" . $location . ".jpg";
        $pfile = "language/" . $user->lang['lang'] . "/images/zones/photo/" . $location . ".jpg";
        $swfile = "language/" . $user->lang['lang'] . "/images/zones/sw/" . $location . ".jpg";
        $font = "zoneimages/TirantiSolidLTE.ttf";

        ## Text command
        $textcom = 'convert -font ' . $font . ' -pointsize 40 -fill white -gravity Northwest -draw "text 5,5 \'';
        $textcom .= addslashes($user->lang[$location]['long']);
        $textcom .= '\'" ';

        ## Create sw and sepia image
        $swcom = 'convert ' . $sfile . ' -colorspace Gray ' . $swfile;
        $pcom = 'convert -sepia-tone 80% ' . $sfile . " " . $pfile;

        ## Add text to images
        $textn = $textcom . " " . $sfile . " " . $nfile;
        $textsw = $textcom . " " . $swfile . " " . $swfile;
        $textp = $textcom . " " . $pfile . " " . $pfile;

        ## Output for further usage
        $devout .= $swcom . "<br />";
        $devout .= $pcom . "<br />";
        $devout .= $textn . "<br />";
        $devout .= $textsw . "<br />";
        $devout .= $textp . "<br />";
    }
	return $devout;
}



function bp_date2text($date) {
global $user;
	if (($date == MAXDATE) or ($date == MINDATE)) {
		return $user->lang['never'];
	} else {
		return strftime($user->lang['dateFormat'], $date);
	}
}
?>
