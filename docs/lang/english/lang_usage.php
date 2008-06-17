<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id$
 ******************************/
 
if ( !defined('EQDKP_INC') ){
header('HTTP/1.0 404 Not Found');exit;
}

$usage_html =
'
<tr><td class="row1">If you use one of the later EQdkp Plus 0.5 Versions you should not need to edit any files. If you use an older Plus version you should update to 0.5. If you use a vanilla eqDKP please follow the instructions.</td></tr>';


if (!is_array($conf_plus)) 
{
	'<tr><th>New installation: BossCounter</th></tr>
	<tr><td class="row1">Open the common.php in the root folder of your eqdkp installation and search for the expression bosscounter. If no result was found you never used the bosscounter before, fine.<br><br>Search for the following line:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">$pm = new EQdkp_Plugin_Manager(true, DEBUG);<br></pre></div></td></tr>
	
	<tr><td class="row1"><br>After those add:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">//BossCounter<br>if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_showBC\']) )<br>{<br>&nbsp; &nbsp; include_once($eqdkp_root_path . \'plugins/bosssuite/mods/bosscounter.php\');<br>}<br></pre></div></td></tr>
	<tr><td class="row1"><br>and save the common.php. This will assign two variables for your template system named {BOSSKILLV}(for vertical templates with side menu) and {BOSSKILLV} (for horizontal templates with menu at the top). Now you will have to edit the page_header.html files of the templates you use and add the bosscounter (e.g. after the menus). Example: Open the templates/default/page_header.html and search for the following code:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">&lt;!-- IF S_NORMAL_HEADER --&gt;<br>&lt;table width="100%" border="0" cellspacing="1" cellpadding="2" class="borderless"&gt;<br>&nbsp; &lt;tr&gt;<br>&nbsp; &nbsp; &lt;td width="201" nowrap="nowrap"&gt;&lt;img src="{TEMPLATE_PATH}/images/{LOGO_PATH}" alt="Logo" /&gt;&lt;br /&gt;&lt;/td&gt;<br>&nbsp; &nbsp; &lt;td width="100%"&gt;<br>&nbsp; &nbsp; &nbsp; &lt;center&gt;&lt;span class="maintitle"&gt;{MAIN_TITLE}&lt;/span&gt;&lt;br /&gt;<br>&nbsp; &nbsp; &nbsp; &lt;span class="subtitle"&gt;{SUB_TITLE}&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;<br>&nbsp; &nbsp; &nbsp; &lt;span class="menu"&gt;<br>&nbsp; &nbsp; &nbsp; {MAIN_MENU1}<br>&nbsp; &nbsp; &nbsp; &lt;br /&gt;<br>&nbsp; &nbsp; &nbsp; {MAIN_MENU2}<br>&nbsp; &nbsp; &nbsp; &lt;/span&gt;&lt;/center&gt;<br>&nbsp; &nbsp; &lt;/td&gt;<br>&nbsp; &lt;/tr&gt;<br>&lt;/table&gt;<br></pre></td></tr>
	<tr><td class="row1"><br>Change it to:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">&lt;!-- IF S_NORMAL_HEADER --&gt;<br>&lt;table width="100%" border="0" cellspacing="1" cellpadding="2" class="borderless"&gt;<br>&nbsp; &lt;tr&gt;<br>&nbsp; &nbsp; &lt;td width="201" nowrap="nowrap"&gt;&lt;img src="{TEMPLATE_PATH}/images/{LOGO_PATH}" alt="Logo" /&gt;&lt;br /&gt;&lt;/td&gt;<br>&nbsp; &nbsp; &lt;td width="100%"&gt;<br>&nbsp; &nbsp; &nbsp; &lt;center&gt;&lt;span class="maintitle"&gt;{MAIN_TITLE}&lt;/span&gt;&lt;br /&gt;<br>&nbsp; &nbsp; &nbsp; &lt;span class="subtitle"&gt;{SUB_TITLE}&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;<br>&nbsp; &nbsp; &nbsp; &lt;span class="menu"&gt;<br>&nbsp; &nbsp; &nbsp; {MAIN_MENU1}<br>&nbsp; &nbsp; &nbsp; &lt;br /&gt;<br>&nbsp; &nbsp; &nbsp; {MAIN_MENU2}<br>&nbsp; &nbsp; &nbsp; &lt;br /&gt;<br>&nbsp; &nbsp; &nbsp; {BOSSKILL}<br>&nbsp; &nbsp; &nbsp; &lt;/span&gt;&lt;/center&gt;<br>&nbsp; &nbsp; &lt;/td&gt;<br>&nbsp; &lt;/tr&gt;<br>&lt;/table&gt;<br></pre></td></tr>
	<tr><td class="row1"><br>and save the page_header.html. What exactly you have to do or how the lines look like may vary from template to template, but this should give you a general idea.</td></tr>
	<tr><th>New installation: Note2Link</th></tr>
	<tr><td class="row1">Open the listraids.php in the root folder of your eqdkp installation and search for the exspression bossloot. If no result was found you never used the note2link part before, fine.<br><br>Search for the following lines:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">while ( $row = $db->fetch_record($raids_result) )<br>{</pre></div></td></tr>
	<tr><td class="row1"><br>After those add:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">&nbsp; &nbsp; &nbsp;if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_linkBL\']) ){<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; require_once ($eqdkp_root_path.\'plugins/bosssuite/mods/note2link.php\');<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = bl_note2link(stripslashes($row[\'raid_note\']));<br>&nbsp; &nbsp; &nbsp;}else{<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = stripslashes($row[\'raid_note\']);<br>&nbsp; &nbsp; &nbsp;}</pre></div></td></tr>
	<tr><td class="row1"><br>Now, a few lines after that you should find a row that looks like:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">\'NOTE\' => ( !empty($row[\'raid_note\']) ) ? stripslashes($row[\'raid_note\']) : \'&nbsp;\',</pre></div></td></tr>
	<tr><td class="row1"><br>Replace it with:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">\'NOTE\' => ( !empty($row[\'raid_note\']) ) ? $raidnote : \'&nbsp;\',</pre></div></td></tr>
	<tr><td class="row1"><br>and save the listraids.php.</td></tr>
	
	<tr><th>Update: BossCounter</th></tr>
	<tr><td class="row1">Open the common.php in the root folder of your eqdkp installation and search for the expression bosscounter. You should find something that looks like:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">//BossCounter<br>if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosscounter\'))<br>{<br>&nbsp; &nbsp; include_once($eqdkp_root_path . \'plugins/bosscounter/bosscounter.php\');<br>}<br></pre></div></td></tr>
	<tr><td class="row1"><br>replace it with:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">//BossCounter<br>if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_showBC\']) )<br>{<br>&nbsp; &nbsp; include_once($eqdkp_root_path . \'plugins/bosssuite/mods/bosscounter.php\');<br>}<br></pre></div></td></tr>
	<tr><td class="row1"><br>and save the common.php.</td></tr>
	
	<tr><th>Update: Note2Link</th></tr>
	<tr><td class="row1">Open the listraids.php in the root folder of your eqdkp installation and search for the exspression bossloot. You should find something that looks like:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">&nbsp; &nbsp; &nbsp;if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssloot\')){<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; require_once ($eqdkp_root_path.\'plugins/bossloot/include/extfunc.php\');<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = bl_note2link(stripslashes($row[\'raid_note\']));<br>&nbsp; &nbsp; &nbsp;}else{<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = stripslashes($row[\'raid_note\']);<br>&nbsp; &nbsp; &nbsp;}</pre></div></td></tr>
	<tr><td class="row1"><br>Replace it with:</td></tr>
	<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">&nbsp; &nbsp; &nbsp;if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_linkBL\']) ){<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; require_once ($eqdkp_root_path.\'plugins/bosssuite/mods/note2link.php\');<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = bl_note2link(stripslashes($row[\'raid_note\']));<br>&nbsp; &nbsp; &nbsp;}else{<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = stripslashes($row[\'raid_note\']);<br>&nbsp; &nbsp; &nbsp;}</pre></div></td></tr>
	<tr><td class="row1"><br>and save the listraids.php.</td></tr>
	';
	
}
?>
