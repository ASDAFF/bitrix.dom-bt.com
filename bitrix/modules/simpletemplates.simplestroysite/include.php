<?
IncludeModuleLangFile(__FILE__);
class CSimpletemplatesSimplestroysite
{
    function ShowPanel()
    {
        if ($GLOBALS["USER"]->IsAdmin() && COption::GetOptionString("main", "wizard_solution", "", SITE_ID) == "simplestroysite")
        {
            $GLOBALS["APPLICATION"]->AddPanelButton(array(
                "HREF" => "/bitrix/admin/settings.php?mid=simpletemplates.simplestroysite&lang=".LANGUAGE_ID."&siteTabControl_active_tab=opt_site_".SITE_ID."&".bitrix_sessid_get(),
                "ID" => "demo_simplestroysite_wizard",
                "ICON" => "bx-panel-site-wizard-icon",
                "MAIN_SORT" => 2500,
                "TYPE" => "BIG",
                "SORT" => 10,
                "ALT" => GetMessage("SIMPLET_BUTTON_DESCRIPTION"),
                "TEXT" => GetMessage("SIMPLET_BUTTON_NAME"),
                "MENU" => array(),
            ));
        }
    }
}

require_once ($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/simpletemplates.simplestroysite/vendors/lessphp/Less.php");
?>