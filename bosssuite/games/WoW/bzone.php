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
	'blackwing_descent_10_hc' => array(
		'magmaw_10_hc',
		'omnotron_defense_system_10_hc',
		'maloriak_10_hc',
		'atramedes_10_hc',
		'chimaeron_10_hc',
		'nefarian_10_hc',
	),
	'blackwing_descent_25_hc' => array(
		'magmaw_25_hc',
		'omnotron_defense_system_25_hc',
		'maloriak_25_hc',
		'atramedes_25_hc',
		'chimaeron_25_hc',
		'nefarian_25_hc',
	),
	'bastion_of_twilight_10_hc' => array(
		'valiona_theralion_10_hc',
		'wyrmbreaker_10_hc',
		'twilight_council_10_hc',
		'chogall_10_hc',
		'sinestra_10_hc',
	),
	'bastion_of_twilight_25_hc' => array(
		'valiona_theralion_25_hc',
		'wyrmbreaker_25_hc',
		'twilight_council_25_hc',
		'chogall_25_hc',
		'sinestra_25_hc',
	),
	'throne_of_four_winds_10_hc' => array(
		'conclave_of_wind_10_hc',
		'alakir_10_hc',
	),
	'throne_of_four_winds_25_hc' => array(
		'conclave_of_wind_25_hc',
		'alakir_25_hc',
	),
	'blackwing_descent_10' => array(
		'magmaw_10',
		'omnotron_defense_system_10',
		'maloriak_10',
		'atramedes_10',
		'chimaeron_10',
		'nefarian_10',
	),
	'blackwing_descent_25' => array(
		'magmaw_25',
		'omnotron_defense_system_25',
		'maloriak_25',
		'atramedes_25',
		'chimaeron_25',
		'nefarian_25',
	),
	'bastion_of_twilight_10' => array(
		'valiona_theralion_10',
		'wyrmbreaker_10',
		'twilight_council_10',
		'chogall_10',
	),
	'bastion_of_twilight_25' => array(
		'valiona_theralion_25',
		'wyrmbreaker_25',
		'twilight_council_25',
		'chogall_25',
	),
	'throne_of_four_winds_10' => array(
		'conclave_of_wind_10',
		'alakir_10',
	),
	'throne_of_four_winds_25' => array(
		'conclave_of_wind_25',
		'alakir_25',
	),
	'baradin_hold_10' => array(
		'argaloth_10',
	),
	'baradin_hold_25' => array(
		'argaloth_25',
	),
	'ruby_sanctum_10' => array(
	  'halion_10',
	  'halion_10_hm',
	),
	'ruby_sanctum_25' => array(
		'halion_25',
		'halion_25_hm',
	),
  'icecrown_10' => array(
    'marrowgar_10',
    'marrowgar_10_hm',
    'deathwhisper_10',
    'deathwhisper_10_hm',    
    'gunship_battle_10',
    'gunship_battle_10_hm',
    'deathbringer_10',
    'deathbringer_10_hm',
    'festergut_10',
    'festergut_10_hm',
    'rotface_10',
    'rotface_10_hm',
    'putricide_10',
    'putricide_10_hm',
    'blood_prince_council_10',
    'blood_prince_council_10_hm',
    'lanathel_10',
    'lanathel_10_hm',
    'dreamwalker_rescue_10',
    'dreamwalker_rescue_10_hm',
    'sindragosa_10',
    'sindragosa_10_hm',
    'lichking_10',
    'lichking_10_hm',
  ),
  'icecrown_25' => array(
    'marrowgar_25',
    'marrowgar_25_hm',
    'deathwhisper_25',
    'deathwhisper_25_hm',    
    'gunship_battle_25',
    'gunship_battle_25_hm',
    'deathbringer_25',
    'deathbringer_25_hm',
    'festergut_25',
    'festergut_25_hm',
    'rotface_25',
    'rotface_25_hm',
    'putricide_25',
    'putricide_25_hm',
    'blood_prince_council_25',
    'blood_prince_council_25_hm',
    'lanathel_25',
    'lanathel_25_hm',
    'dreamwalker_rescue_25',
    'dreamwalker_rescue_25_hm',
    'sindragosa_25',
    'sindragosa_25_hm',
    'lichking_25',
    'lichking_25_hm',
  ),
  'onylair_10' => array(
    'onyxia_10'
  ),
  'onylair_25' => array(
    'onyxia_25'
  ),
  'totc_10' => array(
    'beasts_of_northrend_10',
    'lord_jaraxxus_10',
    'faction_champions_10',
    'twin_valkyr_10',
    'anubarak_10'
  ),
  'totgc_10' => array(
    'beasts_of_northrend_10_hm',
    'lord_jaraxxus_10_hm',
    'faction_champions_10_hm',
    'twin_valkyr_10_hm',
    'anubarak_10_hm',
    'tribute_s_10_hm',
    'tribute_ms_10_hm',
    'tribute_ins_10_hm'
  ),
  'totc_25' => array(
    'beasts_of_northrend_25',
    'lord_jaraxxus_25',
    'faction_champions_25',
    'twin_valkyr_25',
    'anubarak_25'
  ),
  'totgc_25' => array(
    'beasts_of_northrend_25_hm',
    'lord_jaraxxus_25_hm',
    'faction_champions_25_hm',
    'twin_valkyr_25_hm',
    'anubarak_25_hm',
    'tribute_s_25_hm',
    'tribute_ms_25_hm',
    'tribute_ins_25_hm'
  ),
  'ulduar_10' => array (
    'leviathan_10',
    'leviathan_10_hm',
    'ignis_10',
    'razorscale_10',
    'deconstructor_10',
    'deconstructor_10_hm',
    'iron_council_10',
    'iron_council_10_hm',
    'kologarn_10',  
    'auriaya_10',
    'hodir_10',
    'hodir_10_hm',
    'thorim_10',
    'thorim_10_hm',
    'freya_10',
    'freya_10_hm',
    'mimiron_10',
    'mimiron_10_hm',
    'vezax_10',
    'vezax_10_hm',     
    'yoggsaron_10',
    'yoggsaron_10_hm',
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
    'emalon_10',
    'koralon_10',
    'toravon_10',
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
    'leviathan_25_hm',
    'ignis_25',
    'razorscale_25',
    'deconstructor_25',
    'deconstructor_25_hm',
    'iron_council_25',
    'iron_council_25_hm',
    'kologarn_25',  
    'auriaya_25',
    'hodir_25',
    'hodir_25_hm',
    'thorim_25',
    'thorim_25_hm',
    'freya_25',
    'freya_25_hm',
    'mimiron_25',
    'mimiron_25_hm',
    'vezax_25',
    'vezax_25_hm',     
    'yoggsaron_25',
    'yoggsaron_25_hm',
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
    'emalon_25',
    'koralon_25',
    'toravon_25',
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
