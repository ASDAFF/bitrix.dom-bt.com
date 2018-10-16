<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(!CModule::IncludeModule("iblock"))
    return;

if(!WIZARD_INSTALL_DEMO_DATA)
    return;

$arTypes = array (
  0 => 
  array (
    'ID' => 'smt_form',
    'SECTIONS' => 'Y',
    'IN_RSS' => 'N',
    'SORT' => '500',
    'LANG' => 
    array (
    ),
  ),
  1 => 
  array (
    'ID' => 'smt_promo',
    'SECTIONS' => 'Y',
    'IN_RSS' => 'N',
    'SORT' => '500',
    'LANG' => 
    array (
    ),
  ),
  2 => 
  array (
    'ID' => 'smt_company',
    'SECTIONS' => 'Y',
    'IN_RSS' => 'N',
    'SORT' => '500',
    'LANG' => 
    array (
    ),
  ),
  3 => 
  array (
    'ID' => 'smt_content',
    'SECTIONS' => 'Y',
    'IN_RSS' => 'N',
    'SORT' => '500',
    'LANG' => 
    array (
    ),
  ),
);

$arLanguages = Array();
$rsLanguage = CLanguage::GetList($by, $order, array());
while($arLanguage = $rsLanguage->Fetch()) {
    $arLanguages[] = $arLanguage["LID"];
}

$iblockType = new CIBlockType;
foreach($arTypes as $arType)
{
    $dbType = CIBlockType::GetList(Array(),Array("=ID" => $arType["ID"]));
    if($dbType->Fetch()) {
        continue;
    }

    foreach($arLanguages as $languageID)
    {
        WizardServices::IncludeServiceLang("type.php", $languageID);

        $code = strtoupper($arType["ID"]);
        $arType["LANG"][$languageID]["NAME"] = GetMessage($code."_TYPE_NAME");
        $arType["LANG"][$languageID]["ELEMENT_NAME"] = GetMessage($code."_ELEMENT_NAME");

        if ($arType["SECTIONS"] == "Y") {
            $arType["LANG"][$languageID]["SECTION_NAME"] = GetMessage($code."_SECTION_NAME");
        }
    }

    $iblockType->Add($arType);
}

COption::SetOptionString('iblock','combined_list_mode','Y');
?>