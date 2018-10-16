<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Iblock;
use Bitrix\Main\Web\Json;

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

if($arParams["LINE_ELEMENT_GRID"]) {
    $leftGridSettings = array_fill(0, 4, 12);
    $rightGridSettings = array_fill(0, 4, 12);

    $arResult["LINE_ELEMENT_GRID"] = array(
        array(
            'col-xs-',
            'col-sm-',
            'col-md-',
            'col-lg-',
        ),
        array(
            'col-xs-',
            'col-sm-',
            'col-md-',
            'col-lg-',
        ),
    );
    $paramsGridSettings = explode(' ', $arParams["LINE_ELEMENT_GRID"]);
    foreach($leftGridSettings as $count=>$value) {
        if (isset($paramsGridSettings[$count])) {
            $leftValue = intval($paramsGridSettings[$count]);
            if($leftValue > 0 && $leftValue <= 12) {
                $leftGridSettings[$count] = $leftValue;
                $rightValue = (12 - $leftValue)?12 - $leftValue:$leftValue;
                $rightGridSettings[$count] = $rightValue;
            } else {
                $leftValue = 12;
                $rightValue = 12;
            }
            $arResult["LINE_ELEMENT_GRID"][0][$count] .= $leftValue;
            $arResult["LINE_ELEMENT_GRID"][1][$count] .= $rightValue;
        }
    }
} else {
    $arResult["LINE_ELEMENT_GRID"] = array(
        array(
            'col-xs-12',
            'col-sm-12',
            'col-md-4',
            'col-lg-4',
        ),
        array(
            'col-xs-12',
            'col-sm-12',
            'col-md-8',
            'col-lg-8',
        ),
    );
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