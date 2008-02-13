<?php
/******************************
 * EQdkp Bossprogress2
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
 * bossprogress.php
 * 02.10.06 sz3
 * 16.04.07 sz3
 ******************************/

define('EQDKP_INC', true);
define('PLUGIN', 'bosssuite');

$eqdkp_root_path = './../../';
include_once ($eqdkp_root_path . 'common.php');

global $user;

$user->check_auth('u_bosssuite_bp_view');

require_once(dirname(__FILE__).'/include/bp_functions.php');
require_once(dirname(__FILE__).'/include/bp_htmlfunc.php');


if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') )
{
	message_die('BossSuite plugin not installed.');
}


# Get configuration data from the database
####################################################
// new mgs class
require(dirname(__FILE__).'/include/bsmgs.class.php');
$mybsmgs = new BSMGS();

if (!$mybsmgs->game_supported('bossbase')){
  $bcout = '<table width=100% class="borderless" cellspacing="0" cellpadding="2">
		        <tr><th colspan="2" align="center">BossCounter</th></tr>'."\n".
	         '<td>GAME NOT SUPPORTED!</td></tr></table>';
	$bchout = '<table cellpadding=2 cellspacing=0 border=0 width='.$BKtablewidth.' align=center>'."\n".
	          '<tr><td>GAME NOT SUPPORTED</td></tr></table>';
}else{

$mybsmgs->load_game_specific_language('bossbase');

// sql class
require(dirname(__FILE__).'/include/bssql.class.php');
$mybssql = new BSSQL();

$bzone = $mybsmgs->get_bzone();
$bb_conf = $mybssql->get_config('bossbase');
$bb_pboss = $mybssql->get_parse_boss();
$bb_pzone = $mybssql->get_parse_zone();
$bp_conf = $mybssql->get_config('bossprogress');
//$bzone = bb_get_bzone();
$sbzone = $bzone;//bc_get_visible_bzone($bzone, $bc_conf);

# Get data from database
####################################################
if ($bb_conf['source'] == 'database'){
	$data = bp_init_data_array($bzone);
	$data = bp_fetch_bzi($sbzone, $data, $bb_conf, $bb_pzone, $bb_pboss);
}
if ($bb_conf['source'] == 'offsets'){
	$bb_boffs = $mybssql->get_boss_offsets();
	$bb_zoffs = $mybssql->get_zone_offsets();
	foreach($bzone as $zone => $bosses){
		$data[$zone]['fvd'] = $bb_zoffs[$zone]['fd'];
		$data[$zone]['lvd'] = $bb_zoffs[$zone]['ld'];
		$data[$zone]['vc'] = $bb_zoffs[$zone]['counter'];		
		foreach($bosses as $boss){
			$data[$zone][bosses][$boss]['fkd'] = $bb_boffs[$boss]['fd'];
			$data[$zone][bosses][$boss]['lkd'] = $bb_boffs[$boss]['ld'];
			$data[$zone][bosses][$boss]['kc'] = $bb_boffs[$boss]['counter'];		
		}
	}
}
if ($bb_conf['source'] == 'both'){
	$bb_boffs = $mybssql->get_boss_offsets();
	$bb_zoffs = $mybssql->get_zone_offsets();
	foreach($bzone as $zone => $bosses){
		$data[$zone]['fvd'] = $bb_zoffs[$zone]['fd'];
		$data[$zone]['lvd'] = $bb_zoffs[$zone]['ld'];
		$data[$zone]['vc'] = $bb_zoffs[$zone]['counter'];		
		foreach($bosses as $boss){
			$data[$zone][bosses][$boss]['fkd'] = $bb_boffs[$boss]['fd'];
			$data[$zone][bosses][$boss]['lkd'] = $bb_boffs[$boss]['ld'];
			$data[$zone][bosses][$boss]['kc'] = $bb_boffs[$boss]['counter'];		
		}
	}
	$data = bp_fetch_bzi($sbzone, $data, $bb_conf, $bb_pzone, $bb_pboss);	
}

# Output
####################################################
switch ($bp_conf['style']){
	case 0:	$bpout = bp_html_get_zoneinfo_bp($bp_conf, $data, $sbzone);
			break; 	
	case 1: $bpout = bp_html_get_zoneinfo_bps($bp_conf, $data, $sbzone);
			break;
	case 2: $bpout = bp_html_get_zoneinfo_rp2r($bp_conf, $data, $sbzone);
			break;
	case 3: $bpout = bp_html_get_zoneinfo_rp3r($bp_conf, $data, $sbzone);
			break;
}

# Developer Output
####################################################
#$bpout = bp_html_dev_out($bzone);
}
# Assign Vars
####################################################
$tpl->assign_vars(array (
	'BOSSKILLVV' => $bpout,
	'CREDITS' => $credits1 . $pm->get_data('bosssuite', 'version') . $credits2
));

$eqdkp->set_vars(array (
	'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['is_title_bossprogress'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'bossprogress.html',
	'display' => true)
	);
	
?>
