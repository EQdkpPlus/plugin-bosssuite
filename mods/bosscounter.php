<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id$
 ******************************/

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
	         '<tr><td>GAME NOT SUPPORTED!</td></tr></table>';
	$bchout = '<table cellpadding=2 cellspacing=0 border=0 width='.$BKtablewidth.' align=center>'."\n".
	          '<tr><td>GAME NOT SUPPORTED</td></tr></table>';
}else{
  # Get configuration data from the database
  ####################################################
  $mybsmgs->load_game_specific_language('bossbase');

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

  require_once(dirname(__FILE__).'/../include/bslink.class.php');
  $mybslink = new BSLINK($bc_conf['linkurl'], $bc_conf['linklength']);
  
  global $jqueryp;
  
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
          $bc_acc_title = '<table width=100% class="borderless" cellspacing="0" cellpadding="0"><tr style="cursor:pointer;"><th width="80%">'.$user->lang[$zone][$bc_conf['zonelength']].'</th><th>'.$loc_killed.'/'.sizeof($data[$zone]['bosses']).'</th></tr></table>'."\n";
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
      $bcout = '<table width=100% class="forumline" cellspacing="0" cellpadding="0"><tr><th colspan="2" align="center">BossCounter</th></tr>';
      $bcout .= '<tr><td>'."\n";
      $bcout .= $jqueryp->accordion('bc_accordion',$bc_acc_array);
      $bcout .= '</td></tr>';
      $bcout .= '</table>';
  }else{
      $bcout = '<table width=100% class="forumline" cellspacing="0" cellpadding="0"><tr><th colspan="2" align="center">BossCounter</th></tr>';
      
      foreach ($sbzone as $zone => $bosses)
      {
      	if ((!$bc_conf['dynZone']) or ($data[$zone]['zk'] > 0))
      	{
      		$bcout .=  '<tr><th align="left">'.$user->lang[$zone][$bc_conf['zonelength']].'</th><th align="right">'.$data[$zone]['zk'].'/'.sizeof($data[$zone]['bosses']).'</th></tr>'."\n";
      		$bi = 1; //row number 1/2
      		foreach($bosses as $boss){
      			if ((!$bc_conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)){
      		    	$bcout .= '<tr class="row'.($bi+1).'"><td align="left">'.$mybslink->get_boss_link($boss).'</td><td align="right">'.$data[$zone]['bosses'][$boss]['kc'].'</td></tr>' . "\n";
      				$bi = 1 - $bi;
      			}
      		}
      	}
      }
      $bcout .= '</table>';
  }

  //HORIZONTAL
  $bi = 1;
  $BKtablewidth = '"600px"';
  $bchout .= '<table cellpadding=2 cellspacing=0 border=0 width='.$BKtablewidth.' align=center>'."\n";

  foreach ($sbzone as $zone => $bosses)
  {
  		  $bchout .= '<tr class="row'.($bi+1).'" align="left">'."\n";
  			$bchout .= '<td colspan="8" style="text-decoration:underline"><span style="font-size:1em">'.$user->lang[$zone][$bc_conf['zonelength']].'</span></td></tr>'."\n";
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
