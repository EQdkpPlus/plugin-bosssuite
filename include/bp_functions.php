<?php
/******************************
 * EQdkp Bossprogress2
 * by sz3
 * 
 * Additional Credits should go to 
 * Corgan's bosscounter mod
 * Wallenium's ItemSpecials plugin
 * Magnus' raidprogress plugin
 * 
 * which all lend inspiration and/or code bits 
 *  
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * bp_functions.php
 * 02.10.06 sz3
 * 16.04.07 sz3
 ******************************/

define ('MAXDATE', mktime (0,0,0,1,1,2015));
define ('MINDATE', mktime (0,0,0,1,1,2000));

// Save or add values to the database.
function bp_update_config($fieldname,$insertvalue) {
global $eqdkp_root_path, $user, $SID, $table_prefix, $db;
    	$sql = "UPDATE `".$table_prefix."bp_config` SET config_value='".strip_tags(htmlspecialchars($insertvalue))."' WHERE config_name='".$fieldname."';";
		$db->query($sql);
		if (mysql_affected_rows() == 0){
			$sql = "INSERT INTO `".$table_prefix."bp_config` VALUES('".$fieldname."', '".strip_tags(htmlspecialchars($insertvalue))."');";	
			$db->query($sql);
		}
}



// Get configuration from database
function bp_get_config() {
global $db, $table_prefix;
$sql = 'SELECT * FROM ' . $table_prefix . 'bp_config ORDER BY config_name';
if (!($settings_result = $db->query($sql))) {
	message_die('Could not obtain bossprogress configuration data', '', __FILE__, __LINE__, $sql);
}

while($roww = $db->fetch_record($settings_result)) {
    $conf[$roww['config_name']] = $roww['config_value'];
}	

return $conf;
}



function bp_get_sql_data_string($tablestring){
$tables = array();
if($tablestring != '')
	$tables = explode(", ", $tablestring);

$sql = "";
if (count($tables) == 0) {
	$sql = "SELECT  raid_name AS rname, raid_date AS rdate, raid_note AS rnote FROM " . RAIDS_TABLE . ";";
} else {
	$bpinc = 0;
	foreach ($tables as $raidtable) {
		if ($bpinc == 0) {
			$sql .= "SELECT raid_name AS rname, raid_date AS rdate, raid_note AS rnote FROM " . $raidtable . "_raids";
			$bpinc++;
		} else {
			$sql .= " UNION ALL SELECT raid_name, raid_date, raid_note FROM " . $raidtable . "_raids";
		}
	}
	$sql .= ";";
}
return $sql;
}



function bp_get_visible_bzone($zones, $conf){
	$szones = array();
	foreach($zones as $zone => $bosses){
		if ($conf['sz_'.$zone] == '1'){
			$szones[$zone] = $bosses;
		}
	}
	return $szones;
}


function bp_init_data_array($bzone){
foreach ($bzone as $zone => $bosses) {
	$data[$zone]['vc'] = 0 + $zo_vc[$zone];
	$data[$zone]['fvd']=MAXDATE;
	$data[$zone]['lvd']=MINDATE;
			 
	foreach ($bosses as $boss){
    	$data[$zone][bosses][$boss]['kc'] = 0;
    	$data[$zone][bosses][$boss]['fkd']=MAXDATE;
    	$data[$zone][bosses][$boss]['lkd']=MINDATE;
	}
}

return $data;

}



function bp_fetch_bzi($bzone, $data, $bb_conf, $bb_pzone, $bb_pboss) {
	$delim = array (
    	'rnote' => '/'.$bb_conf['noteDelim'].'/',
		'rname' => '/'.$bb_conf['nameDelim'].'/'
	);

	$bossInfo = $bb_conf['bossInfo'];
	$zoneInfo = $bb_conf['zoneInfo'];

	#Get data from the raids tables
	##################################################
	$sql = bp_get_sql_data_string($bb_conf['tables']);	
	$result = mysql_query($sql) or message_die(mysql_error());

	while ($row = mysql_fetch_assoc($result)) {
		foreach ($bzone as $zone => $bosses){
			# Get zoneinfo from current row
			################################
			if ($delim[$zoneInfo] != "//"){
				$zone_element = preg_split($delim[$zoneInfo], $row[$zoneInfo], -1, PREG_SPLIT_NO_EMPTY);
			} else {
				$zone_element = array($row[$zoneInfo]);
			}
			foreach ($zone_element as $raid){
				$zparseList = preg_split("/\', \'/", stripslashes(trim($bb_pzone['pz_'.$zone], "\' ")));
				if (in_array(stripslashes(trim($raid)), $zparseList)) {
					$data[$zone][vc]++;
					if ($data[$zone][fvd] > $row["rdate"]) {
						$data[$zone][fvd] = $row["rdate"];
					}
					if ($data[$zone][lvd] < $row["rdate"]) {
						$data[$zone][lvd] = $row["rdate"];
					}
				}	
			}

			# Get bossinfo from current row
			################################
			if ($delim[$bossInfo] != "//"){
				$boss_element = preg_split($delim[$bossInfo], $row[$bossInfo], -1, PREG_SPLIT_NO_EMPTY);
			} else {
				$boss_element = array($row[$bossInfo]);
			}
			foreach ($boss_element as $raid){
				foreach ($bosses as $boss){
        			$bparseList = preg_split("/\', \'/", stripslashes(trim($bb_pboss['pb_'.$boss], "\' ")));
					if (in_array(stripslashes(trim($raid)), $bparseList)) {
						$data[$zone][bosses][$boss][kc]++;
						if ($data[$zone][bosses][$boss][fkd] > $row["rdate"]) {
							$data[$zone][bosses][$boss][fkd] = $row["rdate"];
						}
						if ($data[$zone][bosses][$boss][lkd] < $row["rdate"]) {
							$data[$zone][bosses][$boss][lkd] = $row["rdate"];
						}
					}		
				}
			}
		}	
	}
	mysql_free_result($result);
	return $data;
}
?>
