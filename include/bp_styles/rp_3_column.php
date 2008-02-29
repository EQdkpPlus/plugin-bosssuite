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

function bp_html_get_zoneinfo_rp3r($conf, $data, $sbzone){
global $user;
// new link class
require_once(dirname(__FILE__).'/../bslink.class.php');
$mybslink = new BSLINK($conf['linkurl'], $conf['linklength']);

$zonei = 0;
foreach ($sbzone as $zone => $bosses){
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

	if ((!$conf['dynZone']) or ($data[$zone]['zk'] > 0)){
        $loc_completed = round($data[$zone]['zk'] / count($bosses) * 100);
		$bpout .= '<tr><td class="row1"></td><td class="row2"><dl style="width:197px; height:20px"><dd style="width:197px; height:20px"><div style="width:' . $loc_completed . '%; height:18px"><strong>' . $loc_completed . '%</strong></div></dd></dl></td>';
		$bpout .= '<td class="row2">'.$data[$zone]['zk'] .'/'. count($bosses) . '('. $loc_completed .'%)</td></tr>';
        foreach($bosses as $boss){
        	if ((!$conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)) {
            	$rowid = ($printed%2)+1;
				if ($data[$zone]['bosses'][$boss][kc] > 0){
                	$bpout .= "\t" . '<tr><td style="width: 25px; height: 18px" align="center" class="row1"><img src="images/bossprogress/rp/checkmark.gif" width="20" height="15" border="0" /><td class="row'. $rowid .'" colspan="2">'.$mybslink->get_boss_link($boss).'</td></tr>'."\n";
           		}else{
                	$bpout .= "\t" . '<tr><td style="width: 25px; height: 18px" align="center" class="row1">&nbsp;</td><td class="row'. $rowid . '" colspan="2">'.$mybslink->get_boss_link($boss).'</td></tr>'."\n";
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

function bp_date2text($date) {
global $user;
	if (($date == BS_MAX_DATE) or ($date == BS_MIN_DATE)) {
		return $user->lang['never'];
	} else {
		return strftime($user->lang['dateFormat'], $date);
	}
}
?>
