<?php
/******************************
* EQdkp BossLoot
* by sz3
*
* Copyright 2006
* Licensed under the GNU GPL.  See COPYING for full terms.
* ------------------
* bossloot.php
* 01.05.07 sz3
******************************/


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
require(dirname(__FILE__).'/include/bssql.class.php');
$mybssql = new BSSQL();

  $bzone = $mybssql->get_bzone();
	$bb_conf = $mybssql->get_config('bossbase');
	$bb_pboss = $mybssql->get_parse_boss();
	$bl_conf = $mybssql->get_config('bossloot');
	//$bzone = bb_get_bzone();
	$sbzone = $bzone;//bc_get_visible_bzone($bzone, $bc_conf);


require(dirname(__FILE__).'/include/blmgs.class.php');
$myblmgs = new BLMGS();

// sql class
require(dirname(__FILE__).'/include/blsql.class.php');
$myblsql = new BLSQL();


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



if ($bb_conf['source'] == 'database'){
	$data = $myblsql->bl_fetch_bli($bb_conf, $bb_pboss, $bossid);
} else if ($bb_conf['source'] == 'offsets'){
	message_die("Source = offsets => no loot!");
} else if ($bb_conf['source'] == 'both'){
  $data = $myblsql->bl_fetch_bli($bb_conf, $bb_pboss, $bossid);  
  $bb_boffs = $mybssql->get_boss_offsets();
  $data['kc'] +=  $bb_boffs[$bossid]['co'];
} else if ($bb_conf['source'] == 'cache'){
  $data = $myblsql->bl_fetch_bli($bb_conf, $bb_pboss, $bossid);  
  $bb_boffs = $mybssql->get_boss_offsets();
  $data['kc'] +=  $bb_boffs[$bossid]['co'];

}

//Name
$bl_out  = '<tr class="row2"><th colspan="3" align="center">'. $user->lang['bl_loottable'].$user->lang[$bossid]['long'].$user->lang['bl_kc_p1'].$data['kc'].$user->lang['bl_kc_p2'].'</th></tr>'."\n";

//Image
$bl_out .= '<tr class="row1"><td colspan="3" align="center">'.$myblmgs->bl_get_bossimage($bossid).'</td></tr>'."\n";

//get loot table
$loottable = $myblmgs->bl_get_loottable($bl_conf['item_lang'], $bossid, $bl_conf['item_minqual']);

$printed0 = 0;
$printed1 = 0;

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
                $bl_cloot .= "\t\t\t".'<tr class="row'.$rowid0.'"><td><a href="'.$eqdkp->config['server_path'].'viewitem.php?s=&i='.$itemeid.'">'.$is_itemname.'</a></td><td>'.$itemcount.'</td><td>'.$droprate.'%</td></tr>'."\n";
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
				//$bl_ndloot .= "\t\t\t".'<tr class="row'.$rowid2.'"><td colspan="3"><a href="' . $eqdkp_root_path . 'itemstats/updateitem.php?item='.urlencode(urlencode($name)).'">'.$is_itemname.'</a></td></tr>'."\n";
				$bl_ndloot .= "\t\t\t".'<tr class="row'.$rowid2.'"><td colspan="3">'.$is_itemname.'</td></tr>'."\n";
				$printed2++;
			}
		}
	}
}

if($bl_conf['eyecandy'] == true){
// Loot output
$bl_out .= '<tr><td><div id="container"><div id="vertical_container">'."\n";

//Dropped loot
if ($bl_cloot != ''){
    $bl_out .= '<h2 class="accordion_toggle">'.$user->lang['bl_dl'].'</h2>';
    $bl_out .= "\t".'<div class="accordion_content">'."\n";
    $bl_out .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
    $bl_out .= "\t\t\t".'<tr class="row2"><th>'.$user->lang['bl_itemname'].'</th><th>'.$user->lang['bl_itemcount'].'</th><th>'.$user->lang['bl_droprate'].'</th></tr>'."\n";
    $bl_out .= "\t\t\t".$bl_cloot."\n";
    $bl_out .= "\t\t\t".'<tr class="row2"><td colspan="3" align="right">' . $printed0 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_out .= "\t\t".'</table>'."\n";
    $bl_out .= "\t".'</div>'."\n";
}

//never dropped loot
if ($bl_ndloot != ''){
    $bl_out .= '<h2 class="accordion_toggle">'.$user->lang['bl_ndl'].'</h2>'."\n";
    $bl_out .= "\t".'<div class="accordion_content">'."\n";
    $bl_out .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
    $bl_out .= "\t\t\t".'<tr class="row2"><th colspan="3">'.$user->lang['bl_itemname'].'</th></tr>'."\n";
    $bl_out .= $bl_ndloot;
    $bl_out .= "\t\t\t".'<tr class="row2"><td colspan="3" align="right">' . $printed2 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_out .= "\t\t".'</table>'."\n";
    $bl_out .= "\t".'</div>'."\n";
}

//wrong loot
if (($bl_conf['show_wl'] == true) && ($bl_wloot != '')){
    $bl_out .= '<h2 class="accordion_toggle">'.$user->lang['bl_wl'].'</h2>'."\n";
    $bl_out .= "\t".'<div class="accordion_content">'."\n";
    $bl_out .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
    $bl_out .= "\t\t\t".'<tr class="row2"><th>'.$user->lang['bl_itemname'].'</th><th>'.$user->lang['bl_itemcount'].'</th><th>'.$user->lang['bl_droprate'].'</th></tr>'."\n";
    $bl_out .= $bl_wloot;
    $bl_out .= "\t\t\t".'<tr class="row2"><td colspan="3" align="right">' . $printed1 . ' '.$user->lang['bl_itemsfound'].'</td></tr>'."\n";
    $bl_out .= "\t\t".'</table>'."\n";
    $bl_out .= "\t".'</div>'."\n";
}

$bl_out .= '</div></div></td></tr>';
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
    $bl_out .= '<tr><td><table width="100%"><tr class="row2"<th colspan="3" align="center">'.$user->lang['bl_ndl'].'</th></tr>'."\n";
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
	'BL_CREDITS' => $user->lang['bl_credits_p1'].$pm->get_data('bosssuite', 'version').$user->lang['bl_credits_p2'],
	'BL_LL_CREDITS' => $user->lang['bl_credits_ll'].$myblmgs->bl_get_lootlist_credits($bl_conf['item_lang']),
	'BL_BI_CREDITS' => $user->lang['bl_credits_bi'].$myblmgs->bl_get_bossimages_credits()
));

$eqdkp->set_vars(array (
	'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bossloot'],
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'template_file' => 'bossloot.html',
	'display' => true
	));
?>
