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

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

// You have to define the Module Information
$portal_module['bosscounter_h'] = array(                   // the same name as the folder!
			'name'			    => 'BossCounter horizontal Module',             // The name to show
			'path'			    => 'bosscounter_h',                     // Folder name again
			'version'		    => '0.9.0',                          // Version
			'author'        => 'sz3',                         // Author
			'contact'		    => 'sz3@gmx.net',          // email adress
			'description'   => 'Show the horizontal BossCounter',           // Detailed Description
			'positions'     => array('middle'), // Which blocks should be usable? left1 (over menu), left2 (under menu), right, middle
      'settings'      => '0',                               // 0  = no settings, 1 = settings
      'install'       => array(
                            'autoenable'        => '0',
                            'defaultposition'   => 'middle',
                            'defaultnumber'     => '1',
                          ),
    );

if(!function_exists(bosscounter_h_module)){
  function bosscounter_h_module(){
  	global $eqdkp , $user , $tpl, $db, $plang, $conf_plus, $pm;
  	if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') ){
	    return '<table><tr><td>BossSuite plugin not installed.</td></tr></table>';
    }else{
  	  include_once(dirname(__FILE__).'/../mods/bosscounter.php');
		  return $bchout;
		}
  }
}
?>