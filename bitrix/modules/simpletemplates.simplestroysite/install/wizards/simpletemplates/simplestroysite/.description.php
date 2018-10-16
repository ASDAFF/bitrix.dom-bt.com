<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!defined("WIZARD_DEFAULT_SITE_ID") && !empty($_REQUEST["wizardSiteID"]))
    define("WIZARD_DEFAULT_SITE_ID", $_REQUEST["wizardSiteID"]);

$arWizardDescription = Array(
    "NAME" => GetMessage("WIZARD_NAME_SIMPLESTROYSITE"),
    "DESCRIPTION" => GetMessage("WIZARD_DESCRIPTION_SIMPLESTROYSITE"),
    "VERSION" => "1.0.0",
    "START_TYPE" => "WINDOW",
    "WIZARD_TYPE" => "INSTALL",
    "IMAGE" => "/images/".LANGUAGE_ID."/solution.png",
    "PARENT" => "wizard_sol",
    "TEMPLATES" => Array(
        Array("SCRIPT" => "wizard_sol")
    ),
    "STEPS" => array(),
);
if(defined("WIZARD_DEFAULT_SITE_ID"))
{
    if(LANGUAGE_ID == "ru")
        $arWizardDescription["STEPS"] = Array("SelectTemplateStep", "SelectThemeStep", "SiteSettingsStep", "DataInstallStep" ,"FinishStep");
    else
        $arWizardDescription["STEPS"] = Array("SelectTemplateStep", "SelectThemeStep", "SiteSettingsStep", "DataInstallStep" ,"FinishStep");
}
else
{
    if(LANGUAGE_ID == "ru")
        $arWizardDescription["STEPS"] = Array("SelectSiteStep", "SelectTemplateStep", "SelectThemeStep", "SiteSettingsStep", "DataInstallStep" ,"FinishStep");
    else
        $arWizardDescription["STEPS"] = Array("SelectSiteStep", "SelectTemplateStep", "SelectThemeStep", "SiteSettingsStep", "DataInstallStep" ,"FinishStep");
}
?>