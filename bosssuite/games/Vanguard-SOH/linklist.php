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
