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
$user->check_auth('a_bosssuite_conf');

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
if ($_POST['bs_refresh']){
    require(dirname(__FILE__).'/../mods/data2cache.php');
    bs_data2cache();
}

$bs_cache = $mybssql->get_cache();


$arrvals = array (
	'CREDITS' => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
	'F_CONFIG' => 'cache.php' . $SID,
	'L_CACHE_INFO' => $user->lang['bs_adm_cache_info'],
	'L_REFRESH' => $user->lang['bs_adm_cache_refresh']
);

foreach ($bzone as $zoneid => $bosslist){   
    $zbcode .= '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
    $zbcode .= '<tr><th colspan="4">'.$user->lang[$zoneid]['long'].'</th></tr>';
    $zbcode .= '<tr><th>'.$user->lang['bs_ol_in'].'</th><th>'.$user->lang['bs_ol_fd'].'</th><th>'.$user->lang['bs_ol_ld'].'</th><th>'.$user->lang['bs_ol_co'].'</th></tr>';
    
    $zbcode .= '<tr>';
    $zbcode .= '<td width="40%" class="row2">' .$user->lang[$zoneid]['long'] . '</td>';
    $zbcode .= '<td class="row1">' . bs_date2text($bs_cache[$zoneid]['fvd']) . '</td>';
    $zbcode .= '<td class="row1">' . bs_date2text($bs_cache[$zoneid]['lvd']) . '</td>';
    $zbcode .= '<td class="row1">' . $bs_cache[$zoneid]['vc'] . '</td>';
    $zbcode .= '</tr>';
			
   	foreach ($bosslist as $bossid){
    		$zbcode .= '<tr>';
    		$zbcode .= '<td class="row2">' . $user->lang[$bossid]['long'] . '</td>';
    		$zbcode .= '<td class="row1">' . bs_date2text($bs_cache[$bossid]['fkd']) . '</td>';
    		$zbcode .= '<td class="row1">' . bs_date2text($bs_cache[$bossid]['lkd']) . '</td>';
        $zbcode .= '<td class="row1">' . $bs_cache[$bossid]['kc'] . '</td>';
    		$zbcode .= '</tr>';
	  }
  $zbcode .= "</table>";
	$arrvals['CACHE_OUTPUT'] = $zbcode;
}

function bs_date2text($date) {
global $user;
	if (($date == BS_MAX_DATE) or ($date == BS_MIN_DATE)) {
		return $user->lang['never'];
	} else {
		return strftime($user->lang['dateFormat'], $date);
	}
}

//Output
$tpl->assign_vars($arrvals);

$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bs_conf_pagetitle'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'admin/cache.html',
	'display' => true
	)
);
