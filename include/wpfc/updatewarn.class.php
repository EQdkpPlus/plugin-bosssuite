<?php
 /***************************************
 * EQdkp Plugin Dev Classes Framework Kit
 * Update Warn Class
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

class PluginUpdWarn
{
	var $ucc_version 	= '1.0.0'; // Version of this class
	var $show_warn		= false;
	
	function PluginUpdWarn($plugin_names, $dbfields){
		global $pm, $db, $table_prefix;
				
		// Check Pluginversions
		$tmpplugarray = array();
		foreach($plugin_names as $plugg){
			if($pm->check(PLUGIN_INSTALLED, $plugg)){
				$ppversion = $pm->get_data($plugg, 'version');
				$sql = 'SELECT config_value FROM ' . $table_prefix .$dbfields[$plugg]['table'].' WHERE config_name=\''.$dbfields[$plugg]['field'].'\'';
				$tmpconf = $db->query($sql);
				$rowcc = $db->fetch_record($tmpconf);
				if($ppversion > $rowcc['config_value']){
					$plgarry = 	array(
												$plugg		=> $rowcc['config_value']
											);
					$tmpplugarray = array_merge_recursive($tmpplugarray,$plgarry);
					$this->show_warn = true;
				}
			}
		}
		$this->plugin_array = $tmpplugarray;
	}
	
	function OutputHTML(){
		global $user, $pm, $eqdkp_root_path;
		if ($this->show_warn && $user->check_auth('a_raid_upd', false)){
		$out_htm = '<table width="100%" border="0" cellspacing="1" cellpadding="2" class="errortable">
								  <tr>
								    <td class="row1" width ="48px"><img src="images/wpfc/false.png" /></td>
								    <td class="row1">
								    	<table width="100%" border="0" cellspacing="1" cellpadding="2" class="errortable_inner">';
		$out_htm .= '				<tr>
													<td>'.$user->lang['wpfc_perform_intro'].'</td>
												</tr>
                        <tr>
                        <td> </td>
                        </tr>
                        ';
    foreach($this->plugin_array as $pluginname=>$pluginversion){
		  $sentence = sprintf($user->lang['wpfc_pluginneedupdate'], $user->lang[$pluginname], $pluginversion, $pm->get_data($pluginname, 'version'));
			$out_htm .= '    	<tr>
								    		<td>
								    			'.$sentence.'
								    		</td>
								    		<td>
								    		<a href="'.$eqdkp_root_path.'/plugins/'.$pluginname.'/admin/settings.php" target="blank">'.$user->lang['wpfc_solve_dbissues'].'</a>
								    		</td>
								    		</tr>';
		}
		$out_htm .= '			</table>
								    </td>
								  </tr>
								  <tr>
								</table>
								<br/>';
			}else{
				$out_htm = '';
				}
			return $out_htm;
	}
}
?>
