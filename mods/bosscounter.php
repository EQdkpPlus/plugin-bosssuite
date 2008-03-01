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
    // new link class
    require_once(dirname(__FILE__).'/../include/bslink.class.php');
    $mybslink = new BSLINK($bc_conf['linkurl'], $bc_conf['linklength']);
    
    //VERTICAL
    if ($bc_conf['eyecandy'] == 1){
        //WITH ACCORDION
        $bspath = $eqdkp_root_path.'plugins/bosssuite/';
        $bcout = '
        <style type="text/css">
    
    #basic-accordion{
    	//border:5px solid #EEE;
    	//padding:5px;
    	//width:350px;
    	//position:absolute;
    	//left:50%;
    	//top:50%;
    	//margin-left:-175px;
    	//z-index:2;
    	//margin-top:-100px;
    }
    
    .accordion_headings{
    	//padding:5px;
    	//background:#99CC00;
    	//color:#FFFFFF;
    	//border:1px solid #FFF;
    	cursor:pointer;
    	font-weight:bold;
    }
    
    .accordion_headings:hover{
    	background:#00CCFF;
    }
    
    .accordion_child{
    	//padding:15px;
    	//background:#EEE;
    }
    
    .header_highlight{
    	//background:#00CCFF;
    }
    
    </style>
    <script type="text/javascript" src="'.$bspath.'include/javascripts/accordian-src.js"></script>';
    $bcout .= "
    <script type=\"text/javascript\">
    Event.observe(window, 'load', loadAccordions, false);  
    function loadAccordions() {  
      new Accordian('basic-accordion',5,'header_highlight');
    } 
    </script> 
    ";
    
    $bcout .= '<table width=100% class="borderless" cellspacing="0" cellpadding="0">';
    $bcout .= '<tr><th colspan="2" align="center">BossCounter</th></tr>'."\n";
    $bcout .= "<tr><td><div id='basic-accordion'>";
    $i = 1;
    foreach ($sbzone as $zone => $bosslist){
      $loc_killed = 0;
    	 foreach ($data[$zone]['bosses'] as $boss){
    		if ($boss['kc'] > 0)
    			$loc_killed++;
    	}
    	if ((!$bc_conf['dynZone']) or ($loc_killed > 0)) 
    	{
        $bcout .= '<div id="test'.$i.'-header" class="accordion_headings header_highlight" ><table width=100% class="borderless" cellspacing="0" cellpadding="0"><tr><th width="80%">'.$user->lang[$zone]['short'].'</th><th>'.$loc_killed.'/'.sizeof($data[$zone]['bosses']).'</th></tr></table></div>'."\n";
        $bcout .= "\t".'<div id="test'.$i.'-content"><div class="accordion_child">'."\n";
        $bcout .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
        $bi = 1; //row number 1/2
        foreach ($bosslist as $boss){
          if ((!$bc_conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)){
            $bcout .= "\t\t".'<tr class="row'.($bi+1).'"><td align="left">'.$mybslink->get_boss_link($boss).'</td>'; 
            $bcout .= '<td align="right">'.$data[$zone]['bosses'][$boss]['kc'].'</td></tr>'."\n";
            $bi = 1 - $bi;
          }
        }
        $bcout .= "\t\t</table></div></div>\n";
        $i++;
      }
    }
    $bcout .= '</div></td></tr></table>';
/*
//WITH ACCORDION
    $bspath = $eqdkp_root_path.'plugins/bosssuite/';
    $bcout = '
    <style type="text/css" >
    .accordion_toggle {
      display: block;
    	//font-size:11px;
      padding: 0 0 0 0;
      outline: none;
      cursor: pointer;
      margin: 0 0 0 0;
    }
    
    .accordion_toggle_active {
      margin: 0 0 0 0;
      padding: 0 0 0 0;
    }
    
    .accordion_content {
      overflow: hidden;
      margin: 0 0 0 0;
      padding: 0 0 0 0;
    }
    
    .accordion_content h2 {
      margin: 0 0 0 0;
      padding: 0 0 0 0;
    }
    </style>
    
    <script type="text/javascript" src="'.$bspath.'/include/javascripts/prototype.js"></script>
    <script type="text/javascript" src="'.$bspath.'/include/javascripts/effects.js"></script>
    <script type="text/javascript" src="'.$bspath.'/include/javascripts/accordion.js"></script>
    
    <script type="text/javascript">
    Event.observe(window, \'load\', loadAccordions, false);  
    function loadAccordions() {  
        var bcAccordion = new accordion(\'vertical_container_bosscounter\'); 
        bcAccordion.activate($$(\'#vertical_container_bosscounter .accordion_toggle\')[0]);  
    }
    </script>
    ';
    
    $bcout .= '<table width=100% class="borderless" cellspacing="0" cellpadding="0">';
    $bcout .= '<tr><th colspan="2" align="center">BossCounter</th></tr>'."\n";
    $bcout .= '<tr><td><div id="container"><div id="vertical_container_bosscounter">';
    foreach ($sbzone as $zone => $bosslist){
      $loc_killed = 0;
    	 foreach ($data[$zone]['bosses'] as $boss){
    		if ($boss['kc'] > 0)
    			$loc_killed++;
    	}
    	if ((!$bc_conf['dynZone']) or ($loc_killed > 0)) 
    	{
        $bcout .= '<h2 class="accordion_toggle"><table width=100% class="borderless" cellspacing="0" cellpadding="0"><tr><th width="80%">'.$user->lang[$zone]['short'].'</th><th>'.$loc_killed.'/'.sizeof($data[$zone]['bosses']).'</th></tr></table></h2>'."\n";
        $bcout .= "\t".'<div class="accordion_content">'."\n";
        $bcout .= "\t\t".'<table width="100%" border="0" cellspacing="1" cellpadding="2">'."\n";
        $bi = 1; //row number 1/2
        foreach ($bosslist as $boss){
          if ((!$bc_conf['dynBoss']) or ($data[$zone]['bosses'][$boss]['kc'] > 0)){
            $bcout .= "\t\t".'<tr class="row'.($bi+1).'"><td align="left">'.$mybslink->get_boss_link($boss).'</td>'; 
            $bcout .= '<td align="right">'.$data[$zone]['bosses'][$boss]['kc'].'</td></tr>'."\n";
            $bi = 1 - $bi;
          }
        }
        $bcout .= "\t\t</table></div>\n";
      }
    }
    $bcout .= '</div></div></td></tr></table>';
*/
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
