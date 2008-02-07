<?php
/******************************
 * EQdkp BossBase
 * Copyright 2005
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * lang_main.php
 ******************************/

//Labels
$lang['bosssuite'] = "BossSuite";

//Permissions
$lang['bs_pm_conf'] = "config";
$lang['bs_pm_offs'] = "offsets";
$lang['bs_pm_pcon'] = "permission control";

//Admin menu
$lang['bs_am_title'] = "BossSuite";
$lang['bs_am_pcon'] = "BB: Permissions";
$lang['bs_am_conf'] = "Settings";
$lang['bs_am_offs'] = "Offsets";
$lang['bs_am_strings'] = "Strings";
$lang['bs_am_bp_conf'] = "BP: Settings";
$lang['bs_am_bc_conf'] = "BC: Settings";
$lang['bs_am_bl_conf'] = "BL: Settings";

//PCON
$lang['bs_pcon_bs_conf'] = "<b>configure</b>";
$lang['bs_pcon_bs_offs'] = "<b>edit offsets</b>";
$lang['bs_pcon_bs_pcon'] = "<b>access permission control</b>";

$lang['bs_pcon_bp_conf'] = "<b>configure</b>";
$lang['bs_pcon_bp_view'] = "view";
$lang['bs_pcon_bc_conf'] = "<b>configure</b>";
$lang['bs_pcon_bc_view'] = "view";

$lang['bs_pcon_bl_view'] = "view";

$lang['bs_pcon_all_users'] = "All users";
$lang['bs_pcon_pluginname'] = "Plugin name";
$lang['bs_pcon_permission'] = "Permission";
$lang['bs_pcon_grant'] = "Grant";
$lang['bs_pcon_revoke'] = "Revoke";

//Credits
$lang['bs_credits1'] = '<br /><center><span class="copy">EQDKP BossSuite v';
$lang['bs_credits2'] = ' by sz3 (detailed credits will follow!)</span></center>';

// admin page
$lang['bs_al_submit'] = "Save";
$lang['bs_al_parse'] = "String(s) for: ";
$lang['bs_al_general'] = "General settings";
$lang['bs_al_delimRNO'] = "Raidnote delimiter (Opt.: Regular Expression):";
$lang['bs_al_delimRNA'] = "Raidname delimiter (Opt.: Regular Expression):";
$lang['bs_al_tables'] = "Opt.: EQdkp prefixlist (empty => only current prefix):";
$lang['bs_al_parseInfo'] = "Attention! Please keep in mind that the following strings are case-sensitive! JinDo won't match Jindo!";
$lang['bs_al_zoneInfo'] = "Where (in the raid entry) to look for zone infos?";
$lang['bs_al_bossInfo'] = "Where (in the raid entry) to look for boss infos?";
$lang['bs_ao_rnote'] = "raidnote";
$lang['bs_ao_rname'] = "raidname";
$lang['bs_al_source'] = "Data source:";
$lang['bs_source_db'] = "database";
$lang['bs_source_offs'] = "offsets";
$lang['bs_source_both'] = "both";


// offset page
$lang['bs_ol_dateFormat'] = "The date format is: MM/DD/YYYY";
$lang['bs_ol_in'] = "Name";
$lang['bs_ol_fd'] = "First Date";
$lang['bs_ol_ld'] = "Last Date";
$lang['bs_ol_co'] = "Counter";
$lang['bs_ol_submit'] = "Save";

//Settings
$lang['lang'] = "english";
$lang['baseurl'] = "http://wow.allakhazam.com/db/mob.html?wmob=";
$lang['dateFormat'] = "%m/%d/%Y";

//User Page
$lang['bp_um_link'] = "BossProgress";
$lang['firstkill'] = "First kill: ";
$lang['lastkill'] = "Last kill: ";
$lang['firstvisit'] = "First visit: ";
$lang['lastvisit'] = "Last visit: ";
$lang['zonevisitcount'] = "Visit count: ";
$lang['bosskillcount'] = "Kill count: ";
$lang['status'] = "Status: ";
$lang['never'] = "Never";

$lang['opt_general'] = "General settings";
$lang['opt_dynloc'] = "Hide zones with no boss kills?";
$lang['opt_dynboss'] = "Hide never killed bosses?";
$lang['opt_showzone'] = "Show: ";
$lang['opt_showSB'] = "Show a zone progression bar?";
$lang['opt_zhiType'] = "How to display the progress in the header image?";
$lang['zhi_jitter'] ="old photo";
$lang['zhi_bw'] = "black/white";
$lang['zhi_none'] = "not at all";
$lang['opt_style'] = "Style: ";
$lang['bp_style_bp'] = "BossProgress default";
$lang['bp_style_bps'] = "BossProgress simple";
$lang['bp_style_rp2r'] = "Raidprogress 2/row";
$lang['bp_style_rp3r'] = "Raidprogress 3/row";

$lang = array_merge($lang, array( 

'bossloot' => 'Bossloot',
'bossloot_pm_view' => 'view Bossloot',
'bossloot_pm_conf' => 'configure Bossloot',

'bl_loottable' => 'Loottable for: ',
'bl_kc_p1' => ' (killed ',
'bl_kc_p2' => ' times)',

'bl_itemname' => 'Item name',
'bl_itemcount' => 'Drop count',
'bl_droprate' => 'Drop rate',

'bl_dl' => 'Dropped loot',
'bl_ndl' => 'Never dropped loot',
'bl_wl' => 'Wrong loot',

//Admin menu
'bl_opt_minitemqual' => 'Minimum item quality to be shown:',
'bl_opt_itemlang' => 'Item language',
'bl_opt_ndl' => 'Show loot that never dropped for you?',
'bl_opt_wl' => 'Show loot that was found, but not belongs to the boss?',
'bl_opt_is' => 'Get Itemstats data for new items?',

'bl_credits_p1' => 'EQDKP BossLoot v',
'bl_credits_p2' => ' by sz3',
'bl_credits_ll' => 'Loot list: ',
'bl_credits_bi' => 'Boss images: ',
'bl_no_lootlist_credits' => 'no lootlist selected/found',
'bl_no_bossimages_credits' => 'no bossimage credits found',
));

?>
