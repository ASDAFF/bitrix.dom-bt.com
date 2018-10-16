<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Iblock;
use Bitrix\Main\Web\Json;

$sectionsID = array();
foreach ($arResult["ITEMS"] as $arItem) {
    if ($arItem["IBLOCK_SECTION_ID"]) {
        $sectionsID[] = $arItem["IBLOCK_SECTION_ID"];
    }
}
$sectionsID = array_unique($sectionsID);

$result = Iblock\SectionTable::getList(array(
    "select" => array(
        "ID",
        "NAME",
    ),
    "filter" => array(
        "ID" => $sectionsID,
        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
    ),
));

$arResult["SECTIONS"] = array();
while ($row = $result->fetch()) {
    $arResult["SECTIONS"][$row["ID"]] = $row;
}

if($arParams["PICTURE_RESIZE"] == "Y") {
    foreach ($arResult["ITEMS"] as $count=>$arItem) {
        if ($arItem[$arParams["PICTURE_RESIZE_SOURCE"]]) {
            $file = CFile::ResizeImageGet($arItem[$arParams["PICTURE_RESIZE_SOURCE"]], array('width'=> (int) $arParams["PICTURE_RESIZE_WIDTH"], 'height'=> (int) $arParams["PICTURE_RESIZE_HEIGHT"]), (int) $arParams["PICTURE_RESIZE_MODE"], true);
            $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["SRC"] = $file["src"];
            $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["WIDTH"] = $file["width"];
            $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["HEIGHT"] = $file["height"];
        }
    }
}

foreach ($arResult["ITEMS"] as $count=>$arItem) {
    $arResult["ITEMS"][$count]["DISPLAY_PROPERTIES"]=array();
    foreach($arParams["PROPERTY_CODE"] as $pid)
    {
        $prop = &$arResult["ITEMS"][$count]["PROPERTIES"][$pid];
        if(
            (is_array($prop["VALUE"]) && count($prop["VALUE"])>0)
            || (!is_array($prop["VALUE"]) && strlen($prop["VALUE"])>0)
        )
        {
            $arResult["ITEMS"][$count]["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arResult, $prop, "news_out");
        }
    }
}

if (!function_exists('smtCatalogCurrencyFormat'))
{
    function smtCatalogCurrencyFormat($value, $decimals = 0, $dec_point = '.', $thousands_sep = ' ')
    {
        return number_format($value, $decimals, $dec_point, $thousands_sep);
    }
}

if(!$arParams["CURRENCY_DECIMALS"]) {
    $arParams["CURRENCY_DECIMALS"] = 0;
} else {
    $arParams["CURRENCY_DECIMALS"] = (int) $arParams["CURRENCY_DECIMALS"];
}

if(!$arParams["CURRENCY_DECIMALS_POINT"]) {
    $arParams["CURRENCY_DECIMALS_POINT"] = ".";
}

if(!$arParams["CURRENCY_THOUSANDS_SEP"]) {
    $arParams["CURRENCY_THOUSANDS_SEP"] = "";
}

if($arParams["SMT_SLIDER"] == "Y") {
    $sliderParameters = array();

    if($arParams["SMT_SLIDER_VERTICAL_ALIGN"] == "Y") {
    }

    if(strlen($arParams["SMT_SLIDER_ITEMS"]) > 0) {
        $sliderParameters["items"] = $arParams["SMT_SLIDER_ITEMS"];
    }

    if(strlen($arParams["SMT_SLIDER_MARGIN"]) > 0) {
        $sliderParameters["margin"] = (int) $arParams["SMT_SLIDER_MARGIN"];
    }

    if($arParams["SMT_SLIDER_NAV"] == "Y") {
        $sliderParameters["nav"] = true;
    } else {
        $sliderParameters["nav"] = false;
    }

    if($arParams["SMT_SLIDER_DOTS"] == "Y") {
        $sliderParameters["dots"] = true;
    } else {
        $sliderParameters["dots"] = false;
    }

    $responseSliderParameters = array();
    if(!empty($arParams['SMT_SLIDER_RESPONSIVE'])) {
        foreach ($arParams['SMT_SLIDER_RESPONSIVE'] as $code=>$value) {
            if(strlen($value) > 0) {
                $responseParams = array();

                if(isset($arParams["SMT_SLIDER_RESPONSIVE_ITEMS_" . $code]) && $arParams["SMT_SLIDER_RESPONSIVE_ITEMS_" . $code]) {
                    $itemsResponseParams = array("items" => (int) $arParams["SMT_SLIDER_RESPONSIVE_ITEMS_" . $code]);
                } else {
                    $itemsResponseParams = array();
                }

                if(isset($arParams["SMT_SLIDER_RESPONSIVE_CUSTOM_" . $code]) && $arParams["SMT_SLIDER_RESPONSIVE_CUSTOM_" . $code]) {
                    $sliderParam = htmlspecialcharsback(htmlspecialcharsback($arParams["SMT_SLIDER_RESPONSIVE_CUSTOM_" . $code]));
                    try {
                        $customResponseParams = Json::decode($sliderParam);
                    } catch (Exception $e) {
                        $customResponseParams = array();
                    }
                } else {
                    $customResponseParams = array();
                }

                $responseParams = array_merge($itemsResponseParams, $customResponseParams);

                if(!empty($responseParams)) {
                    $responseSliderParameters[$value] = $responseParams;
                }
            }
        }
    }

    if($responseSliderParameters) {
        $sliderParameters["responsive"] = $responseSliderParameters;
    }

    if(strlen($arParams["SMT_SLIDER_CUSTOM"]) > 0) {
        $sliderParam = htmlspecialcharsback(htmlspecialcharsback($arParams["SMT_SLIDER_CUSTOM"]));
        try {
            $sliderCustomParameters = Json::decode($sliderParam);
        } catch (Exception $e) {
            $sliderCustomParameters = array();
        }
        if ($sliderCustomParameters) {
            $sliderParameters = array_merge($sliderParameters, $sliderCustomParameters);
        }
    }

    $arResult["SMT_SLIDER_PROPERTIES_JSON"] = Json::encode($sliderParameters);
}