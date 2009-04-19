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

//Permissions
'bs_pm_conf' => 'Конфигурация',
'bs_pm_offs' => 'offsets',
'bs_bp_view' => 'Просмотр PvE прогресса',
'bs_bl_view' => 'Просмотр трофеев',
'bs_bc_view' => 'Просмотр цен',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => 'Настройки',
'bs_am_offs' => 'Offsets',
'bs_am_cache' => 'Кэш',

// admin page
'bs_al_submit' => 'Сохранить',
'bs_al_general' => 'Главные настройки',
'bs_al_delimRNO' => 'Рейд заметка delimiter (Opt.: Regular Expression):',
'bs_al_delimRNA' => 'Название Рейда delimiter (Opt.: Regular Expression):',
'bs_al_tables' => 'Opt.: EQdkp список prefix(ов) (пусто => только текущий prefix):',
'bs_al_zoneInfo' => 'Где (in the Рейд entry) to look for zone infos?',
'bs_al_bossInfo' => 'Где (in the Рейд entry) to look for boss infos?',
'bs_al_linkInfo' => 'Link опции:',
'bs_al_name' => 'Имя',
'bs_al_trigger' => 'Строка триггера(ов)',
'bs_ao_rnote' => 'Заметка Рейда',
'bs_ao_rname' => 'Название Рейда',
'bs_al_source' => 'Исходные данные:',
'bs_source_db' => 'База данных',
'bs_source_offs' => 'offsets',
'bs_source_both' => 'Оба',
'bs_source_cache' => 'Кэш',
'bs_al_showZone' => 'Выберите зоны, которые будут показаны в плагине:',
'lang' => 'english',

'dateFormat' => '%m/%d/%Y',
'bs_out_date_format' => 'mm/dd/yy',
'bs_date_day' => array('start' => 3, 'length' => 2),
'bs_date_month' => array('start' => 0, 'length' => 2),
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => 'Формат даты: ',
'bs_ol_in' => 'Имя',
'bs_ol_fd' => 'Первая дата',
'bs_ol_ld' => 'Последняя дата',
'bs_ol_co' => 'Счетчик',
'bs_ol_submit' => 'Сохранить',

// cache page
'bs_adm_cache_info' => 'КЭШ: Используя функцию кэш, должно сократиться время загрузки на DKP системах с многочисленными Рейдами',
'bs_adm_cache_refresh' => 'Обновить кэш',

//BossProgress User Page
'bp_um_link' => 'PvE Прогресс',
'firstkill' => 'Первое убийство: ',
'lastkill' => 'Последнее убийство: ',
'firstvisit' => 'Первый визит: ',
'lastvisit' => 'Последний визит: ',
'zonevisitcount' => 'Количество визитов: ',
'bosskillcount' => 'Количество убийств: ',
'status' => 'Статус: ',
'never' => 'Никогда',
'all_zones' => 'Все зоны',
'bs_ol_zoneselect' => 'Выбор зоны:',

'opt_general' => 'Главные настройки',
'opt_dynloc' => 'Скрыть зоны, где не было убийств боссов?',
'opt_dynboss' => 'Скрыть ни разу не убитых боссов?',
'opt_showzone' => 'Показать: ',
'opt_showSB' => 'Показывать полосу прогресса зоны?',
'opt_zhiType' => 'Как отображается процесс на главной странице?',
'zhi_jitter' =>'Старое фото',
'zhi_bw' => 'Черный/Белый',
'zhi_none' => 'Нисколько',
'opt_style' => 'Стиль: ',
'bp_style_bp' => 'Босс прогресс стандартный',
'bp_style_bps' => 'Босс прогресс простой',
'bp_style_rp2r' => 'Прогресс Рейда 2/ряд',
'bp_style_rp3r' => 'Прогресс Рейда 3/ряд',


'bl_loottable' => 'Список трофеев: ',
'bl_kc_p1' => ' убит ',
'bl_kc_p2' => ' раз(а)',
'bs_image_not_found' => 'Извините, изображение босса не было найдено. Если вы нашли одно, не стесняйтесь вносить свой вклад в проект.',
'bl_itemname' => 'Название предмета',
'bl_itemcount' => 'Значение шанса выпадения',
'bl_droprate' => 'Шанс выпадения',
'bl_loottable_offsets' => '(Offset mode) Список предметов:',
'bl_dl' => 'Выпавшие трофеи',
'bl_ndl' => 'Ни разу не выпавшие трофеи',
'bl_wl' => 'Wrong assigned/unclear loot',

'bl_itemsfound' => 'Предметов найдено',
'item_lang_none' => 'Ни один',

//Admin menu
'bl_opt_minitemqual' => 'Показывать предметы по качеству:',
'bl_opt_itemlang' => 'Выбрать язык',
'bl_opt_ndl' => 'Показ трофеев ни разу не выпавших вам?',
'bl_opt_wl' => 'Показ трофеев, не принадлежащих боссу?',
'bl_opt_is' => 'Включить статистику предметов для ни разу не выпавших трофеев?',
'bl_opt_eyecandy' => 'Включить eye-candy (аккордеоны)?',
'bc_opt_eyecandy' => 'Включить eye-candy (аккордеоны)? (Только на PLUS 0.5+ !)',
'bs_credits_p1' => 'EQDKP BossSuite версия',
'bs_credits_p2' => ' by sz3',
'bl_credits_ll' => 'Список трофеев: ',
'bl_credits_bi' => 'Изображения боссов: ',
'bl_no_lootlist_credits' => 'Список предметов не выбран/найден',
'bl_no_bossimages_credits' => 'Главные изображения боссов не найдены',

'item_qual_-1' => 'Все',

//About page
'bs_about_header' => 'О BossSuite',
'bs_additions' => 'Пожертвование:',
'bs_copyright' => 'Авторы:',
'bs_url_web' => 'Web',
'bs_short_desc' => 'Расширенные трофеи/информация о прогрессе.',
'bs_game_not_supported' => 'Извините, ваша игра не поддерживается.',
'bs_enable_bosscounter' => 'Включить BossCounter',
'bs_enable_note2link' => 'Включить note2link',

'bs_img_style_normal' => 'Нормально',
'bs_img_style_sepia' => 'Сепия',
'bs_img_style_grey' => 'Серый',
'bs_style_sname' => 'Короткое название',
'bs_style_lname' => 'Длинное название',
'bs_opt_zlength' => 'Выбранное название зоны длинное',
'bs_trigger' => 'Триггер',
'bs_bp_style_options' => 'BossProgress опции стиля',
'bs_bp_style_si' => 'Image to start with:',
'bs_bp_style_ei' => 'Image to end with:',
'bs_bp_style_ztext' => 'Название зоны ',
'bs_bp_style_ztext_none' => 'none',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => 'Текст',
'bl_opt_lootlist' => 'Опции списка трофеев, работает, только если выбран список трофеев',

'bs_updateitem_l_name' => 'Обновить страницу',

'bs_enable_updchk' => 'Enable check for new Plugin Versions',
'bl_opt_en_mv' => 'Enable wowhead modelviewer',
);

?>
