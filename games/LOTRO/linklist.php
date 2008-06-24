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

$sources = array(
  'lotro_wiki' => array('name' => 'LOTRO Wiki', 'idlist' => 'default', 'baseurl' => 'http://www.lotro-wiki.com/index.php/'),
);

$idlist['default'] = array(
    /******Miscellaneous bosses*****/
    'ferndur' => '6109',
    'bogbereth' => 'Bogbereth',

    /*******Annuminas*************/
    'nengon' => '6109',
    'guloth' => 'Guloth',
    'balhest' => 'Balhest',
    'shingrinder' => 'Shingrinder',
    'valandil' => 'Dolvaethor',

	/******Helegrod*****/
    'servants' => '12435',
    'grisgart' => '13020',
    'zaudru' => '12017',
    'storvagun' => '11981',
    'thorog' => 'Thorog',

    /******Fornost*****/
    'brogadan' => 'Brogadan',
    'megoriath' => 'Megoriath',
    'rhavameldir' => 'Rhavameldir',
    'zhurmat' => 'Zhurmat',
    'warchief_burzghash' => 'Warchief_B%C3%BArzg%C3%A2sh',
    'remmenaeg' => 'Remmenaeg',

    /******The Rift*****/
    'zurm' => 'Zurm',
    'barz' => 'Barz',
    'fruz' => 'Fr%C3%BBz',
    'zogtark' => 'Zogtark',
    'narnulubat' => 'Narn%C3%BBlubat',
    'shadow_eater' => 'Shadow-Eater',
    'thrang' => 'Thr%C3%A2ng',
    'thaurlach' => 'Thaurlach',

    /******Urugarth*****/
    'akrur' => '12435',
    'athpukh' => '13020',
    'dushkal' => '11981',
    'gruglok' => '14601',
    'kughurz' => '14601',
    'lagmas' => '14601',
    'lhugrien' => '14601',
    'morthrang' => '14601',
    'sorkrank' => 'Sorkrank',
    'burzfil' => 'Burzf%C3%AEl',
    'lamkarn' => '14601',

    /******Barad Gularan*******/
    'wisdan' => 'Castellan_Wisd%C3%A1n',
    'udunion' => 'Ud%C3%BAnion',

    /******Carn Dum*****/
    'urro' => 'Urro',
    'barashal' => '12435',
    'helchgam' => 'Helchgam',
    'salvakh' => 'S%C3%A1lvakh',
    'azgoth' => 'Azgoth',
    'tarlug' => 'T%C3%A2rlug',
    'mormoz' => 'Mormoz',
    'rodakhan' => 'Rodakhan',
    'mura' => 'M%C3%BAra',
    'gurthul' => 'G%C3%BArthul',
    'mordirith' => 'Mordirith'
);
?>