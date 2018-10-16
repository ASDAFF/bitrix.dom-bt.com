<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"HIDE_TEXT" => Array(
		"NAME" => GetMessage("T_SMT_NEWS_LIST_REVIEWS_HIDE_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);

$arTemplateParameters['LINE_ELEMENT_GRID'] = array(
	'PARENT' => 'ADDITIONAL_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_LINE_ELEMENT_GRID'),
	'TYPE' => 'STRING',
	'DEFAULT' => '12 12 4 4'
);

$arTemplateParameters["DISPLAY_PICTURE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_PICTURE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["PICTURE_RESIZE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

$arTemplateParameters["PICTURE_RESIZE_MODE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_MODE"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => BX_RESIZE_IMAGE_EXACT,
	"VALUES" => array(
		BX_RESIZE_IMAGE_EXACT => "BX_RESIZE_IMAGE_EXACT",
		BX_RESIZE_IMAGE_PROPORTIONAL=>"BX_RESIZE_IMAGE_PROPORTIONAL",
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT=>"BX_RESIZE_IMAGE_PROPORTIONAL_ALT"
	),
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE']) && $arCurrentValues['PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters['PICTURE_RESOLUTION'] = array(
	'PARENT' => 'ADDITIONAL_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_PICTURE_RESOLUTION'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'1x1' => '1x1',
		'1x2' => '1x2',
		'3x4' => '3x4',
		'10x16' => '10x16',
		'16x10' => '16x10',
	),
	'DEFAULT' => '1x1',
	"ADDITIONAL_VALUES" => "Y",
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE']) && $arCurrentValues['PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["PICTURE_RESIZE_SOURCE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_SOURCE"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => "DETAIL_PICTURE",
	"VALUES" => array("DETAIL_PICTURE" => "DETAIL_PICTURE", "PREVIEW_PICTURE" => "PREVIEW_PICTURE"),
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE']) && $arCurrentValues['PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["PICTURE_RESIZE_WIDTH"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_WIDTH"),
	"TYPE" => "STRING",
	"DEFAULT" => "640",
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE']) && $arCurrentValues['PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["PICTURE_RESIZE_HEIGHT"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_HEIGHT"),
	"TYPE" => "STRING",
	"DEFAULT" => "480",
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE']) && $arCurrentValues['PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

?>
