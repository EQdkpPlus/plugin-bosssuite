<?php
 /*
 * Project:     BossSuite v4 MGS
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		    http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2006
 * Date:        $Date: 2008-10-11 18:40:21 +0200 (Sa, 11 Okt 2008) $
 * -----------------------------------------------------------------------
 * @author      $Author: sz3 $
 * @copyright   2006-2008 sz3
 * @link        http://eqdkp-plus.com
 * @package     bosssuite
 * @version     $Rev: 2801 $
 *
 * $Id: bosscounter_v.php 2801 2008-10-11 16:40:21Z sz3 $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

// You have to define the Module Information
$portal_module['bossbars'] = array(                   // the same name as the folder!
			'name'			    => 'BossBars',             // The name to show
			'path'			    => 'bossbars',                     // Folder name again
			'version'		    => '0.0.1',                          // Version
			'author'        => 'sz3',                         // Author
			'contact'		    => 'sz3@gmx.net',          // email adress
			'description'   => 'Shows progressions bars',           // Detailed Description
			'positions'     => array('left1', 'left2', 'right'), // Which blocks should be usable? left1 (over menu), left2 (under menu), right, middle
      'settings'      => '0',                               // 0  = no settings, 1 = settings
      'install'       => array(
                            'autoenable'        => '0',
                            'defaultposition'   => 'right',
                            'defaultnumber'     => '1',
                         ),  
    );

if(!function_exists(bossbars_module)){
  function bossbars_module(){
  	global $eqdkp_root_path, $eqdkp , $user , $tpl, $db, $plang, $conf_plus, $pm, $html, $jqueryp;
  	if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') ){
	    return '<table><tr><td>BossSuite plugin not installed.</td></tr></table>';
    }else{
      // new mgs class
      require_once($eqdkp_root_path.'plugins/bosssuite/include/bsmgs.class.php');
      $mybsmgs = new BSMGS();
      $mybsmgs->load_game_specific_language('bossbase');
      
      require_once($eqdkp_root_path.'plugins/bosssuite/include/bssql.class.php');
      $mybcsql = new BSSQL();
      
      $bb_conf = $mybcsql->get_config('bossbase');
      $bc_conf = $mybcsql->get_config('bosscounter');
      $sbzone = $mybcsql->get_bzone('bosscounter');
      $data = $mybcsql->get_data($bb_conf, $sbzone);

      require_once($eqdkp_root_path.'plugins/bosssuite/include/bslink.class.php');
      $mybslink = new BSLINK($bc_conf['linkurl'], $bc_conf['linklength']);
      
      $bcout = '<table width="100%" cellspacing="0" cellpadding="0">';
      
      foreach ($sbzone as $zone => $bosses)
      {
      	if ((!$bc_conf['dynZone']) or ($data[$zone]['zk'] > 0))
      	{
      	  $zone_name = $user->lang[$zone][$bc_conf['zonelength']];
      	  $killed = $data[$zone]['zk'];
          $total = sizeof($data[$zone]['bosses']);
          $percentage = round(($killed/$total)*100);
          $rc = $eqdkp->switch_row_class();
          $tooltip = '<table width="100%">';
          foreach($bosses as $boss){
      		  if($data[$zone]['bosses'][$boss]['kc'] > 0){
              $tooltip .= '<tr>';
              $tooltip .= '<td align="right">'.$data[$zone]['bosses'][$boss]['kc'].'x</td>';
              $tooltip .= '<td align="left"><b>'.$mybslink->get_boss_link($boss).'</b></td>';
              $tooltip .= '<td align="right">'.date($user->style['date_notime_short'], $data[$zone]['bosses'][$boss]['fkd']).'</td>';
              $tooltip .= '</tr>';
            }else{
              $tooltip .= '<tr>';
              $tooltip .= '<td align="right">&nbsp;</td>';
              $tooltip .= '<td align="left">'.$mybslink->get_boss_link($boss).'</td>';
              $tooltip .= '<td align="right">&nbsp;</td>';
              $tooltip .= '</tr>';
            }
      		}
          $tooltip .= '</table>'; 
      	
      	  $bcout .= '<tr><td class="'.$rc.'" nowrap="nowrap">';
          $bcout .= $jqueryp->ProgressBar($zone.'_bar', $percentage, $html->ToolTip($tooltip, $zone_name.' : '.$killed.'/'.$total), 'left');
          
          $bcout .= '</td></tr>';
         
      	}
      }
      $bcout .= '</table>';
      return $bcout;
    }
  }
}
?>
