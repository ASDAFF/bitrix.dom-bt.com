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
?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"smt_news",
	Array(
		"DISPLAY_DATE" => $arParams["DETAIL_DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DETAIL_DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DETAIL_DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DETAIL_DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		'STRICT_SECTION_CHECK' => (isset($arParams['DETAIL_STRICT_SECTION_CHECK']) ? $arParams['DETAIL_STRICT_SECTION_CHECK'] : ''),
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),

		'MAIN_BLOCK_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] : ''),

		"LINE_ELEMENT_COUNT" => $arParams["DETAIL_LINE_ELEMENT_COUNT"],

		"DISPLAY_IMAGE_NAME" => (isset($arParams["DETAIL_DISPLAY_IMAGE_NAME"]) ? $arParams["DETAIL_DISPLAY_IMAGE_NAME"] : ""),
		"DISPLAY_IMAGE_PREVIEW_TEXT" => (isset($arParams["DETAIL_DISPLAY_IMAGE_PREVIEW_TEXT"]) ? $arParams["DETAIL_DISPLAY_IMAGE_PREVIEW_TEXT"] : ""),

		"DISPLAY_DESCRIPTION" => (isset($arParams['DETAIL_DISPLAY_DESCRIPTION']) ? $arParams['DETAIL_DISPLAY_DESCRIPTION'] : ''),
		"PICTURE_RESIZE" => (isset($arParams['DETAIL_PICTURE_RESIZE']) ? $arParams['DETAIL_PICTURE_RESIZE'] : ''),
		"PICTURE_RESIZE_MODE" => (isset($arParams['DETAIL_PICTURE_RESIZE_MODE']) ? $arParams['DETAIL_PICTURE_RESIZE_MODE'] : ''),
		"PICTURE_RESOLUTION" => (isset($arParams['DETAIL_PICTURE_RESOLUTION']) ? $arParams['DETAIL_PICTURE_RESOLUTION'] : ''),
		"PICTURE_RESIZE_SOURCE" => (isset($arParams['DETAIL_PICTURE_RESIZE_SOURCE']) ? $arParams['DETAIL_PICTURE_RESIZE_SOURCE'] : ''),
		"PICTURE_RESIZE_WIDTH" => (isset($arParams['DETAIL_PICTURE_RESIZE_WIDTH']) ? $arParams['DETAIL_PICTURE_RESIZE_WIDTH'] : ''),
		"PICTURE_RESIZE_HEIGHT" => (isset($arParams['DETAIL_PICTURE_RESIZE_HEIGHT']) ? $arParams['DETAIL_PICTURE_RESIZE_HEIGHT'] : ''),
		"PICTURE_RESIZE_GALLERY" => (isset($arParams['DETAIL_PICTURE_RESIZE_GALLERY']) ? $arParams['DETAIL_PICTURE_RESIZE_GALLERY'] : ''),
		"PICTURE_RESIZE_MODE_GALLERY" => (isset($arParams['DETAIL_PICTURE_RESIZE_MODE_GALLERY']) ? $arParams['DETAIL_PICTURE_RESIZE_MODE_GALLERY'] : ''),
		"PICTURE_RESIZE_SOURCE_GALLERY" => (isset($arParams['DETAIL_PICTURE_RESIZE_SOURCE_GALLERY']) ? $arParams['DETAIL_PICTURE_RESIZE_SOURCE_GALLERY'] : ''),
		"PICTURE_RESOLUTION_GALLERY" => (isset($arParams['DETAIL_PICTURE_RESOLUTION_GALLERY']) ? $arParams['DETAIL_PICTURE_RESOLUTION_GALLERY'] : ''),
		"PICTURE_RESIZE_WIDTH_GALLERY" => (isset($arParams['DETAIL_PICTURE_RESIZE_WIDTH_GALLERY']) ? $arParams['DETAIL_PICTURE_RESIZE_WIDTH_GALLERY'] : ''),
		"PICTURE_RESIZE_HEIGHT_GALLERY" => (isset($arParams['DETAIL_PICTURE_RESIZE_HEIGHT_GALLERY']) ? $arParams['DETAIL_PICTURE_RESIZE_HEIGHT_GALLERY'] : ''),

		"SMT_SLIDER" => (isset($arParams['DETAIL_SMT_SLIDER']) ? $arParams['DETAIL_SMT_SLIDER'] : ''),
		"SMT_SLIDER_ITEMS" => (isset($arParams['DETAIL_SMT_SLIDER_ITEMS']) ? $arParams['DETAIL_SMT_SLIDER_ITEMS'] : ''),
		"SMT_SLIDER_MARGIN" => (isset($arParams['DETAIL_SMT_SLIDER_MARGIN']) ? $arParams['DETAIL_SMT_SLIDER_MARGIN'] : ''),
		"SMT_SLIDER_NAV" => (isset($arParams['DETAIL_SMT_SLIDER_NAV']) ? $arParams['DETAIL_SMT_SLIDER_NAV'] : ''),
		"SMT_SLIDER_DOTS" => (isset($arParams['DETAIL_SMT_SLIDER_DOTS']) ? $arParams['DETAIL_SMT_SLIDER_DOTS'] : ''),
		"SMT_SLIDER_VERTICAL_ALIGN" => (isset($arParams['DETAIL_SMT_SLIDER_VERTICAL_ALIGN']) ? $arParams['DETAIL_SMT_SLIDER_VERTICAL_ALIGN'] : ''),
		"SMT_SLIDER_RESPONSIVE" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE'] : ''),
		"SMT_SLIDER_CUSTOM" => (isset($arParams['DETAIL_SMT_SLIDER_CUSTOM']) ? $arParams['DETAIL_SMT_SLIDER_CUSTOM'] : ''),

		"SMT_SLIDER_RESPONSIVE_ITEMS_0" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_0']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_0'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_0" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_0']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_0'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_1" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_1']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_1'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_1" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_1']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_1'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_2" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_2']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_2'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_2" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_2']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_2'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_3" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_3']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_3'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_3" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_3']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_3'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_4" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_4']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_4'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_4" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_4']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_4'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_5" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_5']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_5'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_5" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_5']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_5'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_6" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_6']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_6'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_6" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_6']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_6'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_7" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_7']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_7'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_7" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_7']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_7'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_8" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_8']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_8'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_8" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_8']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_8'] : ''),
		"SMT_SLIDER_RESPONSIVE_ITEMS_9" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_9']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_9'] : ''),
		"SMT_SLIDER_RESPONSIVE_CUSTOM_9" => (isset($arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_9']) ? $arParams['DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_9'] : ''),
	),
	$component
);?>
<?if($arParams["DETAIL_DISPLAY_BACK_BUTTON"] == "Y"):?>
	<?
	$sectionsPath = CComponentEngine::makePathFromTemplate($arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"], $arResult["VARIABLES"]);
	$sectionPath = CComponentEngine::makePathFromTemplate($arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"], $arResult["VARIABLES"]);
	?>
	<div class="smt-widget smt-widget_margin smt-widget_border-top smt-widget_padding-sm">
		<?if($arParams["DETAIL_BACK_BUTTON_JS"] == "Y"):?>
			<p><a class="btn smt-btn" href="javascript:history.back();"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a></p>
		<?else:?>
			<p><a class="btn smt-btn" href="<?=($sectionPath)?$sectionPath:$sectionsPath?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a></p>
		<?endif?>
	</div>
<?endif?>