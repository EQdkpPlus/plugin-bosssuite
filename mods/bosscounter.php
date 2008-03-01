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

if (!$mybsmgs->game_supported('bossbase')){
  $bcout = '<table width=100% class="borderless" cellspacing="0" cellpadding="2">
		        <tr><th colspan="2" align="center">BossCounter</th></tr>'."\n".
	         '<td>GAME NOT SUPPORTED!</td></tr></table>';
	$bchout = '<table cellpadding=2 cellspacing=0 border=0 width='.$BKtablewidth.' align=center>'."\n".
	          '<tr><td>GAME NOT SUPPORTED</td></tr></table>';
}else{

$mybsmgs->load_game_specific_language('bossbase');

// sql class
require_once(dirname(__FILE__).'/../include/bssql.class.php');
$mybssql = new BSSQL();

$bb_conf = $mybssql->get_config('bossbase');
$bb_pboss = $mybssql->get_parse_boss();
$bc_conf = $mybssql->get_config('bosscounter');
$sbzone = $mybssql->get_bzone('bosscounter');

# Get data from database&/offsets
####################################################
if ($bb_conf['source'] == 'database'){
    foreach ($sbzone as $zone => $bosses) {
      foreach ($bosses as $boss){
        $data[$zone]['bosses'][$boss]['kc'] = 0;
      }
    }
    $data = bc_fetch_bi($sbzone, $data, $bb_conf, $bb_pboss);
} else if ($bb_conf['source'] == 'offsets'){
    $bb_boffs = $mybssql->get_boss_offsets();
    foreach($sbzone as $zone => $bosses){
        foreach($bosses as $boss){
            $data[$zone]['bosses'][$boss]['kc'] = 0+$bb_boffs[$boss]['counter'];
        }
    }
} else if ($bb_conf['source'] == 'both'){
    $bb_boffs = $mybssql->get_boss_offsets();
    foreach($sbzone as $zone => $bosses){
        foreach($bosses as $boss){
            $data[$zone]['bosses'][$boss]['kc'] = 0+$bb_boffs[$boss]['counter'];
        }
    }
    $data = bc_fetch_bi($sbzone, $data, $bb_conf, $bb_pboss);
} else if ($bb_conf['source'] == 'cache'){
  $data = $mybssql->get_cache();
}
    if ($bc_conf['eyecandy'] == 1){
    # Output
    ####################################################
    require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/init.pwc.php'); 
    $wpfccore = new InitWPFC($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/');
    require_once($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/jquery.class.php'); 
    $bc_jquery = new jQuery($eqdkp_root_path . 'plugins/bosssuite/include/wpfc/'); 
    /*if (!(IS_PLUS)){
      $plus_page_header  = $jquery->Header();
    }*/
    
    // new link class
    require_once(dirname(__FILE__).'/../include/bslink.class.php');
    $mybslink = new BSLINK($bc_conf['linkurl'], $bc_conf['linklength']);
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
        $bc_acc_title = '<table width=100% class="borderless" cellspacing="0" cellpadding="0"><tr><th width="80%">'.$user->lang[$zone]['short'].'</th><th>'.$loc_killed.'/'.sizeof($data[$zone]['bosses']).'</th></tr></table>'."\n";
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
    $bcout .= $bc_jquery->accordion('bc_accordion',$bc_acc_array);
    $bcout .= '</td></tr></table>';
    
}else{
    $bcout = '<table width=100% class="borderless" cellspacing="0" cellpadding="2">
    		  <tr><th colspan="2" align="center">Bosscounter</th></tr>'."\n";
    
    foreach ($sbzone as $zone => $bosses) 
    {
    	 $loc_killed = 0;
    	 foreach ($data[$zone]['bosses'] as $boss){
    		if ($boss['kc'] > 0)
    			$loc_killed++;
    	}
    	
    	if ((!$bc_conf['dynZone']) or ($loc_killed > 0)) 
    	{
    		$bcout .=  '<tr><th align="left">'.$user->lang[$zone]['short'].'</th><th align="right">'.$loc_killed.'/'.sizeof($data[$zone]['bosses']).'</th></tr>'."\n"; 
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
	
	
function bc_get_sql_data_string($tablestring){
  $tables = array();
  if($tablestring != '')
      $tables = explode(", ", $tablestring);
  
  $sql = "";
  if (count($tables) == 0) {
      $sql = "SELECT raid_name AS rname, raid_note AS rnote FROM " . RAIDS_TABLE . ";";
  } else {
      $bpinc = 0;
      foreach ($tables as $raidtable) {
          if ($bpinc == 0) {
              $sql .= "SELECT raid_name AS rname, raid_note AS rnote FROM " . $raidtable . "_raids";
              $bpinc++;
          } else {
              $sql .= " UNION ALL SELECT raid_name, raid_note FROM " . $raidtable . "_raids";
          }
      }
      $sql .= ";";
  }
  return $sql;
}

function bc_fetch_bi($bzone, $data, $bb_conf, $bb_pboss) {
global $db;
    $delim = array (
        'rnote' => '/'.$bb_conf['noteDelim'].'/',
        'rname' => '/'.$bb_conf['nameDelim'].'/'
    );

    $bossInfo = $bb_conf['bossInfo'];

    #Get data from the raids tables
    ##################################################
    $sql = bc_get_sql_data_string($bb_conf['tables']);
    $result = $db->query($sql);
	  foreach($db->fetch_record_set() as $row) {
        foreach ($bzone as $zone => $bosses){
            # Get bossinfo from current row
            ################################
            if ($delim[$bossInfo] != "//"){
                $boss_element = preg_split($delim[$bossInfo], $row[$bossInfo], -1, PREG_SPLIT_NO_EMPTY);
            } else {
                $boss_element = array($row[$bossInfo]);
            }
            foreach ($boss_element as $raid){
                foreach ($bosses as $boss){
                    $bparseList = preg_split("/\', \'/", stripslashes(trim($bb_pboss['pb_'.$boss], "\' ")));
                    if (in_array(stripslashes(trim($raid)), $bparseList)) {
                        $data[$zone]['bosses'][$boss]['kc']++;
                    }
                }
            }
        }
    }
    mysql_free_result($result);
    return $data;
}
	
?>
