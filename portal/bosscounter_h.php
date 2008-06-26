<?php
/******************************
 * EQDKP PLUS
 * (c) 2008 by EQDKP Plus Dev Team
 * http://www.eqdkp-plus.com
 * ------------------
 * $Id: module.php 2266 2008-06-23 21:50:41Z wallenium $
 ******************************/

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
      'settings'      => '0'                               // 0  = no settings, 1 = settings
    );

/* Define the Settings if needed

name:       The name of the Database field & Input name
language:   The name of the language string in the language file
property:   What type of field? (text,checkbox,dropdown)
size:       Size of the field if required (optional)
options:    If dropdown: array('value'=>'Name')

There could be unlimited amount of settings
Settings page is created dynamically
*/
/*$portal_settings['bosscounter_v'] = array(
);*/

// The output function
// the name MUST be FOLDERNAME_module, if not an error will occur
if(!function_exists(bosscounter_h_module)){
  function bosscounter_h_module(){
  	global $eqdkp , $user , $tpl, $db, $plang, $conf_plus, $pm;
  	if ( ($pm->check(PLUGIN_INSTALLED, 'bosssuite')) ){ 
  	 include_once(dirname(__FILE__).'/../mods/bosscounter.php');
		  return $bchout;
		}
  }else{
      return "BossSuite not installed!";
  }
}
?>
