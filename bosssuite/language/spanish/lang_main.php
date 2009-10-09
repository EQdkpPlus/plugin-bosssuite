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

$lang = array(
//General
'bosssuite' => 'BossSuite',
'bosscounter' => 'BossCounter',
'bossbars' => 'Progresi�n',

//Permissions
'bs_pm_conf' => 'configurar',
'bs_pm_offs' => 'offsets',
'bs_bp_view' => 'ver BossProgress',
'bs_bl_view' => 'ver BossLoot',
'bs_bc_view' => 'ver BossCounter',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => 'Ajustes',
'bs_am_offs' => 'Offsets',
'bs_am_cache' => 'Cache',

// admin page
'bs_al_submit' => 'Guardar',
'bs_al_general' => 'Ajustes generales',
'bs_al_delimRNO' => 'Delimitador de nota de banda (Opc.: Expresi�n regular):',
'bs_al_delimRNA' => 'Delimitador de nombre de banda (Opc.: Expresi�n regular):',
'bs_al_tables' => 'Opc.: Lista de prefijo EQdkp (vac�o => s�lo la actual):',
'bs_al_zoneInfo' => '�D�nde (en la entrada de bandas) buscamos info de zona?',
'bs_al_bossInfo' => '�D�nde (en la entrada de bandas) buscamos info de jefes?',
'bs_al_linkInfo' => 'Opciones de enlace:',
'bs_al_name' => 'Nombre',
'bs_al_trigger' => 'Cadenas activadoras',
'bs_ao_rnote' => 'nota de banda',
'bs_ao_rname' => 'nombre de banda',
'bs_al_source' => 'Fuente de los datos:',
'bs_source_db' => 'Base de datos',
'bs_source_offs' => 'offsets',
'bs_source_both' => 'ambos',
'bs_source_cache' => 'cache',
'bs_al_showZone' => 'Selecciona las zonas que deben mostrarse en el plugin:',
'lang' => 'ingl�s',

'dateFormat' => '%m/%d/%Y',
'bs_out_date_format' => 'mm/dd/yy', 
'bs_date_day' => array('start' => 3, 'length' => 2),
'bs_date_month' => array('start' => 0, 'length' => 2), 
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => 'El formato de fecha es: ',
'bs_ol_in' => 'Nombre',
'bs_ol_fd' => 'Primera fecha',
'bs_ol_ld' => '�ltima fecha',
'bs_ol_co' => 'Contador',
'bs_ol_submit' => 'Guardar',

// cache page
'bs_adm_cache_info' => 'Cache: Usando esta funci�n se reducir�n los tiempos de carga en sistemas con muchas abndas',
'bs_adm_cache_refresh' => 'Refrescar cach�',

//BossProgress User Page
'bp_um_link' => 'BossProgress',
'firstkill' => 'Primera muerte: ',
'lastkill' => '�ltima muerte: ',
'firstvisit' => 'Primera visita: ',
'lastvisit' => '�ltima visita: ',
'zonevisitcount' => 'Contador de visitas: ',
'bosskillcount' => 'Contador de muertes: ',
'status' => 'Estado: ',
'never' => 'Nunca',
'all_zones' => 'todas las zonas',
'bs_ol_zoneselect' => 'Selecci�n de zona:',

'opt_general' => 'Ajustes generales',
'opt_dynloc' => '�Ocultar zonas sin jefes muertos?',
'opt_dynboss' => '�Ocultar jefes que nunca han sido derrotados?',
'opt_showzone' => 'Mostrar: ',
'opt_showSB' => '�Mostrar una barra de progresi�n de zona?',
'opt_zhiType' => '�C�mo se muestra el progreso en la imagen de cabecera?',
'zhi_jitter' =>'vieja foto',
'zhi_bw' => 'negro/blanco',
'zhi_none' => 'en absoluto',
'opt_style' => 'Estilo: ',
'bp_style_bp' => 'Por defecto',
'bp_style_bps' => 'Simple',
'bp_style_rp2r' => 'Progreso de banda 2/columnas',
'bp_style_rp3r' => 'Progreso de banda 3/columnas',


'bl_loottable' => 'Puede ser recogido por: ',
'bl_kc_p1' => ' (derrotado ',
'bl_kc_p2' => ' veces)',
'bs_image_not_found' => 'Lo sentimos, no podemos encontrar una imagen para este jefe. Si tienes una, no dudes en colaborar con el proyecto.',
'bl_itemname' => 'Nombre de objeto',
'bl_itemcount' => 'Contador de drops',
'bl_droprate' => 'Probabilidad de obtenerse',
'bl_loottable_offsets' => '(Modo Offset) Lista de objetos:',
'bl_dl' => 'Bot�n obtenido',
'bl_ndl' => 'Bot�n nunca obtenido',
'bl_wl' => 'Bot�n mal/confusamente asignado',

'bl_itemsfound' => 'objetos encontrados',
'item_lang_none' => 'ninguno',

//Admin menu
'bl_opt_minitemqual' => 'M�nima calidad para ser mostrado:',
'bl_opt_itemlang' => 'Seleccionar lista de bot�n',
'bl_opt_ndl' => '�Mostra bot�n que nunca has obtenido?',
'bl_opt_wl' => '�Mostrar bot�n encontrado pero que no pertenece al jefe?',
'bl_opt_is' => '�Activar estad�sticas de objetos para los que nunca se obtuvieron?',
'bl_opt_eyecandy' => '�Activar acordeones llamativos?',
'bc_opt_eyecandy' => '�Activar acordeones llamativos? (�SOLO PLUS 0.5+!)',
'bs_credits_p1' => 'EQDKP BossSuite v',
'bs_credits_p2' => ' por sz3',
'bl_credits_ll' => 'Lista de bot�n: ',
'bl_credits_bi' => 'Im�genes de jefes: ',
'bl_no_lootlist_credits' => 'no se seleccion�/encontr� lista de bot�n',
'bl_no_bossimages_credits' => 'no se han encontrado cr�ditos de imagen de jefes',

'item_qual_-1' => 'todo',

//About page
'bs_about_header' => 'Sobre BossSuite',
'bs_additions' => 'Contribucioens:',
'bs_copyright' => 'Copyright:',
'bs_url_web' => 'Web',
'bs_short_desc' => 'Informaci�n extendida de bot�n/progresi�n.',
'bs_long_desc' => 'Visi�n de los jefes derrotados, el progreso de las zonas y el bot�n conseguido.',
'bs_game_not_supported' => 'Lo sentimos, tu juego no est� soportado.',
'bs_enable_bosscounter' => 'Activar BossCounter',
'bs_enable_note2link' => 'Activar note2link',

'bs_img_style_normal' => 'normal',
'bs_img_style_sepia' => 'sepia',
'bs_img_style_grey' => 'gris',
'bs_style_sname' => 'nombre corto',
'bs_style_lname' => 'nombre largo',
'bs_opt_zlength' => 'Selecciona lontiud del nombre de zona',
'bs_trigger' => 'Activador',
'bs_bp_style_options' => 'Opciones de estilo de BossProgress',
'bs_bp_style_si' => 'Imagen para empezar con:',
'bs_bp_style_ei' => 'Imagen para acabar con:',
'bs_bp_style_ztext' => 'Nombre de zona como ',
'bs_bp_style_ztext_none' => 'nada',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => 'texto',
'bl_opt_lootlist' => 'Opciones de la lista de bot�n, s�lo funciona si hay una seleccionada',

'bs_updateitem_l_name' => 'Actualizar p�gina para',
'bs_depmatch' => 'Igualar jefes dependiendo de la zona:',
'bs_am_bzone' => 'Zonas/Jefes',
'bs_ec_show_bp' => 'Mostrar(BossProgress)',
'bs_ec_show_bc' => 'Mostrar(BossCounter)',
'bs_ec_strings' => 'Activadores',

'bs_enable_updchk' => 'Revisar autom�ticamente nuevas versiones de Plugins',
'bl_opt_en_mv' => 'Activar visualizador de modelos de wowhead',
'bs_enable_autoclose' => 'Cerrar autom�ticamente ventana emergente de jefe/zona tras guardar',
);

?>