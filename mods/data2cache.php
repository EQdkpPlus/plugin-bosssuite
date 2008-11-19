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

if (!defined('EQDKP_INC')) {
	die('You cannot access this file directly.');
}

function bs_get_sql_data_string($tablestring){
  $tables = array();
  if($tablestring != '')
      $tables = explode(", ", $tablestring);
  
  $sql = "";
  if (count($tables) == 0) {
      $sql = "SELECT raid_name AS rname, raid_note AS rnote, raid_date AS rdate FROM " . RAIDS_TABLE . ";";
  } else {
      $bpinc = 0;
      foreach ($tables as $raidtable) {
          if ($bpinc == 0) {
              $sql .= "SELECT raid_name AS rname, raid_note AS rnote, raid_date AS rdate FROM " . $raidtable . "_raids";
              $bpinc++;
          } else {
              $sql .= " UNION ALL SELECT raid_name, raid_note, raid_date AS rdate FROM " . $raidtable . "_raids";
          }
      }
      $sql .= ";";
  }
  return $sql;
}

function bs_data2cache(){
// new mgs class
global $db;
require(dirname(__FILE__).'/../include/bsmgs.class.php');
$mybsmgs = new BSMGS();

if (!$mybsmgs->game_supported('bossbase')){

}else{
  
  $mybsmgs->load_game_specific_language('bossbase');
  
  // sql class
  require(dirname(__FILE__).'/../include/bssql.class.php');
  $mybssql = new BSSQL();
  
  $bzone = $mybssql->get_bzone();
  
  $bb_conf = $mybssql->get_config('bossbase');
  $bb_pboss = $mybssql->get_parse_boss();
  $bb_pzone = $mybssql->get_parse_zone();
  
  $bb_boffs = $mybssql->get_boss_offsets();
	$bb_zoffs = $mybssql->get_zone_offsets();
	
  $data = array();
	
	foreach($bzone as $zone => $bosses){
		$data[$zone]['fvd'] = $bb_zoffs[$zone]['fd'];
		$data[$zone]['lvd'] = $bb_zoffs[$zone]['ld'];
		$data[$zone]['vc'] = $bb_zoffs[$zone]['counter'];
    $data[$zone]['zk'] = 0;			
		foreach($bosses as $boss){
			$data[$zone]['bosses'][$boss]['fkd'] = $bb_boffs[$boss]['fd'];
			$data[$zone]['bosses'][$boss]['lkd'] = $bb_boffs[$boss]['ld'];
			$data[$zone]['bosses'][$boss]['kc'] = $bb_boffs[$boss]['counter'];		
		}
	}

          $delim = array (
            'rnote' => '/'.$bb_conf['noteDelim'].'/',
        		'rname' => '/'.$bb_conf['nameDelim'].'/'
        	);
        
        	$bossInfo = $bb_conf['bossInfo'];
        	$zoneInfo = $bb_conf['zoneInfo'];

        	#Get data from the raids tables
        	##################################################
        	$sql = bs_get_sql_data_string($bb_conf['tables']);	
        
          $result = $db->query($sql);
          $dbdata = $db->fetch_record_set();
          if (!is_array($dbdata)){
            return $data;
          }
        	foreach($dbdata as $row) {
          	foreach ($bzone as $zone => $bosses){
          	  $zone_hit = false;
        			# Get zoneinfo from current row
        			################################
        			if ($delim[$zoneInfo] != "//"){
        				$zone_element = preg_split($delim[$zoneInfo], $row[$zoneInfo], -1, PREG_SPLIT_NO_EMPTY);
        			} else {
        				$zone_element = array($row[$zoneInfo]);
        			}
        			foreach ($zone_element as $raid){
        				$zparseList = preg_split("/\',[ ]*\'/", stripslashes(trim($bb_pzone['pz_'.$zone], "\' ")));
        				if ($mybssql->in_array_nocase(stripslashes(trim($raid)), $zparseList)) {
        					$data[$zone]['vc']++;
        					if ($data[$zone]['fvd'] > $row["rdate"]) {
        						$data[$zone]['fvd'] = $row["rdate"];
        					}
        					if ($data[$zone]['lvd'] < $row["rdate"]) {
        						$data[$zone]['lvd'] = $row["rdate"];
        					}
        					$zone_hit = true;
        				}	
        			}
              if($zone_hit || !$bb_conf['depmatch']){  
          			# Get bossinfo from current row
          			################################
          			if ($delim[$bossInfo] != "//"){
          				$boss_element = preg_split($delim[$bossInfo], $row[$bossInfo], -1, PREG_SPLIT_NO_EMPTY);
          			} else {
          				$boss_element = array($row[$bossInfo]);
          			}
          			foreach ($boss_element as $raid){
          				foreach ($bosses as $boss){
                  			$bparseList = preg_split("/\',[ ]*\'/", stripslashes(trim($bb_pboss['pb_'.$boss], "\' ")));
          					if ($mybssql->in_array_nocase(stripslashes(trim($raid)), $bparseList)) {
          						$data[$zone]['bosses'][$boss]['kc']++;
          						if ($data[$zone]['bosses'][$boss]['fkd'] > $row["rdate"]) {
          							$data[$zone]['bosses'][$boss]['fkd'] = $row["rdate"];
          						}
          						if ($data[$zone]['bosses'][$boss]['lkd'] < $row["rdate"]) {
          							$data[$zone]['bosses'][$boss]['lkd'] = $row["rdate"];
          						}
          					}		
          				}
          			}//end for bosses
        			}
        		}	
        	}
        	foreach ($bzone as $zone => $bosses){
        	  $data[$zone]['zk'] = 0;
            foreach ($data[$zone]['bosses'] as $boss){
              if ($boss['kc'] > 0)
                $data[$zone]['zk']++;
            }
          
	
		}
		$mybssql->update_cache($data);
	
}
}
?>
