<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 */

$arTemplateParameters["DISPLAY_ICON"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_SPFO_DISPLAY_ICON"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["FORMS_DISABLE_AGREEMENT"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_SPFO_FORMS_DISABLE_AGREEMENT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);