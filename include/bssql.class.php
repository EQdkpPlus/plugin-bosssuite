<?php
if ( !defined('EQDKP_INC') )
{
     die('Do not access this file directly.');
}

if ( !class_exists( "BSSQL" ) ) {
  /**
  * BSSQL class
  * BossSuite Base SQL class
  */
  class BSSQL{
  
      
      //get default values
      function get_defaults($plugin){
        global $eqdkp, $user;
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $default_file = dirname(__FILE__).'/../games/'.$game_arr[0].'/'.$plugin.'/lang/'.$user->lang_name.'/defaults.php';
        if (file_exists($default_file)){
          require($default_file);
          return $defaults;
        }else{
          if (file_exists(dirname(__FILE__).'/../games/'.$game_arr[0].'/'.$plugin.'/defaults.php')){
            require(dirname(__FILE__).'/../games/'.$game_arr[0].'/'.$plugin.'/defaults.php');
            return $defaults;
          }else{
            return array();
          }
        }
      }
      
      //get default values
      function reset_to_defaults($plugin){
        $defaults = $this->get_defaults($plugin);
        foreach ($defaults as $key => $value){
          $this->update_config($plugin, array(), $key, $value);
        }
        return $defaults;
      }
        
      // Save or add values to the database.
      function update_config($plugin, $confarr, $fieldname, $insertvalue) {
      global $eqdkp, $user, $db;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      if(array_key_exists( $fieldname, $confarr )){
        $sql = "UPDATE `".BS_CONFIG_TABLE."` SET config_value='".strip_tags(htmlspecialchars($insertvalue))."' WHERE config_name='".$fieldname."' AND game_id='".$game."' AND plugin_id='".$plugin."';";
      	$db->query($sql);
      }else{
      	$sql = "INSERT INTO `".BS_CONFIG_TABLE."` VALUES('".$plugin."','".$game."','".$fieldname."', '".strip_tags(htmlspecialchars($insertvalue))."');";	
      	$db->query($sql);
      	}
      }
      
      function get_config($plugin) {
      global $eqdkp, $db, $table_prefix;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      	$sql = 'SELECT * FROM `' . BS_CONFIG_TABLE . "` WHERE game_id='".$game."' AND plugin_id='".$plugin."';";
      	if (!($settings_result = $db->query($sql))) {
      		message_die('Could not obtain '.$plugin.' configuration data', '', __FILE__, __LINE__, $sql);
      	}
      
      	while($roww = $db->fetch_record($settings_result)) { 
      	   		$conf[$roww['config_name']] = $roww['config_value'];
      	}	
      	
      	if (!empty($conf))
      	   return $conf;
      	else
      	   return $this->reset_to_defaults($plugin);
      }
      
      function get_parse_zone(){
        global $eqdkp, $db, $table_prefix;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      	$sql = 'SELECT zone_id, zone_string FROM `' . BS_ZONE_TABLE . "` WHERE game_id='".$game."';";
      	if (!($settings_result = $db->query($sql))) {
      		message_die('Could not obtain zone string data', '', __FILE__, __LINE__, $sql);
      	}
      
      	while($roww = $db->fetch_record($settings_result)) { 
      	   		$conf['pz_'.$roww['zone_id']] = $roww['zone_string'];
      	}	
      	
      	if (!empty($conf))
      	   return $conf;
      	else
      	   return $this->reset_pzone_to_defaults();
      }
      
      function update_parse_zone($confarr, $fieldname, $value){
        global $eqdkp, $user, $db;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      if(array_key_exists( 'pz_'.$fieldname, $confarr )){
        $sql = "UPDATE `".BS_ZONE_TABLE."` SET zone_string='".strip_tags(htmlspecialchars($value))."' WHERE zone_id='".$fieldname."' AND game_id='".$game."';";
      	$db->query($sql);
      }else{
      	$sql = "INSERT INTO `".BS_ZONE_TABLE."` VALUES('".$game."','".$fieldname."', '".strip_tags(htmlspecialchars($value))."','0','".BS_MAX_DATE."','".BS_MIN_DATE."');";	
      	$db->query($sql);
      	}
      
      }     
      
      function get_parse_boss(){
        global $eqdkp, $db, $table_prefix;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      	$sql = 'SELECT boss_id, boss_string FROM `' . BS_BOSS_TABLE . "` WHERE game_id='".$game."';";
      	if (!($settings_result = $db->query($sql))) {
      		message_die('Could not obtain boss string data', '', __FILE__, __LINE__, $sql);
      	}
      
      	while($roww = $db->fetch_record($settings_result)) { 
      	   		$conf['pb_'.$roww['boss_id']] = $roww['boss_string'];
      	}	
      	
      	if (!empty($conf))
      	   return $conf;
      	else
      	   return $this->reset_pboss_to_defaults();
      }
      
      function update_parse_boss($confarr, $fieldname, $value){
        global $eqdkp, $user, $db;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      if(array_key_exists( 'pb_'.$fieldname, $confarr )){
        $sql = "UPDATE `".BS_BOSS_TABLE."` SET boss_string='".strip_tags(htmlspecialchars($value))."' WHERE boss_id='".$fieldname."' AND game_id='".$game."';";
      	$db->query($sql);
      }else{
      	$sql = "INSERT INTO `".BS_BOSS_TABLE."` VALUES('".$game."', '".$fieldname."', '".strip_tags(htmlspecialchars($value))."','0','".BS_MAX_DATE."','".BS_MIN_DATE."');";	
      	$db->query($sql);
      	}
      }
      
      function reset_pboss_to_defaults(){
       global $user;
       
       $bzone = $this->get_bzone();
	     foreach ($bzone as $zone => $bosses){
	       foreach ($bosses as $boss){
       if (strcmp($user->lang[$boss]['long'], $user->lang[$boss]['short'])){
				$bossstring = "''". str_replace("'", "''", $user->lang[$boss]['long']) . "'', ''" .  str_replace("'", "''", $user->lang[$boss]['short']) . "''";
			}else{
				$bossstring = "''". str_replace("'", "''", $user->lang[$boss]['long']) . "''";
			}   
            $defaults['pb_'.$boss] = $bossstring;
            $this->update_parse_boss(array(), $boss, $bossstring);
         
       }
         }
       
       return $defaults;
      }
      
      function reset_pzone_to_defaults(){
       global $user;
       
       $bzone = $this->get_bzone();
	     foreach ($bzone as $zone => $bosses){
       if (strcmp($user->lang[$zone]['long'], $user->lang[$zone]['short'])){
				$zonestring = "''". str_replace("'", "''", $user->lang[$zone]['long']) . "'', ''" .  str_replace("'", "''", $user->lang[$zone]['short']) . "''";
			}else{
				$zonestring = "''". str_replace("'", "''", $user->lang[$zone]['long']) . "''";
			}   
            $defaults['pz_'.$zone] = $zonestring;
            $this->update_parse_zone(array(), $zone, $zonestring);
         
       }
       return $defaults;
      }
      
      function get_boss_offsets(){
        global $eqdkp, $db, $table_prefix;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      	$sql = 'SELECT boss_id, boss_co_offs, boss_fd_offs, boss_ld_offs FROM `' . BS_BOSS_TABLE . "` WHERE game_id='".$game."';";
      	if (!($settings_result = $db->query($sql))) {
      		message_die('Could not obtain boss offset data', '', __FILE__, __LINE__, $sql);
      	}
      
      	while($roww = $db->fetch_record($settings_result)) { 
              $conf[$roww['boss_id']]['counter'] = $roww['boss_co_offs'];
      	   		$conf[$roww['boss_id']]['fd'] = $roww['boss_fd_offs'];
      	   		$conf[$roww['boss_id']]['ld'] = $roww['boss_ld_offs'];
      	}	
      	
      	if (!empty($conf))
      	   return $conf;
      	else
      	   return $this->reset_boss_offsets_to_defaults();
      }
      
      function get_zone_offsets(){
        global $eqdkp, $db, $table_prefix;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      	$sql = 'SELECT zone_id, zone_co_offs, zone_fd_offs, zone_ld_offs FROM `' . BS_ZONE_TABLE . "` WHERE game_id='".$game."';";
      	if (!($settings_result = $db->query($sql))) {
      		message_die('Could not obtain zone offset data', '', __FILE__, __LINE__, $sql);
      	}
      
      	while($roww = $db->fetch_record($settings_result)) { 
      	   		$conf[$roww['zone_id']]['counter'] = 0 + $roww['zone_co_offs'];
      	   		$conf[$roww['zone_id']]['fd'] = $roww['zone_fd_offs'];
      	   		$conf[$roww['zone_id']]['ld'] = $roww['zone_ld_offs'];
      	}	
      	
      	if (!empty($conf))
      	   return $conf;
      	else
      	   return $this->reset_zone_offsets_to_defaults();
      }
      
      function update_boss_offsets($offsets, $id, $fdate, $ldate, $counter){
      global $eqdkp, $user, $db;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      if(array_key_exists( $id, $offsets )){
        $sql = "UPDATE `".BS_BOSS_TABLE."` SET boss_co_offs='".$counter."', boss_ld_offs='".$ldate."', boss_fd_offs='".$fdate."' WHERE boss_id='".$id."' AND game_id='".$game."';";
      	$db->query($sql);
      }else{
      	$sql = "INSERT INTO `".BS_BOSS_TABLE."` VALUES('".$game."','".$id."', '', '".$counter."', '".$fdate."', '".$ldate."');";	
      	$db->query($sql);
      	}
      }
      
      function update_zone_offsets($offsets, $id, $fdate, $ldate, $counter){
      global $eqdkp, $user, $db;
      
        $game_arr = explode('_', $eqdkp->config['default_game']);
        $game = $game_arr[0];
        
      if(array_key_exists( $id, $offsets )){
        $sql = "UPDATE `".BS_ZONE_TABLE."` SET zone_co_offs='".$counter."', zone_ld_offs='".$ldate."', zone_fd_offs='".$fdate."' WHERE zone_id='".$id."' AND game_id='".$game."';";
      	$db->query($sql);
      }else{
      	$sql = "INSERT INTO `".BS_ZONE_TABLE."` VALUES('".$game."','".$id."', '', '".$counter."', '".$fdate."', '".$ldate."');";	
      	$db->query($sql);
      	}
      }
      
      function reset_boss_offsets_to_defaults(){
      }
      
      function reset_zone_offsets_to_defaults(){
      }
      
      function get_bzone(){
       global $eqdkp, $user;
       
       $game_arr = explode('_', $eqdkp->config['default_game']);
       $game = $game_arr[0];
       
    	 require(dirname(__FILE__).'/../games/'.$game.'/bossbase/bzone.php');
	     return $bzone;
    }
  }
}
?>
