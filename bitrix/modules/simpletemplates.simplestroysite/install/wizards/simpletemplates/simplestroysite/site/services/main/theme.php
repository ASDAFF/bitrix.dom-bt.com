<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!defined("WIZARD_TEMPLATE_ID"))
    return;

$templateDir = BX_PERSONAL_ROOT . "/templates/" . WIZARD_TEMPLATE_ID;

CopyDirFiles(
    $_SERVER["DOCUMENT_ROOT"].$templateDir . '/themes/' . WIZARD_THEME_ID . '/template.css',
    $_SERVER["DOCUMENT_ROOT"].$templateDir . '/assets/css/colors/template_'.WIZARD_SITE_ID.'.css',
    $rewrite = true,
    $recursive = false,
    $delete_after_copy = false,
    $exclude = "description.php"
);

CopyDirFiles(
    $_SERVER["DOCUMENT_ROOT"].$templateDir . '/themes/' . WIZARD_THEME_ID . '/template.min.css',
    $_SERVER["DOCUMENT_ROOT"].$templateDir . '/assets/css/colors/template_'.WIZARD_SITE_ID.'.min.css',
    $rewrite = true,
    $recursive = false,
    $delete_after_copy = false,
    $exclude = "description.php"
);

COption::SetOptionString("main", "wizard_".WIZARD_TEMPLATE_ID."_theme_id", WIZARD_THEME_ID, "", WIZARD_SITE_ID);
?>