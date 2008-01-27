<?php
/******************************
 * EQdkp BossBase
 * by sz3
 * 
 * Additional Credits should go to 
 * Corgan's bosscounter mod
 * Wallenium's ItemSpecials plugin
 * Magnus' raidprogress plugin
 * 
 * which all lend inspiration and/or code bits 
 *  
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * settings.php
 * 22.01.07 sz3
 ******************************/

// EQdkp required files/vars
define('EQDKP_INC', true);
define('IN_ADMIN', true);
define('PLUGIN', 'bosssuite');

$eqdkp_root_path = './../../../';
include_once($eqdkp_root_path . 'common.php');

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

$bzone = $mybsmgs->get_bzone();

$bs_conf = $mybssql->get_config('bossbase');
$pzrow = $mybssql->get_parse_zone();
$pbrow = $mybssql->get_parse_boss();

// Saving
if ($_POST['bpsavebu']){
  	// global config
	$mybssql->update_config('bossbase', $bs_conf, 'zoneInfo', $_POST['zoneInfo']);
	$mybssql->update_config('bossbase', $bs_conf, 'bossInfo', $_POST['bossInfo']);
	$mybssql->update_config('bossbase', $bs_conf, 'noteDelim', $_POST['notedelim']);
	$mybssql->update_config('bossbase', $bs_conf, 'nameDelim', $_POST['namedelim']);
	$mybssql->update_config('bossbase', $bs_conf, 'tables', $_POST['tables']);
	$mybssql->update_config('bossbase', $bs_conf, 'source', $_POST['source']);
	foreach ($bzone as $zoneid => $bosslist){
		$mybssql->update_parse_zone($pzrow, $zoneid, $_POST['pz_'.$zoneid]);
		foreach ($bosslist as $bossid){
			$mybssql->update_parse_boss($pbrow, $bossid, $_POST['pb_'.$bossid]);
		}
	}
}

$bs_conf = $mybssql->get_config('bossbase');
$pzrow = $mybssql->get_parse_zone();
$pbrow = $mybssql->get_parse_boss();

$arrvals = array (
  'CREDITS' => $user->lang['bs_credits1'] . $pm->get_data('bosssuite', 'version') . $user->lang['bs_credits2'],
	'F_CONFIG' => 'settings.php' . $SID,

	'BP_NOTEDELIM' => $bs_conf['noteDelim'],
	'BP_NAMEDELIM' => $bs_conf['nameDelim'],
	'BP_TABLES' => $bs_conf['tables'],
	'ZONEINFO_SEL_RNAME'    => ( $bs_conf['zoneInfo'] == "rname" ) ? ' selected="selected"' : '',
	'ZONEINFO_SEL_RNOTE'    => ( $bs_conf['zoneInfo'] == "rnote" ) ? ' selected="selected"' : '',
	'BOSSINFO_SEL_RNAME'    => ( $bs_conf['bossInfo'] == "rname" ) ? ' selected="selected"' : '',
	'BOSSINFO_SEL_RNOTE'    => ( $bs_conf['bossInfo'] == "rnote" ) ? ' selected="selected"' : '',	
	
	// Language
	'L_GENERAL' => $user->lang['bs_al_general'],
	'L_NOTEDELIM' => $user->lang['bs_al_delimRNO'],
  'L_NAMEDELIM' => $user->lang['bs_al_delimRNA'],
  'L_TABLES' => $user->lang['bs_al_tables'],
  'L_PINFO' => $user->lang['bs_al_parseInfo'],
  'L_SUBMIT' => $user->lang['bs_al_submit'],
	'L_ZONEINFO' => $user->lang['bs_al_zoneInfo'],
	'L_BOSSINFO' => $user->lang['bs_al_bossInfo'],
	'L_RNAME' => $user->lang['bs_ao_rname'],
	'L_RNOTE' => $user->lang['bs_ao_rnote'],
	'L_SOURCE' => $user->lang['bs_al_source'],

);

$bs_source['database'] = $user->lang['bs_source_db'];
$bs_source['offsets'] = $user->lang['bs_source_offs'];
$bs_source['both'] = $user->lang['bs_source_both'];

foreach ($bs_source as $value => $option) {
	$tpl->assign_block_vars('source_row', array (
		'VALUE' => $value,
		'SELECTED' => ($bs_conf['source'] == $value) ? ' selected="selected"' : '',
		'OPTION' => $option
		)
	);
}

//Parse string settings
$zbcode = '<div id="container"><div id="vertical_container">';
foreach ($bzone as $zoneid => $bosslist){
  $zbcode .= '<h2 class="accordion_toggle">'.$user->lang[$zoneid]['long'].'</h2>'."\n";
  $zbcode .= "\t".'<div class="accordion_content">'."\n";
  $zbcode .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
  $zbcode .= "\t\t".'<tr><td width="40%" class="row2">' . $user->lang['bs_al_parse'].$user->lang[$zoneid]['long']. '</td>';
  $zbcode .= '<td width="60%" class="row1"><input type="text" name="pz_' . $zoneid .'" size="64" value="' . $pzrow['pz_'.$zoneid] . '" class="input" /></td></tr>'."\n";

  foreach ($bosslist as $bossid){
    $zbcode .= "\t\t".'<tr><td class="row2">' . $user->lang['bs_al_parse'].$user->lang[$bossid]['long'] . '</td>'; 
    $zbcode .= '<td class="row1"><input type="text" name="pb_' . $bossid .'" size="64" value="' . $pbrow['pb_'.$bossid] .'" class="input" /></td></tr>'."\n";
  }
  
  $zbcode .= "\t\t</table></div>\n";
}

$arrvals['PARSE_CONFIG'] = $zbcode.'</div></div>';

//Output
$tpl->assign_vars($arrvals);

$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bs_am_conf'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'admin/settings.html', 'display' => true
	)
);
