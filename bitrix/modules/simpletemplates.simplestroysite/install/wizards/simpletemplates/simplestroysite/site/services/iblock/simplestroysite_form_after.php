<?php

if ($iblockID) {
    $dbRes = CIBlock::GetProperties($iblockID);
    $props = array();
    $arReplace = array();
    while($prop = $dbRes->GetNext()) {
        if ($prop["CODE"] == "PHONE" ||
            $prop["CODE"] == "EMAIL" ||
            $prop["CODE"] == "FORM_SUFFIX" ||
            $prop["CODE"] == "OBJECT_ID" ||
            $prop["CODE"] == "AGREEMENT"
        ) {
            $arReplace[$prop["CODE"]] = $prop["ID"];
        }
    }

    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblockID, "CODE"=>"AGREEMENT"));
    while($enum_fields = $property_enums->GetNext())
    {
        $ibpenum = new CIBlockPropertyEnum();
        $ibpenum->Update($enum_fields["ID"], Array('VALUE' => str_replace('/company/agreement/', WIZARD_SITE_DIR . 'company/agreement/', $enum_fields["~VALUE"])));
    }

    CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order_main.php", $arReplace);
    CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_callback.php", $arReplace);
    CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_question.php", $arReplace);
    CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order.php", $arReplace);
    CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_consult.php", $arReplace);
    CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/form_order_sidebar.php", $arReplace);
    CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."smt_include/contact_form.php", $arReplace);
}