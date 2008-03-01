<?php
 /***************************************
 * EQdkp Plugin Dev Classes Framework Kit
 * Init Language & Classes 
 * (c) 2007 by WalleniuM
 * www.wallenium.de
 * ------------------
 * init.pwc.php
 * $LastChangedDate: 2008-01-03 15:58:25 +0100 (Do, 03 Jan 2008) $
 *
 * This File is part of the Plugin 
 * Developer Framework Kit. You can 
 * use this Class in your Plugins,
 * but not remove this Copyright
 * 
 ****************************************/
 
if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}
 
class InitWPFC {
  function InitWPFC($path_to_wpfc){
    global $user;
    $this->path_to_wpfc = $path_to_wpfc;
    $lang_file = $this->path_to_wpfc.'language/'.$user->lang_name.'.php';
    if ( file_exists($lang_file) ){
      include_once($lang_file);
      $user->lang = ( @is_array($lang) ) ? array_merge($user->lang, $lang) : $user->lang;
    }
    include_once($this->path_to_wpfc.'db.class.php');
    include_once($this->path_to_wpfc.'html.class.php');
  }
  
  function InitAdmin(){
    include_once($this->path_to_wpfc.'updater.class.php');
    include_once($this->path_to_wpfc.'/updcheck.class.php');
  }
  
  function InitUpgradeWarn($pluginlist, $pluginconfigs){
    include_once($this->path_to_wpfc.'updatewarn.class.php');
    $uwarn = new PluginUpdWarn($pluginlist, $pluginconfigs);
    return $uwarn->OutputHTML();
  }
}
?>
