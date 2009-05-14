<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2006-2008 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev$
 *
 * $Id$
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
} 

$lang = array(
//General
'bosssuite' => 'BossSuite',
'bosscounter' => 'BossCounter',

//Permissions
'bs_pm_conf' => 'configure',
'bs_pm_offs' => 'offsets',
'bs_bp_view' => 'view BossProgress',
'bs_bl_view' => 'view BossLoot',
'bs_bc_view' => 'view BossCounter',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => 'Settings',
'bs_am_offs' => 'Offsets',
'bs_am_cache' => 'Cache',

// admin page
'bs_al_submit' => 'Save',
'bs_al_general' => 'General settings',
'bs_al_delimRNO' => 'Raidnote delimiter (Opt.: Regular Expression):',
'bs_al_delimRNA' => 'Raidname delimiter (Opt.: Regular Expression):',
'bs_al_tables' => 'Opt.: EQdkp prefixlist (empty => only current prefix):',
'bs_al_zoneInfo' => 'Where (in the raid entry) to look for zone infos?',
'bs_al_bossInfo' => 'Where (in the raid entry) to look for boss infos?',
'bs_al_linkInfo' => 'Link options:',
'bs_al_name' => 'Name',
'bs_al_trigger' => 'String trigger(s)',
'bs_ao_rnote' => 'raidnote',
'bs_ao_rname' => 'raidname',
'bs_al_source' => 'Data source:',
'bs_source_db' => 'database',
'bs_source_offs' => 'offsets',
'bs_source_both' => 'both',
'bs_source_cache' => 'cache',
'bs_al_showZone' => 'Select the zones which should be shown within the plugin:',
'lang' => 'english',

'dateFormat' => '%m/%d/%Y',
'bs_out_date_format' => 'mm/dd/yy', 
'bs_date_day' => array('start' => 3, 'length' => 2),
'bs_date_month' => array('start' => 0, 'length' => 2), 
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => 'The date format is: ',
'bs_ol_in' => 'Name',
'bs_ol_fd' => 'First Date',
'bs_ol_ld' => 'Last Date',
'bs_ol_co' => 'Counter',
'bs_ol_submit' => 'Save',

// cache page
'bs_adm_cache_info' => 'Cache: Using the cache function should decrease loading times on dkp systems with many raids',
'bs_adm_cache_refresh' => 'Refresh Cache',

//BossProgress User Page
'bp_um_link' => 'BossProgress',
'firstkill' => 'First kill: ',
'lastkill' => 'Last kill: ',
'firstvisit' => 'First visit: ',
'lastvisit' => 'Last visit: ',
'zonevisitcount' => 'Visit count: ',
'bosskillcount' => 'Kill count: ',
'status' => 'Status: ',
'never' => 'Never',
'all_zones' => 'all zones',
'bs_ol_zoneselect' => 'Zone selection:',

'opt_general' => 'General settings',
'opt_dynloc' => 'Hide zones with no boss kills?',
'opt_dynboss' => 'Hide never killed bosses?',
'opt_showzone' => 'Show: ',
'opt_showSB' => 'Show a zone progression bar?',
'opt_zhiType' => 'How to display the progress in the header image?',
'zhi_jitter' =>'old photo',
'zhi_bw' => 'black/white',
'zhi_none' => 'not at all',
'opt_style' => 'Style: ',
'bp_style_bp' => 'BossProgress default',
'bp_style_bps' => 'BossProgress simple',
'bp_style_rp2r' => 'Raidprogress 2/row',
'bp_style_rp3r' => 'Raidprogress 3/row',


'bl_loottable' => 'Loottable for: ',
'bl_kc_p1' => ' (killed ',
'bl_kc_p2' => ' times)',
'bs_image_not_found' => 'Sorry, couldn\'t find an image for the selected boss. If you got one, feel free to contribute to the project.',
'bl_itemname' => 'Item name',
'bl_itemcount' => 'Drop count',
'bl_droprate' => 'Drop rate',
'bl_loottable_offsets' => '(Offset mode) Item list:',
'bl_dl' => 'Dropped loot',
'bl_ndl' => 'Never dropped loot',
'bl_wl' => 'Wrong assigned/unclear loot',

'bl_itemsfound' => 'items found',
'item_lang_none' => 'none',

//Admin menu
'bl_opt_minitemqual' => 'Minimum item quality to be shown:',
'bl_opt_itemlang' => 'Select lootlist',
'bl_opt_ndl' => 'Show loot that never dropped for you?',
'bl_opt_wl' => 'Show loot that was found, but not belongs to the boss?',
'bl_opt_is' => 'Enable Itemstats for never dropped items?',
'bl_opt_eyecandy' => 'Enable eye-candy (accordions)?',
'bc_opt_eyecandy' => 'Enable eye-candy (accordions)? (PLUS 0.5+ ONLY!)',
'bs_credits_p1' => 'EQDKP BossSuite v',
'bs_credits_p2' => ' by sz3',
'bl_credits_ll' => 'Loot list: ',
'bl_credits_bi' => 'Boss images: ',
'bl_no_lootlist_credits' => 'no lootlist selected/found',
'bl_no_bossimages_credits' => 'no bossimage credits found',

'item_qual_-1' => 'all',

//About page
'bs_about_header' => 'About the BossSuite',
'bs_additions' => 'Contributions:',
'bs_copyright' => 'Copyright:',
'bs_url_web' => 'Web',
'bs_short_desc' => 'Extended loot/progression information.',
'bs_long_desc' => 'Overview over killed bossed and the progress of the zones and the received loot.',
'bs_game_not_supported' => 'Sorry, your game is not supported.',
'bs_enable_bosscounter' => 'Enable BossCounter',
'bs_enable_note2link' => 'Enable note2link',

'bs_img_style_normal' => 'normal',
'bs_img_style_sepia' => 'sepia',
'bs_img_style_grey' => 'grey',
'bs_style_sname' => 'short name',
'bs_style_lname' => 'long name',
'bs_opt_zlength' => 'Select zone name length',
'bs_trigger' => 'Trigger',
'bs_bp_style_options' => 'BossProgress Style Options',
'bs_bp_style_si' => 'Image to start with:',
'bs_bp_style_ei' => 'Image to end with:',
'bs_bp_style_ztext' => 'ZoneName as ',
'bs_bp_style_ztext_none' => 'none',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => 'text',
'bl_opt_lootlist' => 'Lootlist options, only work if a lootlist is selected',

'bs_updateitem_l_name' => 'Updatepage for',
'bs_depmatch' => 'Match bosses depending on the zone match:',
'bs_am_bzone' => 'Zones/Bosses',
'bs_ec_show_bp' => 'Show(BossProgress)',
'bs_ec_show_bc' => 'Show(BossCounter)',
'bs_ec_strings' => 'Triggers',

'bs_enable_updchk' => 'Enable check for new Plugin Versions',
'bl_opt_en_mv' => 'Enable wowhead modelviewer',
'bs_enable_autoclose' => 'Auto-close boss/zone popup after saving',
);

?>
