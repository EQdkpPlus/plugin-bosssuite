<?php
 /*
 * Project:     EQdkp-Plus
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date: 2008-10-27 16:40:46 +0100 (Mo, 27 Okt 2008) $
 * -----------------------------------------------------------------------
 * @author      $Author: wallenium $
 * @copyright   2006-2008 Corgan - Stefan Knaak | Wallenium & the EQdkp-Plus Developer Team
 * @link        http://eqdkp-plus.com
 * @package     eqdkp-plus
 * @version     $Rev: 2899 $
 * 
 * $Id: portalsettings.php 2899 2008-10-27 15:40:46Z wallenium $
 */

define('EQDKP_INC', true);
define('IN_ADMIN', true);
$eqdkp_root_path = './../../../';
include_once($eqdkp_root_path . 'common.php');

// sql class
require(dirname(__FILE__).'/../include/bssql.class.php');
$mybssql = new BSSQL();

//Framework include
include_once($eqdkp_root_path . 'plugins/bosssuite/include/libloader.inc.php');
$wpfccore->InitAdmin();
 
$entity = $_GET['entity'];
$mode = $_GET['mode'];

if($mode != 'boss' && $mode!='zone'){
  message_die("Invalid mode: $mode");
}

// Save the settings
if ($_POST['bpsavebu']){
  $strings = strip_tags(htmlspecialchars($_POST['strings']));
  $co_offs = intval($_POST['co_offs']);
  $fd_offs = bs_text2date($_POST['fd_offs'], true);
  $ld_offs = bs_text2date($_POST['ld_offs'], false);

  
  if($mode == 'zone'){
    $pzrow = $mybssql->get_parse_zone();
    $zone_offsets = $mybssql->get_zone_offsets();
    $show_bp = ($_POST['show_bp'] == '1')? 1 : 0;
    $show_bc = ($_POST['show_bc'] == '1')? 1 : 0;
    $mybssql->update_zone_visibility('bosscounter', $entity, $show_bc);
    $mybssql->update_zone_visibility('bossprogress', $entity, $show_bp);
    $mybssql->update_parse_zone($pzrow, $entity, $strings);
    $mybssql->update_zone_offsets($zone_offsets, $entity, $fd_offs, $ld_offs, $co_offs);  
  }else{
    $pbrow = $mybssql->get_parse_boss();
    $boss_offsets = $mybssql->get_boss_offsets();
    $mybssql->update_parse_boss($pbrow, $entity, $strings);
    $mybssql->update_boss_offsets($boss_offsets, $entity, $fd_offs, $ld_offs, $co_offs);
  }
  
  //Update cache if necessary
  $pm->do_hooks('/plugins/bosssuite/admin/entity_conf.php');
}

if($mode == 'zone'){
  $parse_array = $mybssql->get_parse_zone();
  $offset_array = $mybssql->get_zone_offsets();
  $data['strings'] = $parse_array['pz_'.$entity];
  $bc_sbzone = $mybssql->get_bzone('bosscounter');
  $bp_sbzone = $mybssql->get_bzone('bossprogress');
  $data['show_bc'] = ( array_key_exists($entity, $bc_sbzone) ) ? 1 : 0;
  $data['show_bp'] = ( array_key_exists($entity, $bp_sbzone) ) ? 1 : 0;
}else{
  $parse_array = $mybssql->get_parse_boss();
  $offset_array = $mybssql->get_boss_offsets();
  $data['strings'] = $parse_array['pb_'.$entity];
}
$data['fd_offs'] = $offset_array[$entity]['fd'];
$data['ld_offs'] = $offset_array[$entity]['ld'];
$data['co_offs'] = $offset_array[$entity]['counter'];


$zbcode = '<table width="100%" border="0" cellspacing="1" cellpadding="2">';

$zbcode .= '<tr class="'.$eqdkp->switch_row_class().'">';
$zbcode .= '<td>'.$user->lang['bs_ol_fd'].'</td>';
$zbcode .= '<td>';
$zbcode .= $jquery->Calendar("fd_offs", bs_date2text($data['fd_offs']), '', $user->lang['bs_out_date_format']);
$zbcode .= '</td>';
$zbcode .= '</tr>';

$zbcode .= '<tr class="'.$eqdkp->switch_row_class().'">';
$zbcode .= '<td>'.$user->lang['bs_ol_ld'].'</td>';
$zbcode .= '<td>';
$zbcode .= $jquery->Calendar("ld_offs", bs_date2text($data['ld_offs']), '', $user->lang['bs_out_date_format']);
$zbcode .= '</td>';
$zbcode .= '</tr>';

$zbcode .= '<tr class="'.$eqdkp->switch_row_class().'">';
$zbcode .= '<td>'.$user->lang['bs_ol_co'].'</td>';
$zbcode .= '<td><input type="text" name="co_offs" size="3" value="' . $data['co_offs'] . '" class="input" /></td>';
$zbcode .= '</tr>';

$zbcode .= '<tr class="'.$eqdkp->switch_row_class().'">';
$zbcode .= '<td>'.$user->lang['bs_ec_strings'].'</td>';
$zbcode .= '<td><input type="text" name="strings" size="80" value="'.$data['strings'].'" class="input" /></td>';
$zbcode .= '</tr>';

if($mode == 'zone'){
  $zbcode .= '<tr class="'.$eqdkp->switch_row_class().'">';
  $zbcode .= '<td>'.$user->lang['bs_ec_show_bp'].'</td>';
  $bp_checked = ($data['show_bp'] > 0)? 'checked="checked"' : '';
  $zbcode .= '<td><input type="checkbox" name="show_bp" value="1" '.$bp_checked.' /></td>';
  $zbcode .= '</tr>';
  
  $zbcode .= '<tr class="'.$eqdkp->switch_row_class().'">';
  $zbcode .= '<td>'.$user->lang['bs_ec_show_bc'].'</td>';
  $bc_checked = ($data['show_bc'] > 0)? 'checked="checked"' : '';
  $zbcode .= '<td><input type="checkbox" name="show_bc" value="1" '.$bc_checked.' /></td>';
  $zbcode .= '</tr>';
}
$zbcode .= '</table>';

$bs_conf = $mybssql->get_config('bossbase');

$tpl->assign_vars(array(
    'F_SETTINGS'  => "entity_conf.php".$SID."&amp;mode=$mode&amp;entity=$entity",
    'SETTINGS'    => $zbcode,
    'AUTOCLOSE'   => ( $bs_conf['enable_autoclose'] == 1 ) ? ' onclick="self.close()"' : '',
    'L_SUBMIT'    => $user->lang['bs_al_submit'],
    )
);

$eqdkp->set_vars(array(
  'gen_simple_header' => true,
  'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '. 'Settings',
  'template_path' => $pm->get_data('bosssuite', 'template_path'),
  'template_file' => 'admin/entity_conf.html',
  'display'       => true
));

function bs_date2text($date) {
global $user;
	if (($date == BS_MAX_DATE) or ($date == BS_MIN_DATE)) {
		return '';
	} else {
		return strftime($user->lang['dateFormat'], $date);
	}
}

function bs_text2date($text, $max_date) {
  global $user;
  if (($text == $user->lang['never']) || ($text == '')){
    if ($max_date){
      return BS_MAX_DATE;
    } else {
      return BS_MIN_DATE;
    }
  } else {
    $day = substr($text, $user->lang['bs_date_day']['start'], $user->lang['bs_date_day']['length']);
    $month = substr($text, $user->lang['bs_date_month']['start'], $user->lang['bs_date_month']['length']);
    $year = substr($text, $user->lang['bs_date_year']['start'], $user->lang['bs_date_year']['length']);
    return mktime(0,0,0,$month,$day,$year);
  }
}

?>
