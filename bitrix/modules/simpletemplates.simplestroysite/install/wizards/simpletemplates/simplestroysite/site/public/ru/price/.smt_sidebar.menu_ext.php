<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if($APPLICATION->GetProperty("smt_add_section_menu_sidebar") == "Y") {
	$aMenuLinksAdd = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections", 
	"", 
	array(
		"IBLOCK_TYPE" => "smt_company",
		"IBLOCK_ID" => "#SMT_PRICE_IBLOCK_ID#",
		"DEPTH_LEVEL" => "1",
		"CACHE_TIME" => "3600"
	),
	false
);

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksAdd);
}
?>