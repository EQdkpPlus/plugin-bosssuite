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
'bosscounter' => '����ī����',

//Permissions
'bs_pm_conf' => '����',
'bs_pm_offs' => '������',
'bs_bp_view' => '�������� ����',
'bs_bl_view' => '��������ǰ ����',
'bs_bc_view' => '����ī���� ����',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => '����',
'bs_am_offs' => '������',
'bs_am_cache' => 'ĳ��',

// admin page
'bs_al_submit' => '����',
'bs_al_general' => '�Ϲ� ����',
'bs_al_delimRNO' => '���̵��Ʈ ������ (�ɼ�.:���Խ�):',
'bs_al_delimRNA' => '���̵��̸� ������ (�ɼ�.:���Խ�):',
'bs_al_tables' => '�ɼ�.: EQdkp ���ξ��� (��ĭ => ���� ���ξ ���):',
'bs_al_zoneInfo' => 'Where (in the raid entry) to look for zone infos?',
'bs_al_bossInfo' => 'Where (in the raid entry) to look for boss infos?',
'bs_al_linkInfo' => '��ũ �ɼ�:',
'bs_al_name' => '�̸�',
'bs_al_trigger' => 'String Ʈ����',
'bs_ao_rnote' => '���̵��Ʈ',
'bs_ao_rname' => '���̵��̸�',
'bs_al_source' => '������ ����:',
'bs_source_db' => '�����ͺ��̽�',
'bs_source_offs' => '������',
'bs_source_both' => 'both',
'bs_source_cache' => 'ĳ��',
'bs_al_showZone' => '�÷����ο� ������ ������ ������ ����:',
'lang' => 'english',

'dateFormat' => '%m/%d/%Y',
'bs_out_date_format' => 'mm/dd/yy', 
'bs_date_day' => array('start' => 3, 'length' => 2),
'bs_date_month' => array('start' => 0, 'length' => 2), 
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => '��¥ ����: ',
'bs_ol_in' => '�̸�',
'bs_ol_fd' => '���� ��¥',
'bs_ol_ld' => '���� ��¥',
'bs_ol_co' => 'ī����',
'bs_ol_submit' => '����',

// cache page
'bs_adm_cache_info' => 'ĳ��: ĳ�� ����� ����Ͽ� �ټ� ���̵带 ���� DKP �ý��ۿ��� �ε��ð��� ���� �� �ֽ��ϴ�.',
'bs_adm_cache_refresh' => 'ĳ�� ���ΰ�ħ',

//BossProgress User Page
'bp_um_link' => '��������',
'firstkill' => 'ù óġ: ',
'lastkill' => '������ óġ: ',
'firstvisit' => 'ù Ʈ����: ',
'lastvisit' => '������ Ʈ����: ',
'zonevisitcount' => 'Ʈ���� Ƚ��: ',
'bosskillcount' => 'óġ Ƚ��: ',
'status' => '����: ',
'never' => '����',
'all_zones' => '��� ����',
'bs_ol_zoneselect' => '���� ����:',

'opt_general' => '�Ϲ� ����',
'opt_dynloc' => '���� ų�� ���� ������ ����ڽ��ϱ�?',
'opt_dynboss' => 'ų���� ���� ������ ����ڽ��ϱ�?',
'opt_showzone' => '����: ',
'opt_showSB' => '���� ���� ǥ������ ���̰ڽ��ϱ�?',
'opt_zhiType' => '��� �̹������� ���� ���� ����?',
'zhi_jitter' =>'old photo',
'zhi_bw' => 'black/white',
'zhi_none' => 'not at all',
'opt_style' => '��Ÿ��: ',
'bp_style_bp' => 'BossProgress default',
'bp_style_bps' => 'BossProgress simple',
'bp_style_rp2r' => 'Raidprogress 2/row',
'bp_style_rp3r' => 'Raidprogress 3/row',


'bl_loottable' => '����ǰ���: ',
'bl_kc_p1' => ' (killed ',
'bl_kc_p2' => ' times)',
'bs_image_not_found' => '�ش� ������ �̹����� ã�� �� �����ϴ�. �̹����� ������ �ִٸ� �����Ӱ� ������ �ּ���.',
'bl_itemname' => '������ �̸�',
'bl_itemcount' => 'ȹ�� Ƚ��',
'bl_droprate' => 'ȹ����',
'bl_loottable_offsets' => '(Offset mode) ������ ���:',
'bl_dl' => '����ǰ ���',
'bl_ndl' => '����ǰ ������� ����',
'bl_wl' => 'Wrong assigned/unclear loot',

'bl_itemsfound' => '������ ã��',
'item_lang_none' => '����',

//Admin menu
'bl_opt_minitemqual' => '������ �ּ� ������ ���:',
'bl_opt_itemlang' => '����ǰ��� ����',
'bl_opt_ndl' => '���� ������� ���� ����ǰ�� ����?',
'bl_opt_wl' => '�Ϲݸ� ����ǰ�� ����?',
'bl_opt_is' => '����� �� ���� ����ǰ �����۽��� ���?',
'bl_opt_eyecandy' => 'Enable eye-candy (accordions)?',
'bc_opt_eyecandy' => 'Enable eye-candy (accordions)? (PLUS 0.5+ ONLY!)',
'bs_credits_p1' => 'EQDKP BossSuite v',
'bs_credits_p2' => ' by sz3',
'bl_credits_ll' => '����ǰ ���: ',
'bl_credits_bi' => '���� �̹���: ',
'bl_no_lootlist_credits' => '���õǰų� Ȯ�ε� ����ǰ����� ����',
'bl_no_bossimages_credits' => 'Ȯ�ε� ���� �̹��� credits �� ����',

'item_qual_-1' => '���',

//About page
'bs_about_header' => 'About the BossSuite',
'bs_additions' => 'Contributions:',
'bs_copyright' => 'Copyright:',
'bs_url_web' => 'Web',
'bs_short_desc' => 'Ȯ��� ����ǰ/���� ����.',
'bs_long_desc' => 'óġ�� ������ ������ ���� ����, ����ǰ�� ���� ������ ������ ���Դϴ�.',
'bs_game_not_supported' => '�˼��մϴ�, �� ������ �������� �ʽ��ϴ�.',
'bs_enable_bosscounter' => '����ī���� ���',
'bs_enable_note2link' => 'note2link ���',

'bs_img_style_normal' => 'normal',
'bs_img_style_sepia' => 'sepia',
'bs_img_style_grey' => 'grey',
'bs_style_sname' => 'short name',
'bs_style_lname' => 'long name',
'bs_opt_zlength' => '���� �̸� ���� ����',
'bs_trigger' => 'Ʈ����',
'bs_bp_style_options' => '�������� ��Ÿ�� �ɼ�',
'bs_bp_style_si' => 'Image to start with:',
'bs_bp_style_ei' => 'Image to end with:',
'bs_bp_style_ztext' => '�����̸� ',
'bs_bp_style_ztext_none' => '����',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => 'text',
'bl_opt_lootlist' => '����ǰ��� �ɼ�, ����ǰ����� ���� ���� ����',

'bs_depmatch' => 'Match bosses depending on the zone match:',
'bs_am_bzone' => '����/����',
'bs_ec_show_bp' => '����(��������)',
'bs_ec_show_bc' => '����(����ī����)',
'bs_ec_strings' => 'Ʈ����',

'bs_enable_updchk' => '�� �÷����� ���� Ȯ��',
'bl_opt_en_mv' => 'wowhead modelviewer ���',
'bs_enable_autoclose' => '������ ����/���� �˾� �ݱ�',
);

?>
