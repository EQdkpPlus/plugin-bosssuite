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
    'nengon' => 'Nengon',
    'guloth' => 'Guloth',
    'balhest' => 'Balhest',
    'shingrinder' => 'Shingrinder',
    'dolvaethor' => 'Dolvaethor',
    'valandil' => 'Valandil',

	/******Helegrod*****/
	'coldbear' => 'Coldbear',
    'servants' => 'The_Four_Hill-men',
    'grisgart' => 'Grisgart',
    'zaudru' => 'Zaudru',
    'storvagun' => 'Storvagun',
    'thorog' => 'Thorog',

    /******Fornost*****/
    'brogadan' => 'Brogadan',
    'megoriath' => 'Megoriath',
    'rhavameldir' => 'Rhavameldir',
    'zhurmat' => 'Zhurmat',
    'zanthrug' => 'Zanthrug',
    'riamul' => 'Riamul',
    'krithmog' => 'Krithmog',
    'einiora' => 'Einiora',
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
    'akrur' => 'Arkur',
    'athpukh' => 'Athpukh',
    'dushkal' => 'Dushk%C3%A2l',
    'gruglok' => 'Gruglok',
    'kughurz' => 'Kugh%C3%BBrz',
    'lagmas' => 'Lagmas',
    'lhugrien' => 'Lhugrien',
    'morthrang' => 'Morthrang',
    'sorkrank' => 'Sorkrank',
    'burzfil' => 'Burzf%C3%AEl',
    'lamkarn' => 'Lamkarn',

    /******Barad Gularan*******/
    'forvengwath' => 'Forvengwath',
    'wisdan' => 'Castellan_Wisd%C3%A1n',
    'udunion' => 'Ud%C3%BAnion',

    /******Carn Dum*****/
    'urro' => 'Urro',
    'barashal' => 'Barashal',
    'helchgam' => 'Helchgam',
    'salvakh' => 'S%C3%A1lvakh',
    'azgoth' => 'Azgoth',
    'tarlug' => 'T%C3%A2rlug',
    'mormoz' => 'Mormoz',
    'rodakhan' => 'Rodakhan',
    'mura' => 'M%C3%BAra',
    'gurthul' => 'G%C3%BArthul',
    'mordirith' => 'Mordirith',
    
    /******The Great Barrow*****/
    'gaerthel_gaerdring' => 'The_Great_Barrow#Bosses',
	'thadur' => 'Thad%C3%BAr_the_Ravager',
	'sambrog' => 'Sambrog',
	
	/******Garth Agarwen*****/
    'temair' => 'Temair_the_Devoted',
	'grimbark' => 'Grimbark',
	'edan_esyld' => 'Edan_and_Esyld',
	'ivar' => 'Ivar_the_Bloodhand',
	'vatar' => 'Vatar',
	'naruhel' => 'Naruhel'
    
    
);
?>