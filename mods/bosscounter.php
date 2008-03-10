<?php
/******************************
 * EQdkp Bosscounter 2.2
 * Copyright 2006
 * Licensed under the GNU GPL.  See COPYING for full terms.
 * ------------------
 * bosscounter.php
 * 28.05.06 Corgan
 * 31.05.06 Corgan 2.1
 * 07.11.06 Corgan change to fetch Data from Bossprogress
 * 18.04.07 sz3 2.2
 ********************************************************/

if ( !defined('EQDKP_INC') )
{
    die('Do not access this file directly.');
}

include_once ($eqdkp_root_path . 'common.php');

global $user , $eqdkp;

// new mgs class
require_once(dirname(__FILE__).'/../include/bsmgs.class.php');
$mybsmgs = new BSMGS();

# Check whether the current game is supported
####################################################
if (!$mybsmgs->game_supported('bossbase')){
  $bcout = '<table width=100% class="borderless" cellspacing="0" cellpadding="2">
		        <tr><th colspan="2" align="center">BossCounter</th></tr>'."\n".
	         '<td>GAME NOT SUPPORTED!</td></tr></table>';
	$bchout = '<table cellpadding=2 cellspacing=0 border=0 width='.$BKtablewidth.' align=center>'."\n".
	          '<tr><td>GAME NOT SUPPORTED</td></tr></table>';
}else{
  # Get configuration data from the database
  ####################################################
  require_once(dirname(__FILE__).'/../include/bcsql.class.php');
  $mybcsql = new BCSQL();
  
  $bb_conf = $mybcsql->get_config('bossbase');
  $bc_conf = $mybcsql->get_config('bosscounter');
  $sbzone = $mybcsql->get_bzone('bosscounter');
  
  # Get data
  ####################################################
  $data = $mybcsql->get_data($bb_conf, $sbzone);
  
  # Get output
  ####################################################
  $mybsmgs->load_game_specific_language('bossbase');
  require_once(dirname(__FILE__).'/../include/bslink.class.php');
  $mybslink = new BSLINK($bc_conf['linkurl'], $bc_conf['linklength']);

  if (($bc_conf['eyecandy'] == 1) && (isset($jqueryp))){
      # Output
      ####################################################     
      $bc_acc_array = array();
      $i = 1;
      foreach ($sbzone as $zone => $bosslist){
        $loc_killed = 0;
      	 foreach ($data[$zone]['bosses'] as $boss){
      		if ($boss['kc'] > 0)
      			$loc_killed++;
      	}
      	if ((!$bc_conf['dynZone']) or ($loc_killed > 0)) 
      	{
          $bc_acc_title = '<table width=100% class="borderless" cellspacing="0" cellpadding="0"><tr><th width="80%">'.$user->lang[$zone][$bc_conf['zonelength']].'</th><th>'.$loc_killed.'/'.sizeof($data[$zone]['bosses']).'</th></tr></table>'."\n";
          $bc_acc_content = '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
          $bi = 1; //row number 1/2
          foreach ($bosslist as $boss){
            if ((!$bc_conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)){
              $bc_acc_content .= "\t\t".'<tr class="row'.($bi+1).'"><td align="left">'.$mybslink->get_boss_link($boss).'</td>'; 
              $bc_acc_content .= '<td align="right">'.$data[$zone]['bosses'][$boss]['kc'].'</td></tr>'."\n";
              $bi = 1 - $bi;
            }
          }
          $bc_acc_content .= "\t\t</table>\n";
          $bc_acc_array[$bc_acc_title] = $bc_acc_content;     
        }
      }
      $bcout = '<table width=100% class="borderless" cellspacing="0" cellpadding="0">';
      $bcout .= '<tr><th colspan="2" align="center">BossCounter</th></tr><tr><td>'."\n";
      $bcout .= $jqueryp->accordion('bc_accordion',$bc_acc_array);
      $bcout .= '</td></tr></table>';
  }else{
      $bcout = '<table width=100% class="borderless" cellspacing="0" cellpadding="2">
      		  <tr><th colspan="2" align="center">Bosscounter</th></tr>'."\n";
      
      foreach ($sbzone as $zone => $bosses) 
      {
      	if ((!$bc_conf['dynZone']) or ($data[$zone]['zk'] > 0)) 
      	{
      		$bcout .=  '<tr><th align="left">'.$user->lang[$zone]['short'].'</th><th align="right">'.$data[$zone]['zk'].'/'.sizeof($data[$zone]['bosses']).'</th></tr>'."\n"; 
      		$bi = 1; //row number 1/2
      		foreach($bosses as $boss){
      			if ((!$bc_conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)){
      		    	$bcout .= '<tr class="row'.($bi+1).'"><td align="left">'.$mybslink->get_boss_link($boss).'</td><td align="right">'.$data[$zone]['bosses'][$boss]['kc'].'</td></tr>' . "\n";
      				$bi = 1 - $bi;
      			}
      		}									
      	}
      }
      $bcout .= '</table>'."\n";
  }

  //HORIZONTAL
  $bi = 1;
  $BKtablewidth = '"600px"';
  $bchout .= '<table cellpadding=2 cellspacing=0 border=0 width='.$BKtablewidth.' align=center>'."\n";
  
  foreach ($sbzone as $zone => $bosses) 
  {
  		  $bchout .= '<tr class="row'.($bi+1).'" align="left">'."\n";  
  			$bchout .= '<td colspan="8" style="text-decoration:underline"><span style="font-size:1em">'.$user->lang[$zone]['long'].'</span></td></tr>'."\n";
  		  $bchout .= '<tr class="row'.($bi+1).'">'."\n";
  		  $i=0;
  
  		  foreach ($bosses as $boss)
  		  {
  				$i++;
  				$bchout .= '<td align="left" width="10%" class="bossname"><span style="font-size:1em">' . $mybslink->get_boss_link($boss) . '</span></td>'."\n";
  				$bchout .= '<td align="left" width="5%" class="bosscount"><span style="font-size:1em">' . $data[$zone]['bosses'][$boss]['kc'] . '</span></td>'."\n";
  				if (($i % 4) == 0)
  				{
  					$bchout .= '</tr><tr class="row'.($bi+1).'">'."\n";
  				}
  			}	
  
  		  $rest = 4-($i % 4);
  		  $bchout .= str_repeat("<td></td>", ($rest)*2);
  		  $bchout .= '</tr>'."\n";
  
  		  $bi = 1-$bi;
  	}
  	$bchout .= '</table>';
}

$tpl->assign_var('BOSSKILLV',$bcout);
$tpl->assign_var('BOSSKILL',$bchout);
	
?>
