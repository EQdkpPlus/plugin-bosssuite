<?php
/******************************
 * EQdkp BossSuite4
 * by sz3
 * 
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * offsets.php
 * 01.05.07 sz3
 ******************************/

// EQdkp required files/vars
define('EQDKP_INC', true);
define('IN_ADMIN', true);
define('PLUGIN', 'bosssuite');

$eqdkp_root_path = './../../../';
include_once ($eqdkp_root_path . 'common.php');

// Check user permission
$user->check_auth('a_bosssuite_offs');

if (!$pm->check(PLUGIN_INSTALLED, 'bosssuite')) {
	message_die('The BossSuite plugin is not installed.');
}

// new mgs class
require(dirname(__FILE__).'/../include/bsmgs.class.php');
$mybsmgs = new BSMGS();
if (!$mybsmgs->game_supported('bossbase'))
  message_die("GAME NOT SUPPORTED");

$mybsmgs->load_game_specific_language('bossbase');

// sql class
require(dirname(__FILE__).'/../include/bssql.class.php');
$mybssql = new BSSQL();

$bzone = $mybssql->get_bzone();

// Saving
if ($_POST['bpsavebu']){
	$boss_offsets = $mybssql->get_boss_offsets();
	$zone_offsets = $mybssql->get_zone_offsets();
	
	foreach ($bzone as $zoneid => $bosslist){
		/*$fdate = mktime(0,0,0,$_POST['fdm_'.$zoneid],$_POST['fdd_'.$zoneid],$_POST['fdY_'.$zoneid]);
		$ldate = mktime(0,0,0,$_POST['ldm_'.$zoneid],$_POST['ldd_'.$zoneid],$_POST['ldY_'.$zoneid]);*/
		$fdate = bs_text2date($_POST['dp_fd_'.$zoneid], true);
		$ldate = bs_text2date($_POST['dp_ld_'.$zoneid], false);
    $mybssql->update_zone_offsets($zone_offsets, $zoneid, $fdate, $ldate, $_POST['co_'.$zoneid]);

		foreach ($bosslist as $bossid){
			/*$fdate = mktime(0,0,0,$_POST['fdm_'.$bossid],$_POST['fdd_'.$bossid],$_POST['fdY_'.$bossid]);
			$ldate = mktime(0,0,0,$_POST['ldm_'.$bossid],$_POST['ldd_'.$bossid],$_POST['ldY_'.$bossid]);*/
			$fdate = bs_text2date($_POST['dp_fd_'.$bossid], true);
		  $ldate = bs_text2date($_POST['dp_ld_'.$bossid], false);
			$mybssql->update_boss_offsets($boss_offsets, $bossid, $fdate, $ldate, $_POST['co_'.$bossid]);
		}
	}
}

$boss_offsets = $mybssql->get_boss_offsets();
$zone_offsets = $mybssql->get_zone_offsets();

# Output
####################################################
require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/init.pwc.php'); 
$bs_adm_wpfccore = new InitWPFC($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/');
require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/jquery.class.php'); 
$bs_adm_jquery = new jQuery($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/'); 

$bs_off_acc_array = array();

foreach ($bzone as $zoneid => $bosslist){
    $acc_title = '<table width="100%"><tr style="cursor:pointer;"><th>'.$user->lang[$zoneid]['long'].'</th></tr></table>'."\n";
    
    $zbcode = '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
    $zbcode .= '<tr><th>'.$user->lang['bs_ol_in'].'</th><th>'.$user->lang['bs_ol_fd'].'</th><th>'.$user->lang['bs_ol_ld'].'</th><th>'.$user->lang['bs_ol_co'].'</th></tr>';    
    $zbcode .= '<tr>';
    $zbcode .= '<td width="40%" class="row2">' .$user->lang[$zoneid]['long']. '</td>';
    $zbcode .= '<td class="row1">';
    $zbcode .= $bs_adm_jquery->Calendar("dp_fd_".$zoneid, bs_date2text($zone_offsets[$zoneid]['fd']), '', $user->lang['bs_out_date_format']);
    //$zbcode .= '<input type="text" name="fdm_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%m',$zobe_offsets[$zoneid]['fd']) .'" class="input" />/';
    //$zbcode .= '<input type="text" name="fdd_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%d',$zone_offsets[$zoneid]['fd']) .'" class="input" />/';
    //$zbcode .= '<input type="text" name="fdY_' . $zoneid .'" size="5" maxlength="4" value="' . strftime('%Y',$zone_offsets[$zoneid]['fd']) .'" class="input" />';
    $zbcode .= '</td>';
    $zbcode .= '<td class="row1">';
    $zbcode .= $bs_adm_jquery->Calendar("dp_ld_".$zoneid, bs_date2text($zone_offsets[$zoneid]['ld']), '', $user->lang['bs_out_date_format']);
    //$zbcode .= '<input type="text" name="ldm_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%m',$zone_offsets[$zoneid]['ld']) .'" class="input" />/';
    //$zbcode .= '<input type="text" name="ldd_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%d',$zone_offsets[$zoneid]['ld']) .'" class="input" />/';
    //$zbcode .= '<input type="text" name="ldY_' . $zoneid .'" size="5" maxlength="4" value="' . strftime('%Y',$zone_offsets[$zoneid]['ld']) .'" class="input" />';
    $zbcode .= '</td>';
    $zbcode .= '<td class="row1"><input type="text" name="co_' . $zoneid .'" size="3" value="' . $zone_offsets[$zoneid]['counter'] . '" class="input" /></td>';
    $zbcode .= '</tr>';
			
   	foreach ($bosslist as $bossid){
    		$zbcode .= '<tr>';
    		$zbcode .= '<td class="row2">' . $user->lang[$bossid]['long'] . '</td>';
    		$zbcode .= '<td class="row1">';
    		$zbcode .= $bs_adm_jquery->Calendar("dp_fd_".$bossid, bs_date2text($boss_offsets[$bossid]['fd']), '', $user->lang['bs_out_date_format']);
    		//$zbcode .= '<input type="text" name="fdm_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%m',$boss_offsets[$bossid]['fd']) .'" class="input" />/';
    		//$zbcode .= '<input type="text" name="fdd_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%d',$boss_offsets[$bossid]['fd']) .'" class="input" />/';
    		//$zbcode .= '<input type="text" name="fdY_' . $bossid .'" size="5" maxlength="4" value="' . strftime('%Y',$boss_offsets[$bossid]['fd']) .'" class="input" />';
    		$zbcode.= '</td>';
    		$zbcode .= '<td class="row1">';
    		$zbcode .= $bs_adm_jquery->Calendar("dp_ld_".$bossid, bs_date2text($boss_offsets[$bossid]['ld']), '', $user->lang['bs_out_date_format']);
        //$zbcode .= '<input type="text" name="ldm_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%m',$boss_offsets[$bossid]['ld']) .'" class="input" />/';
    		//$zbcode .= '<input type="text" name="ldd_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%d',$boss_offsets[$bossid]['ld']) .'" class="input" />/';
    		//$zbcode .= '<input type="text" name="ldY_' . $bossid .'" size="5" maxlength="4" value="' . strftime('%Y',$boss_offsets[$bossid]['ld']) .'" class="input" />';
    		$zbcode.= '</td>';
    		$zbcode .= '<td class="row1"><input type="text" name="co_' . $bossid .'" size="3" value="' . $boss_offsets[$bossid]['counter'] .'" class="input" /></td>';
    		$zbcode .= '</tr>';
	  }
	  $zbcode .= '</table>';
	  
    $bs_off_acc_array[$acc_title] = $zbcode;
}

//Output
$tpl->assign_vars(array(
	'F_CONFIG'      => 'offsets.php' . $SID,
	'L_OFFSET_INFO' => $user->lang['bs_ol_dateFormat'].$user->lang['bs_out_date_format'],
	'L_SUBMIT'      => $user->lang['bs_ol_submit'],
  'OFFSET_CONFIG' => $bs_adm_jquery->accordion('bs_off_accordion', $bs_off_acc_array),
  'JS_ABOUT'      => $bs_adm_jquery->Dialog_URL('About', $user->lang['bs_about_header'], '../about.php', '400', '400'),
	'L_CREDITS'     => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
	'BS_INFO_IMG'   => '../images/credits/info.png',
  ));

$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bs_conf_pagetitle'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'admin/offsets.html',
	'display' => true
	)
);

function bs_date2text($date) {
global $user;
	if (($date == BS_MAX_DATE) or ($date == BS_MIN_DATE)) {
		return '';
	} else {
		return strftime($user->lang['dateFormat'], $date);
	}
}

function bs_text2date($text, $max_date) {
  global $user;
  if (($text == $user->lang['never']) || ($text == '')){
    if ($max_date){
      return BS_MAX_DATE;
    } else {
      return BS_MIN_DATE;
    }
  } else {
    $day = substr($text, $user->lang['bs_date_day']['start'], $user->lang['bs_date_day']['length']);
    $month = substr($text, $user->lang['bs_date_month']['start'], $user->lang['bs_date_month']['length']);
    $year = substr($text, $user->lang['bs_date_year']['start'], $user->lang['bs_date_year']['length']);
    return mktime(0,0,0,$month,$day,$year);
  }
}

?>
