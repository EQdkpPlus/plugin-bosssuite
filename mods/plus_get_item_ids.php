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

if ( !defined('EQDKP_INC') )
{
    die('Do not access this file directly.');
}

function plus_get_item_ids(){
  require_once(dirname(__FILE__).'/../include/blmgs.class.php');
  $myblmgs = new BLMGS();
  
  require_once(dirname(__FILE__).'/../include/blsql.class.php');
  $myblsql = new BLSQL();
  $bl_conf = $myblsql->get_config('bossloot');
  $bzone = $myblsql->get_bzone();
  
  $id_list = array();
  
  foreach($bzone as $zoneid => $bosslist){
    foreach($bosslist as $bossid){
      $loottable = $myblmgs->bl_get_loottable($bl_conf['item_lang'], $bossid, $bl_conf['item_minqual']);
      foreach($loottable as $id => $name){
        $id_list[$id] = $name;
      }
    }
  }
  return $id_list;
}
?>
