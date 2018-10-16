<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог товаров из 1С:Предприятие");
?>
<?if(IsModuleInstalled('sale')):?>
<div align="right"><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line",
	"",
	Array(
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PERSONAL" => "/personal/",
		"SHOW_PERSONAL_LINK" => "N"
	)
);?></div>
<?endif?>
 <?$APPLICATION->IncludeComponent("bitrix:catalog", ".default", array(
	"IBLOCK_TYPE" => "xmlcatalog",
	"IBLOCK_ID" => "8",
	"BASKET_URL" => "/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/e-store/xml_catalog/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "N",
	"DISPLAY_PANEL" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "FILTER",
	"FILTER_FIELD_CODE" => array(
		0 => "NAME",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "",
		1 => "CML2_ARTICLE",
		2 => "",
	),
	"FILTER_PRICE_CODE" => array(
	),
	"USE_REVIEW" => "N",
	"USE_COMPARE" => "Y",
	"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
	"COMPARE_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"COMPARE_PROPERTY_CODE" => array(
		0 => "",
		1 => "CML2_ARTICLE",
		2 => "CML2_BASE_UNIT",
		3 => "CML2_TRAITS",
		4 => "CML2_ATTRIBUTES",
		5 => "CML2_BAR_CODE",
		6 => "",
	),
	"DISPLAY_ELEMENT_SELECT_BOX" => "N",
	"ELEMENT_SORT_FIELD_BOX" => "name",
	"ELEMENT_SORT_ORDER_BOX" => "asc",
	"COMPARE_ELEMENT_SORT_FIELD" => "sort",
	"COMPARE_ELEMENT_SORT_ORDER" => "asc",
	"PRICE_CODE" => array(
		0 => "Розничная",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SHOW_TOP_ELEMENTS" => "Y",
	"TOP_ELEMENT_COUNT" => "3",
	"TOP_LINE_ELEMENT_COUNT" => "1",
	"TOP_ELEMENT_SORT_FIELD" => "id",
	"TOP_ELEMENT_SORT_ORDER" => "desc",
	"TOP_PROPERTY_CODE" => array(
		0 => "",
		1 => "CML2_ARTICLE",
		2 => "CML2_BASE_UNIT",
		3 => "CML2_TRAITS",
		4 => "CML2_ATTRIBUTES",
		5 => "",
	),
	"PAGE_ELEMENT_COUNT" => "5",
	"LINE_ELEMENT_COUNT" => "1",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "",
		1 => "CML2_ARTICLE",
		2 => "CML2_BASE_UNIT",
		3 => "CML2_TRAITS",
		4 => "CML2_ATTRIBUTES",
		5 => "CML2_BAR_CODE",
		6 => "",
	),
	"INCLUDE_SUBSECTIONS" => "Y",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "CML2_ARTICLE",
		2 => "CML2_BASE_UNIT",
		3 => "CML2_TRAITS",
		4 => "CML2_ATTRIBUTES",
		5 => "CML2_BAR_CODE",
		6 => "",
	),
	"DETAIL_META_KEYWORDS" => "",
	"DETAIL_META_DESCRIPTION" => "",
	"DETAIL_BROWSER_TITLE" => "BROWSER_TITLE",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_IBLOCK_ID" => "",
	"LINK_PROPERTY_SID" => "",
	"LINK_ELEMENTS_URL" => "",
	"USE_ALSO_BUY" => "Y",
	"ALSO_BUY_ELEMENT_COUNT" => "5",
	"ALSO_BUY_MIN_BUYES" => "2",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_ID#/",
		"element" => "#SECTION_ID#/#ELEMENT_ID#/",
		"compare" => "compare.php?action=#ACTION_CODE#",
	),
	"VARIABLE_ALIASES" => array(
		"compare" => array(
			"ACTION_CODE" => "action",
		),
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>