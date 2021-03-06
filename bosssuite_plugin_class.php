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

// Set table names
global $table_prefix;

if (!defined('BS_MAX_DATE')) { define('BS_MAX_DATE', mktime (0,0,0,1,1,2015)); }
if (!defined('BS_MIN_DATE')) { define('BS_MIN_DATE', mktime (0,0,0,1,1,2000)); }

class bosssuite_Plugin_Class extends EQdkp_Plugin {

  var $additional_data;
  var $version = '4.8.3';
  var $fwversion  = '2.0.0';  // required framework Version

	function bosssuite_plugin_class($pm) {
		
		global $eqdkp, $eqdkp_root_path, $user, $SID, $table_prefix;
		
		$this->eqdkp_plugin($pm);
		$this->pm->get_language_pack('bosssuite');
    
		$this->add_data(array (
			'name' => 'BossSuite 4 MGS',
			'code' => 'bosssuite',
			'path' => 'bosssuite',
			'contact' => 'sz3@gmx.net',
			'template_path' => 'plugins/bosssuite/templates/',
			'version' => $this->version
		));
		
		$this->additional_data = array(
		  'author' => 'sz3',
    	'description' => $user->lang['bs_short_desc'],
    	'long_description'  => $user->lang['bs_long_desc'],
    	'homepage' => 'http://www.eqdkp-plus.com/',
    	'manuallink'        => false,
    );

    //Permissions
		$this->add_permission('2380', 'a_bosssuite_conf', 'N', $user->lang['bs_pm_conf']);
		$this->add_permission('2381', 'a_bosssuite_offs', 'N', $user->lang['bs_pm_offs']);

		$this->add_permission('2387', 'u_bosssuite_bp_view', 'Y', $user->lang['bs_bp_view']);
		$this->add_permission('2388', 'u_bosssuite_bl_view', 'Y', $user->lang['bs_bl_view']);
		$this->add_permission('2389', 'u_bosssuite_bc_view', 'Y', $user->lang['bs_bc_view']);


		if (!($this->pm->check(PLUGIN_INSTALLED, 'bosssuite'))){
    		//Grant permissions to installing user
    		if ( $user->data['user_id'] != ANONYMOUS ){
    		      $pids = "'2380', '2381', '2382', '2387', '2388', '2389'";
    		      
    			    $sql = "DELETE FROM __auth_users WHERE user_id='".$user->data['user_id']."' AND auth_id IN (".$pids.")";
          		$this->add_sql(SQL_INSTALL, $sql);
 
              $parr = explode(', ', $pids);
              foreach ($parr as $pid){                     
             		  $sql = "INSERT INTO __auth_users (user_id, auth_id, auth_setting) VALUES ('".$user->data['user_id']."',".$pid.",'Y')";
              		$this->add_sql(SQL_INSTALL, $sql);
              }
        	}
      
      		//Create tables on install		
      		$sql = "CREATE TABLE IF NOT EXISTS __bs_config (
                  `config_name` varchar(255) NOT NULL default '',
      		        `config_value` varchar(255) default '',
                  PRIMARY KEY  (`config_name`))";				    
      		$this->add_sql(SQL_INSTALL, $sql);
      		
      		$sql = "CREATE TABLE IF NOT EXISTS __bs_data_zone (
      		    		`zone_id` varchar(32) NOT NULL default 'unknown',
      		    		`zone_string` varchar(255) NOT NULL default '',
      		    		`zone_co_offs` smallint(5) NOT NULL default '0',
      		    		`zone_fd_offs` int(11) NOT NULL default '".BS_MAX_DATE."',
      		    		`zone_ld_offs` int(11) NOT NULL default '".BS_MIN_DATE."',
      		    		`zone_sz_bp` tinyint(1) default '1',
      		    		`zone_sz_bc` tinyint(1) default '1',
      				    PRIMARY KEY  (`zone_id`))";				    
      		$this->add_sql(SQL_INSTALL, $sql);
      		
      		$sql = "CREATE TABLE IF NOT EXISTS __bs_data_boss (
      		    		`boss_id` varchar(32) NOT NULL default 'unknown',
      		    		`boss_string` varchar(255) NOT NULL default '',
      		    		`boss_co_offs` smallint(5) NOT NULL default '0',
      		    		`boss_fd_offs` int(11) NOT NULL default '".BS_MAX_DATE."',
      		    		`boss_ld_offs` int(11) NOT NULL default '".BS_MIN_DATE."',
      				    PRIMARY KEY  (`boss_id`))";			    
      		$this->add_sql(SQL_INSTALL, $sql);
      		
      		$sql = "CREATE TABLE IF NOT EXISTS __bs_cache_zone (
      		    		`zone_id` varchar(32) NOT NULL default 'unknown',
      		    		`zone_co_cache` smallint(5) NOT NULL default '0',
      		    		`zone_zk_cache` smallint(5) NOT NULL default '0',
      		    		`zone_fd_cache` int(11) NOT NULL default '".BS_MAX_DATE."',
      		    		`zone_ld_cache` int(11) NOT NULL default '".BS_MIN_DATE."',
      				    PRIMARY KEY  (`zone_id`))";				    
      				    
      		$this->add_sql(SQL_INSTALL, $sql);
      		
      		$sql = "CREATE TABLE IF NOT EXISTS __bs_cache_boss (
      		    		`boss_id` varchar(32) NOT NULL default 'unknown',
      		    		`boss_co_cache` smallint(5) NOT NULL default '0',
      		    		`boss_fd_cache` int(11) NOT NULL default '".BS_MAX_DATE."',
      		    		`boss_ld_cache` int(11) NOT NULL default '".BS_MIN_DATE."',
      				    PRIMARY KEY  (`boss_id`))";			    
      		$this->add_sql(SQL_INSTALL, $sql);

  	 	    $this->add_sql(SQL_INSTALL, "INSERT INTO __config VALUES ('bs_showBC', '1');");
          $this->add_sql(SQL_INSTALL, "INSERT INTO __config VALUES ('bs_linkBL', '1');");
          
          //Write version info
          $this->add_sql(SQL_INSTALL, "INSERT INTO __bs_config VALUES ('bb_inst_version', '".$this->version."');");
          
          //update check
          $this->add_sql(SQL_INSTALL, "INSERT INTO __bs_config VALUES ('bb_enable_updatechk', '1');");
    		  
		}else{
    		//Menus
    		$this->add_menu('admin_menu', $this->gen_admin_menu());
    	  $this->add_menu('main_menu1', $this->gen_main_menu1());
    		//Drop table on deinstall
    		$this->add_sql(SQL_UNINSTALL, "DROP TABLE IF EXISTS __bs_data_zone");
    		$this->add_sql(SQL_UNINSTALL, "DROP TABLE IF EXISTS __bs_data_boss");
    		$this->add_sql(SQL_UNINSTALL, "DROP TABLE IF EXISTS __bs_cache_zone");
    		$this->add_sql(SQL_UNINSTALL, "DROP TABLE IF EXISTS __bs_cache_boss");
    		$this->add_sql(SQL_UNINSTALL, "DROP TABLE IF EXISTS __bs_config");
    		$this->add_sql(SQL_UNINSTALL, "DELETE FROM __config WHERE config_name='bs_showBC';");
        $this->add_sql(SQL_UNINSTALL, "DELETE FROM __config WHERE config_name='bs_linkBL';");
    }
	}

  function gen_main_menu1() {
		if ($this->pm->check(PLUGIN_INSTALLED, 'bosssuite')) {
			global $db, $user, $SID;

			$main_menu1 = array (
				array (
					'link' => 'plugins/' . $this->get_data('path') . '/bossprogress.php' . $SID,
					'text' => $user->lang['bp_um_link'],
					'check' => 'u_bosssuite_bp_view'
			));

			return $main_menu1;
		}
		return;
	}
	
  function do_hook($hook){
  global $eqdkp_root_path;
    $valid_hooks = array(
      '/admin/addevent.php?action=update',
      '/admin/addraid.php?action=add',
      '/admin/addraid.php?action=update',
      '/admin/addraid.php?action=delete',
      '/plugins/bosssuite/admin/settings.php',
      '/plugins/bosssuite/admin/cache.php',
      '/plugins/bosssuite/admin/entity_conf.php',
      '/plugins/ctrt/index.php',
      '/plugins/raidlogimport/admin/dkp.php'
    );
    if(in_array($hook, $valid_hooks)){
      include($eqdkp_root_path.'plugins/bosssuite/include/bsmgs.class.php');
      $bsmgs = new BSMGS();
      if ($bsmgs->game_supported('bossbase')){
        include($eqdkp_root_path.'plugins/bosssuite/include/bssql.class.php');
        $bssql = new BSSQL();
        $bssql->update_cache();
      }
    }
  }
  
	function gen_admin_menu() {
		if ($this->pm->check(PLUGIN_INSTALLED, 'bosssuite')) {
			global $db, $user, $SID, $eqdkp_root_path, $eqdkp;

			$url_prefix = ( EQDKP_VERSION <  '1.3.2' ) ? $eqdkp_root_path : '';

			$admin_menu = array (
				'bosssuite' => array (
				  99 => '../../plugins/bosssuite/images/glupschi_icon.png',
					0 => $user->lang['bs_am_title'],
					1 => array (
						'link' => $url_prefix . 'plugins/bosssuite/admin/settings.php' . $SID,
						'text' => $user->lang['bs_am_conf'],
						'check' => 'a_bosssuite_conf'
					),
					2 => array (
						'link' => $url_prefix . 'plugins/bosssuite/admin/bzone.php' . $SID,
						'text' => $user->lang['bs_am_bzone'],
						'check' => 'a_bosssuite_offs'
					),
					3 => array (
						'link' => $url_prefix . 'plugins/bosssuite/admin/cache.php' . $SID,
						'text' => $user->lang['bs_am_cache'],
						'check' => 'a_bosssuite_conf'
					),

				)
			);

			return $admin_menu;
		}
		return;
	}
}
?>
