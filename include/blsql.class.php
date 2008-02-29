<?php
if ( !defined('EQDKP_INC') )
{
     die('Do not access this file directly.');
}

/*
if ( !class_exists( "BBSQL") ) {
  include_once(dirname(__FILE__).'/bbsql.class.php');
}
*/

if ( !class_exists( "BLSQL" ) ) {
  /**
  * BPSQL class
  * BossBase SQL class
  */
  class BLSQL{// extends BBSQL{

      function bl_fetch_bli($bb_conf, $bb_pboss, $boss) {
      global $db, $table_prefix;
        
        $delim = array (
          'rnote' => '/'.$bb_conf['noteDelim'].'/',
          'rname' => '/'.$bb_conf['nameDelim'].'/'
        );
        
        $bossInfo = $bb_conf['bossInfo'];
        
        $data['kc'] = 0;
        $data['rids'] = "";
        $tables = array();
        
        if($bb_conf['tables'] != '')
          $tables = explode(", ", $bb_conf['tables']);
        else
          $tables[0] = trim(substr($table_prefix, 0, -1));
      
        foreach ($tables as $prefix){
         
          $sql = "SELECT raid_id AS id, raid_name AS rname, raid_note AS rnote FROM " . $prefix . "_raids;";
          //$result = mysql_query($sql) or message_die(mysql_error());
          //while ($row = mysql_fetch_assoc($result)) {
          
          $result = $db->query($sql);
          foreach($db->fetch_record_set() as $row) {
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
        //mysql_free_result($result);
        
        return $data;
      }
  }
}
?>
