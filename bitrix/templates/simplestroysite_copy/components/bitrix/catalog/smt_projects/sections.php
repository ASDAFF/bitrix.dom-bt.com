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
$isSidebar = ($arParams["SIDEBAR_SECTIONS_SHOW"] == "Y");
$isSidebarCustom = ($arParams["SIDEBAR_PATH"]);
$isFilter = ($arParams['USE_FILTER'] == 'Y');
$isSidebarRight = ($arParams['SIDEBAR_RIGHT'] == 'Y');
$isTopIncludeCustom = ($arParams["TOP_INCLUDE_PATH"]);
$isBottomIncludeCustom = ($arParams["BOTTOM_INCLUDE_PATH"]);
?>
<div class="row">
	<?if($isFilter):?>
        
        <div class="smt-widget smt-widget_margin">
			<a class="btn smt-btn btn-block hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" href="#bx_filter_catalog" aria-expanded="false" aria-controls="bx_filter_catalog">
				<?=GetMessage("SMT_CPT_CATALOG_FILTER_MORE_BUTTON")?>
			</a>
			<div class="collapse visible-lg" id="bx_filter_catalog">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"smt_projects",
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"SHOW_ALL_WO_SECTION" => "Y",
						"FILTER_NAME" => $arParams["FILTER_NAME"],
						"PRICE_CODE" => $arParams["PRICE_CODE"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"SAVE_IN_SESSION" => "N",
						"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
						"XML_EXPORT" => "Y",
						"SECTION_TITLE" => "NAME",
						"SECTION_DESCRIPTION" => "DESCRIPTION",
						'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
						"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						"SEF_MODE" => "",
						"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
						"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
						"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
						"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
						"POPUP_POSITION" => ($isSidebarRight == "Y")?"left":"right",
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		</div>
		 
		<?endif?>
</div>

<div class="row">
	<?if($isSidebar):?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cat-filter<?if($isSidebarRight):?> col-md-push-9 col-lg-push-9<?endif?>">
		<div class="smt-widget<?$APPLICATION->ShowViewContent('smt_sidebar');?>">
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
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);?>


	</div>
		
		<?if($isSidebarCustom):?>
			<?$APPLICATION->IncludeFile(
				$arParams["SIDEBAR_PATH"],
				Array(),
				Array("MODE"=>"html")
			);?>
		<?endif?>
	</div>
	<?endif?>
	<?if($isSidebar):?>
    <!-- projects grid -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12<?if($isSidebarRight):?> col-md-pull-3 col-lg-pull-3<?endif?>">
	<?else:?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?endif?>
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
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);?>
		<?endif?>
		<?if($arParams["SHOW_TOP_ELEMENTS_ALL"] == "Y"):?>
		 
		<?endif?>
		<?if($isBottomIncludeCustom):?>
			<?$APPLICATION->IncludeFile(
				$arParams["BOTTOM_INCLUDE_PATH"],
				Array(),
				Array("MODE"=>"html", "SHOW_BORDER" => true)
			);?>
		<?endif?>
	</div>
</div>