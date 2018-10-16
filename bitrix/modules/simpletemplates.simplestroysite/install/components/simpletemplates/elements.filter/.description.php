<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SMT_IBLOCK_FILTER_TEMPLATE_NAME"),
	"DESCRIPTION" => GetMessage("SMT_IBLOCK_FILTER_TEMPLATE_DESCRIPTION"),
	"ICON" => "/images/iblock_filter.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 70,
	"PATH" => array(
		"ID" => "simpletemplates",
		"NAME" => GetMessage("SMT_SBQC_PATH_NAME"),
	),
);
?>