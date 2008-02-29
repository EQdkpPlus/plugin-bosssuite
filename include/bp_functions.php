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

function bp_init_data_array($bzone){
foreach ($bzone as $zone => $bosses) {
	$data[$zone]['vc'] = 0 + $zo_vc[$zone];
	$data[$zone]['fvd']=BS_MAX_DATE;
	$data[$zone]['lvd']=BS_MIN_DATE;
			 
	foreach ($bosses as $boss){
    	$data[$zone]['bosses'][$boss]['kc'] = 0;
    	$data[$zone]['bosses'][$boss]['fkd']=BS_MAX_DATE;
    	$data[$zone]['bosses'][$boss]['lkd']=BS_MIN_DATE;
	}
}

return $data;

}

function bp_fetch_bzi($bzone, $data, $bb_conf, $bb_pzone, $bb_pboss) {
	global $db;
  $delim = array (
    'rnote' => '/'.$bb_conf['noteDelim'].'/',
		'rname' => '/'.$bb_conf['nameDelim'].'/'
	);

	$bossInfo = $bb_conf['bossInfo'];
	$zoneInfo = $bb_conf['zoneInfo'];

	#Get data from the raids tables
	##################################################
	$sql = bp_get_sql_data_string($bb_conf['tables']);	
	
  //$result = mysql_query($sql) or message_die(mysql_error());
	//while ($row = mysql_fetch_assoc($result)) {
	
  $result = $db->query($sql);
	foreach($db->fetch_record_set() as $row) {
	
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
					$data[$zone]['vc']++;
					if ($data[$zone]['fvd'] > $row["rdate"]) {
						$data[$zone]['fvd'] = $row["rdate"];
					}
					if ($data[$zone]['lvd'] < $row["rdate"]) {
						$data[$zone]['lvd'] = $row["rdate"];
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
						$data[$zone]['bosses'][$boss]['kc']++;
						if ($data[$zone]['bosses'][$boss]['fkd'] > $row["rdate"]) {
							$data[$zone]['bosses'][$boss]['fkd'] = $row["rdate"];
						}
						if ($data[$zone]['bosses'][$boss]['lkd'] < $row["rdate"]) {
							$data[$zone]['bosses'][$boss]['lkd'] = $row["rdate"];
						}
					}		
				}
			}
		}	
	}
	//mysql_free_result($result);
	return $data;
}
?>
