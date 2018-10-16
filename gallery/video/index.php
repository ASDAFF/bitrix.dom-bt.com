<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Видео");
?>
<? global $videoFilter;?>
<? $videoFilter = array(
'!PROPERTY_177' => false);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"smt_gallery_video", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "videoFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "19",
		"IBLOCK_TYPE" => "smt_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Видео",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "VIDEO_LINK",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "Y",
		"COMPONENT_TEMPLATE" => "smt_gallery_video",
		"MAIN_BLOCK_PROPERTY_CODE" => array(
			0 => "VIDEO_LINK",
		),
		"LINE_ELEMENT_COUNT" => "2",
		"LINE_ELEMENT_GRID" => "12 12 4 4",
		"SMT_LINK_SHOW_MODE" => "LINK",
		"DISPLAY_DESCRIPTION" => "Y",
		"DISPLAY_IMAGE_NAME" => "N",
		"DISPLAY_IMAGE_FIXED" => "N",
		"DISPLAY_IMAGE_PREVIEW_TEXT" => "N",
		"PICTURE_RESIZE" => "Y",
		"PICTURE_RESIZE_MODE" => "2",
		"PICTURE_RESOLUTION" => "1x1",
		"PICTURE_RESIZE_SOURCE" => "DETAIL_PICTURE",
		"PICTURE_RESIZE_WIDTH" => "640",
		"PICTURE_RESIZE_HEIGHT" => "480",
		"SMT_SLIDER" => "N",
		"SMT_SLIDER_ITEMS" => "1",
		"SMT_SLIDER_MARGIN" => "",
		"SMT_SLIDER_NAV" => "N",
		"SMT_SLIDER_DOTS" => "N",
		"SMT_SLIDER_VERTICAL_ALIGN" => "N",
		"SMT_SLIDER_RESPONSIVE" => array(
		),
		"SMT_SLIDER_CUSTOM" => "",
		"PICTURE_RESIZE_GALLERY" => "Y",
		"PICTURE_RESIZE_MODE_GALLERY" => "2",
		"PICTURE_RESIZE_SOURCE_GALLERY" => "DETAIL_PICTURE",
		"PICTURE_RESOLUTION_GALLERY" => "1x1",
		"PICTURE_RESIZE_WIDTH_GALLERY" => "640",
		"PICTURE_RESIZE_HEIGHT_GALLERY" => "480"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>