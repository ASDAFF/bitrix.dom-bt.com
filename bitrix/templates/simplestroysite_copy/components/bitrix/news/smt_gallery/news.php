<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$isTopIncludeCustom = ($arParams["TOP_INCLUDE_PATH"]);
$isBottomIncludeCustom = ($arParams["BOTTOM_INCLUDE_PATH"]);
?>
<?if($isTopIncludeCustom):?>
	<?$APPLICATION->IncludeFile(
		$arParams["TOP_INCLUDE_PATH"],
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true)
	);?>
<?endif?>
<?if($arParams["SHOW_SECTIONS_SECTIONS"] == "Y"):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"smt_section",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
			"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
			"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
			"LINE_ELEMENT_COUNT" => $arParams["SECTIONS_LINE_ELEMENT_COUNT"],
			"DISPLAY_NAME" => $arParams["SECTIONS_DISPLAY_NAME"],
			"DISPLAY_PICTURE" => $arParams["SECTIONS_DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["SECTIONS_DISPLAY_PREVIEW_TEXT"],
			"DISPLAY_DESCRIPTION" => $arParams["SECTIONS_DISPLAY_DESCRIPTION"],
			"DISPLAY_BUTTON" => $arParams["SECTIONS_DISPLAY_BUTTON"],
			"PICTURE_RESIZE" => $arParams["SECTIONS_PICTURE_RESIZE"],
			"PICTURE_RESIZE_MODE" => $arParams["SECTIONS_PICTURE_RESIZE_MODE"],
			"PICTURE_RESIZE_SOURCE" => $arParams["SECTIONS_PICTURE_RESIZE_SOURCE"],
			"PICTURE_RESIZE_WIDTH" => $arParams["SECTIONS_PICTURE_RESIZE_WIDTH"],
			"PICTURE_RESIZE_HEIGHT" => $arParams["SECTIONS_PICTURE_RESIZE_HEIGHT"],
			"DISPLAY_IMAGE_NAME" => $arParams["SECTIONS_DISPLAY_IMAGE_NAME"],
			"DISPLAY_IMAGE_PREVIEW_TEXT" => $arParams["SECTIONS_DISPLAY_IMAGE_PREVIEW_TEXT"],
			"SECTION_USER_FIELDS" => array("UF_PREVIEW_TEXT"),
			"LINE_ELEMENT_GRID" => $arParams["SECTIONS_LINE_ELEMENT_GRID"],
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);?>
<?endif?>
<?if($arParams["SHOW_TOP_ELEMENTS_ALL"] == "Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"smt_gallery",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["LIST_DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["LIST_DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["LIST_DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["LIST_DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],

		"LINE_ELEMENT_COUNT" => $arParams["LIST_LINE_ELEMENT_COUNT"],
		"SMT_LINK_SHOW_MODE" => $arParams["LIST_SMT_LINK_SHOW_MODE"],

		"DISPLAY_IMAGE_NAME" => (isset($arParams["LIST_DISPLAY_IMAGE_NAME"]) ? $arParams["LIST_DISPLAY_IMAGE_NAME"] : ""),
		"DISPLAY_IMAGE_PREVIEW_TEXT" => (isset($arParams["LIST_DISPLAY_IMAGE_PREVIEW_TEXT"]) ? $arParams["LIST_DISPLAY_IMAGE_PREVIEW_TEXT"] : ""),

		"MAIN_BLOCK_PROPERTY_CODE" => (isset($arParams["LIST_MAIN_BLOCK_PROPERTY_CODE"]) ? $arParams["LIST_MAIN_BLOCK_PROPERTY_CODE"] : ""),
		"DISPLAY_DESCRIPTION" => (isset($arParams['LIST_DISPLAY_DESCRIPTION']) ? $arParams['LIST_DISPLAY_DESCRIPTION'] : ''),

		"PICTURE_RESIZE" => (isset($arParams['LIST_PICTURE_RESIZE']) ? $arParams['LIST_PICTURE_RESIZE'] : ''),
		"PICTURE_RESIZE_MODE" => (isset($arParams['LIST_PICTURE_RESIZE_MODE']) ? $arParams['LIST_PICTURE_RESIZE_MODE'] : ''),
		"PICTURE_RESOLUTION" => (isset($arParams['LIST_PICTURE_RESOLUTION']) ? $arParams['LIST_PICTURE_RESOLUTION'] : ''),
		"PICTURE_RESIZE_SOURCE" => (isset($arParams['LIST_PICTURE_RESIZE_SOURCE']) ? $arParams['LIST_PICTURE_RESIZE_SOURCE'] : ''),
		"PICTURE_RESIZE_WIDTH" => (isset($arParams['LIST_PICTURE_RESIZE_WIDTH']) ? $arParams['LIST_PICTURE_RESIZE_WIDTH'] : ''),
		"PICTURE_RESIZE_HEIGHT" => (isset($arParams['LIST_PICTURE_RESIZE_HEIGHT']) ? $arParams['LIST_PICTURE_RESIZE_HEIGHT'] : ''),
		"SMT_SLIDER" => (isset($arParams['LIST_SMT_SLIDER']) ? $arParams['LIST_SMT_SLIDER'] : ''),
		"SMT_SLIDER_ITEMS" => (isset($arParams['LIST_SMT_SLIDER_ITEMS']) ? $arParams['LIST_SMT_SLIDER_ITEMS'] : ''),
		"SMT_SLIDER_MARGIN" => (isset($arParams['LIST_SMT_SLIDER_MARGIN']) ? $arParams['LIST_SMT_SLIDER_MARGIN'] : ''),
		"SMT_SLIDER_NAV" => (isset($arParams['LIST_SMT_SLIDER_NAV']) ? $arParams['LIST_SMT_SLIDER_NAV'] : ''),
		"SMT_SLIDER_DOTS" => (isset($arParams['LIST_SMT_SLIDER_DOTS']) ? $arParams['LIST_SMT_SLIDER_DOTS'] : ''),
		"SMT_SLIDER_VERTICAL_ALIGN" => (isset($arParams['LIST_SMT_SLIDER_VERTICAL_ALIGN']) ? $arParams['LIST_SMT_SLIDER_VERTICAL_ALIGN'] : ''),
		"SMT_SLIDER_RESPONSIVE" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE'] : ''),
		"SMT_SLIDER_CUSTOM" => (isset($arParams['LIST_SMT_SLIDER_CUSTOM']) ? $arParams['LIST_SMT_SLIDER_CUSTOM'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_0" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_0']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_0'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_0" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_0']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_0'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_1" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_1']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_1'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_1" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_1']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_1'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_2" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_2']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_2'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_2" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_2']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_2'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_3" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_3']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_3'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_3" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_3']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_3'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_4" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_4']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_4'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_4" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_4']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_4'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_5" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_5']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_5'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_5" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_5']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_5'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_6" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_6']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_6'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_6" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_6']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_6'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_7" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_7']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_7'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_7" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_7']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_7'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_8" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_8']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_8'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_8" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_8']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_8'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_9" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_9']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_ITEMS_9'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_9" => (isset($arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_9']) ? $arParams['LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_9'] : ''),
	),
	$component
);?>
<?endif?>
<?if($isBottomIncludeCustom):?>
	<?$APPLICATION->IncludeFile(
		$arParams["BOTTOM_INCLUDE_PATH"],
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true)
	);?>
<?endif?>