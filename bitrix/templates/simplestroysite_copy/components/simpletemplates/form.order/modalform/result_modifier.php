<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
    return;
}

foreach($arParams["PROPERTY_CODES"] as $property) {
    if (!in_array($property, $arResult["PROPERTY_LIST"])) {
        unset($arParams["PROPERTY_CODES"][$property]);
    }
}

$arProperties = $arParams["PROPERTY_CODES"];
$arParams["FIELDS_ORDER"] = explode(',', $arParams["FIELDS_ORDER"]);
if(isset($arParams["FIELDS_ORDER"]) && !empty($arParams["FIELDS_ORDER"])) {
    $arProperties = array();
    foreach($arParams["FIELDS_ORDER"] as $property) {
        if (in_array($property, $arParams["PROPERTY_CODES"])) {
            $arProperties[] = $property;
        }
    }
}

foreach($arParams["PROPERTY_CODES"] as $property) {
    if (!in_array($property, $arProperties)) {
        $arProperties[] = $property;
    }
}

if(empty($arProperties)) {
    $arProperties = $arParams["PROPERTY_CODES"];
}

$arResult["PROPERTY_LIST"] = $arProperties;

$propertiesIcon = array(
    "NAME" => array('glyphicon', 'glyphicon-user'),
    "PHONE" => array('glyphicon', 'glyphicon-phone'),
    "EMAIL" => array('glyphicon', 'glyphicon-envelope'),
    "DATE" => array('glyphicon', 'glyphicon-calendar'),
    "DETAIL_TEXT" => array('glyphicon', 'glyphicon-chevron-down'),
);

$addClass = array(
    "DATE" => array('date-control'),
);

$addGroupClass = array(
    "DATE" => array('form-group-relative'),
    "AGREEMENT" => array('smt-form-agreement'),
);

if($arParams["FORMS_DISABLE_AGREEMENT"] == "Y") {
    $addGroupClass["AGREEMENT"][] = "hidden";
}

foreach($arResult["PROPERTY_LIST_FULL"] as $propertyID=>$property) {
    $code = intval($propertyID)?$property["CODE"]:$propertyID;
    if (isset($propertiesIcon[$code]) && $propertiesIcon[$code] && $arParams["DISPLAY_ICON"] == "Y") {
        $arResult["PROPERTY_LIST_FULL"][$propertyID]["SMT_ICON"] = $propertiesIcon[$code];
    }

    if (isset($addClass[$code]) && $addClass[$code]) {
        $arResult["PROPERTY_LIST_FULL"][$propertyID]["SMT_ADD_CLASS"] = $addClass[$code];
    }

    if (isset($addGroupClass[$code]) && $addGroupClass[$code]) {
        $arResult["PROPERTY_LIST_FULL"][$propertyID]["SMT_ADD_GROUP_CLASS"] = $addGroupClass[$code];
    }

    if ($property["CODE"] == "OBJECT_ID") {
        if(isset($arParams["OBJECT_ID"]) || isset($_GET["OBJECT_ID"])) {
            $objectID = false;
            if(isset($_GET["OBJECT_ID"]) && intval($_GET["OBJECT_ID"]) > 0) {
                $objectID = intval($_GET["OBJECT_ID"]);
            }
            if(isset($arParams["OBJECT_ID"]) && intval($arParams["OBJECT_ID"]) > 0) {
                $objectID = intval($arParams["OBJECT_ID"]);
            }
            if($objectID) {
                $res = CIBlockElement::GetByID($objectID);
                if($arItemResult = $res->GetNext()) {
                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"] = $arItemResult["ID"];
                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["DISPLAY_VALUE"] = $arItemResult["NAME"];
                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] = "";
                }
            }
        }

        if(!empty($_POST) && $arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"] > 0) {
            $res = CIBlockElement::GetByID(intval($arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]));
            if($arItemResult = $res->GetNext()) {
                $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] = "";
                $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"] = $arItemResult["ID"];
                $arResult["PROPERTY_LIST_FULL"][$propertyID]["DISPLAY_VALUE"] = $arItemResult["NAME"];
            }
        }
    }

    if ($property["CODE"] == "FORM_SUFFIX") {
        if(isset($arParams["FORM_SUFFIX"])) {
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"] = $arParams["FORM_SUFFIX"];
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "HIDDEN";
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] = "";
        }
        if(!empty($_POST) && $arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"] > 0) {
        }
    }
}