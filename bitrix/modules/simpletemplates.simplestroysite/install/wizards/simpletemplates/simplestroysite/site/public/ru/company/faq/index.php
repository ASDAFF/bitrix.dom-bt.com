<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вопрос-ответ");
?><?$APPLICATION->IncludeComponent(
	"bitrix:photo.sections.top", 
	"smt_tabs_panel_vertical", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"DISPLAY_BUTTON" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_DESCRIPTION" => "N",
		"DISPLAY_IMAGE_NAME" => "N",
		"DISPLAY_IMAGE_PREVIEW_TEXT" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"ELEMENT_COUNT" => "50",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "#SMT_FAQ_IBLOCK_ID#",
		"IBLOCK_TYPE" => "smt_content",
		"LINE_ELEMENT_COUNT" => "1",
		"LINE_ELEMENT_GRID" => "12 12 12 12",
		"MAIN_BLOCK_PROPERTY_CODE" => "",
		"PICTURE_RESIZE" => "N",
		"PICTURE_RESIZE_HEIGHT" => "480",
		"PICTURE_RESIZE_MODE" => "2",
		"PICTURE_RESIZE_SOURCE" => "DETAIL_PICTURE",
		"PICTURE_RESIZE_WIDTH" => "640",
		"PICTURE_RESOLUTION" => "1x1",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ADDITIONAL_CLASS" => "",
		"SECTION_COUNT" => "10",
		"SECTION_DISPLAY_BUTTON" => "N",
		"SECTION_DISPLAY_DESCRIPTION" => "N",
		"SECTION_DISPLAY_LINK" => "N",
		"SECTION_DISPLAY_NAME" => "N",
		"SECTION_DISPLAY_PICTURE" => "N",
		"SECTION_DISPLAY_PREVIEW_TEXT" => "N",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_PICTURE_RESIZE" => "N",
		"SECTION_PICTURE_RESIZE_HEIGHT" => "480",
		"SECTION_PICTURE_RESIZE_MODE" => "2",
		"SECTION_PICTURE_RESIZE_SOURCE" => "PICTURE",
		"SECTION_PICTURE_RESIZE_WIDTH" => "640",
		"SECTION_SORT_FIELD" => "sort",
		"SECTION_SORT_ORDER" => "asc",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SMT_LINK_SHOW_MODE" => "NONE",
		"SMT_SLIDER" => "N",
		"SMT_SLIDER_CUSTOM" => "",
		"SMT_SLIDER_DOTS" => "N",
		"SMT_SLIDER_ITEMS" => "",
		"SMT_SLIDER_MARGIN" => "",
		"SMT_SLIDER_NAV" => "N",
		"SMT_SLIDER_RESPONSIVE" => "",
		"SMT_SLIDER_VERTICAL_ALIGN" => "N",
		"COMPONENT_TEMPLATE" => "smt_tabs"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>