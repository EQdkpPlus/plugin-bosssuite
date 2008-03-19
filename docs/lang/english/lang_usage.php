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
<tr><th>Installation: BossCounter:</th></tr>
<tr><td class="row1">
Open the common.php in the root folder of your eqdkp installation and search for the phrase bosscounter. If no result was found you never used the bosscounter before, fine.<br><br>Search for the following line:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">$pm = new EQdkp_Plugin_Manager(true, DEBUG);<br></pre></div></td></tr>

<tr><td class="row1"><br>After those add:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">//BossCounter<br>if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_showBC\']) )<br>{<br>&nbsp; &nbsp; include_once($eqdkp_root_path . \'plugins/bosssuite/mods/bosscounter.php\');<br>}<br></pre></div></td></tr>
<tr><td class="row1"><br>and save the common.php.</td></tr>

<tr><th>Installation: Note2Link:</th></tr>
<tr><td class="row1">
Open the listraids.php in the root folder of your eqdkp installation and search for the phrase bossloot. If no result was found you never used the bossloot part before, fine.<br><br>Search for the following line:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">$pm = new EQdkp_Plugin_Manager(true, DEBUG);<br></pre></div></td></tr>

<tr><td class="row1"><br>After those add:</td></tr>
<tr><td class="row2"><div><pre style="margin-top: 0pt; display: inline;">//BossCounter<br>if ( ($pm-&gt;check(PLUGIN_INSTALLED, \'bosssuite\')) &amp;&amp; ($eqdkp-&gt;config[\'bs_showBC\']) )<br>{<br>&nbsp; &nbsp; include_once($eqdkp_root_path . \'plugins/bosssuite/mods/bosscounter.php\');<br>}<br></pre></div></td></tr>
<tr><td class="row1"><br>and save the common.php.</td></tr>
';
?>
