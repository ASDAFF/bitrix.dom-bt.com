<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/install/wizard_sol/wizard.php");

class SelectSiteStep extends CSelectSiteWizardStep
{
    function InitStep()
    {
        parent::InitStep();

        $wizard =& $this->GetWizard();
        $wizard->solutionName = "simplestroysite";
    }
}


class SelectTemplateStep extends CSelectTemplateWizardStep
{
    function OnPostForm() {
        $wizard =& $this->GetWizard();

        $proactive = COption::GetOptionString("statistic", "DEFENCE_ON", "N");
        if ($proactive == "Y")
        {
            COption::SetOptionString("statistic", "DEFENCE_ON", "N");
            $wizard->SetVar("proactive", "Y");
        }
        else
        {
            $wizard->SetVar("proactive", "N");
        }

        parent::OnPostForm();
    }
}

class SelectThemeStep extends CSelectThemeWizardStep
{

}

class SiteSettingsStep extends CSiteSettingsWizardStep
{
    function InitStep()
    {
        $wizard =& $this->GetWizard();
        $wizard->solutionName = "simplestroysite";
        parent::InitStep();

        $this->SetNextCaption(GetMessage("NEXT_BUTTON"));
        $this->SetTitle(GetMessage("WIZ_STEP_SITE_SET"));

        $siteID = $wizard->GetVar("siteID");
        $wizardPath = $wizard->GetPath();
        $templatesPath = WizardServices::GetTemplatesPath($wizardPath . "/site");
        $templateID = $wizard->GetVar("templateID");
        $themeID = $wizard->GetVar($templateID."_themeID");
        $themeName = substr($themeID, 7, strlen($themeID)-1);

        $defaultLogo = $templatesPath . "/". $templateID . "/assets/img/".$themeName."/logo.png";

        $siteLogo = $this->GetFileContentImgSrc(WIZARD_SITE_PATH."smt_include/logo.php", $defaultLogo);
        if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $siteLogo)) {
            $siteLogo = $defaultLogo;
        }

        $wizard->SetDefaultVars(
            Array(
                "siteLogo" => $siteLogo,
                "SITE_NAME" => GetMessage("WIZ_SITE_NAME_DEF"),
"SITE_DESCR" => GetMessage("WIZ_SITE_DESCR_DEF"),
"SITE_ADDRESS" => GetMessage("WIZ_SITE_ADDRESS_DEF"),
"SITE_SECOND_ADDRESS" => GetMessage("WIZ_SITE_SECOND_ADDRESS_DEF"),
"SITE_PHONE" => GetMessage("WIZ_SITE_PHONE_DEF"),
"SITE_YEAR" => GetMessage("WIZ_SITE_YEAR_DEF"),
            )
        );
    }

    function ShowStep()
    {
        $wizard =& $this->GetWizard();

        $this->content .= '<div class="wizard-input-form">';

        $this->content .= '
                <div class="wizard-input-form-block">
			        <label for="SITE_NAME" class="wizard-input-title">'.GetMessage("WIZ_SITE_NAME").'</label>
                    '.$this->ShowInputField('text', 'SITE_NAME', array("id" => "SITE_NAME", "class" => "wizard-field")).'
                </div>';
$this->content .= '
                <div class="wizard-input-form-block">
			        <label for="SITE_DESCR" class="wizard-input-title">'.GetMessage("WIZ_SITE_DESCR").'</label>
                    '.$this->ShowInputField('text', 'SITE_DESCR', array("id" => "SITE_DESCR", "class" => "wizard-field")).'
                </div>';
$this->content .= '
                <div class="wizard-input-form-block">
			        <label for="SITE_ADDRESS" class="wizard-input-title">'.GetMessage("WIZ_SITE_ADDRESS").'</label>
                    '.$this->ShowInputField('text', 'SITE_ADDRESS', array("id" => "SITE_ADDRESS", "class" => "wizard-field")).'
                </div>';
$this->content .= '
                <div class="wizard-input-form-block">
			        <label for="SITE_SECOND_ADDRESS" class="wizard-input-title">'.GetMessage("WIZ_SITE_SECOND_ADDRESS").'</label>
                    '.$this->ShowInputField('text', 'SITE_SECOND_ADDRESS', array("id" => "SITE_SECOND_ADDRESS", "class" => "wizard-field")).'
                </div>';
$this->content .= '
                <div class="wizard-input-form-block">
			        <label for="SITE_PHONE" class="wizard-input-title">'.GetMessage("WIZ_SITE_PHONE").'</label>
                    '.$this->ShowInputField('text', 'SITE_PHONE', array("id" => "SITE_PHONE", "class" => "wizard-field")).'
                </div>';
$this->content .= '
                <div class="wizard-input-form-block">
			        <label for="SITE_YEAR" class="wizard-input-title">'.GetMessage("WIZ_SITE_YEAR").'</label>
                    '.$this->ShowInputField('text', 'SITE_YEAR', array("id" => "SITE_YEAR", "class" => "wizard-field")).'
                </div>';;

        $siteLogo = $wizard->GetVar("siteLogo", true);

        $this->content .= '<div class="wizard-upload-img-block"><div class="wizard-catalog-title">'.GetMessage("WIZ_COMPANY_LOGO").'</div>';
        $this->content .= CFile::ShowImage($siteLogo, 9999, 60, "border=0 vspace=15");
        $this->content .= "<br />".$this->ShowFileField("siteLogo", Array("show_file_info" => "N", "id" => "site-logo")).'</div>';

        $firstStep = COption::GetOptionString("main", "wizard_first" . substr($wizard->GetID(), 7)  . "_" . $wizard->GetVar("siteID"), false, $wizard->GetVar("siteID"));
        $styleMeta = 'style="display:block"';
        if($firstStep == "Y") $styleMeta = 'style="display:none"';

//install Demo data
        if($firstStep == "Y")
        {
            $this->content .= '
			<div class="wizard-input-form-block"'.(LANGUAGE_ID != "ru" ? ' style="display:none"' : '').'>
				'.$this->ShowCheckboxField(
                    "installDemoData",
                    "Y",
                    (array("id" => "installDemoData", "onClick" => "if(this.checked == true){document.getElementById('bx_metadata').style.display='block';}else{document.getElementById('bx_metadata').style.display='none';}"))
                ).'
				<label for="installDemoData">'.GetMessage("wiz_structure_data").'</label>
			</div>';
        }
        else
        {
            $this->content .= $this->ShowHiddenField("installDemoData","Y");
        }

        $this->content .= '</div>';
    }
    function OnPostForm()
    {
        $wizard =& $this->GetWizard();
        $res = $this->SaveFile("siteLogo", Array("extensions" => "gif,jpg,jpeg,png", "max_height" => 60, "max_width" => 350));
    }
}

class DataInstallStep extends CDataInstallWizardStep
{
    function CorrectServices(&$arServices)
    {
        $wizard =& $this->GetWizard();
        if($wizard->GetVar("installDemoData") != "Y")
        {
        }
    }
}

class FinishStep extends CFinishWizardStep
{
    function InitStep()
    {
        $this->SetStepID("finish");
        $this->SetNextStep("finish");
        $this->SetTitle(GetMessage("FINISH_STEP_TITLE"));
        $this->SetNextCaption(GetMessage("wiz_go"));
    }

    function ShowStep()
    {
        $wizard =& $this->GetWizard();
        if ($wizard->GetVar("proactive") == "Y")
            COption::SetOptionString("statistic", "DEFENCE_ON", "Y");

        $siteID = WizardServices::GetCurrentSiteID($wizard->GetVar("siteID"));
        $rsSites = CSite::GetByID($siteID);
        $siteDir = "/";
        if ($arSite = $rsSites->Fetch())
            $siteDir = $arSite["DIR"];

        $wizard->SetFormActionScript(str_replace("//", "/", $siteDir."/?finish"));

        $this->CreateNewIndex();

        COption::SetOptionString("main", "wizard_solution", $wizard->solutionName, false, $siteID);

        $this->content .=
            '<table class="wizard-completion-table">
				<tr>
					<td class="wizard-completion-cell">'
            .GetMessage("FINISH_STEP_CONTENT").
            '</td>
				</tr>
			</table>';

        if ($wizard->GetVar("installDemoData") == "Y")
            $this->content .= GetMessage("FINISH_STEP_REINDEX");

    }

}
?>