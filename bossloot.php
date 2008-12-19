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

// EQdkp required files/vars
define('EQDKP_INC', true);

$eqdkp_root_path = './../../';

include_once($eqdkp_root_path . 'common.php');


global $table_prefix, $SID, $user;

if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') )
{
    message_die('BossSuite plugin not installed.');
}

$user->check_auth('u_bosssuite_bl_view');

//Itemstats stuff
if (!(function_exists('itemstats_decorate_name'))) {
    if (file_exists(dirname(__FILE__).'/../../itemstats/eqdkp_itemstats.php')){
        include_once(dirname(__FILE__).'/../../itemstats/eqdkp_itemstats.php');
    }else{
        function itemstats_decorate_name($name){
            return $name;
        }
    }
}

// new mgs class
require(dirname(__FILE__).'/include/bsmgs.class.php');
$mybsmgs = new BSMGS();

if (!$mybsmgs->game_supported('bossbase')){
    message_die("GAME NOT SUPPORTED");
}

$mybsmgs->load_game_specific_language('bossbase');
$mybsmgs->load_game_specific_language('bossloot');

// sql class
require(dirname(__FILE__).'/include/blsql.class.php');
$myblsql = new BLSQL();

$bb_conf = $myblsql->get_config('bossbase');
$bl_conf = $myblsql->get_config('bossloot');

require(dirname(__FILE__).'/include/blmgs.class.php');
$myblmgs = new BLMGS();

if (isset($_GET['boss'])){
	$bossname = $_GET['boss'];
	foreach($bb_pboss as $name => $value){
		if(!(strpos($value, stripslashes($bossname)) === false)){
			$bossid = substr($name, 3);
			break;
		}
	}
	if ($bossid == "") 
		message_die("Boss unknown!");
}else if(isset($_GET['bossid'])){
	$bossid = $_GET['bossid'];
	
	if ($user->lang[$bossid]['short'] == "")
		message_die("Invalid boss id!: ".$bossid);
}else{
	message_die("no bossname/id given");
}

$data = $myblsql->get_bl_data($bb_conf, $bossid); 

//Name
$bl_out  = '<tr class="row2"><th colspan="3" align="center">'. $user->lang['bl_loottable'].$user->lang[$bossid]['long'].$user->lang['bl_kc_p1'].$data['kc'].$user->lang['bl_kc_p2'].'</th></tr>'."\n";

//Image
$bs_image_suffix = null;
$bs_image_map = null;

function import_image_config(){ 
global $bs_image_suffix, $bs_image_map, $mybsmgs;
  $mapfile = dirname(__FILE__)."/games/".$mybsmgs->get_current_game()."/image_config.php";
  if(file_exists($mapfile)){
    include($mapfile);
    $bs_image_suffix = $suffix;
    $bs_image_map = $image_map;
  }
}

import_image_config();

$bl_out .= '<tr class="row1"><td colspan="3" align="center">'.$myblmgs->bl_get_bossimage($bossid).'</td></tr>'."\n";

//get loot table
$loottable = $myblmgs->bl_get_loottable($bl_conf['item_lang'], $bossid, $bl_conf['item_minqual']);

$printed0 = 0;
$printed1 = 0;

//Framework include
include_once($eqdkp_root_path . 'plugins/bosssuite/include/libloader.inc.php');


if ((is_array($loottable)) && !(empty($loottable))){
    if (($data['kc'] > 0) && (count($data['items'])>0)){
        arsort($data['items']);	
    
        foreach($data['items'] as $itemname => $values){
            $itemcount = $values['dc'];
            $itemeid = $values['id'];			      
            if( (in_array($itemname, $loottable)) ){
                $droprate = round($itemcount/$data['kc']*100,2);
                $rowid0 = $printed0%2+1;
                $is_itemname = itemstats_decorate_name(stripslashes($itemname));
                $bl_cloot .= "\t\t\t".'<tr class="row'.$rowid0.'"><td><a href="'.$eqdkp_root_path.'viewitem.php?s=&i='.$itemeid.'">'.$is_itemname.'</a></td><td>'.$itemcount.'</td><td>'.$droprate.'%</td></tr>'."\n";
                $printed0++;
            } else {
                $rowid1 = $printed1%2+1;
                $droprate = round($itemcount/$data['kc']*100,2);
                $is_itemname = itemstats_decorate_name(stripslashes($itemname));
                $bl_wloot .= "\t\t\t".'<tr class="row'.$rowid1.'"><td><a href="'.$eqdkp_root_path.'viewitem.php?s=&i='.$itemeid.'">'.$is_itemname.'</a></td><td>'.$itemcount.'</td><td>'.$droprate.'%</td></tr>'."\n";
                $printed1++;
            }
        }
    }
}else{
    if (($data['kc'] > 0) && (count($data['items'])>0)){
        arsort($data['items']);	
    
        foreach($data['items'] as $itemname => $values){
            $itemcount = $values['dc'];
            $itemeid = $values['id'];			      
            $droprate = round($itemcount/$data['kc']*100,2);
            $rowid0 = $printed0%2+1;
            $is_itemname = itemstats_decorate_name(stripslashes($itemname));
            $bl_cloot .= "\t\t\t".'<tr class="row'.$rowid0.'"><td><a href="'.$eqdkp_root_path.'viewitem.php?s=&i='.$itemeid.'">'.$is_itemname.'</a></td><td>'.$itemcount.'</td><td>'.$droprate.'%</td></tr>'."\n";
            $printed0++;            
        }
    }
}

if ($bl_conf['show_ndl'] == true){	
  $printed2 = 0;
	if (is_array($loottable)){
		foreach($loottable as $id => $name){
			if ($data['items'][$name]['dc'] == 0){
				$rowid2 = $printed2%2+1;
				if ($bl_conf['get_itemstats'] == true){
						$is_itemname = itemstats_decorate_name(stripslashes($name));
				}else{
					$is_itemname = $name;
				}
        $bl_ndloot .= "\t\t\t".'<tr class="row'.$rowid2.'"><td colspan="3"><a href="' . $eqdkp_root_path . 'plugins/bosssuite/bs_update_item.php?item='.urlencode(urlencode($name)).'">'.$is_itemname.'</a></td></tr>'."\n";
				//$bl_ndloot .= "\t\t\t".'<tr class="row'.$rowid2.'"><td colspan="3">'.$is_itemname.'</td></tr>'."\n";
				$printed2++;
			}
		}
	}
}

if($bl_conf['eyecandy'] == true){

# Output
####################################################
$bl_acc_array = array();

//Dropped loot
if ($bl_cloot != ''){
    $bl_acc_title = '<table width="100%"><tr style="cursor:pointer;"><th>'.$user->lang['bl_dl'].'</th></tr></table>';
    $bl_acc_content = "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
    $bl_acc_content .= "\t\t\t".'<tr class="row2"><th>'.$user->lang['bl_itemname'].'</th><th>'.$user->lang['bl_itemcount'].'</th><th>'.$user->lang['bl_droprate'].'</th></tr>'."\n";
    $bl_acc_content .= "\t\t\t".$bl_cloot."\n";
    $bl_acc_content .= "\t\t\t".'<tr class="row2"><td colspan="3" align="right">' . $printed0 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_acc_content .= "\t\t".'</table>'."\n";
    $bl_acc_array[$bl_acc_title] = $bl_acc_content;
}

//never dropped loot
if ($bl_ndloot != ''){
    if ($bb_conf['source'] == 'offsets'){
      $bl_acc_title = '<table width="100%"><tr style="cursor:pointer;"><th>'.$user->lang['bl_loottable_offsets'].'</th></tr></table>'."\n";
    }else{
      $bl_acc_title = '<table width="100%"><tr style="cursor:pointer;"><th>'.$user->lang['bl_ndl'].'</th></tr></table>'."\n";
    }
    $bl_acc_content = "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
    $bl_acc_content .= "\t\t\t".'<tr class="row2"><th colspan="3">'.$user->lang['bl_itemname'].'</th></tr>'."\n";
    $bl_acc_content .= $bl_ndloot;
    $bl_acc_content .= "\t\t\t".'<tr class="row2"><td colspan="3" align="right">' . $printed2 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_acc_content .= "\t\t".'</table>'."\n";
    $bl_acc_array[$bl_acc_title] = $bl_acc_content;
}

//wrong loot
if (($bl_conf['show_wl'] == true) && ($bl_wloot != '')){
    $bl_acc_title = '<table width="100%"><tr style="cursor:pointer;"><th>'.$user->lang['bl_wl'].'</th></tr></table>'."\n";
    $bl_acc_content = "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
    $bl_acc_content .= "\t\t\t".'<tr class="row2"><th>'.$user->lang['bl_itemname'].'</th><th>'.$user->lang['bl_itemcount'].'</th><th>'.$user->lang['bl_droprate'].'</th></tr>'."\n";
    $bl_acc_content .= $bl_wloot;
    $bl_acc_content .= "\t\t\t".'<tr class="row2"><td colspan="3" align="right">' . $printed1 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_acc_content .= "\t\t".'</table>'."\n";
    $bl_acc_array[$bl_acc_title] = $bl_acc_content;
}

$bl_out .= '<tr><td>'.$jquery->accordion('bl_accordion',$bl_acc_array).'</td></tr>';

}else{
// Loot output
$bl_out .= '<tr><td>';
//Dropped loot
if ($bl_cloot != ''){
    $bl_out .= '<tr><td><table width="100%"><tr class="row2"<th colspan="3" align="center">'.$user->lang['bl_dl'].'</th></tr>';
    $bl_out .= '<tr class="row2"><th>'.$user->lang['bl_itemname'].'</th><th>'.$user->lang['bl_itemcount'].'</th><th>'.$user->lang['bl_droprate'].'</th></tr>'; 	  	  	
    $bl_out .= $bl_cloot;
    $bl_out .= '<tr><td colspan="3" align="right">' . $printed0 . ' '.$user->lang['bl_itemsfound'].'</td></tr>';
    $bl_out .= '</table></td></tr>';
}

//never dropped loot
if ($bl_ndloot != ''){
    if ($bb_conf['source'] == 'offsets'){
      $bl_out .= '<tr><td><table width="100%"><tr class="row2"<th colspan="3" align="center">'.$user->lang['bl_loottable_offsets'].'</th></tr>'."\n";
    }else{
      $bl_out .= '<tr><td><table width="100%"><tr class="row2"<th colspan="3" align="center">'.$user->lang['bl_ndl'].'</th></tr>'."\n";
    }
    
    $bl_out .= '<tr class="row2"><th colspan="3">'.$user->lang['bl_itemname'].'</th></tr>'."\n";
    $bl_out .= $bl_ndloot;
    $bl_out .= '<tr><td colspan="3" align="right">' . $printed2 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_out .= '</table></td></tr>';
}

//wrong loot
if (($bl_conf['show_wl'] == true) && ($bl_wloot != '')){
    $bl_out .= '<tr><td><table width="100%"><tr class="row2"<th colspan="3" align="center">'.$user->lang['bl_wl'].'</th></tr>';
    $bl_out .= '<tr class="row2"><th>'.$user->lang['bl_itemname'].'</th><th>'.$user->lang['bl_itemcount'].'</th><th>'.$user->lang['bl_droprate'].'</th></tr>';
    $bl_out .= $bl_wloot;
    $bl_out .= '<tr><td colspan="3" align="right">' . $printed1 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_out .= '</table></td></tr>';
}

$bl_out .= '</td></tr>';
}

# Assign Vars
# ####################################################
$tpl->assign_vars(array (
	'F_ACTION' => 'bossloot.php' . $SID,
	'BOSSLOOT' => $bl_out,
	'JS_ABOUT' => $jquery->Dialog_URL('About', $user->lang['bs_about_header'], 'about.php', '500', '600'),
	'L_CREDITS' => $user->lang['bs_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bs_credits_p2'],
	'BS_INFO_IMG' => 'images/credits/info.png',
));

$eqdkp->set_vars(array (
	'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bossloot'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'bossloot.html',
	'display' => true
	));
?>
