<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date: 2008-10-09 14:32:18 +0200 (Do, 09 Okt 2008) $
 * -----------------------------------------------------------------------
 * @author      $Author: sz3 $
 * @copyright   2006-2008 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev: 2790 $
 *
 * $Id: settings.php 2790 2008-10-09 12:32:18Z sz3 $
 */

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

//get zone/boss data, not a nice fix, but will prevent empty default strings
$mybssql->get_parse_zone();
$mybssql->get_parse_boss();

//Framework include
include_once($eqdkp_root_path . 'plugins/bosssuite/include/libloader.inc.php');
$wpfccore->InitAdmin();

$bzone = $mybssql->get_bzone();
foreach ($bzone as $zoneid => $bosslist){
  $html_conf_pack .= '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
  $html_conf_pack .= '<tr><th width="70%">'.$user->lang[$zoneid]['long'].'</th><th>&nbsp;</th></tr>';    
  $html_conf_pack .= '<tr class="'.$eqdkp->switch_row_class().'">';
  $html_conf_pack .= '<td>' .$user->lang[$zoneid]['long']. '</td>';
  $html_conf_pack .= '<td>'.bs_gen_popup_link('zone', $zoneid).'</td>';
  $html_conf_pack .= '</tr>';

 	foreach ($bosslist as $bossid){
  	$html_conf_pack .= '<tr class="'.$eqdkp->switch_row_class().'">';
    $html_conf_pack .= '<td>' .$user->lang[$bossid]['long']. '</td>';
    $html_conf_pack .= '<td>'.bs_gen_popup_link('boss', $bossid).'</td>';
    $html_conf_pack .= '</tr>';
  }
  $html_conf_pack .= '</table>';
}

$tpl->assign_vars(array(
	'F_CONFIG' => 'bzone.php' . $SID,
  'CONFIGURE_PACK'  => $html_conf_pack,
  'JS_POPUP_FUNC' =>  $jquery->Dialog_URL('BS_ENTITY_CONF', $user->lang['bs_am_conf'], "entity_conf.php?mode='+mode+'&entity='+entity+'", '640', '200'),
  'JS_ABOUT' => $jquery->Dialog_URL('About', $user->lang['bs_about_header'], '../about.php', '500', '600'),
	'L_CREDITS' => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
  'JQUERY_INCLUDES'   => $jquery->Header(),
	'BS_INFO_IMG' => '../images/credits/info.png',
));

$eqdkp->set_vars(array(
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bs_am_conf'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'admin/bzone.html',
  'display' => true
));

function bs_gen_popup_link($mode, $entity){
global $user, $jquery;
  return '<a onclick="javascript:EntityConf(\''.$mode.'\', \''.$entity.'\')"  style="cursor:pointer;" onmouseover="style.textDecoration=\'underline\';" onmouseout="style.textDecoration=\'none\';" />'.$user->lang['bs_am_conf'].'</a>';
}

?>
