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
  'xanadu-community'  =>  array('name'  =>  'Xanadu-Community', 'idlist'  =>  'default', 'baseurl'  =>  'http://vanguard.xanadu-community.com/items.php?page=browse&id='),
);

$idlist['default'] = array(
    /******Miscellaneous bosses*****/
    'jagund' => '349',
    'primewarden' => '410',

    /******Ancient Port Warehouse*****/
    'x-77' => '369',
    'x-83' => '370',
    'vicus' => '371',
    'travix' => '372',
    'zaraax' => '373',
    'vahsren' => '401',
    'palpenipe' => '402',
    'athriss' => '403',
    'malazath' => '400',
    'chrykalis' => '404',
    'demetrius' => '405',
    'siliusaurus' => '411',
    'shylosia' => '419',
    'vercel' => '413',
    'x-99' => '420',
    'i-99' => '380',
    'core' => '380', 
    'zaygius' => '416',
    'kotasoth' => '415',
);
?>
