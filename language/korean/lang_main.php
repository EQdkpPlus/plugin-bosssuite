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
'bosscounter' => '보스카운터',

//Permissions
'bs_pm_conf' => '구성',
'bs_pm_offs' => '오프셋',
'bs_bp_view' => '보스진행 보기',
'bs_bl_view' => '보스전리품 보기',
'bs_bc_view' => '보스카운터 보기',

//Admin menu
'bs_am_title' => 'BossSuite',
'bs_am_conf' => '설정',
'bs_am_offs' => '오프셋',
'bs_am_cache' => '캐쉬',

// admin page
'bs_al_submit' => '저장',
'bs_al_general' => '일반 설정',
'bs_al_delimRNO' => '레이드노트 구분자 (옵션.:정규식):',
'bs_al_delimRNA' => '레이드이름 구분자 (옵션.:정규식):',
'bs_al_tables' => '옵션.: EQdkp 접두어목록 (빈칸 => 현재 접두어만 사용):',
'bs_al_zoneInfo' => 'Where (in the raid entry) to look for zone infos?',
'bs_al_bossInfo' => 'Where (in the raid entry) to look for boss infos?',
'bs_al_linkInfo' => '링크 옵션:',
'bs_al_name' => '이름',
'bs_al_trigger' => 'String 트리거',
'bs_ao_rnote' => '레이드노트',
'bs_ao_rname' => '레이드이름',
'bs_al_source' => '데이터 원본:',
'bs_source_db' => '데이터베이스',
'bs_source_offs' => '오프셋',
'bs_source_both' => 'both',
'bs_source_cache' => '캐쉬',
'bs_al_showZone' => '플러그인에 들어갔을때 보여질 지역을 선택:',
'lang' => 'english',

'dateFormat' => '%m/%d/%Y',
'bs_out_date_format' => 'mm/dd/yy', 
'bs_date_day' => array('start' => 3, 'length' => 2),
'bs_date_month' => array('start' => 0, 'length' => 2), 
'bs_date_year' => array('start' => 6, 'length' => 4),

// offset page
'bs_ol_dateFormat' => '날짜 형식: ',
'bs_ol_in' => '이름',
'bs_ol_fd' => '시작 날짜',
'bs_ol_ld' => '종료 날짜',
'bs_ol_co' => '카운터',
'bs_ol_submit' => '저장',

// cache page
'bs_adm_cache_info' => '캐쉬: 캐쉬 기능을 사용하여 다수 레이드를 가진 DKP 시스템에서 로딩시간을 줄일 수 있습니다.',
'bs_adm_cache_refresh' => '캐쉬 새로고침',

//BossProgress User Page
'bp_um_link' => '보스진행',
'firstkill' => '첫 처치: ',
'lastkill' => '마지막 처치: ',
'firstvisit' => '첫 트라이: ',
'lastvisit' => '마지막 트라이: ',
'zonevisitcount' => '트라이 횟수: ',
'bosskillcount' => '처치 횟수: ',
'status' => '상태: ',
'never' => '없음',
'all_zones' => '모든 지역',
'bs_ol_zoneselect' => '지역 선택:',

'opt_general' => '일반 설정',
'opt_dynloc' => '보스 킬이 없는 지역을 숨기겠습니까?',
'opt_dynboss' => '킬한적 없는 보스를 숨기겠습니까?',
'opt_showzone' => '보기: ',
'opt_showSB' => '지역 진행 표시줄을 보이겠습니까?',
'opt_zhiType' => '헤더 이미지에서 보일 진행 선택?',
'zhi_jitter' =>'old photo',
'zhi_bw' => 'black/white',
'zhi_none' => 'not at all',
'opt_style' => '스타일: ',
'bp_style_bp' => 'BossProgress default',
'bp_style_bps' => 'BossProgress simple',
'bp_style_rp2r' => 'Raidprogress 2/row',
'bp_style_rp3r' => 'Raidprogress 3/row',


'bl_loottable' => '전리품목록: ',
'bl_kc_p1' => ' (killed ',
'bl_kc_p2' => ' times)',
'bs_image_not_found' => '해당 보스의 이미지를 찾을 수 없습니다. 이미지를 가지고 있다면 자유롭게 제공해 주세요.',
'bl_itemname' => '아이템 이름',
'bl_itemcount' => '획득 횟수',
'bl_droprate' => '획득율',
'bl_loottable_offsets' => '(Offset mode) 아이템 목록:',
'bl_dl' => '전리품 드랍',
'bl_ndl' => '전리품 드랍되지 않음',
'bl_wl' => 'Wrong assigned/unclear loot',

'bl_itemsfound' => '아이템 찾음',
'item_lang_none' => '없음',

//Admin menu
'bl_opt_minitemqual' => '보여질 최소 아이템 등급:',
'bl_opt_itemlang' => '전리품목록 선택',
'bl_opt_ndl' => '전혀 드랍되지 않은 전리품도 보기?',
'bl_opt_wl' => '일반몹 전리품도 보기?',
'bl_opt_is' => '드랍된 적 없는 전리품 아이템스탯 허용?',
'bl_opt_eyecandy' => 'Enable eye-candy (accordions)?',
'bc_opt_eyecandy' => 'Enable eye-candy (accordions)? (PLUS 0.5+ ONLY!)',
'bs_credits_p1' => 'EQDKP BossSuite v',
'bs_credits_p2' => ' by sz3',
'bl_credits_ll' => '전리품 목록: ',
'bl_credits_bi' => '보스 이미지: ',
'bl_no_lootlist_credits' => '선택되거나 확인된 전리품목록이 없음',
'bl_no_bossimages_credits' => '확인된 보스 이미지 credits 이 없음',

'item_qual_-1' => '모두',

//About page
'bs_about_header' => 'About the BossSuite',
'bs_additions' => 'Contributions:',
'bs_copyright' => 'Copyright:',
'bs_url_web' => 'Web',
'bs_short_desc' => '확장된 전리품/진행 정보.',
'bs_long_desc' => '처치된 보스와 던전의 진행 사항, 전리품에 대한 개략적 정보를 보입니다.',
'bs_game_not_supported' => '죄송합니다, 이 게임은 지원하지 않습니다.',
'bs_enable_bosscounter' => '보스카운터 허용',
'bs_enable_note2link' => 'note2link 허용',

'bs_img_style_normal' => 'normal',
'bs_img_style_sepia' => 'sepia',
'bs_img_style_grey' => 'grey',
'bs_style_sname' => 'short name',
'bs_style_lname' => 'long name',
'bs_opt_zlength' => '지역 이름 길이 선택',
'bs_trigger' => '트리거',
'bs_bp_style_options' => '보스진행 스타일 옵션',
'bs_bp_style_si' => 'Image to start with:',
'bs_bp_style_ei' => 'Image to end with:',
'bs_bp_style_ztext' => '지역이름 ',
'bs_bp_style_ztext_none' => '없음',
'bs_bp_style_ztext_png' => 'png',
'bs_bp_style_ztext_text' => 'text',
'bl_opt_lootlist' => '전리품목록 옵션, 전리품목록이 허용될 때만 가능',

'bs_updateitem_l_name' => 'Updatepage for',
'bs_depmatch' => 'Match bosses depending on the zone match:',
'bs_am_bzone' => '지역/보스',
'bs_ec_show_bp' => '보기(보스진행)',
'bs_ec_show_bc' => '보기(보스카운터)',
'bs_ec_strings' => '트리거',

'bs_enable_updchk' => '새 플러그인 버전 확인',
'bl_opt_en_mv' => 'wowhead modelviewer 허용',
'bs_enable_autoclose' => '저장후 보스/지역 팝업 닫기',
);

?>
