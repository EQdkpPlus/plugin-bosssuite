<?php

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
} 

$sources = array(
  'allakhazam' => array('name' => 'Alakhazam', 'idlist' => 'default', 'baseurl' => 'http://lotro.allakhazam.com/db/bestiary.html?lotrmob='),
);

$idlist['default'] = array(
    /******Miscellaneous bosses*****/
    'ferndur' => '6109',
    'bogbereth' => '12397',
    
    /******Helegrod*****/
    'servants' => '12435',
    'grisgart' => '13020',
    'zaudru' => '12017', 
    'storvagun' => '11981',
    'thorog' => '14601', 
    
    /******Fornost*****/
    'brogadan' => '12435', 
    'megoriath' => '13020', 
    'rhavameldir' => '12017', 
    'zhurmat' => '11981',
    'remmenaeg' => '14601', 
    
    /******The Rift*****/
    'zurm' => '12435',
    'barz' => '13020',
    'fruz' => '12017',
    'zogtark' => '11981',
    'narnalubat' => '14601',
    'shadow_eater' => '14601',
    'thrang' => '14601',
    'balrog' => '14601',
    
    /******Urugarth*****/
    'akrur' => '12435',
    'athpukh' => '13020',
    'atkpuh' => '12017',
    'dushkal' => '11981',
    'gruglok' => '14601',
    'kughurz' => '14601',
    'lagmas' => '14601',
    'lhugrien' => '14601',
    'morthrang' => '14601',
    
    /******Carn Dum*****/
    'azgoth' => '12435',
    'barashal' => '13020',
    'helchgam' => '12017',
    'bolgrukh' => '11981',
    'mormoz' => '14601',
    'tarbam' => '14601',
    'urro' => '14601',
    'zurtith' => '14601',
);
?>
