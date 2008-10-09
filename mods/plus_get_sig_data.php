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

function plus_get_sig_data(){
// new mgs class
require_once(dirname(__FILE__).'/../include/bsmgs.class.php');
$mybsmgs = new BSMGS();
if (!$mybsmgs->game_supported('bossbase')){
  return false;
}else{
  # Get configuration data from the database
  ####################################################
  require_once(dirname(__FILE__).'/../include/bcsql.class.php');
  $mybcsql = new BCSQL();

  $bb_conf = $mybcsql->get_config('bossbase');
  $bc_conf = $mybcsql->get_config('bosscounter');
  $sbzone = $mybcsql->get_bzone();

  # Get data
  ####################################################
  $data = $mybcsql->get_data($bb_conf, $sbzone);
  //sizeof($data[$zone]['bosses'])
  //$data[$zone]['zk'] > 0)
  return $data;
}
}
?>
