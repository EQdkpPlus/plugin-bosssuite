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


if ( !class_exists( "BCSQL" ) ) {
  /**
  * BCSQL class
  * BossCounter SQL class
  */
  class BCSQL extends BSSQL{
    
      function get_data($bb_conf, $bzone){
        if ($bb_conf['source'] == 'cache'){
          return $this->get_cache();
        }
        if ($bb_conf['source'] == 'database'){
          $data = $this->init_data_array($bzone);
          return $this->get_db_data($bzone, $data, $bb_conf);
        }
        if ($bb_conf['source'] == 'both'){
          $data = $this->init_data_array($bzone);
          $data = $this->get_offsets($bzone, $data);
          return $this->get_db_data($bzone, $data, $bb_conf);
        }
        if ($bb_conf['source'] == 'offsets'){
          $data = $this->init_data_array($bzone);
          return $this->get_offsets($bzone, $data);
        }  
      }
          
      function init_data_array($bzone){
          foreach ($bzone as $zone => $bosses) {
          	$data[$zone]['zk'] = 0;		 
          	foreach ($bosses as $boss){
              	$data[$zone]['bosses'][$boss]['kc'] = 0;
          	}
          }          
          return $data;
      }
                  
      function get_offsets($bzone, $data){
        $bb_boffs = $this->get_boss_offsets(); 
      	foreach($bzone as $zone => $bosses){  	
          $data[$zone]['zk'] = 0;		
      		foreach($bosses as $boss){        
      			$data[$zone]['bosses'][$boss]['kc'] += $bb_boffs[$boss]['counter'];
            if ($data[$zone]['bosses'][$boss]['kc'] > 0)
              $data[$zone]['zk']++;	
      		}
        }
        return $data;
      }
   
      function get_sql_data_string($tablestring){
          $tables = array();
          if($tablestring != '')
              $tables = explode(", ", $tablestring);
          
          $sql = "";
          if (count($tables) == 0) {
              $sql = "SELECT raid_name AS rname, raid_note AS rnote FROM " . RAIDS_TABLE . ";";
          } else {
              $bpinc = 0;
              foreach ($tables as $raidtable) {
                  if ($bpinc == 0) {
                      $sql .= "SELECT raid_name AS rname, raid_note AS rnote FROM " . $raidtable . "_raids";
                      $bpinc++;
                  } else {
                      $sql .= " UNION ALL SELECT raid_name, raid_note FROM " . $raidtable . "_raids";
                  }
              }
              $sql .= ";";
          }
          return $sql;
      }
   
      function get_db_data($bzone, $data, $bb_conf) {
      global $db, $user;
          $delim = array (
              'rnote' => '/'.$bb_conf['noteDelim'].'/',
              'rname' => '/'.$bb_conf['nameDelim'].'/'
          );
      
          $bossInfo = $bb_conf['bossInfo'];
          $bb_pboss = $this->get_parse_boss();
          #Get data from the raids tables
          ##################################################
          $sql = $this->get_sql_data_string($bb_conf['tables']);
          $result = $db->query($sql);
          
          $dbdata = $db->fetch_record_set();
          if (!is_array($dbdata)){
            return $data;
          }
          
      	  foreach($dbdata as $row) {
              foreach ($bzone as $zone => $bosses){
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
                          if ($this->in_array_nocase(stripslashes(trim($raid)), $bparseList)) {
                              $data[$zone]['bosses'][$boss]['kc']++;
                          }
                      }
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
        	return $data;
      }
  }
}
?>
