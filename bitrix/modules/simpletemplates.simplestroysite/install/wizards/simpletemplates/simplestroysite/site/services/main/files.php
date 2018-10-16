<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if (!defined("WIZARD_SITE_ID") || !defined("WIZARD_SITE_DIR"))
    return;

function ___writeToAreasFile($path, $text)
{
    $fd = @fopen($path, "wb");
    if(!$fd)
        return false;

    if(false === fwrite($fd, $text))
    {
        fclose($fd);
        return false;
    }

    fclose($fd);

    if(defined("BX_FILE_PERMISSIONS"))
        @chmod($path, BX_FILE_PERMISSIONS);
}

if (COption::GetOptionString("main", "upload_dir") == "")
    COption::SetOptionString("main", "upload_dir", "upload");

if(WIZARD_INSTALL_DEMO_DATA)
{
    if(file_exists(WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/"))
    {
        CopyDirFiles(
            WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/",
            WIZARD_SITE_PATH,
            $rewrite = true,
            $recursive = true,
            $delete_after_copy = false
        );
    }
}

$wizard =& $this->GetWizard();

CheckDirPath(WIZARD_SITE_PATH."smt_include/");

$siteLogo = $wizard->GetVar("siteLogo");

if($siteLogo>0)
{
    $ff = CFile::GetByID($siteLogo);
    if($zr = $ff->Fetch())
    {
        $strOldFile = str_replace("//", "/", WIZARD_SITE_ROOT_PATH."/".(COption::GetOptionString("main", "upload_dir", "upload"))."/".$zr["SUBDIR"]."/".$zr["FILE_NAME"]);
        @copy($strOldFile, WIZARD_SITE_PATH."smt_images/logo." . pathinfo($strOldFile, PATHINFO_EXTENSION));
        ___writeToAreasFile(WIZARD_SITE_PATH."smt_include/logo.php", '<img src="'.WIZARD_SITE_DIR.'smt_images/logo.'.pathinfo($strOldFile, PATHINFO_EXTENSION).'" alt="" />');
        ___writeToAreasFile(WIZARD_SITE_PATH."smt_include/logo_affix.php", '<img src="'.WIZARD_SITE_DIR.'smt_images/logo.'.pathinfo($strOldFile, PATHINFO_EXTENSION).'" alt="" />');
        CFile::Delete($siteLogo);
    }
}
else
{
    $imageExts = array('png', 'gif', 'jpg', 'jpeg');
    foreach ($imageExts as $ext) {
        if(file_exists(WIZARD_TEMPLATE_ABSOLUTE_PATH."/assets/img/".substr(WIZARD_THEME_ID, 7, strlen(WIZARD_THEME_ID)-1)."/logo." . $ext)) {
            @copy(WIZARD_TEMPLATE_ABSOLUTE_PATH."/assets/img/".substr(WIZARD_THEME_ID, 7, strlen(WIZARD_THEME_ID)-1)."/logo." . $ext, WIZARD_SITE_PATH."smt_include/logo." . $ext);
            ___writeToAreasFile(WIZARD_SITE_PATH."smt_include/logo.php", '<img src="'.WIZARD_SITE_DIR.'smt_images/logo.'.$ext.'" alt="" />');
            ___writeToAreasFile(WIZARD_SITE_PATH."smt_include/logo_affix.php", '<img src="'.WIZARD_SITE_DIR.'smt_images/logo.'.$ext.'" alt="" />');
        }
    }
}

if(!WIZARD_INSTALL_DEMO_DATA)
    return;

WizardServices::PatchHtaccess(WIZARD_SITE_PATH);

CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_callback.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_services_text.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/footer_address.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_services.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/contact_form.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order_main.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/top_label.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order_sidebar.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_consult.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/footer_copyright.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/top_phone.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_info1.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_info2.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_question.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_projects.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/news/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/promo/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/.left.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.".top.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."gallery/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."service/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."blog/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.".smt_popular.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.".smt_footer.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."projects/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."_index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_callback.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_services_text.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/footer_address.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_services.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/contact_form.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order_main.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/top_label.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order_sidebar.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_consult.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/footer_copyright.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/top_phone.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_info1.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_info2.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_question.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/main_projects.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/news/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/promo/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."company/.left.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.".top.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."gallery/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."service/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."blog/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.".smt_popular.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.".smt_footer.menu.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."projects/index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."_index.php", array("MACROS_SITE_NAME" => $wizard->GetVar("SITE_NAME"),"MACROS_SITE_DESCR" => $wizard->GetVar("SITE_DESCR"),"MACROS_SITE_ADDRESS" => $wizard->GetVar("SITE_ADDRESS"),"MACROS_SITE_SECOND_ADDRESS" => $wizard->GetVar("SITE_SECOND_ADDRESS"),"MACROS_SITE_PHONE" => $wizard->GetVar("SITE_PHONE"),"MACROS_SITE_YEAR" => $wizard->GetVar("SITE_YEAR"),"SITE_DIR" => WIZARD_SITE_DIR));;

$arUrlRewrite = array();
if (file_exists(WIZARD_SITE_ROOT_PATH."/urlrewrite.php"))
{
    include(WIZARD_SITE_ROOT_PATH."/urlrewrite.php");
}

$arNewUrlRewrite = array(
    array (
  'CONDITION' => '#^'.WIZARD_SITE_DIR.'company/promo/#',
  'RULE' => '',
  'ID' => 'bitrix:news',
  'PATH' => WIZARD_SITE_DIR.'company/promo/index.php',
),array (
  'CONDITION' => '#^'.WIZARD_SITE_DIR.'company/news/#',
  'RULE' => '',
  'ID' => 'bitrix:news',
  'PATH' => WIZARD_SITE_DIR.'company/news/index.php',
),array (
  'CONDITION' => '#^'.WIZARD_SITE_DIR.'projects/#',
  'RULE' => '',
  'ID' => 'bitrix:catalog',
  'PATH' => WIZARD_SITE_DIR.'projects/index.php',
),array (
  'CONDITION' => '#^'.WIZARD_SITE_DIR.'service/#',
  'RULE' => '',
  'ID' => 'bitrix:news',
  'PATH' => WIZARD_SITE_DIR.'service/index.php',
),array (
  'CONDITION' => '#^'.WIZARD_SITE_DIR.'gallery/#',
  'RULE' => '',
  'ID' => 'bitrix:news',
  'PATH' => WIZARD_SITE_DIR.'gallery/index.php',
),array (
  'CONDITION' => '#^'.WIZARD_SITE_DIR.'blog/#',
  'RULE' => '',
  'ID' => 'bitrix:news',
  'PATH' => WIZARD_SITE_DIR.'blog/index.php',
)
);

foreach ($arNewUrlRewrite as $arUrl)
{
    if (!in_array($arUrl, $arUrlRewrite))
    {
        CUrlRewriter::Add($arUrl);
    }
}

?>