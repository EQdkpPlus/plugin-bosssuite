<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id$
 ******************************/

define('EQDKP_INC', true);
define('PLUGIN', 'bosssuite');

$eqdkp_root_path = './../../';
include_once ($eqdkp_root_path . 'common.php');
include_once($eqdkp_root_path . 'itemstats/eqdkp_itemstats.php');

$user->check_auth('u_bosssuite_bp_view');

if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') )
{
	message_die('BossSuite plugin not installed.');
}

if (isset($_GET['item'])){
  $item = stripslashes(urldecode($_GET['item']));
  $bs_item_out = itemstats_get_html($item);
} else {
  $bs_item_out = "No item!";
}

require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/init.pwc.php'); 
$bs_bp_wpfccore = new InitWPFC($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/');
require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/jquery.class.php'); 
$bs_bp_jquery = new jQuery($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/'); 

# Assign Vars
####################################################
$tpl->assign_vars(array (
  'L_ITEMNAME' => $user->lang['bs_updateitem_l_name'],
  'ITEM_NAME' => $item,
	'ITEM_OUT' => $bs_item_out,
	'JS_ABOUT' => $bs_bp_jquery->Dialog_URL('About', $user->lang['bs_about_header'], 'about.php', '400', '400'),
	'L_CREDITS' => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
	'BS_INFO_IMG' => 'images/credits/info.png',
));

$eqdkp->set_vars(array (
	'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['is_title_bossprogress'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'bossitem.html',
	'display' => true)
	);
	
?>
