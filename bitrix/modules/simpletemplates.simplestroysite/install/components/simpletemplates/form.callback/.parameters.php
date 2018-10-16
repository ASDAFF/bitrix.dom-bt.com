<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"AJAX_FORM_ID" => array(
			"NAME" => GetMessage("SMT_COMP_FORM_CALLBACK_AJAX_FORM_ID"),
			"TYPE" => "STRING",
			"ADDITIONAL_VALUES" => "Y",
			"MULTIPLE" => "Y",
			"PARENT" => "BASE",
		),
		"FILTER_NAME" => array(
			"NAME" => GetMessage("SMT_IBLOCK_FILTER_NAME_OUT"),
			"TYPE" => "STRING",
			"DEFAULT" => "formFilter",
		),
		"FORM_FILES" => array(
			"NAME" => GetMessage("SMT_COMP_FORM_CALLBACK_FORM_FILES"),
			"TYPE" => "STRING",
			"ADDITIONAL_VALUES" => "Y",
			"MULTIPLE" => "Y",
			"PARENT" => "BASE",
		),
	),
);
?>