<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Прайс-лист");
?><?$APPLICATION->IncludeComponent(
	"bitrix:photo.sections.top", 
	"smt_price", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"ELEMENT_COUNT" => "1000",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "#SMT_PRICE_IBLOCK_ID#",
		"IBLOCK_TYPE" => "smt_company",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "",
		),
		"SECTION_COUNT" => "1000",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_SORT_FIELD" => "sort",
		"SECTION_SORT_ORDER" => "asc",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_OPEN",
			1 => "UF_CURRENCY",
			2 => "",
		),
		"COMPONENT_TEMPLATE" => "smt_price",
		"CURRENCY" => "руб./м2"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>