<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentName */
/** @var string $componentPath */
/** @var string $componentTemplate */
/** @var string $parentComponentName */
/** @var string $parentComponentPath */
/** @var string $parentComponentTemplate */

if(!isset($arParams["MESSAGE"]) || strlen($arParams["MESSAGE"])<=0) {
	$arParams["MESSAGE"] = GetMessage("SMT_SBQC_MESSAGE_DEFAULT");
} else {
	$arParams["MESSAGE"] = htmlspecialcharsbx($arParams["MESSAGE"]);
}

if(!isset($arParams["BUTTON"]) || strlen($arParams["BUTTON"])<=0) {
	$arParams["BUTTON"] = GetMessage("SMT_SBQC_BUTTON_DEFAULT");
} else {
	$arParams["BUTTON"] = htmlspecialcharsbx($arParams["BUTTON"]);
}

if(!isset($arParams["LINK"]) || strlen($arParams["LINK"])<=0) {
	$arParams["LINK"] = GetMessage("SMT_SBQC_LINK_DEFAULT");
} else {
	$arParams["LINK"] = htmlspecialcharsbx(str_replace("#SITE_DIR#", SITE_DIR, $arParams["LINK"]));
}

if(!isset($arParams["BACKGROUND_IMAGE"]) || strlen($arParams["BACKGROUND_IMAGE"])<=0) {
	$arParams["BACKGROUND_IMAGE"] = '';
} else {
	$arParams["BACKGROUND_IMAGE"] = htmlspecialcharsbx(str_replace("#SITE_DIR#", SITE_DIR, $arParams["BACKGROUND_IMAGE"]));
}

if(!isset($arParams["POPUP"])) {
	$arParams["POPUP"] = '';
} else {
	$arParams["POPUP"] = ($arParams["POPUP"])?"Y":"";
}

if(!isset($arParams["LINK_CLASS"])) {
	$arParams["LINK_CLASS"] = [];
} else {
	$arResult["LINK_CLASS"] = explode(' ', $arParams["LINK_CLASS"]);
}

if(!isset($arParams["FIXED_BACKGROUND"])) {
	$arParams["FIXED_BACKGROUND"] = '';
} else {
	$arParams["FIXED_BACKGROUND"] = ($arParams["FIXED_BACKGROUND"])?"Y":"";
}

$arResult["MESSAGE"] = $arParams["MESSAGE"];
$arResult["LINK"] = $arParams["LINK"];
$arResult["BUTTON"] = $arParams["BUTTON"];
$arResult["BACKGROUND_IMAGE"] = $arParams["BACKGROUND_IMAGE"];
if ($arParams["POPUP"]) {
	$arResult["LINK_CLASS"][] = 'smt-popup-link-js';
}

$this->IncludeComponentTemplate();