<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arParams["RG_FILTER"])) {
    $filter = [];
    foreach($arParams["RG_FILTER"]["VALUES"] as $key => $item) {
        $filter[] = $key;
    }
    foreach($arResult["ITEMS"][1] as $key => $item_sort) {
        if (!in_array($item_sort["ID"],$filter) && $key != "PROPERTY_TYPE" && $key != "NAME" && $key != "SORT") {
            unset($arResult["ITEMS"][1][$key]);
        }
    }
}