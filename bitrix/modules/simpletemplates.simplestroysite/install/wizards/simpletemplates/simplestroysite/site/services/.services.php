<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arServices = Array(
    "main" => Array(
        "NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
        "STAGES" => Array(
            "files.php",
//            "search.php",
            "template.php",
            "theme.php",
            "events.php",
            "menu.php",
            "settings.php",
        ),
    ),
    "iblock" => Array(
        "NAME" => GetMessage("SERVICE_IBLOCK_DEMO_DATA"),
        "STAGES" => Array(
            "types.php",
            "simplestroysite_smt_slider.php",
"simplestroysite_smt_benefit.php",
"simplestroysite_smt_project.php",
"simplestroysite_smt_action.php",
"simplestroysite_smt_news.php",
"simplestroysite_smt_social.php",
"simplestroysite_smt_form.php",
"simplestroysite_smt_photogallery.php",
"simplestroysite_smt_document.php",
"simplestroysite_smt_review.php",
"simplestroysite_smt_price.php",
"simplestroysite_smt_service.php",
"simplestroysite_smt_article.php",
"simplestroysite_smt_history.php",
"simplestroysite_smt_vacancy.php",
"simplestroysite_smt_contact.php",
"simplestroysite_smt_faq.php",
"simplestroysite_smt_worker.php",
"simplestroysite_smt_service_main.php",
        ),
    ),
);
?>