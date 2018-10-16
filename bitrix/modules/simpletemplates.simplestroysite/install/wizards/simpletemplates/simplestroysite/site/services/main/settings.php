<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

COption::SetOptionString("iblock", "use_htmledit", "Y");
COption::SetOptionString("fileman", "propstypes", serialize(array(
    "description"=>GetMessage("MAIN_OPT_DESCRIPTION"),
    "keywords"=>GetMessage("MAIN_OPT_KEYWORDS"),
    "title"=>GetMessage("MAIN_OPT_TITLE"),
    "keywords_inner"=>GetMessage("MAIN_OPT_KEYWORDS_INNER"),
    "smt_col_12"=>GetMessage("SMT_OPT_COL_12"),
    "smt_page_background"=>GetMessage("SMT_OPT_PAGE_BACKGROUND"),
    "smt_sidebar_right"=>GetMessage("SMT_OPT_SIDEBAR_RIGHT"),
    "smt_show_sidebar_search"=>GetMessage("SMT_OPT_SHOW_SIDEBAR_SEARCH"),
    "smt_show_sidebar_text"=>GetMessage("SMT_OPT_SHOW_SIDEBAR_TEXT"),
    "smt_show_content_bottom"=>GetMessage("SMT_OPT_SHOW_CONTENT_BOTTOM"),
    "smt_show_form_top"=>GetMessage("SMT_OPT_SHOW_FORM_TOP"),
    "smt_menu_main_smart"=>GetMessage("SMT_OPT_MENU_MAIN_SMART"),
    "smt_navbar_fixed"=>GetMessage("SMT_OPT_NAVBAR_FIXED"),
    "smt_sticky_footer"=>GetMessage("SMT_OPT_STICKY_FOOTER"),
    "smt_add_section_menu"=>GetMessage("SMT_OPT_ADD_SECTION_MENU"),
    "smt_show_sidebar_form"=>GetMessage("SMT_OPT_SHOW_SIDEBAR_FORM"),
    "smt_show_sidebar_banner"=>GetMessage("SMT_OPT_SHOW_SIDEBAR_BANNER"),
    "smt_show_button_up"=>GetMessage("SMT_OPT_SHOW_BUTTON_UP"),
    "smt_show_sidebar_article"=>GetMessage("SMT_OPT_SHOW_SIDEBAR_ARTICLE"),
)), false, $siteID);

COption::SetOptionString("search", "use_tf_cache", "Y");
COption::SetOptionString("search", "use_word_distance", "Y");
COption::SetOptionString("search", "use_social_rating", "Y");

if (COption::GetOptionString("socialservices", "auth_services") == "")
{
    $bRu = (LANGUAGE_ID == 'ru');
    $arServices = array(
        "VKontakte" => "N",
        "MyMailRu" => "N",
        "Twitter" => "N",
        "Facebook" => "N",
        "Livejournal" => "Y",
        "YandexOpenID" => ($bRu? "Y":"N"),
        "Rambler" => ($bRu? "Y":"N"),
        "MailRuOpenID" => ($bRu? "Y":"N"),
        "Liveinternet" => ($bRu? "Y":"N"),
        "Blogger" => "Y",
        "OpenID" => "Y",
        "LiveID" => "N",
    );
    COption::SetOptionString("socialservices", "auth_services", serialize($arServices));
}
?>