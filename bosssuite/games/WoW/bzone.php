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

$bzone = array (
  'ulduar_10' => array (
    'leviathan_10',
    'ignis_10',
    'razorscale_10',
    'deconstructor_10',
    'iron_council_10',
    'kologarn_10',  
    'auriaya_10',
    'hodir_10',
    'thorim_10',
    'freya_10',
    'mimiron_10',
    'vezax_10',   
    'yoggsaron_10',
    'algalon_10',
  ),
  'naxx_10' => array (
		'anubrekhan_10',
		'faerlina_10',
		'maexxna_10',
		'noth_10',
		'heigan_10',
		'loatheb_10',
		'patchwerk_10',
		'grobbulus_10',
		'gluth_10',
		'thaddius_10',
		'razuvious_10',
		'gothik_10',
		'horsemen_10',
		'sapphiron_10',
		'kelthuzad_10'		
	),
	'vault_of_archavon_10' => array(
    'archavon_10',
    'emalon_10'
  ),
	'eye_of_eternity_10' => array(
    'malygos_10'
  ),
  'obsidian_sanctum_10' => array(
    'sartharion_0d_10',
    'sartharion_1d_10',
    'sartharion_2d_10',
    'sartharion_3d_10'
  ),
  'ulduar_25' => array (
    'leviathan_25',
    'ignis_25',
    'razorscale_25',
    'deconstructor_25',
    'iron_council_25',
    'kologarn_25',  
    'auriaya_25',
    'hodir_25',
    'thorim_25',
    'freya_25',
    'mimiron_25',
    'vezax_25',   
    'yoggsaron_25',
    'algalon_25',
  ),
  'naxx_25' => array (
		'anubrekhan_25',
		'faerlina_25',
		'maexxna_25',
		'noth_25',
		'heigan_25',
		'loatheb_25',
		'patchwerk_25',
		'grobbulus_25',
		'gluth_25',
		'thaddius_25',
		'razuvious_25',
		'gothik_25',
    'horsemen_25',
		'sapphiron_25',
		'kelthuzad_25'		
	),
	'vault_of_archavon_25' => array(
    'archavon_25',
    'emalon_25'
  ),
	'eye_of_eternity_25' => array(
    'malygos_25'
  ),
  'obsidian_sanctum_25' => array(
    'sartharion_0d_25',
    'sartharion_1d_25',
    'sartharion_2d_25',
    'sartharion_3d_25'
  ),
  'sunwell' => array (
		'kalecgos',
		'brutallus',
		'felmyst',
		'fetwins',
		'muru',
		'kiljaeden'
	),
	'temple' => array (
		'najentus',
		'supremus',
		'akama',
		'gorefiend',
		'essence',
		'bloodboil',
		'shahraz',
		'council',
		'illidan'
	),
	'hyjal' => array (
		'winterchill',
		'anetheron',
		'kazrogal',
		'azgalor',
		'archimonde'
	),
	'eye' => array (
    'alar',
    'vreaver',
    'solarian',
    'kaelthas'
  ),
  'serpent' => array (
		'hydross',
		'karathress',
		'morogrim',
		'leotheras',
		'lurker',
		'vashj'
	),
	'maglair' => array (
		'magtheridon'
	),
  'gruuls' => array (
		'maulgar',
		'gruul'
	),
	'za' => array (
		'nalorakk',
		'akilzon',
		'halazzi',
		'janalai',
		'malacrass',
		'zuljin'
	),
	'kara' => array (
		'attumen',
		'moroes',
		'maiden',
		'opera',
		'curator',
		'illhoof',
		'aran',
		'chess',
		'netherspite',
		'malchezaar',
		'nightbane'
	),
	'outdoor2' => array (
		'doomkazzak',
		'doomwalker'
	),
	'dream' => array (
		'ysondre',
		'taerar',
		'emeriss',
		'lethon'
	),
	'misc' => array (
		'azuregos',
		'kazzak'
	),
	'naxx' => array (
		'anubrekhan',
		'faerlina',
		'maexxna',
		'noth',
		'heigan',
		'loatheb',
		'patchwerk',
		'grobbulus',
		'gluth',
		'thaddius',
		'razuvious',
		'gothik',
		'korthazz',
		'blaumeux',
		'mograine',
		'zeliek',
		'sapphiron',
		'kelthuzad'		
	),
	'aq40' => array (
		'skeram',
		'kri',
		'yauj',
		'vem',
		'sartura',
		'fankriss',
		'huhuran',
		'viscidus',
		'veknilash',
		'veklor',
		'ouro',
		'cthun'
	),
	'bwl' => array (
		'razorgore',
		'vaelastrasz',
		'lashlayer',
		'firemaw',
		'ebonroc',
		'flamegor',
		'chromaggus',
		'nefarian'
	),
	'mc' => array (
		'lucifron',
		'magmadar',
		'gehennas',
		'garr',
		'geddon',
		'shazzrah',
		'sulfuron',
		'golemagg',
		'majordomo',
		'ragnaros'
	),
	'onylair' => array (
		'onyxia'
	),
	'aq20' => array (
		'kurinnaxx',
		'rajaxx',
		'ayamiss',
		'buru',
		'moam',
		'ossirian'
	),
	'zg' => array (
		'mandokir',
		'jindo',
		'gahzranka',
		'grilek',
		'hazzarah',
		'renataki',
		'wushoolay',
		'thekal',
		'arlokk',
		'jeklik',
		'marli',
		'venoxis',
		'hakkar'
	),
);


?>
