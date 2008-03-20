<?php
/******************************
* EQdkp BossBase
* Copyright 2005
* Licensed under the GNU GPL.  See COPYING for full terms.
* ------------------
* lang_main.php
******************************/
if ( !defined('EQDKP_INC') ){
header('HTTP/1.0 404 Not Found');exit;
}

$usage_html =
'
<tr><td class="row1">If you use one of the later EQdkp Plus 0.5 Versions you should not need to edit any files. If you use an older Plus version you should update to 0.5. If you use a vanilla eqDKP please follow the instructions.</td></tr>
<tr><th>Installation: BossCounter:</th></tr>
<tr><td class="row1">Open the common.php in the root folder of your eqdkp installation and search for the expression bosscounter. If no result was found you never used the bosscounter before, fine.<br><br>Search for the following line:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">$pm = new EQdkp_Plugin_Manager(true, DEBUG);<br></pre></div></td></tr>

<tr><td class="row1"><br>After those add:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">//BossCounter<br>if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_showBC\']) )<br>{<br>&nbsp; &nbsp; include_once($eqdkp_root_path . \'plugins/bosssuite/mods/bosscounter.php\');<br>}<br></pre></div></td></tr>
<tr><td class="row1"><br>and save the common.php.</td></tr>

<tr><th>Installation: Note2Link:</th></tr>
<tr><td class="row1">Open the listraids.php in the root folder of your eqdkp installation and search for the exspression bossloot. If no result was found you never used the note2link part before, fine.<br><br>Search for the following lines:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">while ( $row = $db->fetch_record($raids_result) )<br>{</pre></div></td></tr>

<tr><td class="row1"><br>After those add:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">&nbsp; &nbsp; &nbsp;if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_linkBL\']) ){<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; require_once ($eqdkp_root_path.\'plugins/bosssuite/mods/note2link.php\');<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = bl_note2link(stripslashes($row[\'raid_note\']));<br>&nbsp; &nbsp; &nbsp;}else{<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $raidnote = stripslashes($row[\'raid_note\']);<br>&nbsp; &nbsp; &nbsp;}</pre></div></td></tr>
<tr><td class="row1"><br>Now, a few lines after that you should find a row that looks like:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">\'NOTE\' => ( !empty($row[\'raid_note\']) ) ? stripslashes($row[\'raid_note\']) : \'&nbsp;\',</pre></div></td></tr>
<tr><td class="row1"><br>Replace it with:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">\'NOTE\' => ( !empty($row[\'raid_note\']) ) ? $raidnote : \'&nbsp;\',</pre></div></td></tr>
<tr><td class="row1"><br>and save the listraids.php.</td></tr>


';
?>
