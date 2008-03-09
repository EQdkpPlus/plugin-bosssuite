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

if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') )
{
	message_die('BossSuite plugin not installed.');
}

# Check whether the current game is supported
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
  # Get configuration data
  ####################################################
  require(dirname(__FILE__).'/include/bpsql.class.php');
  $mybpsql = new BPSQL();
  
  $sbzone = $mybpsql->get_bzone('bossprogress');
  $bb_conf = $mybpsql->get_config('bossbase');
  $bp_conf = $mybpsql->get_config('bossprogress');
  
  # Get data
  ####################################################
  $data = $mybpsql->get_data($bb_conf, $sbzone);
  
  # Get output
  ####################################################
  $mybsmgs->load_game_specific_language('bossbase');
  switch ($bp_conf['style']){
  	case 0:	require_once(dirname(__FILE__).'/include/bp_styles/bp_style.php');
            $bpout = bp_html_get_zoneinfo_bp($bp_conf, $data, $sbzone);
  			break; 	
  	case 1: require_once(dirname(__FILE__).'/include/bp_styles/bp_style_simple.php');
            $bpout = bp_html_get_zoneinfo_bps($bp_conf, $data, $sbzone);
  			break;
  	case 2: require_once(dirname(__FILE__).'/include/bp_styles/rp_2_column.php');
            $bpout = bp_html_get_zoneinfo_rp2r($bp_conf, $data, $sbzone);
  			break;
  	case 3: require_once(dirname(__FILE__).'/include/bp_styles/rp_3_column.php');
            $bpout = bp_html_get_zoneinfo_rp3r($bp_conf, $data, $sbzone);
  			break;
  }

}

require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/init.pwc.php'); 
$bs_bp_wpfccore = new InitWPFC($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/');
require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/jquery.class.php'); 
$bs_bp_jquery = new jQuery($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/'); 

# Assign Vars
####################################################
$tpl->assign_vars(array (
	'BOSSKILLVV' => $bpout,
	'JS_ABOUT' => $bs_bp_jquery->Dialog_URL('About', $user->lang['bs_about_header'], 'about.php', '400', '400'),
	'L_CREDITS' => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
	'BS_INFO_IMG' => 'images/credits/info.png',
));

$eqdkp->set_vars(array (
	'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['is_title_bossprogress'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'bossprogress.html',
	'display' => true)
	);
	
?>
