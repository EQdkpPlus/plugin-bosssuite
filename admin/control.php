<?php
/******************************
 * EQdkp BossBase
 * by sz3
 * 
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * control.php
 * 01.06.07 sz3
 ******************************/

// EQdkp required files/vars
define('EQDKP_INC', true);
define('IN_ADMIN', true);

$eqdkp_root_path = './../../../';
include_once ($eqdkp_root_path . 'common.php');

// Check user permission
$user->check_auth('a_bossbase_pcon');

if (!$pm->check(PLUGIN_INSTALLED, 'bossbase')) {
	message_die('The BossBase plugin is not installed.');
}

include_once ('../include/functions.php');


$arrvals = array (
	'L_BB' => "BossBase",
	'L_BB_CONF' => $user->lang['bb_pcon_bb_conf'],
	'L_BB_OFFS' => $user->lang['bb_pcon_bb_offs'],
	'L_BB_PCON' => $user->lang['bb_pcon_bb_pcon'],

	'L_BP' => "BossProgress",
	'SHOW_BP' => $pm->check(PLUGIN_INSTALLED, 'bossprogress'),
	'L_BP_CONF' => $user->lang['bb_pcon_bp_conf'],
	'L_BP_VIEW' => $user->lang['bb_pcon_bp_view'],

	'L_BC' => "BossCounter",
	'SHOW_BC' => $pm->check(PLUGIN_INSTALLED, 'bosscounter'),
	'L_BC_CONF' => $user->lang['bb_pcon_bc_conf'],
	'L_BC_VIEW' => $user->lang['bb_pcon_bc_view'],

	'L_BL' => "BossLoot",
	'SHOW_BL' => $pm->check(PLUGIN_INSTALLED, 'bossloot'),
	'L_BL_VIEW' => $user->lang['bb_pcon_bl_view'],

	'L_ALL_USERS' => $user->lang['bb_pcon_all_users'],
	'L_PLUGIN' => $user->lang['bb_pcon_pluginname'],
	'L_PERMISSION' => $user->lang['bb_pcon_permission'],
	'L_GRANT' => $user->lang['bb_pcon_grant'],
	'L_REVOKE' => $user->lang['bb_pcon_revoke'],

	'CREDITS' => $user->lang['bb_credits1'] . $pm->get_data('bossbase', 'version') . $user->lang['bb_credits2'],
	'F_CONFIG' => 'control.php' . $SID,
);

//BossBase permissions
if ($_POST['bb_pcon_bb_conf_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2352');
	}
}
if ($_POST['bb_pcon_bb_conf_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2352');
	}
}
if ($_POST['bb_pcon_bb_offs_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2351');
	}
}
if ($_POST['bb_pcon_bb_offs_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2351');
	}
}
if ($_POST['bb_pcon_bb_pcon_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2353');
	}
}
if ($_POST['bb_pcon_bb_pcon_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2353');
	}
}



//BossProgress permissions
if ($_POST['bb_pcon_bp_view_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2301');
	}
}
if ($_POST['bb_pcon_bp_view_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2301');
	}
}
if ($_POST['bb_pcon_bp_conf_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2302');
	}
}
if ($_POST['bb_pcon_bp_conf_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2302');
	}
}

//BossCounter permissions
if ($_POST['bb_pcon_bc_view_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2340');
	}
}
if ($_POST['bb_pcon_bc_view_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2340');
	}
}
if ($_POST['bb_pcon_bc_conf_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2341');
	}
}
if ($_POST['bb_pcon_bc_conf_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2341');
	}
}

//BossLoot permissions
if ($_POST['bb_pcon_bl_view_grant_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_grant_permission($id, '2330');
	}
}
if ($_POST['bb_pcon_bl_view_revoke_bu']){
	$userids = bb_get_all_userids();
	foreach ($userids as $id){
		bb_revoke_permission($id, '2330');
	}
}


//Output
$tpl->assign_vars($arrvals);

$eqdkp->set_vars(array (
	'page_title' => sprintf($user->lang['admin_title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['bb_conf_pagetitle'],
	'template_path' => $pm->get_data('bossbase', 'template_path'),
	'template_file' => 'admin/control.html',
	'display' => true
	)
);

function bb_get_all_userids(){
global $table_prefix, $db;
	$sql = 'SELECT `user_id` FROM `'.$table_prefix.'users` ';
	if (!($result = $db->query($sql))) {
		message_die('(BossBase) Could not obtain user ids', '', __FILE__, __LINE__, $sql);
	}
    $i=0;
	while($row = $db->fetch_record($result)) { 
		$idarr[$i] = $row['user_id'];
		$i++;
	}
	return $idarr;
}


?>
