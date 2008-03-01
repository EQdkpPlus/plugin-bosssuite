<?php
 /***************************************
 * EQdkp Plugin Dev Classes Framework Kit
 * Update Check Class
 * (c) 2007 by WalleniuM
 * www.wallenium.de
 * ------------------
 * updcheck.class.php
 * $LastChangedDate: 2008-02-07 23:11:09 +0100 (Do, 07 Feb 2008) $
 *
 * This Class is part of the Plugin 
 * Developer Framework Kit. You can 
 * use this Class in your Plugins,
 * but not remove this Copyright
 * 
 ****************************************/
if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

class PluginUpdCheck
{
	var $ucc_version = '1.1.0'; // Version of this class
	
	function PluginUpdCheck($plugininfo, $cachedb){
	  global $table_prefix;
		$this->server_link 			= "http://vcheck.eqdkp-plus.com"; // edit if changed!
		$this->server_name			= substr($this->server_link, 7);
		$this->plugin_name 			= $plugininfo['name'];
		$this->act_version			= $plugininfo['version'];
		$this->updcheck_on			= $plugininfo['enabled'];
		
		// The Cache Table Settings
		$this->update_offset    = 48; // Re-Check after xxx hours
		$this->table            = $table_prefix.$cachedb['table'];
		$this->lastcheck        = $cachedb['lastcheck'];
		$this->f_lastcheck      = $cachedb['f_lastcheck'];
		$this->cache_data       = $cachedb['data'];
		$this->f_data           = $cachedb['f_data'];
	}
	
	function checklink($url){
  	if($url){
  		$ipaddr = gethostbyname($this->server_name);
  		if($ipaddr == $url){
   			return false;
  		}else{
  			if (!$x = fsockopen($ipaddr, 80, $errno, $errstr, 5)){ // attempt to connect
  				return false;
				}else{
        	return true;
          if ($x){
          	@fclose($x); //close connection (i dont know if this is needed or not).
          }
 				}
  		}
  	}
	}
	
	function PerformUpdateCheck(){
		global $eqdkp_root_path, $user;
		if($this->updcheck_on){
		  // When was the last update?
      if ($this->lastcheck && $this->lastcheck > (time()-($this->update_offset*60*60))){
        // Take the version out of the database...
        $getdata = $this->cache_data;
      }else{
  		  // Check if the Server is online
  			if($this->checklink($this->server_link)){
          // get the version Data:
      		if(function_exists('curl_init')){
      			$ch = curl_init();
  					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  					curl_setopt($ch, CURLOPT_URL, $this->server_link.'/version/'.$this->plugin_name);
  					$getdata = curl_exec($ch);
  					curl_close($ch);
      		}elseif (function_exists('file_get_contents')){
  					$getdata = @file_get_contents($this->server_link.'/version/'.$this->plugin_name);
  				}else{
  					$pparray = file ($this->server_link.'/version/'.$this->plugin_name);
  					$getdata = $pparray[0];
  				}
  				// insert into cache db field
  				$bladada = array(
              $this->f_lastcheck  => time(),
              $this->f_data       => $getdata
          );
  				$this->InsertCacheData($bladada);
  			}else{ // Server is offline
          $this->updchk_output = $user->lang['ucc_noserver'];
          $this->updchk_window =true;
  			} // end if availability check
  		} // end if time check
  		$parse = explode('|', $getdata);
  		$versions['version'] = $parse[0];
  		$versions['level'] = $parse[1];
  		$versions['changelog'] = $parse[2];
  		$versions['download'] = $parse[3];
  		$versions['release'] = $parse[5];
  		$versions['name'] = $parse[6];
      if($versions['version'] == $this->act_version || $versions['version'] < $this->act_version){
        $this->updchk_output = "";
        $this->updchk_window = false;
      }else{
        $this->updchk_output = $user->lang['ucc_update_available_p0']." ".$this->plugin_name." ".$user->lang['ucc_update_available_p1']." ".
        $user->lang['ucc_update_available_p2']." <b>".$this->act_version."</b> ".
        $user->lang['ucc_update_available_p3']." <b>".$versions['version'] ." (".$user->lang['ucc_updated_date'].": ".date($user->lang['ucc_timeformat'], $versions['release']).")</b><br>".
        "[".$user->lang['ucc_release_level'].": ".$versions['level']."] <a target='_blank' href='".$versions['download']."'>".$user->lang['ucc_update_url']."</a> | <a target='_blank' href='".$versions['changelog']."'>".$user->lang['ucc_changelog_url']."</a>";
        $this->updchk_window = true;
      }
		} // end updatecheck on
	}

	function OutputHTML(){
		global $user, $eqdkp_root_path;
		if ( $this->updchk_window){
		$out_htm = '<table width="100%" border="0" cellspacing="1" cellpadding="2">
  								<tr>
    								<th align="center" colspan="2">'.$user->lang['ucc_update_box'].'</th>
 	 								</tr>
  								<tr>
    								<td class="row1" width ="48px"><img src="../images/wpfc/false.png" align="absmiddle" /></td>
    								<td class="row1"><font color="red">'.$this->updchk_output.'</font></td>
  								</tr>
  								<tr>
								</table>
								<br/>';
			}else{
				$out_htm = '';
				}
			return $out_htm;
	}
	
	function InsertCacheData($array){
    global $db;
    foreach($array as $field=>$value){
      $delsql = "DELETE FROM ".$this->table." WHERE config_name= '".$field."'";
      $db->query($delsql);
      $sql = "INSERT INTO `" . $this->table . "` ( `config_name`, `config_value` ) VALUES ('".$field."', '".$value."');";
      $blubb = $db->query($sql);
    }
  }
	
}
?>
