<?php
/******************************
 * EQdkp BossBase
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
define('PLUGIN', 'bossbase');

$eqdkp_root_path = './../../../';
include_once ($eqdkp_root_path . 'common.php');

// Check user permission
$user->check_auth('a_bossbase_offs');

if (!$pm->check(PLUGIN_INSTALLED, 'bossbase')) {
	message_die('The BossBase plugin is not installed.');
}

require_once (dirname(__FILE__).'/../include/functions.php');
require_once (dirname(__FILE__).'/../include/extfunc.php');

$bzone = bb_get_bzone();

// Saving
if ($_POST['bpsavebu']){
	$offsets = bb_get_offsets();
	foreach ($bzone as $zoneid => $bosslist){
		$fdate = mktime(0,0,0,$_POST['fdm_'.$zoneid],$_POST['fdd_'.$zoneid],$_POST['fdY_'.$zoneid]);
		$ldate = mktime(0,0,0,$_POST['ldm_'.$zoneid],$_POST['ldd_'.$zoneid],$_POST['ldY_'.$zoneid]);
		bb_update_offsets($offsets, $zoneid, $fdate, $ldate, $_POST['co_'.$zoneid]);

		foreach ($bosslist as $bossid){
			$fdate = mktime(0,0,0,$_POST['fdm_'.$bossid],$_POST['fdd_'.$bossid],$_POST['fdY_'.$bossid]);
			$ldate = mktime(0,0,0,$_POST['ldm_'.$bossid],$_POST['ldd_'.$bossid],$_POST['ldY_'.$bossid]);
			bb_update_offsets($offsets, $bossid, $fdate, $ldate, $_POST['co_'.$bossid]);
		}
	}
}

$offsets = bb_get_offsets();

$arrvals = array (
	'CREDITS' => $user->lang['bb_credits1'] . $pm->get_data('bossbase', 'version') . $user->lang['bb_credits2'],
	'F_CONFIG' => 'offsets.php' . $SID,
	'L_OFFSET_INFO' => $user->lang['bb_ol_dateFormat'],
	'L_SUBMIT' => $user->lang['bb_ol_submit']
);

$zbcode = '<div id="container"><div id="vertical_container">';

foreach ($bzone as $zoneid => $bosslist){
	$zbcode .= '<h2 class="accordion_toggle">'.$user->lang[$zoneid]['long'].'</h2>'."\n";
    $zbcode .= "\t".'<div class="accordion_content">'."\n";

	$zbcode .= '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
    $zbcode .= '<tr><th>'.$user->lang['bb_ol_in'].'</th><th>'.$user->lang['bb_ol_fd'].'</th><th>'.$user->lang['bb_ol_ld'].'</th><th>'.$user->lang['bb_ol_co'].'</th></tr>';
    
   	$zbcode .= '<tr>';
	$zbcode .= '<td width="40%" class="row2">' .$user->lang[$zoneid]['long']. '</td>';
	$zbcode .= '<td class="row1">';
		$zbcode .= '<input type="text" name="fdm_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%m',$offsets[$zoneid]['fd']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="fdd_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%d',$offsets[$zoneid]['fd']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="fdY_' . $zoneid .'" size="5" maxlength="4" value="' . strftime('%Y',$offsets[$zoneid]['fd']) .'" class="input" />';
	$zbcode .= '</td>';
	$zbcode .= '<td class="row1">';
		$zbcode .= '<input type="text" name="ldm_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%m',$offsets[$zoneid]['ld']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="ldd_' . $zoneid .'" size="3" maxlength="2" value="' . strftime('%d',$offsets[$zoneid]['ld']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="ldY_' . $zoneid .'" size="5" maxlength="4" value="' . strftime('%Y',$offsets[$zoneid]['ld']) .'" class="input" />';
	$zbcode .= '</td>';
    $zbcode .= '<td class="row1"><input type="text" name="co_' . $zoneid .'" size="3" value="' . $offsets[$zoneid]['counter'] . '" class="input" /></td>';
	
	$zbcode .= '</tr>';
			
   	foreach ($bosslist as $bossid){
		$zbcode .= '<tr>';
		$zbcode .= '<td class="row2">' . $user->lang[$bossid]['long'] . '</td>';
		$zbcode .= '<td class="row1">';
		$zbcode .= '<input type="text" name="fdm_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%m',$offsets[$bossid]['fd']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="fdd_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%d',$offsets[$bossid]['fd']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="fdY_' . $bossid .'" size="5" maxlength="4" value="' . strftime('%Y',$offsets[$bossid]['fd']) .'" class="input" />';
		$zbcode.= '</td>';
		$zbcode .= '<td class="row1">';
		$zbcode .= '<input type="text" name="ldm_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%m',$offsets[$bossid]['ld']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="ldd_' . $bossid .'" size="3" maxlength="2" value="' . strftime('%d',$offsets[$bossid]['ld']) .'" class="input" />/';
		$zbcode .= '<input type="text" name="ldY_' . $bossid .'" size="5" maxlength="4" value="' . strftime('%Y',$offsets[$bossid]['ld']) .'" class="input" />';
		$zbcode.= '</td>';
		$zbcode .= '<td class="row1"><input type="text" name="co_' . $bossid .'" size="3" value="' . $offsets[$bossid]['counter'] .'" class="input" /></td>';
		
		$zbcode .= '</tr>';
	}
    
  	$zbcode .= "</table></div>";
	$arrvals['OFFSET_CONFIG'] = $zbcode.'</div></div>';
}

//Output
$tpl->assign_vars($arrvals);

$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bb_conf_pagetitle'],
	'template_path' => $pm->get_data('bossbase', 'template_path'),
	'template_file' => 'admin/offsets.html',
	'display' => true
	)
);
