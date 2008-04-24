<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id$
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
require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/init.pwc.php'); 
$bs_adm_wpfccore = new InitWPFC($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/');
require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/jquery.class.php'); 
$bs_adm_jquery = new jQuery($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/'); 

require_once(dirname(__FILE__).'/lang/english/lang_usage.php');

# Assign Vars
####################################################
$tpl->assign_vars(array (
	'USAGE'         => $usage_html,
	'JS_ABOUT'      => $bs_adm_jquery->Dialog_URL('About', $user->lang['bs_about_header'], '../about.php', '400', '400'),
	'L_CREDITS'     => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
		'BS_INFO_IMG'   => '../images/credits/info.png',
));

$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bs_am_conf'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'docs/usage.html', 'display' => true
	)
);
