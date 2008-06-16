<?php
/******************************
 * EQdkp BossSuite
 * (c) 2006 - 2008
 * created by sz3 
 * ---------------------------
 * $Id$
 ******************************/

define('EQDKP_INC', true);
define('PLUGIN', 'bosssuite');
$eqdkp_root_path = '../../';
include_once($eqdkp_root_path . 'common.php');

if ( !$pm->check(PLUGIN_INSTALLED, 'bosssuite') )
{
	message_die('BossSuite plugin not installed.');
}
// Build the data in arrays. Thats easier than editing the template file every time.
$additions = array(
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

$wow_additions = array(
    'General'           => '© <a href="http://www.blizzard.com/legalfaq.shtml">World of Warcraft and Blizzard Entertainment </a> are trademarks or registered trademarks of Blizzard Entertainment, Inc.  in the U.S. and/or other countries.',
    'Basic support'     => 'Trionix, sz3 and many others',
    'Zone images'       => '™&amp;© by <a href="http://www.blizzard.com/legalfaq.shtml">Blizzard Entertainment</a> and <a href="http://sonsofthestorm.com/">Sons of the Storm</a>.<br />
                            adjusted for the use within the BossSuite by Cattiebrie, Trionix and sz3',
    'Boss images' 	    => 'All characters and designs are ™ & © their respective owners. <br/>
                            captured for the BossSuite from the World of Warcraft game files by Cattiebrie, mikedoh, Trionix, sz3 ',
    'Lootlists'		      => 'extracted from <a href="http://www.daviesh.net/atlasloot_enhanced/">Daviesh\' Atlasloot enhanced</a> by sz3',
);
      
foreach ($wow_additions as $key => $value){
  $tpl->assign_block_vars('wow_addition_row', array(
      'KEY'    => $key,
      'VALUE' => $value,
    )
  );
}

$vsoh_additions = array(
    'Basic support'    => ' Sult',
);
      
foreach ($vsoh_additions as $key => $value){
  $tpl->assign_block_vars('vsoh_addition_row', array(
      'KEY'    => $key,
      'VALUE' => $value,
    )
  );
}

$lotro_additions = array(
  'Basic support'    => 'aeglis, markan',
  'Zone images'      => 'dinatius from "The Watch of Windfola"',
  'Boss images'      => 'Barz, Thaurlach and Thorog are from The Watch of Windfola</br>
                         Zurm, Fruz, Narnulubat, and Thrang are from Precept kinship, EU Laurelin server (via allakhazam)</br>
                         Zaudru is from lotro.allakhazam.com</br>
                         Storvagun is from ingamers.de</br>
                         adjusted for the use within the BossSuite by dinatius',            
);
      
foreach ($lotro_additions as $key => $value){
  $tpl->assign_block_vars('lotro_addition_row', array(
      'KEY'    => $key,
      'VALUE' => $value,
    )
  );
}

$eq2_additions = array(
  'Basic support'    => ' Brinelan, of the Guk server',
);
      
foreach ($eq2_additions as $key => $value){
  $tpl->assign_block_vars('eq2_addition_row', array(
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
    'L_IMAGE_CREDITS'           => 'All images contained in this plugin are copyrighted by their respective creators. This is a fan made plugin and not intended for profit.',
    'L_ADDITONS'                => $user->lang['bs_additions'],
    'L_WOW_ADDITONS'            => $user->lang['bs_additions'] . ' World of Warcraft™',
    'L_VSOH_ADDITONS'           => $user->lang['bs_additions'] . ' Vanguard - Saga of Heroes™',
    'L_LOTRO_ADDITONS'          => $user->lang['bs_additions'] . ' Lord of the rings: online™',
    'L_EQ2_ADDITONS'            => $user->lang['bs_additions'] . ' Everquest II™',
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
