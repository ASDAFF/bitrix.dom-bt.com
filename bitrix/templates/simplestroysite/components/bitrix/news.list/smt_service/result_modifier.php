<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$widthPreview = 150;
$heightPreview = 150;

foreach ($arResult["ITEMS"] as $count=>$arItem) {
    if ($arItem["DETAIL_PICTURE"]) {
        $file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=> $widthPreview, 'height'=> $heightPreview), BX_RESIZE_IMAGE_EXACT, true);
        $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["SRC"] = $file["src"];
        $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["WIDTH"] = $file["width"];
        $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["HEIGHT"] = $file["height"];
    } elseif($arItem["PREVIEW_PICTURE"]) {
        $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=> $widthPreview, 'height'=> $heightPreview), BX_RESIZE_IMAGE_EXACT, true);
        $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["SRC"] = $file["src"];
        $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["WIDTH"] = $file["width"];
        $arResult["ITEMS"][$count]["PREVIEW_PICTURE"]["HEIGHT"] = $file["height"];
    }
}

