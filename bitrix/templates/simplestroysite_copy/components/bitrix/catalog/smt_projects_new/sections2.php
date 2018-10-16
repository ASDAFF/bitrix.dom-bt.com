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
<?if ($APPLICATION->GetCurDir() == "/projects/") {?>
<div style="    margin-left: -15px;">
<?$APPLICATION->IncludeComponent(
	"bitrix:search.tags.cloud",
	"oblako",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"COLOR_NEW" => "30abe2",
		"COLOR_OLD" => "30abe2",
		"COLOR_TYPE" => "Y",
		"COMPONENT_TEMPLATE" => "oblako",
		"FILTER_NAME" => "",
		"FONT_MAX" => "50",
		"FONT_MIN" => "14",
		"PAGE_ELEMENTS" => "150",
		"PERIOD" => "",
		"PERIOD_NEW_TAGS" => "10",
		"SHOW_CHAIN" => "N",
		"SORT" => "NAME",
		"TAGS_INHERIT" => "Y",
		"URL_SEARCH" => "/search/index.php",
		"WIDTH" => "100%",
		"arrFILTER" => array(0=>"iblock_smt_company",),
		"arrFILTER_iblock_smt_company" => array(0=>"14",),
		"arrFILTER_iblock_xmlcatalog" => array(0=>"8",)
	)
);?>
</div>       
        <div class="smt-widget smt-widget_margin">
			<a class="btn smt-btn btn-block hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" href="#bx_filter_catalog" aria-expanded="false" aria-controls="bx_filter_catalog">
				<?=GetMessage("SMT_CPT_CATALOG_FILTER_MORE_BUTTON")?>
			</a>
			<div class="" id="bx_filter_catalog">
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
	<?}?> 
		<?endif?>
</div>

<div class="row">
	<?if($isSidebar):?>
	<?/*	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cat-filter<?if($isSidebarRight):?> col-md-push-9 col-lg-push-9<?endif?>">
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


</div>   */?>
		
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

<?$orderFields = array(
            'name' => 'названию',
            'property_price' => 'цене',
            'property_area_common' => 'площади',
        );
        $currentSortField = $arParams["ELEMENT_SORT_FIELD"];
        if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $orderFields)) {
            $currentSortField = $_GET['sort'];
        }
        $currentSortOrder = 'asc';
        if (isset($_GET['order'])) {
            $currentSortOrder = ($_GET['order'] === 'asc') ? 'asc' : 'desc';
            $inverseSortOrder = ($currentSortOrder === 'asc') ? 'desc' : 'asc';
        }
        $arParams["ELEMENT_SORT_FIELD"] = $currentSortField;
        $arParams["ELEMENT_SORT_ORDER"] = $currentSortOrder;?>


<?$intSectionID = $APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"smt_projects",
			array(
				"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
				"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
				"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
"SHOW_ALL_WO_SECTION" => "Y",
				"MAIN_BLOCK_PROPERTY_CODE" => (isset($arParams["LIST_MAIN_BLOCK_PROPERTY_CODE"]) ? $arParams["LIST_MAIN_BLOCK_PROPERTY_CODE"] : ""),

				"DISPLAY_NAME" => (isset($arParams['LIST_DISPLAY_NAME']) ? $arParams['LIST_DISPLAY_NAME'] : ''),
				"DISPLAY_PICTURE" => (isset($arParams['LIST_DISPLAY_PICTURE']) ? $arParams['LIST_DISPLAY_PICTURE'] : ''),
				"DISPLAY_PREVIEW_TEXT" => (isset($arParams['LIST_DISPLAY_PREVIEW_TEXT']) ? $arParams['LIST_DISPLAY_PREVIEW_TEXT'] : ''),
				"DISPLAY_DATE" => (isset($arParams['LIST_DISPLAY_DATE']) ? $arParams['LIST_DISPLAY_DATE'] : ''),
				"DISPLAY_DESCRIPTION" => (isset($arParams['LIST_DISPLAY_DESCRIPTION']) ? $arParams['LIST_DISPLAY_DESCRIPTION'] : ''),
				"PRICE_HEADER" => (isset($arParams['LIST_PRICE_HEADER']) ? $arParams['LIST_PRICE_HEADER'] : ''),
				"CURRENCY_DECIMALS" => (isset($arParams['LIST_CURRENCY_DECIMALS']) ? $arParams['LIST_CURRENCY_DECIMALS'] : ''),
				"CURRENCY_DECIMALS_POINT" => (isset($arParams['LIST_CURRENCY_DECIMALS_POINT']) ? $arParams['LIST_CURRENCY_DECIMALS_POINT'] : ''),
				"CURRENCY_THOUSANDS_SEP" => (isset($arParams['LIST_CURRENCY_THOUSANDS_SEP']) ? $arParams['LIST_CURRENCY_THOUSANDS_SEP'] : ''),
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

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

				"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
				'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
				'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
				'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
				'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
			),
			$component
		);?>
	</div>
</div>