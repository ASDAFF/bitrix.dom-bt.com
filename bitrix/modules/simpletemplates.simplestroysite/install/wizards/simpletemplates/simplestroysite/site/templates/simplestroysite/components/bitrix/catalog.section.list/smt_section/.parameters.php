<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array();

$arViewModeList = array(
	'LIST' => GetMessage('CPT_BCSL_VIEW_MODE_LIST'),
	'LINE' => GetMessage('CPT_BCSL_VIEW_MODE_LINE'),
	'TEXT' => GetMessage('CPT_BCSL_VIEW_MODE_TEXT'),
	'TILE' => GetMessage('CPT_BCSL_VIEW_MODE_TILE')
);

$arTemplateParameters['VIEW_MODE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CPT_BCSL_VIEW_MODE'),
	'TYPE' => 'LIST',
	'VALUES' => $arViewModeList,
	'MULTIPLE' => 'N',
	'DEFAULT' => 'LINE',
	'REFRESH' => 'Y'
);
$arTemplateParameters['SHOW_PARENT_NAME'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CPT_BCSL_SHOW_PARENT_NAME'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y'
);

if (isset($arCurrentValues['VIEW_MODE']) && 'TILE' == $arCurrentValues['VIEW_MODE'])
{
	$arTemplateParameters['HIDE_SECTION_NAME'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CPT_BCSL_HIDE_SECTION_NAME'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);
}

$arTemplateParameters['LINE_ELEMENT_COUNT'] = array(
	'PARENT' => 'ADDITIONAL_SETTINGS',
	'NAME' => GetMessage('IBLOCK_LINE_ELEMENT_COUNT'),
	'TYPE' => 'STRING',
	'DEFAULT' => '3'
);

$arTemplateParameters["DISPLAY_NAME"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_NAME"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DISPLAY_PICTURE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_PICTURE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DISPLAY_PREVIEW_TEXT"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_PREVIEW_TEXT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DISPLAY_DESCRIPTION"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_DESCRIPTION"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DISPLAY_BUTTON"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_BUTTON"),
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
	"VALUES" => array(BX_RESIZE_IMAGE_EXACT => "BX_RESIZE_IMAGE_EXACT", BX_RESIZE_IMAGE_PROPORTIONAL=>"BX_RESIZE_IMAGE_PROPORTIONAL",BX_RESIZE_IMAGE_PROPORTIONAL_ALT=>"BX_RESIZE_IMAGE_PROPORTIONAL_ALT"),
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE']) && $arCurrentValues['PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["PICTURE_RESIZE_SOURCE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_SOURCE"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => "PICTURE",
	"VALUES" => array("PICTURE" => "PICTURE"),
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

$arTemplateParameters['DISPLAY_IMAGE_NAME'] = array(
	'PARENT' => 'ADDITIONAL_SETTINGS',
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_IMAGE_NAME"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters['DISPLAY_IMAGE_PREVIEW_TEXT'] = array(
	'PARENT' => 'ADDITIONAL_SETTINGS',
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_IMAGE_PREVIEW_TEXT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);