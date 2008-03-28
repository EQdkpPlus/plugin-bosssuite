<?php
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

      function get_data($bb_conf, $bossid){
          if ($bb_conf['source'] == 'database'){
            $data = $this->get_db_data($bb_conf, $bossid);
          } else if ($bb_conf['source'] == 'offsets'){
            $bb_boffs = $this->get_boss_offsets();
            $data['kc'] = $bb_boffs[$bossid]['counter'];
          } else if ($bb_conf['source'] == 'both'){
            $data = $this->get_db_data($bb_conf, $bossid);  
            $bb_boffs = $this->get_boss_offsets();
            $data['kc'] += $bb_boffs[$bossid]['counter'];
          } else if ($bb_conf['source'] == 'cache'){
            $data = $this->get_db_data($bb_conf, $bossid);  
            $bb_boffs = $this->get_boss_offsets();
            $data['kc'] += $bb_boffs[$bossid]['counter'];
          }
          return $data;
      }

      function get_db_data($bb_conf, $boss) {
      global $db, $table_prefix;
        echo($table_prefix);
        $delim = array (
          'rnote' => '/'.$bb_conf['noteDelim'].'/',
          'rname' => '/'.$bb_conf['nameDelim'].'/'
        );
        
        $bossInfo = $bb_conf['bossInfo'];
        $bb_pboss = $this->get_parse_boss();
        
        $data['kc'] = 0;
        $data['rids'] = "";
        $tables = array();
        
        if($bb_conf['tables'] != '')
          $tables = explode(", ", $bb_conf['tables']);
        else
          $tables[0] = trim(substr($table_prefix, 0, -1));
      
        foreach ($tables as $prefix){
         
          $sql = "SELECT raid_id AS id, raid_name AS rname, raid_note AS rnote FROM " . $prefix . "_raids;";
          
          $result = $db->query($sql);
          $dbdata = $db->fetch_record_set();
          if (!is_array($dbdata)){
            return $data;
          }
          foreach($dbdata as $row) {
            if ($delim[$bossInfo] != "//"){
              $boss_element = preg_split($delim[$bossInfo], $row[$bossInfo], -1, PREG_SPLIT_NO_EMPTY);
            } else {
              $boss_element = array($row[$bossInfo]);
            }
            foreach ($boss_element as $raid){
              $bparseList = preg_split("/\', \'/", stripslashes(trim($bb_pboss['pb_'.$boss], "\' ")));
              if (in_array(stripslashes(trim($raid)), $bparseList)) {
                $data['kc']++;
                $data['rids'] .= $row['id'] . "\n";
                $sql2 = "Select item_name, item_id from ". $prefix ."_items where raid_id = '".$row['id']."' order by item_name";
                $result2 = mysql_query($sql2) or message_die(mysql_error());
                while($row2 = mysql_fetch_assoc($result2)){
                  $data['items'][$row2['item_name']]['dc']++;
                  $data['items'][$row2['item_name']]['id'] = $row2['item_id'];
                }
                mysql_free_result($result2);	
              }
            }
          }
        }      
        return $data;
      }
  }
}
?>
