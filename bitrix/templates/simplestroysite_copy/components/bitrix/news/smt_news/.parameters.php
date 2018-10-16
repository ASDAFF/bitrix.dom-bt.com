<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arCurrentValues */

use Bitrix\Main\Loader;
use Bitrix\Iblock;

if (!Loader::includeModule('iblock'))
	return;

$defaultValue = array('-' => GetMessage('CP_BCE_TPL_PROP_EMPTY'));
$arTemplateParameters = array();

$arProperty_LINK = array();
if (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0)
{
	$propertyIterator = Iblock\PropertyTable::getList(array(
		'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE', 'SORT'),
		'filter' => array('=IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=PROPERTY_TYPE' => Iblock\PropertyTable::TYPE_ELEMENT, '=ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
	));
	while ($property = $propertyIterator->fetch())
	{
		$propertyCode = (string)$property['CODE'];
		if ($propertyCode == '')
			$propertyCode = $property['ID'];
		$arProperty_LINK[$propertyCode] = '['.$propertyCode.'] '.$property['NAME'];
	}
	unset($propertyCode, $property, $propertyIterator);
}


$arTemplateParameters["SMT_IBLOCK_LINK_PROPERTY_SID"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_IBLOCK_LINK_PROPERTY_SID"),
	"TYPE" => "LIST",
	"ADDITIONAL_VALUES" => "Y",
	"VALUES" => $arProperty_LINK,
);
$arTemplateParameters["LINK_PAGE_ELEMENT_COUNT"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_IBLOCK_PAGE_ELEMENT_COUNT"),
	"TYPE" => "STRING",
	"DEFAULT" => "6",
);
$arTemplateParameters["LINK_LINE_ELEMENT_COUNT"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_IBLOCK_LINE_ELEMENT_COUNT"),
	"TYPE" => "STRING",
	"DEFAULT" => "3",
);

$arAllPropList = array();
$arListPropList = array();

if (isset($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0) {
	$rsProps = CIBlockProperty::GetList(
		array('SORT' => 'ASC', 'ID' => 'ASC'),
		array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y')
	);
	while ($arProp = $rsProps->Fetch()) {
		$strPropName = '[' . $arProp['ID'] . ']' . ('' != $arProp['CODE'] ? '[' . $arProp['CODE'] . ']' : '') . ' ' . $arProp['NAME'];
		if ('' == $arProp['CODE']) {
			$arProp['CODE'] = $arProp['ID'];
		}

		$arAllPropList[$arProp['CODE']] = $strPropName;

		if ('F' == $arProp['PROPERTY_TYPE']) {
			$arFilePropList[$arProp['CODE']] = $strPropName;
		}

		if ('L' == $arProp['PROPERTY_TYPE']) {
			$arListPropList[$arProp['CODE']] = $strPropName;
		}
	}
}

$arCurrentValues['DETAIL_PROPERTY_CODE'] = isset($arCurrentValues['DETAIL_PROPERTY_CODE']) ? $arCurrentValues['DETAIL_PROPERTY_CODE'] : array();
if (!empty($arCurrentValues['DETAIL_PROPERTY_CODE']))
{
	$selected = array();

	foreach ($arCurrentValues['DETAIL_PROPERTY_CODE'] as $code)
	{
		if (isset($arAllPropList[$code]))
		{
			$selected[$code] = $arAllPropList[$code];
		}
	}

	$arTemplateParameters['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MAIN_BLOCK_PROPERTY_CODE'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'SIZE' => (count($selected) > 5 ? 8 : 3),
		'VALUES' => $selected
	);
}

$arCurrentValues['LIST_PROPERTY_CODE'] = isset($arCurrentValues['LIST_PROPERTY_CODE']) ? $arCurrentValues['LIST_PROPERTY_CODE'] : array();
if (!empty($arCurrentValues['LIST_PROPERTY_CODE']))
{
	$selected = array();

	foreach ($arCurrentValues['LIST_PROPERTY_CODE'] as $code)
	{
		if (isset($arAllPropList[$code]))
		{
			$selected[$code] = $arAllPropList[$code];
		}
	}

	$arTemplateParameters['LIST_MAIN_BLOCK_PROPERTY_CODE'] = array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MAIN_BLOCK_PROPERTY_CODE'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'SIZE' => (count($selected) > 5 ? 8 : 3),
		'VALUES' => $selected
	);
}

$arTemplateParameters["DETAIL_DISPLAY_NAME"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_NAME"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DETAIL_DISPLAY_BACK_BUTTON"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_BACK_BUTTON"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters["DETAIL_BACK_BUTTON_JS"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_BACK_BUTTON_JS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters["DETAIL_DISPLAY_PICTURE"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_PICTURE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DETAIL_DISPLAY_PREVIEW_TEXT"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_PREVIEW_TEXT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DETAIL_DISPLAY_DATE"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_DATE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DETAIL_DISPLAY_DESCRIPTION"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_DESCRIPTION"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters['DETAIL_LINE_ELEMENT_COUNT'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('IBLOCK_LINE_ELEMENT_COUNT'),
	'TYPE' => 'STRING',
	'DEFAULT' => '3'
);

$arTemplateParameters['DETAIL_DISPLAY_IMAGE_NAME'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_IMAGE_NAME"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters['DETAIL_DISPLAY_IMAGE_PREVIEW_TEXT'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_IMAGE_PREVIEW_TEXT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_MODE"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_MODE"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => BX_RESIZE_IMAGE_EXACT,
	"VALUES" => array(BX_RESIZE_IMAGE_EXACT => "BX_RESIZE_IMAGE_EXACT", BX_RESIZE_IMAGE_PROPORTIONAL=>"BX_RESIZE_IMAGE_PROPORTIONAL",BX_RESIZE_IMAGE_PROPORTIONAL_ALT=>"BX_RESIZE_IMAGE_PROPORTIONAL_ALT"),
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE']) && $arCurrentValues['DETAIL_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters['DETAIL_PICTURE_RESOLUTION'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_PICTURE_RESOLUTION'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'1x1' => '1x1'
	),
	'DEFAULT' => '1x1',
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE']) && $arCurrentValues['DETAIL_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_SOURCE"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_SOURCE"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => "DETAIL_PICTURE",
	"VALUES" => array("DETAIL_PICTURE" => "DETAIL_PICTURE", "PREVIEW_PICTURE" => "PREVIEW_PICTURE"),
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE']) && $arCurrentValues['DETAIL_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_WIDTH"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_WIDTH"),
	"TYPE" => "STRING",
	"DEFAULT" => "640",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE']) && $arCurrentValues['DETAIL_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_HEIGHT"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_HEIGHT"),
	"TYPE" => "STRING",
	"DEFAULT" => "480",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE']) && $arCurrentValues['DETAIL_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

/* Picture gallery resize template parameters */

$arTemplateParameters["DETAIL_PICTURE_RESIZE_GALLERY"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_GALLERY"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_MODE_GALLERY"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_MODE_GALLERY"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => BX_RESIZE_IMAGE_EXACT,
	"VALUES" => array(BX_RESIZE_IMAGE_EXACT => "BX_RESIZE_IMAGE_EXACT", BX_RESIZE_IMAGE_PROPORTIONAL=>"BX_RESIZE_IMAGE_PROPORTIONAL",BX_RESIZE_IMAGE_PROPORTIONAL_ALT=>"BX_RESIZE_IMAGE_PROPORTIONAL_ALT"),
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY']) && $arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_SOURCE_GALLERY"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_SOURCE_GALLERY"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => "DETAIL_PICTURE",
	"VALUES" => array("DETAIL_PICTURE" => "DETAIL_PICTURE", "PREVIEW_PICTURE" => "PREVIEW_PICTURE"),
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY']) && $arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters['DETAIL_PICTURE_RESOLUTION_GALLERY'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_PICTURE_RESOLUTION_GALLERY'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'1x1' => '1x1'
	),
	'DEFAULT' => '1x1',
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY']) && $arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_WIDTH_GALLERY"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_WIDTH_GALLERY"),
	"TYPE" => "STRING",
	"DEFAULT" => "640",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY']) && $arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_PICTURE_RESIZE_HEIGHT_GALLERY"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_HEIGHT_GALLERY"),
	"TYPE" => "STRING",
	"DEFAULT" => "480",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY']) && $arCurrentValues['DETAIL_PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["USE_SHARE"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_USE_SHARE"),
	"TYPE" => "CHECKBOX",
	"MULTIPLE" => "N",
	"VALUE" => "Y",
	"DEFAULT" =>"N",
	"REFRESH"=> "Y",
);

if ($arCurrentValues["USE_SHARE"] == "Y")
{
	$arTemplateParameters["SHARE_HIDE"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_HIDE"),
		"TYPE" => "CHECKBOX",
		"VALUE" => "Y",
		"DEFAULT" => "N",
	);

	$arTemplateParameters["SHARE_TEMPLATE"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_TEMPLATE"),
		"DEFAULT" => "",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"COLS" => 25,
		"REFRESH"=> "Y",
	);

	if (strlen(trim($arCurrentValues["SHARE_TEMPLATE"])) <= 0)
		$shareComponentTemlate = false;
	else
		$shareComponentTemlate = trim($arCurrentValues["SHARE_TEMPLATE"]);

	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/bitrix/main.share/util.php");

	$arHandlers = __bx_share_get_handlers($shareComponentTemlate);

	$arTemplateParameters["SHARE_HANDLERS"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SYSTEM"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arHandlers["HANDLERS"],
		"DEFAULT" => $arHandlers["HANDLERS_DEFAULT"],
	);

	$arTemplateParameters["SHARE_SHORTEN_URL_LOGIN"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SHORTEN_URL_LOGIN"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);

	$arTemplateParameters["SHARE_SHORTEN_URL_KEY"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SHORTEN_URL_KEY"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
}

/* Slider template parameters */
$arTemplateParameters["DETAIL_SMT_SLIDER"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"REFRESH" => "Y",
);

$arTemplateParameters["DETAIL_SMT_SLIDER_ITEMS"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_ITEMS"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_SMT_SLIDER_MARGIN"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_MARGIN"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_SMT_SLIDER_NAV"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_NAV"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_SMT_SLIDER_DOTS"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_DOTS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_SMT_SLIDER_VERTICAL_ALIGN"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_VERTICAL_ALIGN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["DETAIL_SMT_SLIDER_RESPONSIVE"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"VALUES" => "",
	"REFRESH" => "Y",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

if (!empty($arCurrentValues['DETAIL_SMT_SLIDER_RESPONSIVE']))
{
	$values = array();
	foreach ($arCurrentValues['DETAIL_SMT_SLIDER_RESPONSIVE'] as $code=>$value)
	{
		if (strlen($value) > 0) {
			$arTemplateParameters["DETAIL_SMT_SLIDER_RESPONSIVE_ITEMS_" . $code] = array(
				"PARENT" => "DETAIL_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_ITEMS") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
			$arTemplateParameters["DETAIL_SMT_SLIDER_RESPONSIVE_CUSTOM_" . $code] = array(
				"PARENT" => "DETAIL_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_CUSTOM") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
		}
	}
}

$arTemplateParameters["DETAIL_SMT_SLIDER_CUSTOM"] = array(
	"PARENT" => "DETAIL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_CUSTOM"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['DETAIL_SMT_SLIDER']) && $arCurrentValues['DETAIL_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_DISPLAY_NAME"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_NAME"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["LIST_DISPLAY_PICTURE"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_PICTURE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["LIST_DISPLAY_PREVIEW_TEXT"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_PREVIEW_TEXT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["LIST_DISPLAY_DATE"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_DATE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["LIST_DISPLAY_DESCRIPTION"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_DESCRIPTION"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["LIST_DISPLAY_BUTTON"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_BUTTON"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters['LIST_SMT_LINK_SHOW_MODE'] = array(
	'PARENT' => 'LIST_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_LINK_SHOW_MODE'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'LINK' => 'LINK',
		'DETAIL_PICTURE' => 'DETAIL_PICTURE',
		'PROPERTY_LINK' => 'PROPERTY_LINK',
	),
	'DEFAULT' => 'LINK'
);

$arTemplateParameters['LIST_LINE_ELEMENT_COUNT'] = array(
	'PARENT' => 'LIST_SETTINGS',
	'NAME' => GetMessage('IBLOCK_LINE_ELEMENT_COUNT'),
	'TYPE' => 'STRING',
	'DEFAULT' => '3'
);

$arTemplateParameters['LIST_LINE_ELEMENT_GRID'] = array(
	'PARENT' => 'LIST_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_LINE_ELEMENT_GRID'),
	'TYPE' => 'STRING',
	'DEFAULT' => '12 12 4 4'
);

$arTemplateParameters['LIST_DISPLAY_IMAGE_NAME'] = array(
	'PARENT' => 'LIST_SETTINGS',
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_IMAGE_NAME"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters['LIST_DISPLAY_IMAGE_PREVIEW_TEXT'] = array(
	'PARENT' => 'LIST_SETTINGS',
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_IMAGE_PREVIEW_TEXT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arTemplateParameters["LIST_PICTURE_RESIZE"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

$arTemplateParameters["LIST_PICTURE_RESIZE_MODE"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_MODE"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => BX_RESIZE_IMAGE_EXACT,
	"VALUES" => array(BX_RESIZE_IMAGE_EXACT => "BX_RESIZE_IMAGE_EXACT", BX_RESIZE_IMAGE_PROPORTIONAL=>"BX_RESIZE_IMAGE_PROPORTIONAL",BX_RESIZE_IMAGE_PROPORTIONAL_ALT=>"BX_RESIZE_IMAGE_PROPORTIONAL_ALT"),
	"HIDDEN" => (isset($arCurrentValues['LIST_PICTURE_RESIZE']) && $arCurrentValues['LIST_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters['LIST_PICTURE_RESOLUTION'] = array(
	'PARENT' => 'LIST_SETTINGS',
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
	"HIDDEN" => (isset($arCurrentValues['LIST_PICTURE_RESIZE']) && $arCurrentValues['LIST_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_PICTURE_RESIZE_SOURCE"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_SOURCE"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => "DETAIL_PICTURE",
	"VALUES" => array("DETAIL_PICTURE" => "DETAIL_PICTURE", "PREVIEW_PICTURE" => "PREVIEW_PICTURE"),
	"HIDDEN" => (isset($arCurrentValues['LIST_PICTURE_RESIZE']) && $arCurrentValues['LIST_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_PICTURE_RESIZE_WIDTH"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_WIDTH"),
	"TYPE" => "STRING",
	"DEFAULT" => "640",
	"HIDDEN" => (isset($arCurrentValues['LIST_PICTURE_RESIZE']) && $arCurrentValues['LIST_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_PICTURE_RESIZE_HEIGHT"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_HEIGHT"),
	"TYPE" => "STRING",
	"DEFAULT" => "480",
	"HIDDEN" => (isset($arCurrentValues['LIST_PICTURE_RESIZE']) && $arCurrentValues['LIST_PICTURE_RESIZE'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_SMT_SLIDER"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"REFRESH" => "Y",
);

$arTemplateParameters["LIST_SMT_SLIDER_ITEMS"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_ITEMS"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_SMT_SLIDER_MARGIN"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_MARGIN"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_SMT_SLIDER_NAV"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_NAV"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_SMT_SLIDER_DOTS"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_DOTS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_SMT_SLIDER_VERTICAL_ALIGN"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_VERTICAL_ALIGN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LIST_SMT_SLIDER_RESPONSIVE"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"VALUES" => "",
	"REFRESH" => "Y",
	"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

if (!empty($arCurrentValues['LIST_SMT_SLIDER_RESPONSIVE']))
{
	$values = array();
	foreach ($arCurrentValues['LIST_SMT_SLIDER_RESPONSIVE'] as $code=>$value)
	{
		if (strlen($value) > 0) {
			$arTemplateParameters["LIST_SMT_SLIDER_RESPONSIVE_ITEMS_" . $code] = array(
				"PARENT" => "LIST_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_ITEMS") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
			$arTemplateParameters["LIST_SMT_SLIDER_RESPONSIVE_CUSTOM_" . $code] = array(
				"PARENT" => "LIST_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_CUSTOM") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
		}
	}
}

$arTemplateParameters["LIST_SMT_SLIDER_CUSTOM"] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_CUSTOM"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['LIST_SMT_SLIDER']) && $arCurrentValues['LIST_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

/* Link slider */

$arTemplateParameters["LINK_SMT_SLIDER"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"REFRESH" => "Y",
);

$arTemplateParameters["LINK_SMT_SLIDER_ITEMS"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_ITEMS"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LINK_SMT_SLIDER_MARGIN"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_MARGIN"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LINK_SMT_SLIDER_NAV"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_NAV"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LINK_SMT_SLIDER_DOTS"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_DOTS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LINK_SMT_SLIDER_VERTICAL_ALIGN"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_VERTICAL_ALIGN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["LINK_SMT_SLIDER_RESPONSIVE"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"VALUES" => "",
	"REFRESH" => "Y",
	"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

if (!empty($arCurrentValues['LINK_SMT_SLIDER_RESPONSIVE']))
{
	$values = array();
	foreach ($arCurrentValues['LINK_SMT_SLIDER_RESPONSIVE'] as $code=>$value)
	{
		if (strlen($value) > 0) {
			$arTemplateParameters["LINK_SMT_SLIDER_RESPONSIVE_ITEMS_" . $code] = array(
				"PARENT" => "LINK",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_ITEMS") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
			$arTemplateParameters["LINK_SMT_SLIDER_RESPONSIVE_CUSTOM_" . $code] = array(
				"PARENT" => "LINK",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_CUSTOM") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
		}
	}
}

$arTemplateParameters["LINK_SMT_SLIDER_CUSTOM"] = array(
	"PARENT" => "LINK",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_CUSTOM"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['LINK_SMT_SLIDER']) && $arCurrentValues['LINK_SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);