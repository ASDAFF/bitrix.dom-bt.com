<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTemplateParameters = array(
	"SMT_ADD_CLASS" => array(
		"NAME" => GetMessage("SMT_CMSM_SMT_ADD_CLASS"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
);
?>
