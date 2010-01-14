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
'bossbars' => 'Progression',

//Permissions
'bs_pm_conf' => '选项',
'bs_pm_offs' => '微调',
'bs_bp_view' => '查看首领进度',
'bs_bl_view' => '查看首领掉落',
'bs_bc_view' => '查看首领计数器',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => '设置',
'bs_am_offs' => '微调',
'bs_am_cache' => '缓存',

// admin page
'bs_al_submit' => '保存',
'bs_al_general' => '一般设置',
'bs_al_delimRNO' => 'Raid 注释分隔符 (Opt.: 正则表达式):',
'bs_al_delimRNA' => 'Raid 名称分隔符 (Opt.: 正则表达式):',
'bs_al_tables' => 'Opt.: EQdkp prefixlist (empty => only current prefix):',
'bs_al_zoneInfo' => '哪里 (在 raid 入口) 查找区域信息?',
'bs_al_bossInfo' => '哪里 (在 raid 入口) 查找首领信息?',
'bs_al_linkInfo' => '链接选项:',
'bs_al_name' => '名称',
'bs_al_trigger' => '字符串触发器',
'bs_ao_rnote' => 'raid 注释',
'bs_ao_rname' => 'raid 名称',
'bs_al_source' => '数据源:',
'bs_source_db' => '数据库',
'bs_source_offs' => '微调',
'bs_source_both' => '两者',
'bs_source_cache' => '缓存',
'bs_al_showZone' => '选择应当被插件显示的区域:',
'lang' => '英语',

'dateFormat' => '%m/%d/%Y',
'bs_out_date_format' => 'mm/dd/yy', 
'bs_date_day' => array('start' => 3, 'length' => 2),
'bs_date_month' => array('start' => 0, 'length' => 2), 
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => '日期格式是: ',
'bs_ol_in' => '名称',
'bs_ol_fd' => '首次日期',
'bs_ol_ld' => '最近日期',
'bs_ol_co' => '计数器',
'bs_ol_submit' => '保存',

// cache page
// cache page
'bs_adm_cache_info' => '缓存: 使用缓存功能应该可以在 dkp 系统有很多 raid 的时候减少载入时间',
'bs_adm_cache_refresh' => '刷新缓存',

//BossProgress User Page
'bp_um_link' => '首领进度',
'firstkill' => '首次击杀: ',
'lastkill' => '最近击杀: ',
'firstvisit' => '首次尝试: ',
'lastvisit' => '最近尝试: ',
'zonevisitcount' => '尝试数: ',
'bosskillcount' => '击杀数: ',
'status' => '状态: ',
'never' => '从未',
'all_zones' => '全部区域',
'bs_ol_zoneselect' => '区域选择:',

'opt_general' => '一般设置',
'opt_dynloc' => '隐藏无首领击杀的区域?',
'opt_dynboss' => '隐藏从未击杀的首领?',
'opt_showzone' => '显示: ',
'opt_showSB' => '显示一个区域进度条?',
'opt_zhiType' => '如何显示进度条在头部图片?',
'zhi_jitter' =>'老照片',
'zhi_bw' => '黑/白',
'zhi_none' => '从不',
'opt_style' => '样式: ',
'bp_style_bp' => '首领进度 默认',
'bp_style_bps' => '首领进度 简单',
'bp_style_rp2r' => '首领进度 2/行',
'bp_style_rp3r' => '首领进度 3/行',


'bl_loottable' => '掉落表 for: ',
'bl_kc_p1' => ' (击杀 ',
'bl_kc_p2' => ' 次)',
'bs_image_not_found' => '对不起, 无法为选中的首领找到一张图片。如果你有,请把它捐献给项目组。',
'bl_itemname' => '物品名称',
'bl_itemcount' => '掉落计数',
'bl_droprate' => '掉落级别',
'bl_loottable_offsets' => '(微调模式) 物品列表:',
'bl_dl' => '已掉落的掉落',
'bl_ndl' => '从未掉落的掉落',
'bl_wl' => '错误分配/不清楚掉落',

'bl_itemsfound' => '物品找到',
'item_lang_none' => '从未',

//Admin menu
'bl_opt_minitemqual' => '被显示的最小物品品质:',
'bl_opt_itemlang' => '选择捡取列表',
'bl_opt_ndl' => '显示你从未掉落的捡取?',
'bl_opt_wl' => '显示找到的但不属于这个首领的捡取?',
'bl_opt_is' => '为从未掉落的物品启用 Itemstats?',
'bl_opt_eyecandy' => '启用 eye-candy (accordions)?',
'bc_opt_eyecandy' => '启用 eye-candy (accordions)? (PLUS 0.5+ ONLY!)',
'bs_credits_p1' => 'EQDKP BossSuite v',
'bs_credits_p2' => ' by sz3',
'bl_credits_ll' => '捡取列表: ',
'bl_credits_bi' => 'Boss 图片: ',
'bl_no_lootlist_credits' => '没有掉落列表被选择/找到',
'bl_no_bossimages_credits' => 'no bossimage credits found',

'item_qual_-1' => '全部',

//About page
'bs_about_header' => '关于 BossSuite',
'bs_additions' => '贡献:',
'bs_copyright' => 'Copyright:',
'bs_url_web' => 'Web',
'bs_short_desc' => '展开掉落/进度信息。',
'bs_game_not_supported' => '抱歉, 你的游戏是不支持的。',
'bs_enable_bosscounter' => '启用首领计数器',
'bs_enable_note2link' => '启用注释到连接',

'bs_img_style_normal' => '一般',
'bs_img_style_sepia' => 'sepia',
'bs_img_style_grey' => '灰',
'bs_style_sname' => '短名称',
'bs_style_lname' => '长名称',
'bs_opt_zlength' => '选择区域名称长度',
'bs_trigger' => '触发器',
'bs_bp_style_options' => '首领进度样式选项',
'bs_bp_style_si' => '开始图片:',
'bs_bp_style_ei' => '结束图片:',
'bs_bp_style_ztext' => '区域名 as ',
'bs_bp_style_ztext_none' => '无',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => 'text',
'bl_opt_lootlist' => '掉落列表选项, 仅当一个掉落列表被选择时工作',

'bs_enable_updchk' => 'Enable check for new Plugin Versions',
'bl_opt_en_mv' => 'Enable wowhead modelviewer',
'bs_enable_autoclose' => 'Auto-close boss/zone popup after saving',
);

?>
