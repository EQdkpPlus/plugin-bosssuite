<?php

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
} 

$sources = array(
  'lotro_wiki' => array('name' => 'LOTRO Wiki', 'idlist' => 'default', 'baseurl' => 'http://www.lotro-wiki.com/index.php/'),
);

$idlist['default'] = array(
    /******Miscellaneous bosses*****/
    'ferndur' => '6109',
    'bogbereth' => 'bogbereth',
    
    /******Helegrod*****/
    'servants' => '12435',
    'grisgart' => '13020',
    'zaudru' => '12017', 
    'storvagun' => '11981',
    'thorog' => 'thorog', 
    
    /******Fornost*****/
    'brogadan' => 'Brogadan', 
    'megoriath' => 'Megoriath', 
    'rhavameldir' => 'Rhavameldir', 
    'zhurmat' => 'Zhurmat',
    'warchief_burzghash' => 'Warchief_B%C3%BArzg%C3%A2sh',
    'remmenaeg' => 'Remmenaeg', 
    
    /******The Rift*****/
    'zurm' => 'zurm',
    'barz' => 'barz',
    'fruz' => 'Fr%C3%BBz',
    'zogtark' => 'zogtark',
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
    'sorkrank' => '14601',
    'burzfil' => '14601',
    'lamkarn' => '14601',
    
    /******Barad Gularan*******/
    'wisdan' => 'Castellan_Wisd%C3%A1n',
    'udonion' => 'Ud%C3%BAnion',
    
    /******Carn Dum*****/
    'urro' => 'Urro',
    'barashal' => '12435',
    'helchgam' => 'Helchgam',
    'salvakh' => 'Salvakh',
    'azgoth' => 'Azgoth',
    'tarlug' => 'Tarlug',
    'mormoz' => 'Mormoz',
    'rodakhan' => 'Rodakhan',
    'mura' => 'Mura',
    'gurthal' => 'Gurthal',
    'mordirith' => 'Mordirith'
);
?>
