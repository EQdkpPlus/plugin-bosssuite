<?php
/******************************
 * EQdkp RaidPlan
 * (c) 2005 - 2007
 * past dev by Urox, A.Stranger
 * continued by Wallenium 
 * ---------------------------
 * $Id: english.php 1358 2008-01-26 11:16:59Z wallenium $
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
    'ucc_update_box'                  => 'New Version available',
    'ucc_changelog_url'								=> 'Changelog',
    'ucc_updated_date'								=> 'Released at',
    'ucc_timeformat'									=> 'm/d/Y',
    'ucc_release_level'               => 'release',
    'ucc_noserver'                    => 'An error occurred while trying to contact the update server, either your host does not allow outbound connections
                                          or the error was caused by a network problem.
                                          Please visit the eqdkp-plugin-forum to make sure you are running the latest plugin version.',
    'ucc_update_available_p0'         =>  'Please update the installed ',
    'ucc_update_available_p1'         =>  'Plugin.',
    'ucc_update_available_p2'         =>  'Your current version is',
    'ucc_update_available_p3'         =>  'and the latest version is',
    'ucc_update_url'                  =>  'To the Download Page',

    // Plugin Updater Class
    'puc_update_txt'                  =>  "%1\$s to %2\$s",
    'puc_update_box'                  =>  'Database update required',
    'puc_upd_txt1'                    =>  'The existing Database ( Version ',
    'puc_upd_txt2'                    =>  ' ) does not fit to the installed Plugin Version ',
    'puc_upd_txt3'                    =>  '. Please use the Update Button to update the Database automatically',
    'puc_upd_bttn'                    =>  'Update Database',
    'puc_upd_unknown'                 =>  '[unknown version]',
    'puc_upd_no_file'                 =>  'Update file is missing',
    'puc_upd_glob_error'              =>  'An error occured during the update process.',
    'puc_upd_ok'                      =>  'The update of the Database was successful',
    'puc_upd_step'                    =>  'Step',
    'puc_upd_step_ok'                 =>  'Successfull',
    'puc_upd_step_false'              =>  'Failed',
    'puc_upd_stp_unknwn'              =>  '[unknown]',

    // Plugin Update Warn Class
    'wpfc_perform_intro'						  => 'There might be still some database changes left to do. Click the solve button and see if database changes are left to do. Following plugin tables are out of date:',
    'wpfc_pluginneedupdate'						=> "%1\$s: (version of database: %2\$s -> installed version: %3\$s)",
    'wpfc_solve_dbissues'             => 'solve',
    
    // jQuery
    'wpfc_bttn_ok'                    => 'Ok',
    'wpfc_bttn_cancel'                => 'Cancel',
));
?>
