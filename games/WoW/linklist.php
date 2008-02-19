<?php

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
  'zuljin' => '99999',
  
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
  'kalecgos' => '99999',
  'brutallus' => '99999',
  'felmyst' => '99999',
  'fetwins' => '99999',
  'muru' => '99999',
  'kiljaeden' => '99999',
);

?>
