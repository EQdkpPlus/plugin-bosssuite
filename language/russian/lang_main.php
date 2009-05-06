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
'bs_pm_conf' => '������������',
'bs_pm_offs' => 'offsets',
'bs_bp_view' => '�������� PvE ���������',
'bs_bl_view' => '�������� �������',
'bs_bc_view' => '�������� ���',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => '���������',
'bs_am_offs' => 'Offsets',
'bs_am_cache' => '���',

// admin page
'bs_al_submit' => '���������',
'bs_al_general' => '������� ���������',
'bs_al_delimRNO' => '���� ������� delimiter (Opt.: Regular Expression):',
'bs_al_delimRNA' => '�������� ����� delimiter (Opt.: Regular Expression):',
'bs_al_tables' => 'Opt.: EQdkp ������ prefix(��) (����� => ������ ������� prefix):',
'bs_al_zoneInfo' => '��� (in the ���� entry) to look for zone infos?',
'bs_al_bossInfo' => '��� (in the ���� entry) to look for boss infos?',
'bs_al_linkInfo' => 'Link �����:',
'bs_al_name' => '���',
'bs_al_trigger' => '������ ��������(��)',
'bs_ao_rnote' => '������� �����',
'bs_ao_rname' => '�������� �����',
'bs_al_source' => '�������� ������:',
'bs_source_db' => '���� ������',
'bs_source_offs' => 'offsets',
'bs_source_both' => '���',
'bs_source_cache' => '���',
'bs_al_showZone' => '�������� ����, ������� ����� �������� � �������:',
'lang' => 'english',

'dateFormat' => '%m/%d/%Y',
'bs_out_date_format' => 'mm/dd/yy',
'bs_date_day' => array('start' => 3, 'length' => 2),
'bs_date_month' => array('start' => 0, 'length' => 2),
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => '������ ����: ',
'bs_ol_in' => '���',
'bs_ol_fd' => '������ ����',
'bs_ol_ld' => '��������� ����',
'bs_ol_co' => '�������',
'bs_ol_submit' => '���������',

// cache page
'bs_adm_cache_info' => '���: ��������� ������� ���, ������ ����������� ����� �������� �� DKP �������� � ��������������� �������',
'bs_adm_cache_refresh' => '�������� ���',

//BossProgress User Page
'bp_um_link' => 'PvE ��������',
'firstkill' => '������ ��������: ',
'lastkill' => '��������� ��������: ',
'firstvisit' => '������ �����: ',
'lastvisit' => '��������� �����: ',
'zonevisitcount' => '���������� �������: ',
'bosskillcount' => '���������� �������: ',
'status' => '������: ',
'never' => '�������',
'all_zones' => '��� ����',
'bs_ol_zoneselect' => '����� ����:',

'opt_general' => '������� ���������',
'opt_dynloc' => '������ ����, ��� �� ���� ������� ������?',
'opt_dynboss' => '������ �� ���� �� ������ ������?',
'opt_showzone' => '��������: ',
'opt_showSB' => '���������� ������ ��������� ����?',
'opt_zhiType' => '��� ������������ ������� �� ������� ��������?',
'zhi_jitter' =>'������ ����',
'zhi_bw' => '������/�����',
'zhi_none' => '���������',
'opt_style' => '�����: ',
'bp_style_bp' => '���� �������� �����������',
'bp_style_bps' => '���� �������� �������',
'bp_style_rp2r' => '�������� ����� 2/���',
'bp_style_rp3r' => '�������� ����� 3/���',


'bl_loottable' => '������ �������: ',
'bl_kc_p1' => ' ���� ',
'bl_kc_p2' => ' ���(�)',
'bs_image_not_found' => '��������, ����������� ����� �� ���� �������. ���� �� ����� ����, �� ����������� ������� ���� ����� � ������.',
'bl_itemname' => '�������� ��������',
'bl_itemcount' => '�������� ����� ���������',
'bl_droprate' => '���� ���������',
'bl_loottable_offsets' => '(Offset mode) ������ ���������:',
'bl_dl' => '�������� ������',
'bl_ndl' => '�� ���� �� �������� ������',
'bl_wl' => 'Wrong assigned/unclear loot',

'bl_itemsfound' => '��������� �������',
'item_lang_none' => '�� ����',

//Admin menu
'bl_opt_minitemqual' => '���������� �������� �� ��������:',
'bl_opt_itemlang' => '������� ����',
'bl_opt_ndl' => '����� ������� �� ���� �� �������� ���?',
'bl_opt_wl' => '����� �������, �� ������������� �����?',
'bl_opt_is' => '�������� ���������� ��������� ��� �� ���� �� �������� �������?',
'bl_opt_eyecandy' => '�������� eye-candy (����������)?',
'bc_opt_eyecandy' => '�������� eye-candy (����������)? (������ �� PLUS 0.5+ !)',
'bs_credits_p1' => 'EQDKP BossSuite ������',
'bs_credits_p2' => ' by sz3',
'bl_credits_ll' => '������ �������: ',
'bl_credits_bi' => '����������� ������: ',
'bl_no_lootlist_credits' => '������ ��������� �� ������/������',
'bl_no_bossimages_credits' => '������� ����������� ������ �� �������',

'item_qual_-1' => '���',

//About page
'bs_about_header' => '� BossSuite',
'bs_additions' => '�������������:',
'bs_copyright' => '������:',
'bs_url_web' => 'Web',
'bs_short_desc' => '����������� ������/���������� � ���������.',
'bs_game_not_supported' => '��������, ���� ���� �� ��������������.',
'bs_enable_bosscounter' => '�������� BossCounter',
'bs_enable_note2link' => '�������� note2link',

'bs_img_style_normal' => '���������',
'bs_img_style_sepia' => '�����',
'bs_img_style_grey' => '�����',
'bs_style_sname' => '�������� ��������',
'bs_style_lname' => '������� ��������',
'bs_opt_zlength' => '��������� �������� ���� �������',
'bs_trigger' => '�������',
'bs_bp_style_options' => 'BossProgress ����� �����',
'bs_bp_style_si' => 'Image to start with:',
'bs_bp_style_ei' => 'Image to end with:',
'bs_bp_style_ztext' => '�������� ���� ',
'bs_bp_style_ztext_none' => 'none',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => '�����',
'bl_opt_lootlist' => '����� ������ �������, ��������, ������ ���� ������ ������ �������',

'bs_updateitem_l_name' => '�������� ��������',

'bs_enable_updchk' => 'Enable check for new Plugin Versions',
'bl_opt_en_mv' => 'Enable wowhead modelviewer',
'bs_enable_autoclose' => 'Auto-close boss/zone popup after saving',
);

?>
