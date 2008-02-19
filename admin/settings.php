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
$mybsmgs->load_game_specific_language('bossloot');

// sql class
require(dirname(__FILE__).'/../include/bssql.class.php');
$mybssql = new BSSQL();

$bzone = $mybssql->get_bzone();

$pzrow = $mybssql->get_parse_zone();
$pbrow = $mybssql->get_parse_boss();

$bs_conf = $mybssql->get_config('bossbase');
$bl_conf = $mybssql->get_config('bossloot');
$bp_conf = $mybssql->get_config('bossprogress');
$bc_conf = $mybssql->get_config('bosscounter');
$bc_sbzone = $mybssql->get_bzone('bosscounter');
$bp_sbzone = $mybssql->get_bzone('bossprogress');

// Saving
if ($_POST['bpsavebu']){
  //General Config
  $eqdkp->config_set('bs_showBC', $_POST['ebc']);
  $eqdkp->config_set('bs_linkBL', $_POST['en2l']);

  //BossBase Config
	$mybssql->update_config('bossbase', $bs_conf, 'zoneInfo', $_POST['zoneInfo']);
	$mybssql->update_config('bossbase', $bs_conf, 'bossInfo', $_POST['bossInfo']);
	$mybssql->update_config('bossbase', $bs_conf, 'noteDelim', $_POST['notedelim']);
	$mybssql->update_config('bossbase', $bs_conf, 'nameDelim', $_POST['namedelim']);
	$mybssql->update_config('bossbase', $bs_conf, 'tables', $_POST['tables']);
	$mybssql->update_config('bossbase', $bs_conf, 'source', $_POST['source']);

	//BossLoot Config
	$mybssql->update_config('bossloot', $bl_conf, 'item_minqual', $_POST['itemqual']);
	$mybssql->update_config('bossloot', $bl_conf, 'item_lang', $_POST['itemlang']);
	$mybssql->update_config('bossloot', $bl_conf, 'show_ndl', $_POST['ndl']);
	$mybssql->update_config('bossloot', $bl_conf, 'show_wl', $_POST['wl']);
	$mybssql->update_config('bossloot', $bl_conf, 'get_itemstats', $_POST['is']);
	
	//BossProgress Config
	$mybssql->update_config('bossprogress', $bp_conf, 'style', $_POST['bp_style']);
	$mybssql->update_config('bossprogress', $bp_conf, 'dynZone', $_POST['bp_dynloc']);
 	$mybssql->update_config('bossprogress', $bp_conf, 'dynBoss', $_POST['bp_dynboss']);
	$mybssql->update_config('bossprogress', $bp_conf, 'zhiType', $_POST['bp_zhiType']);
	$mybssql->update_config('bossprogress', $bp_conf, 'showSB', $_POST['bp_showSB']);
	$mybssql->update_config('bossprogress', $bp_conf, 'linkurl', $_POST['bp_linkurl']);
 	$mybssql->update_config('bossprogress', $bp_conf, 'linklength', $_POST['bp_linklength']);
  foreach ($bzone as $zoneid => $bosslist){
		$mybssql->update_zone_visibility('bossprogress', $zoneid, $_POST['bp_sz_'.$zoneid]);
	}
	
	//BossCounter Config
	$mybssql->update_config('bosscounter', $bc_conf, 'dynZone', $_POST['bc_dynloc']);
 	$mybssql->update_config('bosscounter', $bc_conf, 'dynBoss', $_POST['bc_dynboss']);
 	$mybssql->update_config('bosscounter', $bc_conf, 'linkurl', $_POST['bc_linkurl']);
 	$mybssql->update_config('bosscounter', $bc_conf, 'linklength', $_POST['bc_linklength']);
 	
 	foreach ($bzone as $zoneid => $bosslist){
		$mybssql->update_zone_visibility('bosscounter', $zoneid, $_POST['bc_sz_'.$zoneid]);
	}
	
 	//Zone parse strings
 	foreach ($bzone as $zoneid => $bosslist){
		$mybssql->update_parse_zone($pzrow, $zoneid, $_POST['pz_'.$zoneid]);
		foreach ($bosslist as $bossid){
			$mybssql->update_parse_boss($pbrow, $bossid, $_POST['pb_'.$bossid]);
		}
	}
}

$pzrow = $mybssql->get_parse_zone();
$pbrow = $mybssql->get_parse_boss();

$bs_conf = $mybssql->get_config('bossbase');
$bl_conf = $mybssql->get_config('bossloot');
$bp_conf = $mybssql->get_config('bossprogress');
$bc_conf = $mybssql->get_config('bosscounter');
$bc_sbzone = $mybssql->get_bzone('bosscounter');
$bp_sbzone = $mybssql->get_bzone('bossprogress');

global $eqdkp, $SID;

$arrvals = array (
  'CREDITS' => $user->lang['bs_credits1'] . $pm->get_data('bosssuite', 'version') . $user->lang['bs_credits2'],
	'F_CONFIG' => 'settings.php' . $SID,
   
  //General
  'BS_EBC'    => ( $eqdkp->config['bs_showBC'] == 1 ) ? ' checked="checked"' : '',
	'BS_EN2L'   => ( $eqdkp->config['bs_linkBL'] == 1 ) ? ' checked="checked"' : '',
   
   // Language
	'L_EBC' => "Enable bosscounter", //$user->lang['bs_al_general'],
	'L_EN2L' => "Enable note 2 link",//$user->lang['bs_al_delimRNO'],
   
  //BossBase
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
	
	//BossLoot
	'BL_NDL' => ($bl_conf['show_ndl'] == 1) ? ' checked="checked"' : '',
	'BL_WL' => ($bl_conf['show_wl'] == 1) ? ' checked="checked"' : '',
	'BL_IS' => ($bl_conf['get_itemstats'] == 1) ? ' checked="checked"' : '',
	
	// Language
	'L_ITEMQUAL' => $user->lang['bl_opt_minitemqual'],
	'L_ITEMLANG' => $user->lang['bl_opt_itemlang'],
	'L_NDL' => $user->lang['bl_opt_ndl'],
	'L_WL' => $user->lang['bl_opt_wl'],
	'L_IS' => $user->lang['bl_opt_is'],
	
	//BossProgress
	'BP_DYNLOC' => ($bp_conf['dynZone'] == 1) ? ' checked="checked"' : '',
	'BP_DYNBOSS' => ($bp_conf['dynBoss'] == 1) ? ' checked="checked"' : '',
	'BP_SHOWSB' => ($bp_conf['showSB'] == 1) ? ' checked="checked"' : '',
	
	// Language
	'L_BP_DYNLOC'      => $user->lang['opt_dynloc'],
	'L_BP_DYNBOSS'    => $user->lang['opt_dynboss'],
	'L_BP_ZHITYPE' => $user->lang['opt_zhiType'],
	'L_BP_SHOWSB' => $user->lang['opt_showSB'],
	'L_BP_STYLE' => $user->lang['opt_style'],	

	'L_BP_JITTER' => $user->lang['zhi_jitter'],
	'L_BP_BW' => $user->lang['zhi_bw'],
	'L_BP_NONE' => $user->lang['zhi_none'],

	'BP_ZHITYPE_SEL_JITTER'    => ( $bp_conf['zhiType'] == "0" ) ? ' selected="selected"' : '',
	'BP_ZHITYPE_SEL_BW'    => ( $bp_conf['zhiType'] == "1" ) ? ' selected="selected"' : '',
	'BP_ZHITYPE_SEL_NONE'    => ( $bp_conf['zhiType'] == "2" ) ? ' selected="selected"' : '',
	
  //BossCounter
	'BC_DYNLOC' => ($bc_conf['dynZone'] == 1) ? ' checked="checked"' : '',
	'BC_DYNBOSS' => ($bc_conf['dynBoss'] == 1) ? ' checked="checked"' : '',
	
	// Language
	'L_BC_DYNLOC'      => $user->lang['opt_dynloc'],
	'L_BC_DYNBOSS'    => $user->lang['opt_dynboss'],
);

$bs_source['database'] = $user->lang['bs_source_db'];
$bs_source['offsets'] = $user->lang['bs_source_offs'];
$bs_source['both'] = $user->lang['bs_source_both'];
$bs_source['cache'] = $user->lang['bs_source_cache'];


foreach ($bs_source as $value => $option) {
	$tpl->assign_block_vars('source_row', array (
		'VALUE' => $value,
		'SELECTED' => ($bs_conf['source'] == $value) ? ' selected="selected"' : '',
		'OPTION' => $option
		)
	);
}

//Show zones BossSuite
$zbcode = '<div id="container"><div id="vertical_container_bpsz">';
$zbcode .= '<h2 class="accordion_toggle">'.$user->lang['bs_al_showZone'].'</h2>'."\n";
$zbcode .= "\t".'<div class="accordion_content">'."\n";
$zbcode .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
foreach ($bzone as $zoneid => $bosslist){
  $zbcode .= "\t\t\t".'<tr><td width="70%" class="row2">' . $user->lang[$zoneid]['long']. '</td>';
  $zbcode .= '<td class="row1"><input type="checkbox" name="bp_sz_'.$zoneid.'" value="1" ';
  if ( array_key_exists($zoneid, $bp_sbzone) )
    $zbcode .= 'checked="checked"';
  $zbcode .= ' /></td></tr>'."\n";
}
$zbcode .= "\t\t</table>\n";
$zbcode .= "\t</div>\n";
$zbcode .= '</div></div>';

$arrvals['SHOW_BP'] = $zbcode;

//Show zones BossCounter
$zbcode = '<div id="container"><div id="vertical_container_bcsz">';
$zbcode .= '<h2 class="accordion_toggle">'.$user->lang['bs_al_showZone'].'</h2>'."\n";
$zbcode .= "\t".'<div class="accordion_content">'."\n";
$zbcode .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
foreach ($bzone as $zoneid => $bosslist){
  $zbcode .= "\t\t\t".'<tr><td width="70%" class="row2">' . $user->lang[$zoneid]['long']. '</td>';
  $zbcode .= '<td class="row1"><input type="checkbox" name="bc_sz_'.$zoneid.'" value="1" ';
  if ( array_key_exists($zoneid, $bc_sbzone) )
    $zbcode .= 'checked="checked"';
  $zbcode .= ' /></td></tr>'."\n";
}
$zbcode .= "\t\t</table>\n";
$zbcode .= "\t</div>\n";
$zbcode .= '</div></div>';

$arrvals['SHOW_BC'] = $zbcode;

//Parse string settings
$zbcode = '<div id="container"><div id="vertical_container_parse">';
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
$zbcode .= '</div></div>';
$arrvals['PARSE_CONFIG'] = $zbcode;

//Output
$tpl->assign_vars($arrvals);

require(dirname(__FILE__).'/../include/blmgs.class.php');
$myblmgs = new BLMGS();

//minimum item quality setting
$bl_qual = $myblmgs-> bl_get_item_qualities();
foreach ($bl_qual as $value) {
    $tpl->assign_block_vars('itemqual_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bl_conf['item_minqual'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $user->lang['item_qual_'.$value]
		)
	);
}

//item language settings
$bl_itemlang = $myblmgs->bl_get_supported_item_languages();
foreach ($bl_itemlang as $id => $value) {
    $tpl->assign_block_vars('itemlang_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bl_conf['item_lang'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => ($user->lang['item_lang_'.$value] == '') ? $value : $user->lang['item_lang_'.$value]
		)
	);
}

//BossProgress styles
$bp_styles['0'] = $user->lang['bp_style_bp'];
$bp_styles['1'] = $user->lang['bp_style_bps'];
$bp_styles['2'] = $user->lang['bp_style_rp2r'];
$bp_styles['3'] = $user->lang['bp_style_rp3r'];

foreach ($bp_styles as $value => $option) {
    $tpl->assign_block_vars('bp_style_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bp_conf['style'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $option
		)
	);
}

require_once(dirname(__FILE__).'/../include/bslink.class.php');
$mybslink = new BSLINK('none','');
$bs_sources = $mybslink->get_sources();

foreach ($bs_sources as $value => $options) {
    $tpl->assign_block_vars('bc_linkurl_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bc_conf['linkurl'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $options['name']
		)
	);
}

foreach ($bs_sources as $value => $options) {
    $tpl->assign_block_vars('bp_linkurl_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bp_conf['linkurl'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $options['name']
		)
	);
}

$bs_linklength['short'] = 'short name';//$user->lang['bp_style_bp'];
$bs_linklength['long'] = 'long name';//$user->lang['bp_style_bps'];

foreach ($bs_linklength as $value => $option) {
    $tpl->assign_block_vars('bc_linklength_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bc_conf['linklength'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $option
		)
	);
}

foreach ($bs_linklength as $value => $option) {
    $tpl->assign_block_vars('bp_linklength_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bp_conf['linklength'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $option
		)
	);
}

$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bs_am_conf'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'admin/settings.html', 'display' => true
	)
);
