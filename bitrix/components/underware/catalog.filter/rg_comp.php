<?
if ( ! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){
    die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
global $DB;
/** @global CUser $USER */
global $USER;
/** @global CMain $APPLICATION */
global $APPLICATION;

/*************************************************************************
 * Processing of received parameters
 *************************************************************************/
if ( ! isset($arParams["CACHE_TIME"])){
    $arParams["CACHE_TIME"] = 36000000;
}
$arParams["AJAX_MODE"] = 'Y';
unset($arParams["IBLOCK_TYPE"]); //was used only for IBLOCK_ID setup with Editor
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

if ( ! is_array($arParams["FIELD_CODE"])){
    $arParams["FIELD_CODE"] = array ();
}
foreach ($arParams["FIELD_CODE"] as $k => $v){
    if ($v === ""){
        unset($arParams["FIELD_CODE"][ $k ]);
    }
}

if ( ! is_array($arParams["PROPERTY_CODE"])){
    $arParams["PROPERTY_CODE"] = array ();
}
foreach ($arParams["PROPERTY_CODE"] as $k => $v){
    if ($v === ""){
        unset($arParams["PROPERTY_CODE"][ $k ]);
    }
}

$arParams["NUMBER_WIDTH"] = intval($arParams["NUMBER_WIDTH"]);
if ($arParams["NUMBER_WIDTH"] <= 0){
    $arParams["NUMBER_WIDTH"] = 5;
}


if ( ! CModule::IncludeModule("iblock")){
    ShowError(GetMessage("CC_BCF_MODULE_NOT_INSTALLED"));

    return 0;
}
$arProperties = array ();
$items        = array ();
$sortedItems  = array ();
$properties   = CIBlockProperty::GetList(Array (
    "sort" => "asc",
    "name" => "asc"
), Array ("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_ID"]));

while ($prop_fields = $properties->GetNext()){
    if (in_array($prop_fields['CODE'], $arParams["PROPERTY_CODE"])){
        foreach ($arParams[ 'PROPERTY_' . $prop_fields['CODE'] . '_VALUE' ] as $k => $v){
            if ($v === ""){
                unset($arParams[ 'PROPERTY_' . $prop_fields['CODE'] . '_VALUE' ][ $k ]);
            }
        }
        if ($prop_fields['PROPERTY_TYPE'] == 'L'){

            $enum_list = CIBlockPropertyEnum::GetList(Array ("SORT" => "ASC", "NAME" => "ASC"), Array (
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "CODE"      => $prop_fields['CODE']
            ));
            while ($arEnumprop = $enum_list->GetNext()){

                if (in_array($arEnumprop['ID'], $arParams[ 'PROPERTY_' . $prop_fields['CODE'] . '_VALUE' ])){
                    $items[ $prop_fields['CODE'] ][] = array (
                        'PROPERTY_ID' => $arEnumprop['PROPERTY_ID'],
                        'ID'          => $arEnumprop['ID'],
                        'VALUE'       => $arEnumprop['VALUE'],
                    );
                }
            }
            $items[ $prop_fields['CODE'] ]['PROPERTY_TYPE'] = 'L';
            $items[ $prop_fields['CODE'] ]['SORT']          = $arParams[ $prop_fields['CODE'] . '_SORT' ][0];
            $items[ $prop_fields['CODE'] ]['NAME']          = $prop_fields['NAME'];
        }elseif ($prop_fields['PROPERTY_TYPE'] == 'S' ||
            $prop_fields['PROPERTY_TYPE'] == 'N'
        ){
            $items[ $prop_fields['CODE'] ]['ID']            = $prop_fields['ID'];
            $items[ $prop_fields['CODE'] ]['NAME']          = $prop_fields['NAME'];
            $items[ $prop_fields['CODE'] ]['PROPERTY_TYPE'] = $prop_fields['PROPERTY_TYPE'];
            $items[ $prop_fields['CODE'] ]['VALUE']         = $arParams[ 'PROPERTY_' . $prop_fields['CODE'] . '_VALUE' ];
            $items[ $prop_fields['CODE'] ]['SORT']          = intval($arParams[ $prop_fields['CODE'] . '_SORT' ][0]);
        }
    }
}
foreach ($items as $item){
    if (array_key_exists($item['SORT'], $sortedItems)){
        $item['SORT'] ++;
    }
    $sortedItems[ $item['SORT'] ] = $item;
}
$arResult['ITEMS'] = $sortedItems;

$this->IncludeComponentTemplate();
