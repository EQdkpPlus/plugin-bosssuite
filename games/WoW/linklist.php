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
  'allakhazam' => array('name' => 'Alakhazam', 'idlist' => 'default', 'baseurl' => 'http://wow.allakhazam.com/db/mob.html?wmob='),
  'buffed' => array('name' => 'buffed.de', 'idlist' => 'default', 'baseurl' => 'http://wow.buffed.de/?n='),
  'wowdb' => array('name' => 'wowDB', 'idlist' => 'default', 'baseurl' => 'http://www.wowdb.com/npc.aspx?id='),
  'wowhead' => array('name' => 'Wowhead', 'idlist' => 'default', 'baseurl' => 'http://www.wowhead.com/?npc='),
);

$modelviewer = array(
  'wowheadmv' => array('name' => 'Wowhead MV',
                       'idlist' => 'wowheadmv',
                       'object' => '<object id="head" width="500" height="500" 
            				                  type="application/x-shockwave-flash" 
                              				data="http://static.wowhead.com/modelviewer/ModelView.swf"
                              				style="visibility: visible;">
                              			<param name="quality" value="high"/>
                              			<param name="allowscriptaccess" value="always"/>
                              			<param name="menu" value="false"/>
                              			<param name="wmode" value="transparent"/>
                              			<param name="flashvars" value="model=%s&contentPath=http://static.wowhead.com/modelviewer/&blur=0"/>				
                              			</object>'
                  ),
);

$idlist['default'] = array(
  /******Miscellaneous bosses*****/
  'azuregos' => '6109', 
  'kazzak' => '12397',
  
  /******Blackwing Lair*****/
  'razorgore' => '12435',
  'vaelastrasz' => '13020',
  'lashlayer' => '12017',
  'firemaw' => '11981',
  'ebonroc' => '14601',
  'flamegor' => '11983',
  'chromaggus' => '14020',
  'nefarian' => '11583',
  
  /******Onyxia*****/
  'onyxia' => '10184',
  
  /******The Emerald Dream*****/
  'ysondre' => '14887',
  'taerar' => '14890',
  'emeriss' => '14889',
  'lethon' => '14888',
  
  /******Molten Core*****/
  'lucifron' => '12118',
  'magmadar' => '11982',
  'gehennas' => '12259',
  'garr' => '12057',
  'geddon' => '12056',
  'shazzrah' => '12264',
  'sulfuron' => '12098',
  'golemagg' => '11988',
  'majordomo' => '12018',
  'ragnaros' => '11502',
  
  /******Zul'Gurub*****/
  'mandokir' => '11382',
  'jindo' => '11380',
  'gahzranka' => '15114',
  'grilek' => '15082',
  'hazzarah' => '15083',
  'renataki' => '15084',
  'wushoolay' => '15085',
  'thekal' => '14509',
  'arlokk' => '14515',
  'jeklik' => '14517',
  'marli' => '14510',
  'venoxis' => '14507',
  'hakkar' => '14834',
  
  /******Ruins of Ahn'Qiraj*****/
  'kurinnaxx' => '15348',
  'rajaxx' => '15341',
  'ayamiss' => '15369',
  'buru' => '15370',
  'moam' => '15340',
  'ossirian' => '15339',
  
  /******Gates of Ahn'Qiraj*****/
  'skeram' => '15263',
  'kri' => '15511',
  'yauj' => '15543',
  'vem' => '15544',
  'sartura' => '15516',
  'fankriss' => '15510',
  'huhuran' => '15509',
  'viscidus' => '15299',
  'veknilash' => '15275',
  'veklor' => '15276',
  'ouro' => '15517',
  'cthun' => '15727',
  
  /******Naxxramas*****/
  'anubrekhan' => '15956',
  'faerlina' => '15953',
  'maexxna' => '15952',
  'noth' => '15954',
  'heigan' => '15936',
  'loatheb' => '16011',
  'patchwerk' => '16028',
  'grobbulus' => '15931',
  'gluth' => '15932',
  'thaddius' => '15928',
  'razuvious' => '16061',
  'gothik' => '16060',
  'korthazz' => '16064',
  'blaumeux' => '16065',
  'mograine' => '16062',
  'zeliek' => '16063',
  'sapphiron' => '15989',
  'kelthuzad' => '15990',
  
  /******Outland Outdoor Bosses*****/
  'doomkazzak' => '18728',
  'doomwalker' => '17711',
  
  /******Magtheridon's Lais******/
  'magtheridon' => '21174',
  
  /******Karazhan*****/
  'attumen' => '16152',
  'moroes' => '15687',
  'maiden' => '16457',
  'curator' => '15691',
  'illhoof' => '15688',
  'aran' => '16524',
  'netherspite' => '15689',
  'malchezaar' => '15690',
  'nightbane' => '17225',
  'chess' => '99999',
  'opera' => '99999',
  
  /******Zul'Aman*****/
  'nalorakk' => '23576',
  'akilzon' => '23574',
  'janalai' => '23578',
  'halazzi' => '23577',
  'malacrass' => '24364',
  'zuljin' => '23863',
  
  /******Gruul's Lair*****/
  'maulgar' => '18831',
  'gruul' => '19044',
  
  /******Serpentshrine Cavern*****/
  'hydross' => '21932',
  'leotheras' => '21215',
  'karathress' => '21214',
  'morogrim' => '21213',
  'lurker' =>  '21217',
  'vashj' => '21212',
  
  /******The Eye*****/
  'alar' => '19514',
  'vreaver' => '19516',
  'solarian' => '18805',
  'kaelthas' => '19622',
  
  /******Battle of Mount Hyjal*****/
  'winterchill' => '17767',
  'anetheron' => '17808',
  'kazrogal' => '17888',
  'azgalor' => '17842',
  'archimonde' => '17968',
  
  /******The Black Temple*****/
  'najentus' => '22887',
  'supremus' => '22898',
  'akama' => '22841',
  'gorefiend' => '22871',
  'essence' => '99999',
  'bloodboil' => '22948',
  'shahraz' => '22947',
  'council' => '99999',
  'illidan' => '22917',
  
  /******Sunwell Plateau*****/
  'kalecgos' => '24850',
  'brutallus' => '24882',
  'felmyst' => '25038',
  'fetwins' => '99999',
  'muru' => '25741',
  'kiljaeden' => '25315',
  
  /******Naxxramas (10)*****/
  'anubrekhan_10' => '15956',
  'faerlina_10' => '15953',
  'maexxna_10' => '15952',
  'noth_10' => '15954',
  'heigan_10' => '15936',
  'loatheb_10' => '16011',
  'patchwerk_10' => '16028',
  'grobbulus_10' => '15931',
  'gluth_10' => '15932',
  'thaddius_10' => '15928',
  'razuvious_10' => '16061',
  'gothik_10' => '16060',
  'horsemen_10' => '99999',
  'sapphiron_10' => '15989',
  'kelthuzad_10' => '15990',
  
  /******Vault of Archavon (10)*****/
  'archavon_10' => '31125',
  'emalon_10' => '33993',
  'koralon_10' => '99999',
  
  /******Eye of Eternity (10)*****/
  'malygos_10' => '28859',
  
  /******The Obsidian Sanctum (10)*****/
  'sartharion_0d_10' => '28860',
  'sartharion_1d_10' => '28860',
  'sartharion_2d_10' => '28860',
  'sartharion_3d_10' => '28860',
  
  /******Ulduar (10)*****/
  'hodir_10' => '32845',
  'hodir_10_hm' => '32845',
  'thorim_10' => '32865',
  'thorim_10_hm' => '32865',
  'iron_council_10' => '32857',
  'iron_council_10_hm' => '32857',
  'freya_10' => '32906',
  'freya_10_hm' => '32906',
  'ignis_10' => '33118',
  'leviathan_10' => '33113',
  'leviathan_10_hm' => '33113',
  'vezax_10' => '33271',
  'vezax_10_hm' => '33271',
  'razorscale_10' => '33186',
  'deconstructor_10' => '33293',
  'deconstructor_10_hm' => '33293',
  'kologarn_10' => '32930',
  'auriaya_10' => '33515',
  'auriaya_10_hm' => '33515',
  'mimiron_10' => '33412',
  'mimiron_10_hm' => '33412',
  'yoggsaron_10' => '33288',
  'yoggsaron_10_hm' => '33288',
  'algalon_10' => '99999',
    
  /******Naxxramas (25)*****/
  'anubrekhan_25' => '15956',
  'faerlina_25' => '15953',
  'maexxna_25' => '15952',
  'noth_25' => '15954',
  'heigan_25' => '15936',
  'loatheb_25' => '16011',
  'patchwerk_25' => '16028',
  'grobbulus_25' => '15931',
  'gluth_25' => '15932',
  'thaddius_25' => '15928',
  'razuvious_25' => '16061',
  'gothik_25' => '16060',
  'horsemen_25' => '99999',
  'sapphiron_25' => '15989',
  'kelthuzad_25' => '15990',
  
  /******Vault of Archavon (25)*****/
  'archavon_25' => '31125',
  'emalon_25' => '99999',
  'koralon_25' => '99999',
  
  /******Eye of Eternity (25)*****/
  'malygos_25' => '28859',
  
  /******The Obsidian Sanctum (25)*****/
  'sartharion_0d_25' => '28860',
  'sartharion_1d_25' => '28860',
  'sartharion_2d_25' => '28860',
  'sartharion_3d_25' => '28860',
  
  /******Ulduar (25)*****/
  'hodir_25' => '32845',
  'hodir_25_hm' => '32845',
  'thorim_25' => '32865',
  'thorim_25_hm' => '32865',
  'iron_council_25' => '32857',
  'iron_council_25_hm' => '32857',
  'freya_25' => '32906',
  'freya_25_hm' => '32906',
  'ignis_25' => '33118',
  'leviathan_25' => '33113',
  'leviathan_25_hm' => '33113',
  'vezax_25' => '33271',
  'vezax_25_hm' => '33271',
  'razorscale_25' => '33186',
  'deconstructor_25' => '33293',
  'deconstructor_25_hm' => '33293',
  'kologarn_25' => '32930',
  'auriaya_25' => '33515',
  'auriaya_25_hm' => '33515',
  'mimiron_25' => '33412',
  'mimiron_25_hm' => '33412',
  'yoggsaron_25' => '33288',
  'yoggsaron_25_hm' => '33288',
  'algalon_25' => '99999',

  /******Trial of the Crusader (10)*****/
  'beasts_of_northrend_10' => '99999',
  'lord_jaraxxus_10' => '34780',
  'faction_champions_10' => '99999',
  'twin_valkyr_10' => '99999',
  'anubarak_10' => '34564',
  
  /******Trial of the Grand Crusader (10)*****/
  'beasts_of_northrend_10_hm' => '99999',
  'lord_jaraxxus_10_hm' => '34780',
  'faction_champions_10_hm' => '99999',
  'twin_valkyr_10_hm' => '99999',
  'anubarak_10_hm' => '34564',
  'tribute_s_10_hm' => '99999',
  'tribute_ms_10_hm' => '99999',
  'tribute_ins_10_hm' => '99999',
  
  /******Trial of the Crusader (25)*****/
  'beasts_of_northrend_25' => '99999',
  'lord_jaraxxus_25' => '99999',
  'faction_champions_25' => '99999',
  'twin_valkyr_25' => '99999',
  'anubarak_25' => '34564',
  
  /******Trial of the Grand Crusader (25)*****/
  'beasts_of_northrend_25_hm' => '99999',
  'lord_jaraxxus_25_hm' => '34780',
  'faction_champions_25_hm' => '99999',
  'twin_valkyr_25_hm' => '99999',
  'anubarak_25_hm' => '34564',
  'tribute_s_25_hm' => '99999',
  'tribute_ms_25_hm' => '99999',
  'tribute_ins_25_hm' => '99999',
  
  /******Icecrown Citadel (10)*****/  
  'marrowgar_10' => '36612',
  'marrowgar_10_hm' => '36612',
  'deathwhisper_10' => '36855',
  'deathwhisper_10_hm' => '36855',    
  'gunship_battle_10' => '36839',
  'gunship_battle_10_hm' => '36839',
  'deathbringer_10' => '37813',
  'deathbringer_10_hm' => '37813',
  'festergut_10' => '36626',
  'festergut_10_hm' => '36626',
  'rotface_10' => '36627',
  'rotface_10_hm' => '36627',
  'putricide_10' => '36678',
  'putricide_10_hm' => '36678',
  'blood_prince_council_10' => '37972',
  'blood_prince_council_10_hm' => '37972',
  'lanathel_10' => '38004',
  'lanathel_10_hm' => '38004',
  'dreamwalker_rescue_10' => '36789',
  'dreamwalker_rescue_10_hm' => '36789',
  'sindragosa_10' => '37755',
  'sindragosa_10_hm' => '37755',
  'lichking_10' => '29983',
  'lichking_10_hm' => '29983',
  
    /******Icecrown Citadel (25)*****/  
  'marrowgar_25' => '36612',
  'marrowgar_25_hm' => '36612',
  'deathwhisper_25' => '36855',
  'deathwhisper_25_hm' => '36855',    
  'gunship_battle_25' => '36839',
  'gunship_battle_25_hm' => '36839',
  'deathbringer_25' => '37813',
  'deathbringer_25_hm' => '37813',
  'festergut_25' => '36626',
  'festergut_25_hm' => '36626',
  'rotface_25' => '36627',
  'rotface_25_hm' => '36627',
  'putricide_25' => '36678',
  'putricide_25_hm' => '36678',
  'blood_prince_council_25' => '37972',
  'blood_prince_council_25_hm' => '37972',
  'lanathel_25' => '38004',
  'lanathel_25_hm' => '38004',
  'dreamwalker_rescue_25' => '36789',
  'dreamwalker_rescue_25_hm' => '36789',
  'sindragosa_25' => '37755',
  'sindragosa_25_hm' => '37755',
  'lichking_25' => '29983',
  'lichking_25_hm' => '29983',
  
  /******Ruby Sanctum (10)*****/
  'halion_10' => '39863',
  'halion_10_hm' => '39863',

	/******Ruby Sanctum (25)*****/
  'halion_25' => '39863',
  'halion_25_hm' => '39863',
  
  	/******Cataclysm*****/
	'magmaw_10' => '41570',
	'omitron_defense_system_10' => '42180',
	'maloriak_10' => '41378',
	'atramedes_10' => '41442',
	'chimaeron_10' => '43296',
	'nefarian_10' => '41376',

	'magmaw_25' => '41570',
	'omitron_defense_system_25' => '42180',
	'maloriak_25' => '41378',
	'atramedes_25' => '41442',
	'chimaeron_25' => '43296',
	'nefarian_25' => '41376',

	'valiona_theralion_10' => '45992',
	'wyrmbreaker_10' => '44600',
	'twilight_council_10' => '43735',
	'chogall_10' => '43324',
	'sinestra_10' => '45213',

	'valiona_theralion_25' => '45992',
	'wyrmbreaker_25' => '44600',
	'twilight_council_25' => '43735',
	'chogall_25' => '43324',
	'sinestra_25' => '45213',

	'conclave_of_wind_10' => '45871',
	'alakir_10' => '46753',

	'conclave_of_wind_25' => '45871',
	'alakir_25' => '46753',

	'argaloth_10' => '47120',
	'occuthar_10' => '52363',
	'alizabal_10' => '55869',
	
	'argaloth_25' => '47120',
	'occuthar_25' => '52363',
	'alizabal_25' => '55869',
	
	'shannox_10' => '53691',
	'bethtilac_10' => '52498',
	'lord_rhyolith_10' => '52558',
	'alysrazar_10' => '52530',
	'baloroc_10' => '53494',
	'majordomo_staghelm_10' => '52571',
	'ragnaros_fl_10' => '52409',

	'shannox_10_hc' => '53691',
	'bethtilac_10_hc' => '52498',
	'lord_rhyolith_10_hc' => '52558',
	'alysrazar_10_hc' => '52530',
	'baloroc_10_hc' => '53494',
	'majordomo_staghelm_10_hc' => '52571',
	'ragnaros_fl_10_hc' => '52409',
	
	'shannox_25' => '53691',
	'bethtilac_25' => '52498',
	'lord_rhyolith_25' => '52558',
	'alysrazar_25' => '52530',
	'baloroc_25' => '53494',
	'majordomo_staghelm_25' => '52571',
	'ragnaros_fl_25' => '52409',
	
	'shannox_25_hc' => '53691',
	'bethtilac_25_hc' => '52498',
	'lord_rhyolith_25_hc' => '52558',
	'alysrazar_25_hc' => '52530',
	'baloroc_25_hc' => '53494',
	'majordomo_staghelm_25_hc' => '52571',
	'ragnaros_fl_25_hc' => '52409',
	
	'morchok_10' => '55265',
	'zonozz_10' => '55308',
	'yorsahj_10' => '55312',
	'hagara_10' => '55689',
	'ultraxion_10' => '55294',
	'blackhorn_10' => '56427',
	'spine_of_deathwing_10' => '',
	'madness_of_deathwing_10' => '',
	
	'morchok_10_hc' => '55265',
	'zonozz_10_hc' => '55308',
	'yorsahj_10_hc' => '55312',
	'hagara_10_hc' => '55689',
	'ultraxion_10_hc' => '55294',
	'blackhorn_10_hc' => '56427',
	'spine_of_deathwing_10_hc' => '',
	'madness_of_deathwing_10_hc' => '',

	'morchok_25' => '55265',
	'zonozz_25' => '55308',
	'yorsahj_25' => '55312',
	'hagara_25' => '55689',
	'ultraxion_25' => '55294',
	'blackhorn_25' => '56427',
	'spine_of_deathwing_25' => '',
	'madness_of_deathwing_25' => '',
	
	'morchok_25_hc' => '55265',
	'zonozz_25_hc' => '55308',
	'yorsahj_25_hc' => '55312',
	'hagara_25_hc' => '55689',
	'ultraxion_25_hc' => '55294',
	'blackhorn_25_hc' => '56427',
	'spine_of_deathwing_25_hc' => '',
	'madness_of_deathwing_25_hc' => '',
);

$idlist['wolids'] = array(
	37955	=> 'lanathel',
);

$idlist['wowheadmv'] = array(
  /******Miscellaneous bosses*****/
  'azuregos' => '11460&modelType=8', 
  'kazzak' => '12449&modelType=8',
  
  /******Blackwing Lair*****/
  'razorgore' => '10115&modelType=8',
  'vaelastrasz' => '13992&modelType=8',
  'lashlayer' => '14308&modelType=8',
  'firemaw' => '6377&modelType=8',
  'ebonroc' => '6377&modelType=8',
  'flamegor' => '6377&modelType=8',
  'chromaggus' => '14367&modelType=8',
  'nefarian' => '11380&modelType=8',
  
  /******Onyxia*****/
  'onyxia' => '8570&modelType=8',
  
  /******The Emerald Dream*****/
  'ysondre' => '15364&modelType=8',
  'taerar' => '15363&modelType=8',
  'emeriss' => '15366&modelType=8',
  'lethon' => '15365&modelType=8',
  
  /******Molten Core*****/
  'lucifron' => '13031&modelType=8',
  'magmadar' => '10193&modelType=8',
  'gehennas' => '13030&modelType=8',
  'garr' => '12110&modelType=8',
  'geddon' => '12129&modelType=8',
  'shazzrah' => '13032&modelType=8',
  'sulfuron' => '13030&modelType=8',
  'golemagg' => '11986&modelType=8',
  'majordomo' => '12029&modelType=8',
  'ragnaros' => '11121&modelType=8',
  
  /******Zul'Gurub*****/
  'mandokir' => '11288&modelType=32',
  'jindo' => '1311&modelType=32',
  'gahzranka' => '15288&modelType=8',
  'grilek' => '8390&modelType=8',
  'hazzarah' => '15267&modelType=32',
  'renataki' => '15268&modelType=32',
  'wushoolay' => '15269&modelType=32',
  'thekal' => '15216&modelType=32',
  'arlokk' => '15218&modelType=32',
  'jeklik' => '15219&modelType=32',
  'marli' => '15220&modelType=32',
  'venoxis' => '15217&modelType=32',
  'hakkar' => '15295&modelType=8',
  
  /******Ruins of Ahn'Qiraj*****/
  'kurinnaxx' => '15742&modelType=8',
  'rajaxx' => '15376&modelType=8',
  'ayamiss' => '15431&modelType=8',
  'buru' => '15654&modelType=8',
  'moam' => '15392&modelType=8',
  'ossirian' => '15432&modelType=8',
  
  /******Gates of Ahn'Qiraj*****/
  'skeram' => '15345&modelType=8',
  'kri' => '15656&modelType=8',
  'yauj' => '15657&modelType=8',
  'vem' => '15658&modelType=8',
  'sartura' => '15583&modelType=8',
  'fankriss' => '15743&modelType=8',
  'huhuran' => '15739&modelType=8',
  'viscidus' => '15686&modelType=8',
  'veknilash' => '15761&modelType=8',
  'veklor' => '15778&modelType=8',
  'ouro' => '15509&modelType=8',
  'cthun' => '15787&modelType=8',
  
  /******Naxxramas*****/
  'anubrekhan' => '15931&modelType=8',
  'faerlina' => '15940&modelType=32',
  'maexxna' => '15928&modelType=8',
  'noth' => '16590&modelType=32',
  'heigan' => '16309&modelType=8',
  'loatheb' => '6110&modelType=8',
  'patchwerk' => '16174&modelType=8',
  'grobbulus' => '16035&modelType=8',
  'gluth' => '16064&modelType=8',
  'thaddius' => '16137&modelType=8',
  'razuvious' => '16582&modelType=32',
  'gothik' => '16279&modelType=8',
  'horsemen' => '',
  'sapphiron' => '16033&modelType=8',
  'kelthuzad' => '15945&modelType=8',
  
  /******Outland Outdoor Bosses*****/
  'doomkazzak' => '17887&modelType=8',
  'doomwalker' => '21435&modelType=8',
  
  /******Magtheridon's Lais******/
  'magtheridon' => '20127&modelType=8',
  
  /******Karazhan*****/
  'attumen' => '16040&modelType=8',
  'moroes' => '16540&modelType=32',
  'maiden' => '16198&modelType=8',
  'curator' => '16958&modelType=8',
  'illhoof' => '11343&modelType=8',
  'aran' => '16621&modelType=32',
  'netherspite' => '15363&modelType=8',
  'malchezaar' => '19274&modelType=8',
  'nightbane' => '18062&modelType=8',
  'chess' => '',
  'opera' => '',
  
  /******Zul'Aman*****/
  'nalorakk' => '21631&modelType=8',
  'akilzon' => '21630&modelType=8',
  'janalai' => '21633&modelType=8',
  'halazzi' => '21632&modelType=8',
  'malacrass' => '22332&modelType=32',
  'zuljin' => '21899&modelType=8',
  
  /******Gruul's Lair*****/
  'maulgar' => '18649&modelType=8',
  'gruul' => '18698&modelType=8',
  
  /******Serpentshrine Cavern*****/
  'hydross' => '0609&modelType=8',
  'leotheras' => '20514&modelType=32',
  'karathress' => '20662&modelType=32',
  'morogrim' => '20739&modelType=8',
  'lurker' =>  '20216&modelType=8',
  'vashj' => '20748&modelType=8',
  
  /******The Eye*****/
  'alar' => '18945&modelType=8',
  'vreaver' => '18951&modelType=8',
  'solarian' => '18239&modelType=32',
  'kaelthas' => '20023&modelType=8',
  
  /******Battle of Mount Hyjal*****/
  'winterchill' => '17444&modelType=8',
  'anetheron' => '21069&modelType=8',
  'kazrogal' => '17886&modelType=8',
  'azgalor' => '18526&modelType=8',
  'archimonde' => '20939&modelType=8',
  
  /******The Black Temple*****/
  'najentus' => '21174&modelType=8',
  'supremus' => '21145&modelType=8',
  'akama' => '21357&modelType=8',
  'gorefiend' => '21254&modelType=32',
  'essence' => '99999',
  'bloodboil' => '21443&modelType=8',
  'shahraz' => '21252&modelType=8',
  'council' => '99999',
  'illidan' => '21135&modelType=8',
  
  /******Sunwell Plateau*****/
  'kalecgos' => '23345&modelType=8',
  'brutallus' => '22711&modelType=8',
  'felmyst' => '22838&modelType=8',
  'fetwins' => '99999',
  'muru' => '23404&modelType=8',
  'kiljaeden' => '23200&modelType=8',
  
  /******Naxxramas (10)*****/
  'anubrekhan_10' => '15931&modelType=8',
  'faerlina_10' => '15940&modelType=32',
  'maexxna_10' => '15928&modelType=8',
  'noth_10' => '16590&modelType=32',
  'heigan_10' => '16309&modelType=8',
  'loatheb_10' => '6110&modelType=8',
  'patchwerk_10' => '16174&modelType=8',
  'grobbulus_10' => '16035&modelType=8',
  'gluth_10' => '16064&modelType=8',
  'thaddius_10' => '16137&modelType=8',
  'razuvious_10' => '16582&modelType=32',
  'gothik_10' => '16279&modelType=8',
  'horsemen_10' => '',
  'sapphiron_10' => '16033&modelType=8',
  'kelthuzad_10' => '15945&modelType=8',
  
  /******Vault of Archavon (10)*****/
  'archavon_10' => '26967&modelType=8',
  'emalon_10' => '27108&modelType=8',
  'koralon_10' => '29185&modelType=8',
  'toravon_10' => '28743&modelType=8',
  
  /******Eye of Eternity (10)*****/
  'malygos_10' => '26752&modelType=8',
  
  /******The Obsidian Sanctum (10)*****/
  'sartharion_0d_10' => '27035&modelType=8',
  'sartharion_1d_10' => '27035&modelType=8',
  'sartharion_2d_10' => '27035&modelType=8',
  'sartharion_3d_10' => '27035&modelType=8',
  
  /******Ulduar (10)*****/
  'hodir_10' => '28743&modelType=8',
  'hodir_10_hm' => '28743&modelType=8',
  'thorim_10' => '28977&modelType=8',
  'thorim_10_hm' => '28977&modelType=8',
  'iron_council_10' => '28344&modelType=8',
  'iron_council_10_hm' => '28344&modelType=8',
  'freya_10' => '28777&modelType=8',
  'freya_10_hm' => '28777&modelType=8',
  'ignis_10' => '29185&modelType=8',
  'leviathan_10' => '28875&modelType=8',
  'leviathan_10_hm' => '28875&modelType=8',
  'vezax_10' => '28548&modelType=8',
  'vezax_10_hm' => '28548&modelType=8',
  'razorscale_10' => '28787&modelType=8',
  'deconstructor_10' => '28611&modelType=8',
  'deconstructor_10_hm' => '28611&modelType=8',
  'kologarn_10' => '28638&modelType=8',
  'auriaya_10' => '28651&modelType=8',
  'mimiron_10' => '29001&modelType=8',
  'mimiron_10_hm' => '29001&modelType=8',
  'yoggsaron_10' => '28817&modelType=8',
  'yoggsaron_10_hm' => '28817&modelType=8',
  'algalon_10' => '28641&modelType=8',
  
  /******Naxxramas (25)*****/
  'anubrekhan_25' => '15931&modelType=8',
  'faerlina_25' => '15940&modelType=32',
  'maexxna_25' => '15928&modelType=8',
  'noth_25' => '16590&modelType=32',
  'heigan_25' => '16309&modelType=8',
  'loatheb_25' => '6110&modelType=8',
  'patchwerk_25' => '16174&modelType=8',
  'grobbulus_25' => '16035&modelType=8',
  'gluth_25' => '16064&modelType=8',
  'thaddius_25' => '16137&modelType=8',
  'razuvious_25' => '16582&modelType=32',
  'gothik_25' => '16279&modelType=8',
  'horsemen_25' => '',
  'sapphiron_25' => '16033&modelType=8',
  'kelthuzad_25' => '15945&modelType=8',
  
  /******Vault of Archavon (25)*****/
  'archavon_25' => '26967&modelType=8',
  'emalon_25' => '27108&modelType=8',
  'koralon_25' => '29185&modelType=8',
  'toravon_25' => '28743&modelType=8',
  
  /******Eye of Eternity (25)*****/
  'malygos_25' => '26752&modelType=8',
  
  /******The Obsidian Sanctum (25)*****/
  'sartharion_0d_25' => '27035&modelType=8',
  'sartharion_1d_25' => '27035&modelType=8',
  'sartharion_2d_25' => '27035&modelType=8',
  'sartharion_3d_25' => '27035&modelType=8',
  
  /******Ulduar (25)*****/
  'hodir_25' => '28743&modelType=8',
  'hodir_25_hm' => '28743&modelType=8',
  'thorim_25' => '28977&modelType=8',
  'thorim_25_hm' => '28977&modelType=8',
  'iron_council_25' => '28344&modelType=8',
  'iron_council_25_hm' => '28344&modelType=8',
  'freya_25' => '28777&modelType=8',
  'freya_25_hm' => '28777&modelType=8',
  'ignis_25' => '29185&modelType=8',
  'leviathan_25' => '28875&modelType=8',
  'leviathan_25_hm' => '28875&modelType=8',
  'vezax_25' => '28548&modelType=8',
  'vezax_25_hm' => '28548&modelType=8',
  'razorscale_25' => '28787&modelType=8',
  'deconstructor_25' => '28611&modelType=8',
  'deconstructor_25_hm' => '28611&modelType=8',
  'kologarn_25' => '28638&modelType=8',
  'auriaya_25' => '28651&modelType=8',
  'mimiron_25' => '29001&modelType=8',
  'mimiron_25_hm' => '29001&modelType=8',
  'yoggsaron_25' => '28817&modelType=8',
  'yoggsaron_25_hm' => '28817&modelType=8',
  'algalon_25' => '28641&modelType=8',
  
  /******Trial of the Crusader (10)*****/
  'beasts_of_northrend_10' => '',
  'lord_jaraxxus_10' => '',
  'faction_champions_10' => '',
  'twin_valkyr_10' => '',
  'anubarak_10' => '',
  
  /******Trial of the Grand Crusader (10)*****/
  'beasts_of_northrend_10_hm' => '',
  'lord_jaraxxus_10_hm' => '',
  'faction_champions_10_hm' => '',
  'twin_valkyr_10_hm' => '',
  'anubarak_10_hm' => '',
  'tribute_s_10_hm' => '',
  'tribute_ms_10_hm' => '',
  'tribute_ins_10_hm' => '',
  
  /******Trial of the Crusader (25)*****/
  'beasts_of_northrend_25' => '',
  'lord_jaraxxus_25' => '',
  'faction_champions_25' => '',
  'twin_valkyr_25' => '',
  'anubarak_25' => '',
  
  /******Trial of the Grand Crusader (25)*****/
  'beasts_of_northrend_25_hm' => '',
  'lord_jaraxxus_25_hm' => '',
  'faction_champions_25_hm' => '',
  'twin_valkyr_25_hm' => '',
  'anubarak_25_hm' => '',
  'tribute_s_25_hm' => '',
  'tribute_ms_25_hm' => '',
  'tribute_ins_25_hm' => '',

  /******Icecrown Citadel (10)*****/  
  'marrowgar_10' => '31119&modelType=8',
  'marrowgar_10_hm' => '31119&modelType=8',
  'deathwhisper_10' => '30893&modelType=8',
  'deathwhisper_10_hm' => '30893&modelType=8',    
  'gunship_battle_10' => '',
  'gunship_battle_10_hm' => '',
  'deathbringer_10' => '30790&modelType=32',
  'deathbringer_10_hm' => '30790&modelType=32',
  'festergut_10' => '31001&modelType=8',
  'festergut_10_hm' => '31001&modelType=8',
  'rotface_10' => '31005&modelType=8',
  'rotface_10_hm' => '31005&modelType=8',
  'putricide_10' => '30993&modelType=8',
  'putricide_10_hm' => '30993&modelType=8',
  'blood_prince_council_10' => '',
  'blood_prince_council_10_hm' => '',
  'lanathel_10' => '31093&modelType=8',
  'lanathel_10_hm' => '31093&modelType=8',
  'dreamwalker_rescue_10' => '30318&modelType=8',
  'dreamwalker_rescue_10_hm' => '30318&modelType=8',
  'sindragosa_10' => '27971&modelType=8',
  'sindragosa_10_hm' => '27971&modelType=8',
  'lichking_10' => '24213&modelType=8',
  'lichking_10_hm' => '24213&modelType=8',
  
  /******Icecrown Citadel (25)*****/  
  'marrowgar_25' => '31119&modelType=8',
  'marrowgar_25_hm' => '31119&modelType=8',
  'deathwhisper_25' => '30893&modelType=8',
  'deathwhisper_25_hm' => '30893&modelType=8',    
  'gunship_battle_25' => '',
  'gunship_battle_25_hm' => '',
  'deathbringer_25' => '30790&modelType=32',
  'deathbringer_25_hm' => '30790&modelType=32',
  'festergut_25' => '31001&modelType=8',
  'festergut_25_hm' => '31001&modelType=8',
  'rotface_25' => '31005&modelType=8',
  'rotface_25_hm' => '31005&modelType=8',
  'putricide_25' => '30993&modelType=8',
  'putricide_25_hm' => '30993&modelType=8',
  'blood_prince_council_25' => '',
  'blood_prince_council_25_hm' => '',
  'lanathel_25' => '31093&modelType=8',
  'lanathel_25_hm' => '31093&modelType=8',
  'dreamwalker_rescue_25' => '30318&modelType=8',
  'dreamwalker_rescue_25_hm' => '30318&modelType=8',
  'sindragosa_25' => '27971&modelType=8',
  'sindragosa_25_hm' => '27971&modelType=8',
  'lichking_25' => '24213&modelType=8',
  'lichking_25_hm' => '24213&modelType=8',
  
  /******Ruby Sanctum (10)*****/
  'halion_10' => '31952&modelType=8',
  'halion_10_hm' => '31952&modelType=8',

	/******Ruby Sanctum (25)*****/
  'halion_25' => '31952&modelType=8',
  'halion_25_hm' => '31952&modelType=8',

	/******Cataclysm*****/
	'magmaw_10' => '32679&modelType=8',
	'omitron_defense_system_10' => '32684&modelType=8',
	'maloriak_10' => '33186&modelType=8',
	'atramedes_10' => '34547&modelType=8',
	'chimaeron_10' => '33308&modelType=8',
	'nefarian_10' => '32716&modelType=8',

	'magmaw_25' => '32679&modelType=8',
	'omitron_defense_system_25' => '32684&modelType=8',
	'maloriak_25' => '33186&modelType=8',
	'atramedes_25' => '34547&modelType=8',
	'chimaeron_25' => '33308&modelType=8',
	'nefarian_25' => '32716&modelType=8',

	'valiona_theralion_10' => '34812&modelType=8',
	'wyrmbreaker_10' => '34816&modelType=8',
	'twilight_council_10' => '34825&modelType=8',
	'chogall_10' => '34576&modelType=8',

	'valiona_theralion_25' => '34812&modelType=8',
	'wyrmbreaker_25' => '34816&modelType=8',
	'twilight_council_25' => '34825&modelType=8',
	'chogall_25' => '34576&modelType=8',

	'conclave_of_wind_10' => '35232&modelType=8',
	'alakir_10' => '35248&modelType=8',

	'conclave_of_wind_25' => '35232&modelType=8',
	'alakir_25' => '35248&modelType=8',

	'argaloth_10' => '35426&modelType=8',
	'occuthar_10' => '37876&modelType=8',
	'alizabal_10' => '21252&modelType=8',
	
	'argaloth_25' => '35426&modelType=8',
	'occuthar_25' => '37876&modelType=8',
	'alizabal_25' => '21252&modelType=8',
	
		/******Cataclysm Heroic*****/
	'magmaw_10_hc' => '32679&modelType=8',
	'omitron_defense_system_10_hc' => '32684&modelType=8',
	'maloriak_10_hc' => '33186&modelType=8',
	'atramedes_10_hc' => '34547&modelType=8',
	'chimaeron_10_hc' => '33308&modelType=8',
	'nefarian_10_hc' => '32716&modelType=8',

	'magmaw_25_hc' => '32679&modelType=8',
	'omitron_defense_system_25_hc' => '32684&modelType=8',
	'maloriak_25_hc' => '33186&modelType=8',
	'atramedes_25_hc' => '34547&modelType=8',
	'chimaeron_25_hc' => '33308&modelType=8',
	'nefarian_25_hc' => '32716&modelType=8',

	'valiona_theralion_10_hc' => '34812&modelType=8',
	'wyrmbreaker_10_hc' => '34816&modelType=8',
	'twilight_council_10_hc' => '34825&modelType=8',
	'chogall_10_hc' => '34576&modelType=8',
	'sinestra_10_hc' => '21401&modelType=8',

	'valiona_theralion_25_hc' => '34812&modelType=8',
	'wyrmbreaker_25_hc' => '34816&modelType=8',
	'twilight_council_25_hc' => '34825&modelType=8',
	'chogall_25_hc' => '34576&modelType=8',
	'sinestra_25_hc' => '21401&modelType=8',

	'conclave_of_wind_10_hc' => '35232&modelType=8',
	'alakir_10_hc' => '35248&modelType=8',

	'conclave_of_wind_25_hc' => '35232&modelType=8',
	'alakir_25_hc' => '35248&modelType=8',

	'shannox_10' => '38448&modelType=8',
	'bethtilac_10' => '38227&modelType=8',
	'lord_rhyolith_10' => '38594&modelType=8',
	'alysrazar_10' => '38446&modelType=8',
	'baloroc_10' => '38621&modelType=8',
	'majordomo_staghelm_10' => '37953&modelType=32',
	'ragnaros_fl_10' => '37875&modelType=8',
	
	'shannox_25' => '38448&modelType=8',
	'bethtilac_25' => '38227&modelType=8',
	'lord_rhyolith_25' => '38594&modelType=8',
	'alysrazar_25' => '38446&modelType=8',
	'baloroc_25' => '38621&modelType=8',
	'majordomo_staghelm_25' => '37953&modelType=32',
	'ragnaros_fl_25' => '37875&modelType=8',

	'shannox_10_hc' => '38448&modelType=8',
	'bethtilac_10_hc' => '38227&modelType=8',
	'lord_rhyolith_10_hc' => '38594&modelType=8',
	'alysrazar_10_hc' => '38446&modelType=8',
	'baloroc_10_hc' => '38621&modelType=8',
	'majordomo_staghelm_10_hc' => '37953&modelType=32',
	'ragnaros_fl_10_hc' => '37875&modelType=8',
	
	'shannox_25_hc' => '38448&modelType=8',
	'bethtilac_25_hc' => '38227&modelType=8',
	'lord_rhyolith_25_hc' => '38594&modelType=8',
	'alysrazar_25_hc' => '38446&modelType=8',
	'baloroc_25_hc' => '38621&modelType=8',
	'majordomo_staghelm_25_hc' => '37953&modelType=32',
	'ragnaros_fl_25_hc' => '37875&modelType=8',
	
	'morchok_10' => '39094&modelType=8',
	'zonozz_10' => '39138&modelType=8',
	'yorsahj_10' => '39101&modelType=8',
	'hagara_10' => '39318&modelType=32',
	'ultraxion_10' => '39099&modelType=8',
	'blackhorn_10' => '39399&modelType=32',
	'spine_of_deathwing_10' => '35943&modelType=8',
	'madness_of_deathwing_10' => '39355&modelType=8',
	
	'morchok_10_hc' => '39094&modelType=8',
	'zonozz_10_hc' => '39138&modelType=8',
	'yorsahj_10_hc' => '39101&modelType=8',
	'hagara_10_hc' => '39318&modelType=32',
	'ultraxion_10_hc' => '39099&modelType=8',
	'blackhorn_10_hc' => '39399&modelType=32',
	'spine_of_deathwing_10_hc' => '35943&modelType=8',
	'madness_of_deathwing_10_hc' => '39355&modelType=8',
	
	'morchok_25' => '39094&modelType=8',
	'zonozz_25' => '39138&modelType=8',
	'yorsahj_25' => '39101&modelType=8',
	'hagara_25' => '39318&modelType=32',
	'ultraxion_25' => '39099&modelType=8',
	'blackhorn_25' => '39399&modelType=32',
	'spine_of_deathwing_25' => '35943&modelType=8',
	'madness_of_deathwing_25' => '39355&modelType=8',
	
	'morchok_25_hc' => '39094&modelType=8',
	'zonozz_25_hc' => '39138&modelType=8',
	'yorsahj_25_hc' => '39101&modelType=8',
	'hagara_25_hc' => '39318&modelType=32',
	'ultraxion_25_hc' => '39099&modelType=8',
	'blackhorn_25_hc' => '39399&modelType=32',
	'spine_of_deathwing_25_hc' => '35943&modelType=8',
	'madness_of_deathwing_25_hc' => '39355&modelType=8',
);
?>
