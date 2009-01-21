<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date: 2008-10-11 20:09:00 +0200 (Sa, 11 Okt 2008) $
 * -----------------------------------------------------------------------
 * @author      $Author: sz3 $
 * @copyright   2006-2008 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev: 2802 $
 *
 * $Id: bosscounter_h.php 2802 2008-10-11 18:09:00Z sz3 $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

// You have to define the Module Information
$portal_module['bosscounter'] = array(                   // the same name as the folder!
			'name'			    => 'BossCounter Module',             // The name to show
			'path'			    => 'bosscounter',                     // Folder name again
			'version'		    => '1.0.0',                          // Version
			'author'        => 'sz3',                         // Author
			'contact'		    => 'sz3@gmx.net',          // email adress
			'description'   => 'Show the BossCounter',           // Detailed Description
			'positions'     => array('middle', 'left1', 'left2', 'right'), // Which blocks should be usable? left1 (over menu), left2 (under menu), right, middle
      'settings'      => '0',                               // 0  = no settings, 1 = settings
      'install'       => array(
                            'autoenable'        => '0',
                            'defaultposition'   => 'right',
                            'defaultnumber'     => '1',
                          ),
    );

if(!function_exists(bosscounter_module)){
  function bosscounter_module(){
  	global $eqdkp , $user , $tpl, $db, $plang, $conf_plus, $pm, $wherevalue;
  	// This Module requires EQDKP PLUS 0.6.2.x
    if(EQDKPPLUS_VERSION < '0.6.2.1'){
      return $plang['pk_latestposts_plus2old'];
    }
  
    if($wherevalue == 'middle'){
      include(dirname(__FILE__).'/../mods/bosscounter.php');
      return $bchout;
    }else{
      include(dirname(__FILE__).'/../mods/bosscounter.php');
      $bla = '<table width=100% class="forumline" cellspacing="0" cellpadding="0"><tr><th colspan="2" align="center">BossCounter</th></tr>';
      $blupp = '</table>';
		  return '<table width=100% cellspacing="0" cellpadding="0">'.substr($bcout, strlen($bla), -(strlen($blupp))).'</table>';    
    }
  }
}
?>
