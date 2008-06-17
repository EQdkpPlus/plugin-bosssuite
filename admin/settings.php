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

//wpfc
require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/init.pwc.php'); 
$bs_adm_wpfccore = new InitWPFC($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/');
$bs_adm_jquery = $bs_adm_wpfccore->InitJquery(); 
$bs_adm_wpfccore->InitAdmin();

// new mgs class
require(dirname(__FILE__).'/../include/bsmgs.class.php');
$mybsmgs = new BSMGS();
if (!$mybsmgs->game_supported('bossbase'))
  message_die($user->lang['bs_game_not_supported']);

$mybsmgs->load_game_specific_language('bossbase');
$mybsmgs->load_game_specific_language('bossloot');

// sql class
require(dirname(__FILE__).'/../include/bssql.class.php');
$mybssql = new BSSQL();

$bzone = $mybssql->get_bzone();

// Saving
if ($_POST['bpsavebu']){
  $pzrow = $mybssql->get_parse_zone();
  $pbrow = $mybssql->get_parse_boss();
  
  $bs_conf = $mybssql->get_config('bossbase');
  $bl_conf = $mybssql->get_config('bossloot');
  $bp_conf = $mybssql->get_config('bossprogress');
  $bc_conf = $mybssql->get_config('bosscounter');
  $bc_sbzone = $mybssql->get_bzone('bosscounter');
  $bp_sbzone = $mybssql->get_bzone('bossprogress');
  $boss_offsets = $mybssql->get_boss_offsets();
  $zone_offsets = $mybssql->get_zone_offsets();

  //General Config
  $eqdkp->config_set('bs_showBC', $_POST['ebc']);
  $eqdkp->config_set('bs_linkBL', $_POST['en2l']);

  //BossBase Config
	$mybssql->update_config('bossbase', $bs_conf, 'bb_zoneInfo', $_POST['zoneInfo']);
	$mybssql->update_config('bossbase', $bs_conf, 'bb_bossInfo', $_POST['bossInfo']);
	$mybssql->update_config('bossbase', $bs_conf, 'bb_noteDelim', $_POST['notedelim']);
	$mybssql->update_config('bossbase', $bs_conf, 'bb_nameDelim', $_POST['namedelim']);
	$mybssql->update_config('bossbase', $bs_conf, 'bb_tables', $_POST['tables']);
	$mybssql->update_config('bossbase', $bs_conf, 'bb_source', $_POST['source']);

	//BossLoot Config
	$mybssql->update_config('bossloot', $bl_conf, 'bl_item_minqual', $_POST['itemqual']);
	$mybssql->update_config('bossloot', $bl_conf, 'bl_item_lang', $_POST['itemlang']);
	$mybssql->update_config('bossloot', $bl_conf, 'bl_show_ndl', $_POST['ndl']);
	$mybssql->update_config('bossloot', $bl_conf, 'bl_show_wl', $_POST['wl']);
	$mybssql->update_config('bossloot', $bl_conf, 'bl_eyecandy', $_POST['bl_eyecandy']);
	$mybssql->update_config('bossloot', $bl_conf, 'bl_get_itemstats', $_POST['is']);
	
	//BossProgress Config
	$mybssql->update_config('bossprogress', $bp_conf, 'bp_style', $_POST['bp_style']);
	$mybssql->update_config('bossprogress', $bp_conf, 'bp_dynZone', $_POST['bp_dynloc']);
 	$mybssql->update_config('bossprogress', $bp_conf, 'bp_dynBoss', $_POST['bp_dynboss']);
  $mybssql->update_config('bossprogress', $bp_conf, 'bp_si_style', $_POST['bp_si_style']);
  $mybssql->update_config('bossprogress', $bp_conf, 'bp_ei_style', $_POST['bp_ei_style']);
  $mybssql->update_config('bossprogress', $bp_conf, 'bp_ztext_style', $_POST['bp_ztext_style']);
  $mybssql->update_config('bossprogress', $bp_conf, 'bp_showSB', $_POST['bp_showSB']);
	$mybssql->update_config('bossprogress', $bp_conf, 'bp_linkurl', $_POST['bp_linkurl']);
 	$mybssql->update_config('bossprogress', $bp_conf, 'bp_linklength', $_POST['bp_linklength']);
  foreach ($bzone as $zoneid => $bosslist){
		$mybssql->update_zone_visibility('bossprogress', $zoneid, $_POST['bp_sz_'.$zoneid]);
	}
	
	//BossCounter Config
	$mybssql->update_config('bosscounter', $bc_conf, 'bc_eyecandy', $_POST['bc_eyecandy']);
	$mybssql->update_config('bosscounter', $bc_conf, 'bc_dynZone', $_POST['bc_dynloc']);
 	$mybssql->update_config('bosscounter', $bc_conf, 'bc_dynBoss', $_POST['bc_dynboss']);
 	$mybssql->update_config('bosscounter', $bc_conf, 'bc_linkurl', $_POST['bc_linkurl']);
 	$mybssql->update_config('bosscounter', $bc_conf, 'bc_linklength', $_POST['bc_linklength']);
 	$mybssql->update_config('bosscounter', $bc_conf, 'bc_zonelength', $_POST['bc_zonelength']);
 	
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
$boss_offsets = $mybssql->get_boss_offsets();
$zone_offsets = $mybssql->get_zone_offsets();

//Updater
$bsupdater = new PluginUpdater('bosssuite','4.0.5','bb_inst_version','bs_config','include');
$drpdwonarry = array(
										'4.0.5' => sprintf($user->lang['puc_update_txt'],'4.0.5','4.0.6'),
										);
$bsupdater->OutputForm($bs_conf['inst_version'], $drpdwonarry);

global $eqdkp, $SID;

$arrvals = array (
  'CREDITS' => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
	'F_CONFIG' => 'settings.php' . $SID,
   
  //Tabs
  'L_BOSSBASE' => 'BossBase',
  'L_BOSSLOOT' => 'BossLoot',
  'L_BOSSPROGRESS' => 'BossProgress',
  'L_BOSSCOUNTER' => 'BossCounter',
  'L_TRIGGERS' => $user->lang['bs_trigger'],
  
  //General
  'BS_EBC'    => ( $eqdkp->config['bs_showBC'] == 1 ) ? ' checked="checked"' : '',
	'BS_EN2L'   => ( $eqdkp->config['bs_linkBL'] == 1 ) ? ' checked="checked"' : '',
   
   // Language
	'L_EBC' => $user->lang['bs_enable_bosscounter'],
	'L_EN2L' => $user->lang['bs_enable_note2link'],
   
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
	'L_BP_LINK' => $user->lang['bs_al_linkInfo'],
	'L_BC_LINK' =>  $user->lang['bs_al_linkInfo'],
	'L_OFFSET_INFO' => $user->lang['bs_ol_dateFormat'],
	'L_BL_EYECANDY' => $user->lang['bl_opt_eyecandy'],
	
	//BossLoot
	'BL_NDL' => ($bl_conf['show_ndl'] == 1) ? ' checked="checked"' : '',
	'BL_WL' => ($bl_conf['show_wl'] == 1) ? ' checked="checked"' : '',
	'BL_IS' => ($bl_conf['get_itemstats'] == 1) ? ' checked="checked"' : '',
	'BL_EYECANDY' => ($bl_conf['eyecandy'] == 1) ? ' checked="checked"' : '',
	
	// Language
	'L_LOOTLIST_OPTS' => $user->lang['bl_opt_lootlist'],
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
	'L_BP_SHOWSB' => $user->lang['opt_showSB'],
	'L_BP_STYLE' => $user->lang['opt_style'],	
	'L_BP_STYLE_OPTS' => $user->lang['bs_bp_style_options'],
	'L_BP_SI_STYLE' => $user->lang['bs_bp_style_si'],
	'L_BP_EI_STYLE' => $user->lang['bs_bp_style_ei'],
	'L_BP_ZTEXT' => $user->lang['bs_bp_style_ztext'],
	
  //BossCounter
	'BC_DYNLOC' => ($bc_conf['dynZone'] == 1) ? ' checked="checked"' : '',
	'BC_DYNBOSS' => ($bc_conf['dynBoss'] == 1) ? ' checked="checked"' : '',
	'BC_EYECANDY' => ($bc_conf['eyecandy'] == 1) ? ' checked="checked"' : '',
	
	// Language
	'L_BC_DYNLOC'      => $user->lang['opt_dynloc'],
	'L_BC_DYNBOSS'    => $user->lang['opt_dynboss'],
	'L_BC_EYECANDY' => $user->lang['bc_opt_eyecandy'],
	'L_BC_ZONELENGTH' => $user->lang['bs_opt_zlength'],
);

//Source selection
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
$zbcode = '<tr><th colspan="2">'.$user->lang['bs_al_showZone'].'</th></tr>'."\n";
foreach ($bzone as $zoneid => $bosslist){
  $zbcode .= "\t".'<tr><td width="70%" class="row2" align="right">' . $user->lang[$zoneid]['long']. ':</td>';
  $zbcode .= '<td class="row1"><input type="checkbox" name="bp_sz_'.$zoneid.'" value="1" ';
  if ( array_key_exists($zoneid, $bp_sbzone) )
    $zbcode .= 'checked="checked"';
  $zbcode .= ' /></td></tr>'."\n";
}
$arrvals['SHOW_BP'] = $zbcode;

//Show zones BossCounter
$zbcode = '<tr><th colspan="2">'.$user->lang['bs_al_showZone'].'</th></tr>'."\n";
foreach ($bzone as $zoneid => $bosslist){
  $zbcode .= "\t".'<tr><td width="70%" class="row2" align="right">' . $user->lang[$zoneid]['long']. ':</td>';
  $zbcode .= '<td class="row1"><input type="checkbox" name="bc_sz_'.$zoneid.'" value="1" ';
  if ( array_key_exists($zoneid, $bc_sbzone) )
    $zbcode .= 'checked="checked"';
  $zbcode .= ' /></td></tr>'."\n";
}
$arrvals['SHOW_BC'] = $zbcode;

//Parse string settings
$zbcode = '<table width="100%">';
foreach ($bzone as $zoneid => $bosslist){
  $zbcode .= '<tr><th colspan="2">'.$user->lang[$zoneid]['long'].'</th></tr>'."\n";
  $zbcode .= "\t".'<tr><th align="center" width="30%">' .$user->lang['bs_al_name']. '</th><th align="center">'.$user->lang['bs_al_trigger'].'</th></tr>'."\n";
  $zbcode .= "\t".'<tr><td class="row2" align="right">'.$user->lang[$zoneid]['long'].':</td>';
  $zbcode .= '<td class="row1"><input type="text" name="pz_' . $zoneid .'" size="80" value="' . $pzrow['pz_'.$zoneid] . '" class="input" /></td></tr>'."\n";

  foreach ($bosslist as $bossid){
    $zbcode .= "\t\t".'<tr><td class="row2" align="right">'.$user->lang[$bossid]['long'].':</td>'; 
    $zbcode .= '<td class="row1"><input type="text" name="pb_' . $bossid .'" size="80" value="' . $pbrow['pb_'.$bossid] .'" class="input" /></td></tr>'."\n";
  }
}
$zbcode .= '</table>';
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
  ));
}

//BossProgress zone image styles
$bp_zi_styles['normal'] = $user->lang['bs_img_style_normal'];
$bp_zi_styles['sepia'] = $user->lang['bs_img_style_sepia'];
$bp_zi_styles['grey'] = $user->lang['bs_img_style_grey'];

foreach ($bp_zi_styles as $value => $option) {
  $tpl->assign_block_vars('bp_si_style_row', array (
    'VALUE' => $value,
    'SELECTED' => ($bp_conf['si_style'] == $value) ? ' selected="selected"' : '',
    'OPTION' => $option
  ));
  
  $tpl->assign_block_vars('bp_ei_style_row', array (
    'VALUE' => $value,
    'SELECTED' => ($bp_conf['ei_style'] == $value) ? ' selected="selected"' : '',
    'OPTION' => $option
  ));
}

//BossProgress zone text style
$bp_ztext_style['none'] = $user->lang['bs_bp_style_ztext_none'];
$bp_ztext_style['png'] = $user->lang['bs_bp_style_ztext_png'];
$bp_ztext_style['text'] = $user->lang['bs_bp_style_ztext_text'];

foreach ($bp_ztext_style as $value => $option) {
  $tpl->assign_block_vars('bp_ztext_style_row', array (
    'VALUE' => $value,
    'SELECTED' => ($bp_conf['ztext_style'] == $value) ? ' selected="selected"' : '',
    'OPTION' => $option
  ));
}

// Link source selection
require_once(dirname(__FILE__).'/../include/bslink.class.php');
$mybslink = new BSLINK('none','');
$bs_sources = $mybslink->get_sources();


foreach ($bs_sources as $value => $options) {
  $tpl->assign_block_vars('bc_linkurl_row', array (
	  'VALUE' => $value,
	  'SELECTED' => ($bc_conf['linkurl'] == $value) ? ' selected="selected"' : '',
	  'OPTION' => $options['name']
	));

	$tpl->assign_block_vars('bp_linkurl_row', array (
	  'VALUE' => $value,
	  'SELECTED' => ($bp_conf['linkurl'] == $value) ? ' selected="selected"' : '',
	  'OPTION' => $options['name']
	));
}

$bs_linklength['short'] = $user->lang['bs_style_sname'];
$bs_linklength['long']  = $user->lang['bs_style_lname'];
foreach ($bs_linklength as $value => $option) {
    $tpl->assign_block_vars('bc_linklength_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bc_conf['linklength'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $option
		));

		$tpl->assign_block_vars('bp_linklength_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bp_conf['linklength'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $option
		));
		
		$tpl->assign_block_vars('bc_zonelength_row', array (
	        'VALUE' => $value,
	        'SELECTED' => ($bc_conf['zonelength'] == $value) ? ' selected="selected"' : '',
	        'OPTION' => $option
		));
}

$tpl->assign_vars(array(
  'UPDATER' => $bsupdater->OutputHTML(),
 'JQUERY_INCLUDES'   => $bs_adm_jquery->Header(),
  'TABOUT' => $bs_adm_jquery->Tab_header('bs_adm_tabs'),
  'JS_ABOUT' => $bs_adm_jquery->Dialog_URL('About', $user->lang['bs_about_header'], '../about.php', '400', '400'),
	'L_CREDITS' => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
	'BS_INFO_IMG' => '../images/credits/info.png',
  ));


$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bs_am_conf'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'admin/settings.html', 'display' => true
	)
);
