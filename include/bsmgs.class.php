<?php

if ( !defined('EQDKP_INC') ){
  die('Do not access this file directly.');
}

if ( !class_exists( "BSMGS" ) ) {
  class BSMGS{
    var $game;
    var $user_lang;
    
    function BSMGS(){
      $this->game = $this->get_current_game();
      $this->user_lang = $this->get_current_language();
    }
    
    function get_current_game(){
      global $eqdkp;
      $game_arr = explode('_', $eqdkp->config['default_game']);
      return $game_arr[0];
    }
    
    function get_bzone(){
    	 require(dirname(__FILE__).'/../games/'.$this->game.'/bossbase/bzone.php');
	     return $bzone;
    }
  
    function get_current_language(){
      global $user;
      return $user->lang_name;
    }
    
    function game_supported($plugin){
      return file_exists(dirname(__FILE__).'/../games/'.$this->game.'/'.$plugin.'/index.php');
    }
       
    function load_game_specific_language($plugin){
        global $user;
        $filename = dirname(__FILE__).'/../games/'.$this->game.'/'.$plugin.'/lang/'.$this->user_lang.'/lang_add.php';
        if (file_exists($filename)){
          require($filename);
        }else{
          require(dirname(__FILE__).'/../games/'.$this->game.'/'.$plugin.'/index.php');
          require(dirname(__FILE__).'/../games/'.$this->game.'/'.$plugin.'/lang/'.$default_lang.'/lang_add.php');
        }
        $user->lang = array_merge($user->lang, $lang);
    }
    
  }
}

?>
