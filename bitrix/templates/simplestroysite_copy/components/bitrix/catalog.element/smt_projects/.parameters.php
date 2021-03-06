<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;

if (!Loader::includeModule('iblock'))
	return;

$arTemplateParameters = array();
$defaultValue = array('-' => GetMessage('CP_BCE_TPL_PROP_EMPTY'));

$arAllPropList = array();
$arFilePropList = $defaultValue;
$arListPropList = array();
$arHighloadPropList = array();

if (isset($arCurrentValues['IBLOCK_ID']) && intval($arCurrentValues['IBLOCK_ID']) > 0)
{
	$rsProps = CIBlockProperty::GetList(
		array('SORT' => 'ASC', 'ID' => 'ASC'),
		array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y')
	);
	while ($arProp = $rsProps->Fetch())
	{
		$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];
		if ($arProp['CODE'] == '')
		{
			$arProp['CODE'] = $arProp['ID'];
		}

		$arAllPropList[$arProp['CODE']] = $strPropName;

		if ($arProp['PROPERTY_TYPE'] === 'F')
		{
			$arFilePropList[$arProp['CODE']] = $strPropName;
		}

		if ($arProp['PROPERTY_TYPE'] === 'L')
		{
			$arListPropList[$arProp['CODE']] = $strPropName;
		}

		if ($arProp['PROPERTY_TYPE'] === 'S' && $arProp['USER_TYPE'] === 'directory' && CIBlockPriceTools::checkPropDirectory($arProp))
		{
			$arHighloadPropList[$arProp['CODE']] = $strPropName;
		}
	}

	$arAllOfferPropList = array();
	$arTreeOfferPropList = $arFileOfferPropList = $defaultValue;

	$arCurrentValues['PROPERTY_CODE'] = isset($arCurrentValues['PROPERTY_CODE']) ? $arCurrentValues['PROPERTY_CODE'] : array();
	if (!empty($arCurrentValues['PROPERTY_CODE']))
	{
		$selected = array();

		foreach ($arCurrentValues['PROPERTY_CODE'] as $code)
		{
			if (isset($arAllPropList[$code]))
			{
				$selected[$code] = $arAllPropList[$code];
			}
		}

		$arTemplateParameters['MAIN_BLOCK_PROPERTY_CODE'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BCE_TPL_MAIN_BLOCK_PROPERTY_CODE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'SIZE' => (count($selected) > 5 ? 8 : 3),
			'VALUES' => $selected
		);
	}
}

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

$arTemplateParameters["DISPLAY_DATE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_DATE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arTemplateParameters["DISPLAY_DESCRIPTION"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_DISPLAY_DESCRIPTION"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

/* Tabs parameters */

$arTemplateParameters["TABS_LIST"] = array(
	"PARENT" => "VISUAL",
	"NAME" => GetMessage("SMT_CP_BCE_TPL_TABS_LIST"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"VALUES" => '',
	"REFRESH" => "Y",
);

if (!empty($arCurrentValues['TABS_LIST']))
{
	$values = array();
	foreach ($arCurrentValues['TABS_LIST'] as $code=>$value)
	{
		if (strlen($value) > 0) {
			$arTemplateParameters["TABS_LIST_ITEM_" . $code] = array(
				"PARENT" => "VISUAL",
				"NAME" => GetMessage("SMT_CP_BCE_TPL_TABS_LIST_ITEM") . $value,
				"TYPE" => "LIST",
				"VALUES" => $defaultValue + array("SMT_DETAIL_TEXT" => GetMessage("SMT_CP_BCE_TPL_TABS_LIST_ITEM_DETAIL_TEXT")) + $arAllPropList,
				"SIZE" => 1,
				"DEFAULT" => "-",
			);
			$arTemplateParameters["TABS_LIST_INCLUDE_" . $code] = array(
				"PARENT" => "VISUAL",
				"NAME" => GetMessage("SMT_CP_BCE_TPL_TABS_LIST_ITEM_INCLUDE") . $value,
				"TYPE" => "STRING",
			);
		}
	}
}

/* Buttons parameters */

$arTemplateParameters["BUTTON_LIST"] = array(
	"PARENT" => "VISUAL",
	"NAME" => GetMessage("SMT_CP_BCE_TPL_BUTTON_LIST"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"VALUES" => '',
	"REFRESH" => "Y",
);

if (!empty($arCurrentValues['BUTTON_LIST']))
{
	$values = array();
	foreach ($arCurrentValues['BUTTON_LIST'] as $code=>$value)
	{
		if (strlen($value) > 0) {
			$arTemplateParameters["BUTTON_LIST_HREF_" . $code] = array(
				"PARENT" => "VISUAL",
				"NAME" => GetMessage("SMT_CP_BCE_TPL_BUTTON_LIST_HREF") . $value,
				"TYPE" => "STRING",
			);
			$arTemplateParameters["BUTTON_LIST_CLASS_" . $code] = array(
				"PARENT" => "VISUAL",
				"NAME" => GetMessage("SMT_CP_BCE_TPL_BUTTON_LIST_CLASS") . $value,
				"TYPE" => "STRING",
				"DEFAULT" => "btn btn-block smt-btn-border"
			);
		}
	}
}

/* Currency parameters */

$arTemplateParameters["CURRENCY"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_CURRENCY_PARAMETER_NAME"),
	"TYPE" => "STRING",
	"DEFAULT" => GetMessage("SMT_BPSP_CURRENCY_PARAMETER_VALUE"),
);

$arTemplateParameters["CURRENCY_DECIMALS"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_CURRENCY_DECIMALS"),
	"TYPE" => "STRING",
	"DEFAULT" => "",
);

$arTemplateParameters["CURRENCY_DECIMALS_POINT"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_CURRENCY_DECIMALS_POINT"),
	"TYPE" => "STRING",
	"DEFAULT" => ".",
);

$arTemplateParameters["CURRENCY_THOUSANDS_SEP"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_CURRENCY_THOUSANDS_SEP"),
	"TYPE" => "STRING",
	"DEFAULT" => " ",
);

$arTemplateParameters["PRICE_HEADER"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PRICE_HEADER_PARAMETER_NAME"),
	"TYPE" => "STRING",
	"DEFAULT" => GetMessage("SMT_BPSP_PRICE_HEADER_PARAMETER_VALUE"),
);

/* Picture resize template parameters */

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

$arTemplateParameters['PICTURE_RESOLUTION'] = array(
	'PARENT' => 'ADDITIONAL_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_PICTURE_RESOLUTION'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'1x1' => '1x1'
	),
	'DEFAULT' => '1x1',
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

/* Picture gallery resize template parameters */

$arTemplateParameters["PICTURE_RESIZE_GALLERY"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_GALLERY"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

$arTemplateParameters["PICTURE_RESIZE_MODE_GALLERY"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_MODE_GALLERY"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => BX_RESIZE_IMAGE_EXACT,
	"VALUES" => array(BX_RESIZE_IMAGE_EXACT => "BX_RESIZE_IMAGE_EXACT", BX_RESIZE_IMAGE_PROPORTIONAL=>"BX_RESIZE_IMAGE_PROPORTIONAL",BX_RESIZE_IMAGE_PROPORTIONAL_ALT=>"BX_RESIZE_IMAGE_PROPORTIONAL_ALT"),
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE_GALLERY']) && $arCurrentValues['PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["PICTURE_RESIZE_SOURCE_GALLERY"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_SOURCE_GALLERY"),
	"MULTIPLE" => "N",
	"TYPE" => "LIST",
	"DEFAULT" => "DETAIL_PICTURE",
	"VALUES" => array("DETAIL_PICTURE" => "DETAIL_PICTURE", "PREVIEW_PICTURE" => "PREVIEW_PICTURE"),
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE_GALLERY']) && $arCurrentValues['PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters['PICTURE_RESOLUTION_GALLERY'] = array(
	'PARENT' => 'ADDITIONAL_SETTINGS',
	'NAME' => GetMessage('SMT_BPSP_PICTURE_RESOLUTION_GALLERY'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'1x1' => '1x1'
	),
	'DEFAULT' => '1x1',
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE_GALLERY']) && $arCurrentValues['PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["PICTURE_RESIZE_WIDTH_GALLERY"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_WIDTH_GALLERY"),
	"TYPE" => "STRING",
	"DEFAULT" => "640",
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE_GALLERY']) && $arCurrentValues['PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["PICTURE_RESIZE_HEIGHT_GALLERY"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_PICTURE_RESIZE_HEIGHT_GALLERY"),
	"TYPE" => "STRING",
	"DEFAULT" => "480",
	"HIDDEN" => (isset($arCurrentValues['PICTURE_RESIZE_GALLERY']) && $arCurrentValues['PICTURE_RESIZE_GALLERY'] == 'N' ? 'Y' : 'N'),
);

/* Slider template parameters */
$arTemplateParameters["SMT_SLIDER"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

$arTemplateParameters["SMT_SLIDER_ITEMS"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_ITEMS"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_MARGIN"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_MARGIN"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_NAV"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_NAV"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_DOTS"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_DOTS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_VERTICAL_ALIGN"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_VERTICAL_ALIGN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_RESPONSIVE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"VALUES" => "",
	"REFRESH" => "Y",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

if (!empty($arCurrentValues['SMT_SLIDER_RESPONSIVE']))
{
	$values = array();
	foreach ($arCurrentValues['SMT_SLIDER_RESPONSIVE'] as $code=>$value)
	{
		if (strlen($value) > 0) {
			$arTemplateParameters["SMT_SLIDER_RESPONSIVE_ITEMS_" . $code] = array(
				"PARENT" => "ADDITIONAL_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_ITEMS") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
			$arTemplateParameters["SMT_SLIDER_RESPONSIVE_CUSTOM_" . $code] = array(
				"PARENT" => "ADDITIONAL_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_CUSTOM") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
			);
		}
	}
}

$arTemplateParameters["SMT_SLIDER_CUSTOM"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_CUSTOM"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER']) && $arCurrentValues['SMT_SLIDER'] == 'N' ? 'Y' : 'N'),
);

/* Gallery slider template parameters */

$arTemplateParameters["SMT_SLIDER_GALLERY"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_GALLERY"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"REFRESH" => "Y",
);

$arTemplateParameters["SMT_SLIDER_GALLERY_ITEMS"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_ITEMS"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_GALLERY_MARGIN"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_MARGIN"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_GALLERY_NAV"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_NAV"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_GALLERY_DOTS"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_DOTS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_GALLERY_VERTICAL_ALIGN"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_VERTICAL_ALIGN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
);

$arTemplateParameters["SMT_SLIDER_GALLERY_RESPONSIVE"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"VALUES" => "",
	"REFRESH" => "Y",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
);

if (!empty($arCurrentValues['SMT_SLIDER_GALLERY_RESPONSIVE']))
{
	$values = array();
	foreach ($arCurrentValues['SMT_SLIDER_GALLERY_RESPONSIVE'] as $code=>$value)
	{
		if (strlen($value) > 0) {
			$arTemplateParameters["SMT_SLIDER_GALLERY_RESPONSIVE_ITEMS_" . $code] = array(
				"PARENT" => "ADDITIONAL_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_ITEMS") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
			);
			$arTemplateParameters["SMT_SLIDER_GALLERY_RESPONSIVE_CUSTOM_" . $code] = array(
				"PARENT" => "ADDITIONAL_SETTINGS",
				"NAME" => GetMessage("SMT_BPSP_SLIDER_RESPONSIVE_CUSTOM") . $value,
				"TYPE" => "STRING",
				"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
			);
		}
	}
}

$arTemplateParameters["SMT_SLIDER_GALLERY_CUSTOM"] = array(
	"PARENT" => "ADDITIONAL_SETTINGS",
	"NAME" => GetMessage("SMT_BPSP_SLIDER_CUSTOM"),
	"TYPE" => "STRING",
	"HIDDEN" => (isset($arCurrentValues['SMT_SLIDER_GALLERY']) && $arCurrentValues['SMT_SLIDER_GALLERY'] == 'N' ? 'Y' : 'N'),
);