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

if ( !defined('EQDKP_INC') )
{
     die('Do not access this file directly.');
}


if ( !class_exists( "BSSQL") ) {
  include_once(dirname(__FILE__).'/bssql.class.php');
}


if ( !class_exists( "BLSQL" ) ) {
  /**
  * BLSQL class
  * BossLoot SQL class
  */
  class BLSQL extends BSSQL{
      var $zoneid;
      var $bossid;
      var $data;
      
      function get_bl_data($bb_conf, $bossid){
          $this->zoneid = $this->get_zone_for_boss($bossid);
          $bzone = array(
            $this->zoneid => array($bossid)
          );
          $dat = $this->get_data($bb_conf, $bzone);
          $this->data['kc'] = $dat[$this->zoneid]['bosses'][$bossid]['kc'];
          
          if (!($bb_conf['source'] == 'offsets') &&  $this->data['kc'] > 0){
            $this->get_bl_db_data($bb_conf, $bossid);
          }
         
          return $this->data;
      }
      
      function get_zone_for_boss($bossid){
        $bzone = $this->get_bzone();
        foreach($bzone as $zone => $bosses){
          foreach($bosses as $boss){
            if($boss == $bossid)
              return $zone;
          }
        }
      }

      function get_bl_db_data($bb_conf, $boss) {
      global $db, $table_prefix, $eqdkp;
        $delim = array (
          'rnote' => '/'.$bb_conf['noteDelim'].'/',
          'rname' => '/'.$bb_conf['nameDelim'].'/'
        );
        
        $bossInfo = $bb_conf['bossInfo'];
        $zoneInfo = $bb_conf['zoneInfo'];
        $bb_pboss = $this->get_parse_boss();
        $bb_pzone = $this->get_parse_zone();
        $tables = array();
        
        if($bb_conf['tables'] != '')
          $tables = explode(", ", $bb_conf['tables']);
        else{
          $tables[0] = $table_prefix;
        }
        
      
        foreach ($tables as $prefix){       
          $sql = "SELECT raid_id AS id, raid_name AS rname, raid_note AS rnote FROM " . $prefix . "raids;";
          
          $result = $db->query($sql);
          $dbdata = $db->fetch_record_set();
          if (!is_array($dbdata)){
            return $this->data;
          }
         	
         	$zparseList = preg_split("/\',[ ]*\'/", stripslashes(trim($bb_pzone['pz_'.$this->zoneid], "\' ")));
          $bparseList = preg_split("/\',[ ]*\'/", stripslashes(trim($bb_pboss['pb_'.$boss], "\' ")));         	
         	
          foreach($dbdata as $row) {
          	  $zone_hit = false;
        			if ($delim[$zoneInfo] != "//"){
        				$zone_element = preg_split($delim[$zoneInfo], $row[$zoneInfo], -1, PREG_SPLIT_NO_EMPTY);
        			} else {
        				$zone_element = array($row[$zoneInfo]);
        			}
        			foreach ($zone_element as $raid){				
        				if ($this->in_array_nocase(stripslashes(trim($raid)), $zparseList)) {
        					$zone_hit = true;
        					continue;
        				}	
        			}
        			
              if($zone_hit || !$bb_conf['depmatch']){  
          			if ($delim[$bossInfo] != "//"){
          				$boss_element = preg_split($delim[$bossInfo], $row[$bossInfo], -1, PREG_SPLIT_NO_EMPTY);
          			} else {
          				$boss_element = array($row[$bossInfo]);
          			}
          			foreach ($boss_element as $raid){                			
          					if ($this->in_array_nocase(stripslashes(trim($raid)), $bparseList)) {
                      $this->data['rids'] .= $row['id'] . "\n";
                      $sql2 = "Select item_name, item_id, game_itemid from ". $prefix ."items where raid_id = '".$row['id']."' order by item_name";
                      $result2 = $db->query($sql2);
                      
                      //current game == wow?
                      $game_arr = explode('_', $eqdkp->config['default_game']);
                      if($game_arr[0] == 'WoW'){
                        while($row2 = $db->fetch_record($result2)){
                          $this->data['items'][$row2['item_name'].'__'.$row2['game_itemid']]['dc']++;
                          $this->data['items'][$row2['item_name'].'__'.$row2['game_itemid']]['id'] = $row2['item_id'];
                        }
                      }else{
                        while($row2 = $db->fetch_record($result2)){
                          $this->data['items'][$row2['item_name']]['dc']++;
                          $this->data['items'][$row2['item_name']]['id'] = $row2['item_id'];
                        }
                      }
                      $db->free_result($result2);	
          					}		          				
          			}//end for boss elements
        			}      			
        	}//end for dbdata
        	$db->free_result($result);
        }      
      }
  }
}
?>
