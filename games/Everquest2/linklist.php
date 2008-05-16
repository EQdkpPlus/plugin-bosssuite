<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id: linklist.php 1943 2008-04-24 23:37:28Z sz3 $
 ******************************/

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
} 

$sources = array(
   'raidwiki' => array('name' => 'Raid Wiki', 'idlist' => 'raidwiki', 'baseurl' => 'http://www.raidwiki.org/wiki/index.php/'),
);

$idlist['raidwiki'] = array(

	/******Awakening x2*****/
    'slashing_talon' => 'Ascent_of_the_Awakeningx2#Prophet_of_The_Slashing_Talon_.5B67_Epic_x2.5D',
    'flapping_wing' => 'Ascent_of_the_Awakeningx2#Ancient_of_the_Flapping_Wing_.5B67_Epic_x2.5D',
    'ireth' => 'Ascent_of_the_Awakeningx2#Ireth_The_Cold_.5B70_epicx2.5D', 
    'sharti' => 'Ascent_of_the_Awakeningx2#Sharti_of_The_Flame_.5B70_Epic_x2.5D',
	
		/******Awakening x4*****/
    'slashing_talon' => 'Ascent_of_the_Awakeningx2#Prophet_of_The_Slashing_Talon_.5B67_Epic_x2.5D',
    'flapping_wing' => 'Ascent_of_the_Awakeningx2#Ancient_of_the_Flapping_Wing_.5B67_Epic_x2.5D',
    'ireth' => 'Ascent_of_the_Awakeningx2#Ireth_The_Cold_.5B70_epicx2.5D', 
    'sharti' => 'Ascent_of_the_Awakeningx2#Sharti_of_The_Flame_.5B70_Epic_x2.5D',
    'tarinax' => 'Deathtoll#Tarinax_the_Destroyer',
	'cruor' => 'Deathtoll#Cruor_Alluvium',
	
    /******Cavern of the Crustaceons*****/
    'bonesplitter' => 'Cavern_of_the_Crustaceans', 
 
    
    /******Deathtoll*****/
    'yitzik' => 'Deathtoll#Yitzik_the_Hurler',
    'fitzpitzle' => 'Deathtoll#Fitzpitzle',
    'amorphous' => 'Deathtoll#Amorphous_Drake',
    'zogtark' => 'zogtark',
    'narnulubat' => 'Narn%C3%BBlubat',
    'shadow_eater' => 'Shadow-Eater',
    'thrang' => 'Thr%C3%A2ng',
    'thaurlach' => 'Thaurlach',
    
    /******Halls of the Seeing*****/
    'shadowy_presence' => 'Halls_of_the_Seeing#A_Shadowy_Presence',
    'charged_presence' => 'Halls_of_the_Seeing#A_Charged_Presence',
    'elemental_warder' => 'Halls_of_the_Seeing#The_Elemental_Warder',
    'pain' => 'Halls_of_the_Seeing#Pain',
    'suffering' => 'Halls_of_the_Seeing#Suffering',
    'bloodbeast' => 'Halls_of_the_Seeing#BloodBeast',
    'venekor' => 'Halls_of_the_Seeing#Venekor',
        
    /******Lyceum of Abhorrence*******/
    'essence_of_fear' => 'Lyceum_of_Abhorrence#Essence_of_Fear',
    'gnillaw' => 'Lyceum_of_Abhorrence#Gnillaw_the_Demented',
	'gnorbl' => 'Lyceum_of_Abhorrence#Gnorbl_the_Playful',
	'vilucidae' => 'Lyceum_of_Abhorrence#Vilucidae_the_Priest_of_Thule',
    
    /******Temple of Scale*****/
    'scaleed_enforcer' => 'Temple_of_Scale#The_Scaled_Enforcer',
    'firanvious' => 'Temple_of_Scale#Firanvious',
    'irolesk' => 'Temple_of_Scale#Irolesk',
    'pantrilla' => 'Temple_of_Scale#Pantrilla',
    'vraksakin' => 'Temple_of_Scale#Vraksakin',
    'zantril' => '/Temple_of_Scale#Zantril',
    'harladar' => 'Temple_of_Scale#Harla_Dar',

    /******Lab of Lord Vyemm*****/
    'scaleed_enforcer' => 'The_Laboratory_of_Lord_Vyemm#The_Slavering_Alzid',
    'doomright' => 'The_Laboratory_of_Lord_Vyemm#Doomright_Vakrizt',
    'pardas' => 'The_Laboratory_of_Lord_Vyemm#Pardas_Predd',
    'kinvah' => 'The_Laboratory_of_Lord_Vyemm#Doom_Prophet_Kin.27vah.2C_Doom_Ravager_Ru.27ystad.2C_Doom_Reaver_Cheyak',
	'ruystad' => 'The_Laboratory_of_Lord_Vyemm#Doom_Prophet_Kin.27vah.2C_Doom_Ravager_Ru.27ystad.2C_Doom_Reaver_Cheyak',
	'cheyak' => 'The_Laboratory_of_Lord_Vyemm#Doom_Prophet_Kin.27vah.2C_Doom_Ravager_Ru.27ystad.2C_Doom_Reaver_Cheyak',
    'uncaged_alzid' => 'The_Laboratory_of_Lord_Vyemm#The_Uncaged_Alzid',
	'uustalastus' => 'The_Laboratory_of_Lord_Vyemm#Uustalastus_Xiterrax',
    'doomsworn' => 'The_Laboratory_of_Lord_Vyemm#Doomsworn_Zatrakh',
    'corsolander' => 'The_Laboratory_of_Lord_Vyemm#The_Corsolander',
	'amdaatk' => 'The_Laboratory_of_Lord_Vyemm#Euktrzkai_Amdaatk',
    'vyemm' => 'The_Laboratory_of_Lord_Vyemm#Lord_Vyemm',
    'alzid_prime' => 'The_Laboratory_of_Lord_Vyemm#Alzid_Prime',
	
	    /******Clockwork  Menace Factory*******/
    'round_1' => 'The_Clockwork_Menace_Factory',
	'round_2' => 'The_Clockwork_Menace_Factory',
	'round_3' => 'The_Clockwork_Menace_Factory',
	
	/** Trial of Leadership **/
	'gurgul' => 'Trials_of_Awakened:_Trial_of_Leadership#Gur.27gul_the_Warden',
	'kogurgul' => 'Trials_of_Awakened:_Trial_of_Leadership#Keeper_of_Gur.27gul',
	'kog' => 'Trials_of_Awakened:_Trial_of_Leadership#Keeper_of_the_Gate',
	'final_warden' => 'Trials_of_Awakened:_Trial_of_Leadership#The_Final_Warden',
	'gol' => 'Trials_of_Awakened:_Trial_of_Leadership#The_Guardian_of_Leadership',
	
	/** Xuxlaio's Roost **/
	'xuxlaio' => 'Xux%27Laio%27s_Roost',
	'tatr' => 'Xux%27Laio%27s_Roost',
	'tatf' => 'Xux%27Laio%27s_Roost',
	'crusher' => 'Xux%27Laio%27s_Roost',
	'pantrilla' => 'Xux%27Laio%27s_Roost',
);
?>
