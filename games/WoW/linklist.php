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
  
  /******Eye of Eternity (10)*****/
  'malygos_10' => '28859',
  
  /******The Obsidian Sanctum (10)*****/
  'sartharion_0d_10' => '28860',
  'sartharion_1d_10' => '28860',
  'sartharion_2d_10' => '28860',
  'sartharion_3d_10' => '28860',
  
  /******Ulduar (10)*****/
  'hodir_10' => '99999',
  'thorim_10' => '99999',
  'iron_council_10' => '99999',
  'freya_10' => '99999',
  'ignis_10' => '99999',
  'leviathan_10' => '99999',
  'vezax_10' => '99999',
  'razorscale_10' => '99999',
  'deconstructor_10' => '99999',
  'kologarn_10' => '99999',
  'auriaya_10' => '99999',
  'mimiron_10' => '99999',
  'yoggsaron_10' => '99999',
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
  
  /******Eye of Eternity (25)*****/
  'malygos_25' => '28859',
  
  /******The Obsidian Sanctum (25)*****/
  'sartharion_0d_25' => '28860',
  'sartharion_1d_25' => '28860',
  'sartharion_2d_25' => '28860',
  'sartharion_3d_25' => '28860',
  
  /******Ulduar (25)*****/
  'hodir_25' => '99999',
  'thorim_25' => '99999',
  'iron_council_25' => '99999',
  'freya_25' => '99999',
  'ignis_25' => '99999',
  'leviathan_25' => '99999',
  'vezax_25' => '99999',
  'razorscale_25' => '99999',
  'deconstructor_25' => '99999',
  'kologarn_25' => '99999',
  'auriaya_25' => '99999',
  'mimiron_25' => '99999',
  'yoggsaron_25' => '99999',
  'algalon_25' => '99999',

);

?>
