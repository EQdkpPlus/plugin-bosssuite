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
  die('Do not access this file directly.');
}

if ( !class_exists( "BSMGS" ) ) {
  class BSMGS{
    var $game;
    var $user_lang;
    var $id_list;
    
    function BSMGS(){
      $this->game = $this->get_current_game();
      $this->user_lang = $this->get_current_language();
    }
    
    function get_current_game(){
      global $eqdkp;
      $game_arr = explode('_', $eqdkp->config['default_game']);
      return $game_arr[0];
    }
      
    function get_current_language(){
      global $user;
      return $user->lang_name;
    }
    
    function game_supported($plugin){
      return file_exists(dirname(__FILE__).'/../games/'.$this->game.'/index.php');
    }
       
    function load_game_specific_language($plugin){
        global $user;
        if (!$this->game_supported($plugin)) {
        	return false;
        }
        $filename = dirname(__FILE__).'/../games/'.$this->game.'/lang/'.$this->user_lang.'/lang_'.$plugin.'.php';
        if (file_exists($filename)){
          require($filename);
        }else{
          require(dirname(__FILE__).'/../games/'.$this->game.'/index.php');
          require(dirname(__FILE__).'/../games/'.$this->game.'/lang/'.$default_lang.'/lang_'.$plugin.'.php');
        }
        $user->lang = array_merge($user->lang, $lang);
    }
    
  }
}

?>
