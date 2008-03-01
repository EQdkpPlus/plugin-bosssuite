<?php
 /***************************************
 * EQdkp Plugin Dev Classes Framework Kit
 * Plugin Updater Class
 * (c) 2007 by WalleniuM
 * www.wallenium.de
 * ------------------
 * updater.class.php
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

class PluginUpdater
{
	var $version = '1.0.9'; // Version of this class
	var $tmpDESC = '';
	
	function PluginUpdater($plugin_name, $fallback_version, $db_field, $db_table, $updfile_path){
		$this->plugin_name 			= $plugin_name;
		$this->fallback_version = $fallback_version;
		$this->version_field		= $db_field;
		$this->version_table		= $db_table;
		$this->filepath 				= $updfile_path;
		$this->inst_dbversion   = 0;
	}
	
	// Change 2.0.3 to 203 for better file use (strip all points)
	// unused atm, but maybe i'll need it some day.
	function FormatVersion($version){
		$tmpversion = str_replace('.','',$version);
		return $tmpversion;
	}
	
	function GetUpdateVersion($version){
		global $eqdkp_root_path;
		include($eqdkp_root_path . 'plugins/'.$this->plugin_name.'/'.$this->filepath.'/updates/versions.php');
		foreach ($up_versions as $key=>$value){
			if ($value == $version)
			$tmmp_nomber = $key;
			$newnumber = $tmmp_nomber + 1;
		}
		return $up_versions[$newnumber];
	}
	
	function CheckIfUpdate($version){
		global $eqdkp_root_path;
		include($eqdkp_root_path . 'plugins/'.$this->plugin_name.'/'.$this->filepath.'/updates/versions.php');
		foreach ($up_versions as $key=>$value){
			if ($value == $version)
			$nomber = $key;
		}
		$this->tmp_nomber = $nomber;
		return $up_updates[$nomber];
	}
	
	// perform the update from a file
	function PerformUpdate($version){
		global $eqdkp_root_path, $user, $SID, $table_prefix, $db, $pm, $wpfcdb, $rpclass;
		($updateSQL) ? $updateSQL = '' : ''; // unset old variable
		(empty($version)) ? $version = $this->fallback_version : '';
		// load the right update file
		include($eqdkp_root_path . 'plugins/'.$this->plugin_name.'/'.$this->filepath.'/updates/versions.php');
			$version_file = $eqdkp_root_path . 'plugins/'.$this->plugin_name.'/'.$this->filepath.'/updates/'.$this->CheckIfUpdate($version);
			if (file_exists($version_file)) {
				require($version_file);
				$this->tmpDESC = $updateDESC;
				$ni = 1;
				foreach($updateSQL as $value) {
					if($db->query($value)){
						$outp['steps'][$ni] = 1;
					}else{
						$outp['steps'][$ni] = 0;
					}
					$ni++;
				}	
				$this->UpdateConfig($this->version_table, $this->GetUpdateVersion($version) ,$this->version_field);
				$outp['error'] = 'ok';
			}else{
				$outp['error'] = 'file';
			} // end of file exists

		return $outp;
	}
	
	function OutputForm($db_version, $manualvarray){
		global $pm, $user, $eqdkp_root_path, $updateDESC;
		if ($_POST['rpupdte']){
			$update_ok = $this->PerformUpdate($_POST['updater_version']);
			if($update_ok['error'] == 'ok'){
				$this->upd_output = '';
				foreach($update_ok['steps'] as $nomb=>$updstep) {
					$tmp_upd_desc = ( $this->tmpDESC[$nomb] ) ? $this->tmpDESC[$nomb] : $user->lang['puc_upd_stp_unknwn'];
					if($updstep == 1){
						$this->upd_output .= '<font color="black">'.$user->lang['puc_upd_step'].' '.$nomb.' - '.$tmp_upd_desc.': </font><font color="green">'.$user->lang['puc_upd_step_ok'].'</font><br/>';
					}else{
						$this->upd_output .= '<font color="black">'.$user->lang['puc_upd_step'].' '.$nomb.' - '.$tmp_upd_desc.': </font><font color="red">'.$user->lang['puc_upd_step_false'].'</font><br/>';
					}
				}
				$this->upd_output .= '<font color="green">'.$user->lang['puc_upd_ok'].'</font>';
				$this->upd_img_out = 'wpfc/ok.png';
			}elseif($update_ok['error'] == 'file'){
				$this->upd_output = $user->lang['puc_upd_no_file'];
				$this->upd_img_out = 'wpfc/false.png';
			}else{
				$this->upd_output = $user->lang['puc_upd_glob_error'];
				$this->upd_img_out = 'wpfc/false.png';
			}
		}else{
			// while minor update (without database changes)
			$check_if_update = $this->CheckIfUpdate($db_version);
			$plugversiontemp = $pm->get_data($this->plugin_name, 'version');
			include($eqdkp_root_path . 'plugins/'.$this->plugin_name.'/'.$this->filepath.'/updates/versions.php');
			if($db_version){
        while($db_version < $plugversiontemp && $check_if_update == false){
					// update version in db if no db updates available
					$this->tmp_nomber = array_search($db_version, $up_versions);
					$newnumber = $this->tmp_nomber + 1;
					$db_version = $up_versions[$newnumber];
					$this->UpdateConfig($this->version_table, $db_version ,$this->version_field);
					$check_if_update = $this->CheckIfUpdate($db_version);
				}
			}
			
			// major upgrade, show box
			$this->upd_img_out = 'wpfc/updates.png';
			if (!$db_version && $manualvarray != ''){
				// show the manual Dropdown
				$v_input =  '<select name="updater_version" class="input">';
				foreach($manualvarray as $key=>$value){
					$v_input .= '<option value="'.$key.'">'.$value.'</option>';
				}
				$v_input .= '</select>';
			}else{
				$v_input = '<input type="hidden" name="updater_version" size="32" value="'.$db_version.'" class="input" />';
			}

			$shw_version 	= ( $db_version ) ? $db_version : $user->lang['puc_upd_unknown'];
			
			$this->upd_output = $user->lang['puc_upd_txt1'].$shw_version.
										$user->lang['puc_upd_txt2'].$this->GetUpdateVersion($db_version).
										$user->lang['puc_upd_txt3'].'<br/><br/><center>'.$v_input.' '.
										'<input type="submit" name="rpupdte" value="'.
										$user->lang['puc_upd_bttn'].'" class="mainoption" /></center>';
		}
		$this->inst_dbversion = $db_version;
	}

	function OutputHTML(){
		global $user,$pm, $eqdkp_root_path;
		if ( !$this->inst_dbversion || $this->inst_dbversion != $pm->get_data($this->plugin_name, 'version') || $_POST['rpupdte']){
		$out_htm = '<form method="post" action="'.$_SERVER['PHP_SELF'].'" name="updater">
								<table width="100%" border="0" cellspacing="1" cellpadding="2">
  								<tr>
    								<th align="center" colspan="2">'.$user->lang['puc_update_box'].'</th>
  								</tr>
  								<tr>
    								<td class="row1" width ="48px"><img src="../images/'.$this->upd_img_out.'" align="absmiddle" /></td>
    								<td class="row1"><font color="red">'.$this->upd_output.'</font></td>
  								</tr>
  								<tr>
								</table>
								</form>
								<br>';
					if($this->inst_dbversion && $this->CheckIfUpdate($this->inst_dbversion) == false && $this->inst_dbversion != $pm->get_data($this->plugin_name, 'version')){
					$out_htm = '';
				}
			}else{
				$out_htm = '';
				}
			return $out_htm;
	}
	
	function DeleteVersionString(){
		global $db, $table_prefix;
		$db->query("DELETE FROM ".$table_prefix.$this->version_table." WHERE config_name='" . $this->version_field . "'");
	}
	
	function UpdateConfig($table, $value, $key){
        global $table_prefix, $db;
        $sql = "SELECT config_name FROM `".$table_prefix.$table."` WHERE config_name='".$key."';";
      	$isthere = $db->query($sql);
      	$blubber = $db->fetch_record($isthere);
        if (!$blubber['config_name']){
        	$sql = "INSERT INTO `".$table_prefix.$table."` ( `config_name` ) VALUES ('".$key."');";
        	$blubb = $db->query($sql);	
        }
        
        	$sql = "UPDATE `".$table_prefix.$table."` SET config_value='".strip_tags(htmlspecialchars($value))."' WHERE config_name='".$key."';";
        	$blubb = $db->query($sql);
      }
}
?>
