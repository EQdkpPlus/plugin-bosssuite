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

function bp_html_get_zoneinfo_rp2r($conf, $data, $sbzone){
global $user;
// new link class
require_once(dirname(__FILE__).'/../bslink.class.php');
$mybslink = new BSLINK($conf['linkurl'], $conf['linklength']);

$zonei = 1;
foreach ($sbzone as $zone => $bosses){
    $zonei = 1 - $zonei;
    if ($zonei == 0){
        $bpout .= '<tr><td width="50%" valign="top"><table width="100%">' . "\n";
    }else{
        $bpout .= '<td width="50%" valign="top"><table width="100%">' . "\n";
    }
    $bpout .= "\t" . '<tr><th colspan="3">'.$user->lang[$zone]['long'].'</th></tr>'. "\n";
    if ((!$conf['dynZone']) or ($data[$zone]['zk'] > 0)){
        $loc_completed = round($data[$zone]['zk'] / count($bosses) * 100);
		$bpout .= '<tr><td class="row1"></td><td class="row2"><dl style="width:197px; height:20px"><dd style="width:197px; height:20px"><div style="width:' . $loc_completed . '%; height:18px"><strong>' . $loc_completed . '%</strong></div></dd></dl></td>';
		$bpout .= '<td class="row2">'.$data[$zone]['zk'] .'/'. count($bosses) . '('. $loc_completed .'%)</td></tr>';
        
        $bi = 1; //row number 1/2
        $printed = 0;

        foreach($bosses as $boss){
        if ((!$conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)) {
            $rowid = $bi + 1;
            if ($data[$zone]['bosses'][$boss]['kc'] > 0){
                $bpout .= "\t" . '<tr><td style="width: 25px; height: 19px" align="center" class="row1"><img src="images/bossprogress/rp/checkmark.gif" width="20" height="15" border="0" /><td class="row'. (($printed%2)+1) .'" colspan="2">'.$mybslink->get_boss_link($boss).'</td></tr>'."\n";
            }else{
                $bpout .= "\t" . '<tr><td style="width: 25px; height: 19px" align="center" class="row1">&nbsp;</td><td class="row'. $rowid .'" colspan="2">'.$mybslink->get_boss_link($boss).'</td></tr>'."\n";
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

function bp_date2text($date) {
global $user;
	if (($date == BS_MAX_DATE) or ($date == BS_MIN_DATE)) {
		return $user->lang['never'];
	} else {
		return strftime($user->lang['dateFormat'], $date);
	}
}
?>
