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
 
$new_version    = '4.3.8';
$updateFunction = 'BS437to438Update';
$reloadSETT = 'settings.php';

$updateDESC = false;
$updateSQL = false;

function BS437to438Update(){
global $db, $user;
  $sql = "INSERT INTO __bs_config VALUES ('bb_enable_updatechk', '1');
  $result = $db->query($sql);
  $db->query($sql);
}
?>
