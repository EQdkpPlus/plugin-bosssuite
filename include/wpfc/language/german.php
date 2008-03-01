<?php
/******************************
 * EQdkp RaidPlan
 * (c) 2005 - 2007
 * past dev by Urox, A.Stranger
 * continued by Wallenium 
 * ---------------------------
 * $Id: german.php 1358 2008-01-26 11:16:59Z wallenium $
 ******************************/

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

// Initialize the language array if it isn't already
if (empty($lang) || !is_array($lang)){
    $lang = array();
}

// %1\$<type> prevents a possible error in strings caused
//      by another language re-ordering the variables
// $s is a string, $d is an integer, $f is a float

$lang = array_merge($lang, array(
    // Update Check
    'ucc_update_box'									=> 'Neue Version verfügbar',
    'ucc_changelog_url'								=> 'Changelog',
    'ucc_updated_date'								=> 'Veröffentlicht am',
    'ucc_timeformat'									=> 'd.m.Y',
    'ucc_release_level'								=> 'Releaseart',
    'ucc_noserver'               			=> 'Beim Versuch den Updateserver zu kontaktieren trat ein Fehler auf. Entweder dein Host erlaubt keine ausgehenden
                                          Verbindungen, oder es bestehen Netzwerkprobleme. Bitte besuche das EQDKP Plugin Forum um sicherzustellen, dass du die neuste Version am laufen hast.',
    'ucc_update_available_p0'    			=> 'Bitte aktualisiere das installierte ',
    'ucc_update_available_p1'					=> 'Plugin.',
    'ucc_update_available_p2'    			=> 'Deine installierte Version ist',
    'ucc_update_available_p3'    			=> 'und die aktuellste Version ist',
    'ucc_update_url'             			=> 'Zur Downloadseite',
    
    // Plugin Updater Class
    'puc_update_txt'                  => "%1\$s auf %2\$s",
    'puc_update_box'									=> 'Datenbankupdate notwendig',
    'puc_upd_txt1'										=> 'Die vorhandene Datenbank ( Version ',
    'puc_upd_txt2'										=> ' ) passt nicht zur installierten Plugin Version ',
    'puc_upd_txt3'										=> '. Bitte benutzen Sie den Update-Button um die Datenbank automatisch zu aktualisieren',
    'puc_upd_bttn'										=> 'Datenbank aktualisieren',
    'puc_upd_unknown'									=> '[Version unbekannt]',
    'puc_upd_no_file'									=> 'Es wurde keine Updatedatei gefunden',
    'puc_upd_glob_error'							=> 'Beim update ist ein Fehler aufgetreten.',
    'puc_upd_ok'											=> 'Die Datenbank wurde erfolgreich aktualsiert',
    'puc_upd_step'										=> 'Schritt',
    'puc_upd_step_ok'									=> 'Erfolgreich',
    'puc_upd_step_false'							=> 'Fehlgeschlagen',
    'puc_upd_stp_unknwn'							=> '[Unbekannt]',
    
    // Plugin Update Warn Class
    'wpfc_perform_intro'						  => 'Es sind möglicherweise nicht alle Tabellenänderungen beim letzten Update ausgeführt worden. Klicke den "beheben" Link um die Tabelle zu überprüfen. Nötige Ändrerungen werden dann angezeigt. Folgende Plugintabellen sind betroffen:',
    'wpfc_pluginneedupdate'						=> "%1\$s: (Datenbankversion: %2\$s -> Installiert: %3\$s)",
    'wpfc_solve_dbissues'             => 'beheben',
    
    // jQuery
    'wpfc_bttn_ok'                    => 'Ok',
    'wpfc_bttn_cancel'                => 'Abbrechen',
));
?>
