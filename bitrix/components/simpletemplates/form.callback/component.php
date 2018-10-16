<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

if(strlen($arParams["FILTER_NAME"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
    $arParams["FILTER_NAME"] = "formFilter";
$FILTER_NAME = $arParams["FILTER_NAME"];

global ${$FILTER_NAME};
${$FILTER_NAME} = array();
if(!empty($arParams["AJAX_FORM_ID"])) {
    foreach ($arParams["AJAX_FORM_ID"] as $count=>$formId) {
        if($arParams["FORM_FILES"][$count]) {
            ${$FILTER_NAME}[$formId] = $arParams["FORM_FILES"][$count];
        }
    }
}
?>