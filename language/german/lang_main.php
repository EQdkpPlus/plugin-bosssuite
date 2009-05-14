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

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
//General
'bosssuite' => 'BossSuite',
'bosscounter' => 'BossCounter',

//Permissions
'bs_pm_conf' => 'Konfiguration',
'bs_pm_offs' => 'Offsets',
'bs_bp_view' => 'zeige BossProgresss',
'bs_bl_view' => 'zeige BossLoot',
'bs_bc_view' => 'zeige BossCounter',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => 'Einstellungen',
'bs_am_offs' => 'Offsets',
'bs_am_cache' => 'Cache',

// admin page
'bs_al_submit' => 'Speichern',
'bs_al_general' => 'Allgemeine Einstellungen',
'bs_al_delimRNO' => 'Trennzeichen f�r die Raidnotiz (Opt.: Regul�rer Ausdruck):',
'bs_al_delimRNA' => 'Trennzeichen f�r den Raidnamen (Opt.: Regul�rer Ausdruck):',
'bs_al_tables' => 'Opt.: EQdkp Pr�fixliste (leer => nur aktuelles Pr�fix):',
'bs_al_zoneInfo' => 'Wo sind die Zonen Infos zu finden?',
'bs_al_bossInfo' => 'Wo sind die Boss Infos zu finden?',
'bs_al_linkInfo' => 'Link Optionen:',
'bs_al_name' => 'Name',
'bs_al_trigger' => 'String trigger(s)',
'bs_ao_rnote' => 'Raidnotiz',
'bs_ao_rname' => 'Raidname',
'bs_al_source' => 'Datenquelle:',
'bs_source_db' => 'Datenbank',
'bs_source_offs' => 'Offsets',
'bs_source_both' => 'Beides',
'bs_source_cache' => 'Cache',
'bs_al_showZone' => 'Auswahl der Zonen die in diesem Plugin angezeigt werden sollen:',
'lang' => 'german',

'dateFormat' => '%d.%m.%Y',
'bs_out_date_format' => 'dd.mm.yy',
'bs_date_day' => array('start' => 0, 'length' => 2),
'bs_date_month' => array('start' => 3, 'length' => 2),
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => 'Das Datumsformat ist: ',
'bs_ol_in' => 'Name',
'bs_ol_fd' => 'Erstes Datum',
'bs_ol_ld' => 'Letztes Datum',
'bs_ol_co' => 'Z�hler',
'bs_ol_submit' => 'Speichern',

// cache page
'bs_adm_cache_info' => 'Cache: Diese Funktion kann die Ladezeiten bei dkp Systemen mit vielen Raids verringern',
'bs_adm_cache_refresh' => 'Cache erneuern',

//BossProgress User Page
'bp_um_link' => 'Instanzfortschritt',
'firstkill' => 'Erster Sieg: ',
'lastkill' => 'Letzter Sieg: ',
'firstvisit' => 'Erster Besuch: ',
'lastvisit' => 'Letzter Besuch: ',
'zonevisitcount' => 'Besuchsanzahl: ',
'bosskillcount' => 'Siegesanzahl: ',
'status' => 'Status: ',
'never' => 'Niemals',
'all_zones' => 'alle Zonen',
'bs_ol_zoneselect' => 'Auswahl der Zone(n):',

'opt_general' => 'Allgemeine Einstellungen',
'opt_dynloc' => 'Verstecke Zonen ohne Siege �ber Bosse?',
'opt_dynboss' => 'Verstecke niemals besiegte Bosse?',
'opt_showzone' => 'Zeige: ',
'opt_showSB' => 'Zeige einen Zonenfortschrittsbalken?',
'opt_style' => 'Style: ',
'bp_style_bp' => 'BossProgress normal',
'bp_style_bps' => 'BossProgress einfach',
'bp_style_rp2r' => 'Raidprogress 2 Spalten',
'bp_style_rp3r' => 'Raidprogress 3 Spalten',


'bl_loottable' => 'Loottabelle f�r: ',
'bl_kc_p1' => ' (',
'bl_kc_p2' => ' mal besiegt)',
'bs_image_not_found' => 'Leider konnte kein Bild f�r den ausgew�hlten Boss gefunden werden.',
'bl_itemname' => 'Gegenstandsname',
'bl_itemcount' => 'Anzahl',
'bl_droprate' => 'Rate',

'bl_dl' => 'Gefallene Beute',
'bl_ndl' => 'Niemals gefallene Beute',
'bl_wl' => 'Falsch zugeordnete/unklare Beute',

'bl_itemsfound' => 'Gegenst�nde gefunden',
'item_lang_none' => 'keine',

//Admin menu
'bl_opt_minitemqual' => 'Minimale Gegenstandsqualit�t, die angezeigt werden soll:',
'bl_opt_itemlang' => 'Auswahl der Lootliste',
'bl_opt_ndl' => 'Zeige Gegenst�nde, die niemals gefallen sind?',
'bl_opt_wl' => 'Zeige Beute, die nicht eindeutig zuzuordnen war?',
'bl_opt_is' => 'Aktiviere Itemstats f�r nie gefallene Gegenst�nde?',
'bl_opt_eyecandy' => 'Aktiviere Akkordions?',
'bc_opt_eyecandy' => 'Aktiviere Akkordions? (nur f�r PLUS 0.5+)',
'bs_credits_p1' => 'EQDKP BossSuite v',
'bs_credits_p2' => ' von sz3',
'bl_credits_ll' => 'Lootliste: ',
'bl_credits_bi' => 'Bossbilder: ',
'bl_no_lootlist_credits' => 'keine Lootliste gefunden/ausgew�hlt',
'bl_no_bossimages_credits' => 'keine Credits f�r die BossBilder gefunden',
'bl_loottable_offsets' => '(Offset Modus) Gegenstandsliste:',
'item_qual_-1' => 'alle',

//About page
'bs_about_header' => '�ber die BossSuite',
'bs_additions' => 'Beitr�ge:',
'bs_copyright' => 'Copyright:',
'bs_url_web' => 'Web',
'bs_short_desc' => 'Statistiken zu Instanzen, Bossen und Loot.',
'bs_long_desc' => '�bersicht-/Statistikseiten �ber bezwungene Bosse und den Fortschritt in Zonen, sowie �ber erhaltene Beute.',
'bs_game_not_supported' => 'Leider wird ihr Spiel nicht unterst�tzt.',
'bs_enable_bosscounter' => 'Aktiviere BossCounter',
'bs_enable_note2link' => 'Aktiviere note2link',

'bs_img_style_normal' => 'normal',
'bs_img_style_sepia' => 'sepia',
'bs_img_style_grey' => 'grau',
'bs_style_sname' => 'kurzer Name',
'bs_style_lname' => 'langer Name',
'bs_opt_zlength' => 'W�hle die L�nge des Zonennamens:',
'bs_trigger' => 'Zeichenketten',
'bs_bp_style_options' => 'BossProgress Style Einstellungen',
'bs_bp_style_si' => 'Anfangsbild:',
'bs_bp_style_ei' => 'Endbild:',
'bs_bp_style_ztext' => 'Zonenamen darstellen:',
'bs_bp_style_ztext_none' => 'garnicht',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => 'Text',
'bl_opt_lootlist' => 'Einstellungen f�r Lootlisten, funktionieren nur, wenn eine Lootliste ausgew�hlt wurde',

'bs_updateitem_l_name' => 'Updateseite f�r',
'bs_depmatch' => 'Werte Bosse zonenabh�ngig aus:',
'bs_am_bzone' => 'Zonen/Bosse',

'bs_ec_show_bp' => 'Zeige(BossProgress)',
'bs_ec_show_bc' => 'Zeige(BossCounter)',
'bs_ec_strings' => 'Zeichenketten',

'bs_enable_updchk' => '�berpr�fe ob neue Plugin Versionen existieren',
'bl_opt_en_mv' => 'wowhead Modelviewer aktivieren',
'bs_enable_autoclose' => 'Schlie�e Boss/Zonen-Popup automatisch nach dem speichern',
);

?>
