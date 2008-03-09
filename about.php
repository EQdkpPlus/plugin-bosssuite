<?php
/******************************
 * EQdkp RaidPlan
 * (c) 2005 - 2007
 * past dev by Urox, A.Stranger
 * continued by Wallenium 
 * ---------------------------
 * $Id: about.php 1423 2008-02-07 22:11:09Z wallenium $
 ******************************/

define('EQDKP_INC', true);
define('PLUGIN', 'bosssuite');
$eqdkp_root_path = '../../';
include_once($eqdkp_root_path . 'common.php');
//global $pm;

if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') )
{
	message_die('BossSuite plugin not installed.');
}
  // Build the data in arrays. Thats easier than editing the template file every time.
     $additions = array(
      'Game'	            => ' World of Warcraft',
      'Language files'    => ' Trionix, sz3 and many others',
      'Zone images'       => ' Cattiebrie, Trionix, sz3',
      'Boss images' 	    => ' Cattiebrie, mikedoh, Trionix, sz3 ',
      'Lootlists'		      => ' extracted from Daviesh\' Atlasloot by sz3',
      'Framework'			    => ' Wallenium',
      'Special Thanks'		=> ' everyone I forgot to mention and all the testers',
  );
        
  foreach ($additions as $key => $value){
    $tpl->assign_block_vars('addition_row', array(
        'KEY'    => $key,
        'VALUE' => $value,
      )
    );
  }

$tpl->assign_vars(array(
    'I_ITEM_NAME'               => 'credits/bs4_logo.jpg',
    'D_AUTHOR_CITY'             => 'Germany',
    'D_WEB_URL'                 => 'eqdkp-plus.com',
    'L_URL_WEB'                 => $user->lang['bs_url_web'],
    'L_ADDITONS'                => $user->lang['bs_additions'],
    'L_TXT_DEVTEAM'							=> $user->lang['bs_credits_p2'],
    'L_DEVTEAM'									=> $user->lang['bs_copyright'],
    'L_VERSION'                 => $pm->get_data('bosssuite', 'version'),
    'L_YEARR'										=> '2008',
));


$eqdkp->set_vars(array(
	'page_title'    => 'About BossSuite',
	'template_file' => 'about.html',
	'template_path' => $pm->get_data('bosssuite', 'template_path'),
	'display'       => true)
);
?>
