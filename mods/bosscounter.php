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

# Output
####################################################

//VERTICAL
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
		    	$bcout .= '<tr class="row'.($bi+1).'"><td align="left">'.bc_html_get_bosslink($boss).'</td><td align="right">'.$data[$zone]['bosses'][$boss]['kc'].'</td></tr>' . "\n";
				$bi = 1 - $bi;
			}
		}									
	}
}
$bcout .= '</table>'."\n";

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
				$bchout .= '<td align="left" width="10%" class="bossname"><span style="font-size:1em">' .  bc_html_get_bosslink($boss) . '</span></td>'."\n";
				$bchout .= '<td align="left" width="5%" class="bosscount"><span style="font-size:1em">' .  $data[$zone]['bosses'][$boss]['kc'] . '</span></td>'."\n";
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
    $delim = array (
        'rnote' => '/'.$bb_conf['noteDelim'].'/',
        'rname' => '/'.$bb_conf['nameDelim'].'/'
    );

    $bossInfo = $bb_conf['bossInfo'];

    #Get data from the raids tables
    ##################################################
    $sql = bc_get_sql_data_string($bb_conf['tables']);
    $result = mysql_query($sql) or message_die(mysql_error());

    while ($row = mysql_fetch_assoc($result)) {
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

function bc_html_get_bosslink($bossid){
global $eqdkp, $pm, $user, $SID;
    if ( $pm->check(PLUGIN_INSTALLED, 'bossloot') )
		  return '<a href="' . $eqdkp->config['server_path'] . 'plugins/bossloot/bossloot.php'.$SID.'&amp;bossid='.$bossid.'">'.$user->lang[$bossid]['short'].'</a><br />';
    return '<a href="' . $user->lang['baseurl'] . $user->lang[$bossid]['id'] . '" target="bossinfo">' . $user->lang[$bossid]['short'] . '</a><br />';
}
	
?>
