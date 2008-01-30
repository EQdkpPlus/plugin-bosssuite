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
      //get default values
      function bl_get_defaults(){
        global $eqdkp, $user;
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $filename = dirname(__FILE__).'/../games/'.$game_arr[0].'/bossloot/lang/'.$user->lang_name.'/defaults.php';
        if (file_exists($filename)){
          require($filename);
          return $defaults;
        }else{
          require(dirname(__FILE__).'/../games/'.$game_arr[0].'/bossloot/index.php');
          require(dirname(__FILE__).'/../games/'.$game_arr[0].'/bossloot/lang/'.$default_lang.'/defaults.php');
          return $defaults;
        }
      }
      
      //get default values
      function bl_reset_to_defaults(){
        $defaults = $this->bl_get_defaults();
        foreach ($defaults as $key => $value){
          $this->bl_update_config(array(), $key, $value);
        }
        return $defaults;
      }
        
      // Save or add values to the database.
      function bl_update_config($confarr, $fieldname, $insertvalue) {
      global $eqdkp_root_path, $user, $SID, $table_prefix, $db;
      if(array_key_exists( $fieldname, $confarr )){
        $sql = "UPDATE `".$table_prefix."bl_config` SET config_value='".strip_tags(htmlspecialchars($insertvalue))."' WHERE config_name='".$fieldname."';";
      	$db->query($sql);
      }else{
      	$sql = "INSERT INTO `".$table_prefix."bl_config` VALUES('".$fieldname."', '".strip_tags(htmlspecialchars($insertvalue))."');";	
      	$db->query($sql);
      	}
      }
      
      function bl_get_config() {
      global $db, $table_prefix;
      	$sql = 'SELECT * FROM `' . $table_prefix . 'bl_config` ORDER BY config_name';
      	if (!($settings_result = $db->query($sql))) {
      		message_die('Could not obtain bossloot configuration data', '', __FILE__, __LINE__, $sql);
      	}
      
      	while($roww = $db->fetch_record($settings_result)) {
      		if ((strpos($roww['config_name'], 'pb_') === FALSE) && (strpos($roww['config_name'], 'pz_') === FALSE)) 
      	   		$conf[$roww['config_name']] = $roww['config_value'];
      	}	
      	
      	if (!empty($conf))
      	   return $conf;
      	else
      	   return $this->bl_reset_to_defaults();
      }
      
      function bl_fetch_bli($bb_conf, $bb_pboss, $boss) {
      global $table_prefix;
        
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
          $result = mysql_query($sql) or message_die(mysql_error());
          
          while ($row = mysql_fetch_assoc($result)) {
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
              }
            }
          }
        }
        mysql_free_result($result);
        mysql_free_result($result2);
        return $data;
      }
  }
}
?>
