<?php
 /***************************************
 * EQdkp Plugin Dev Classes Framework Kit
 * HTML Class
 * (c) 2007 by WalleniuM
 * www.wallenium.de
 * ------------------
 * html.class.php
 * $LastChangedDate: 2008-02-09 11:44:57 +0100 (Sa, 09 Feb 2008) $
 *
 * This Class is part of the Plugin 
 * Developer Framework Kit. You can 
 * use this Class in your Plugins,
 * but not remove this Copyright
 * 
 ****************************************/
if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

class wpfHTML {
	var $html_version = '1.5.1'; // Version of this class
	
	function wpfHTML($pluginname){
		$this->pluginname = $pluginname;
	}
	
	function DropDown($name, $list, $selected, $text='', $javascr = '', $class = ''){
		( $text != '' ) ? $dropdown = $text.": " : '';
		$dropdown  .= "<select size='1' ".$javascr." name='".$name."' id='".$name."' class='".$class."'>";
		if($list){
			foreach ($list as $key => $value) {
				$selected_choice = ($key == $selected) ? 'selected' : '';
				$dropdown .= "<option value='".$key."' ".$selected_choice.">".$value."</option>";
			}
		}
		$dropdown .= "</select>";
		return $dropdown;
	}
	
	function MultiSelect($name, $list, $selected, $text='', $javascr = '', $class = '', $size=4){
		( $text != '' ) ? $dropdown = $text.": " : '';
		$dropdown  .= "<select size='".$size."' ".$javascr." name='".$name."[]' class='".$class."' multiple>";
		$selected = explode("|", $selected);
		if($list){
			foreach ($list as $key => $value) {
				$selected_choice = (in_array($key, $selected)) ? 'selected' : '';
				$dropdown .= "<option value='".$key."' ".$selected_choice.">".$value."</option>";
			}
		}
		$dropdown .= "</select>";
		return $dropdown;
	}
	
	function CheckBox($name, $langname, $options, $help='', $value='1'){
			$is_checked = ( $options == 1 ) ? 'checked' : '';
			$check = "&nbsp;&nbsp;".$this->HelpTooltip($help);
			$check .= "<input type='checkbox' name='".$name."' value='".$value."' ".$is_checked." /> ".$langname;
			return $check;
	}
	
	function HelpTooltip($help){
		global $user, $eqdkp_root_path;
		if ($help != ''){
		  $helptt .= '<a '.$this->HTMLTooltip($help, 'rp_tt_help', 'help.png')."><img src='".$eqdkp_root_path."plugins/".$this->pluginname."/images/wpfc/help_small.png' border='0' alt='' align='absmiddle' /></a>";
		}else{
			$helptt = '';
		}
		return $helptt;
	}

	function WarnTooltip($help){
		global $user, $eqdkp_root_path;
		$helptt .= '<a '.$this->HTMLTooltip($help, 'rp_tt_warn', 'warning.png')."><img src='".$eqdkp_root_path."plugins/".$this->pluginname."/images/wpfc/warn_small.png' border='0' alt='' align='absmiddle' /></a>";
		return $helptt;
	}
	
	function SingleDropDownMenu($id, $cssid, $menuitems, $button=''){
	 global $eqdkp_root_path;
	 if($button){
      $dmmenu  = '<div id="'.$id.'" class="ddcolortabs">
                  <ul>
                    <li><a href="#" rel="'.$cssid.'"><span>'.$button.' <img border="0" src="'.$eqdkp_root_path.'plugins/'.$this->pluginname.'/images/menu/down.png"/></span></a></li>
                  </ul>
                  </div>';
    }
    $dmmenu .= '<!--1st drop down menu -->                                                   
                <div id="'.$cssid.'" class="dropmenudiv_a">';
    foreach($menuitems as $key=>$value){
      if($value['perm']){
        $dmimg = ($value['img']) ? '<img src="'.$eqdkp_root_path.'plugins/'.$this->pluginname.'/images/'.$value['img'].'" alt="" />' : '';
        $dmmenu .= '<a href="'.$value['link'].'">'.$dmimg.'&nbsp;&nbsp;'.$value['name'].'</a>';
      }
    }
    $dmmenu .= '</div>';
    $dmmenu .= '<script type="text/javascript">
                  tabdropdown.init("'.$id.'")
                </script>';
    return $dmmenu;
  }
  
  function Overlib($tt){
    $tt = stripslashes($tt);
    $tt = str_replace('"', "'", $tt);
    $tt = str_replace(array("\n", "\r"), '', $tt);
    $tt = addslashes($tt);
    $output = 'onmouseover="return overlib(' . "'" . $tt . "'" . ', MOUSEOFF, HAUTO, VAUTO,  FULLHTML, WRAP);" onmouseout="return nd();"';
    return $output;
  }
  
  function HTMLTooltip($content, $divstyle, $icon=''){
    $output = $this->Overlib($this->TooltipStyle($content, $divstyle, $icon));
    return $output;
  }
  
  function TooltipStyle($content, $divstyle, $icon=''){
    global $eqdkp_root_path;
    $output = "<div class='".$divstyle."' style='display:block'>
                <div class='rptooldiv'>
                <table cellpadding='0' border='0' class='borderless'>
                <tr>";
    if($icon){
      $output .= "<td valign='middle' width='70px' align='center'>
                    <img src='".$eqdkp_root_path."plugins/".$this->pluginname."/images/tooltip/".$icon."' alt=''/>
                  </td>";
    }
    $output .= "<td>
                  ".$content."
                  
                </td>
                </tr>
                </table></div></div>";
    return $output;
  }
}  
?>
