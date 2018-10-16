<?php

if ($iblockID) {
    $arUserFields = array (
        array (
            'ENTITY_ID' => 'IBLOCK_'.$iblockID.'_SECTION',
            'FIELD_NAME' => 'UF_METATITLE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
        ),
        array (
            'ENTITY_ID' => 'IBLOCK_'.$iblockID.'_SECTION',
            'FIELD_NAME' => 'UF_METADESCRIPTION',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
        ),
        array (
            'ENTITY_ID' => 'IBLOCK_'.$iblockID.'_SECTION',
            'FIELD_NAME' => 'UF_METAKEYWORDS',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
        ),
        array (
            'ENTITY_ID' => 'IBLOCK_'.$iblockID.'_SECTION',
            'FIELD_NAME' => 'UF_PREVIEW_TEXT',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
        ),
        array (
            'ENTITY_ID' => 'IBLOCK_'.$iblockID.'_SECTION',
            'FIELD_NAME' => 'UF_DETAIL_TEXT',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
        ),
    );
    $arLanguages = Array();
    $rsLanguage = CLanguage::GetList($by, $order, array());
    while($arLanguage = $rsLanguage->Fetch()) {
        $arLanguages[] = $arLanguage["LID"];
    }

    $obUserField  = new CUserTypeEntity;
    foreach ($arUserFields as $arFields)
    {
        $dbRes = CUserTypeEntity::GetList(Array(), Array("ENTITY_ID" => $arFields["ENTITY_ID"], "FIELD_NAME" => $arFields["FIELD_NAME"]));
        if ($dbRes->Fetch())
            continue;

        $arLabelNames = Array();
        foreach($arLanguages as $languageID)
        {
            WizardServices::IncludeServiceLang("smt_iblock.php", $languageID);
            $arLabelNames[$languageID] = GetMessage($arFields["FIELD_NAME"]);
        }

        $arFields["EDIT_FORM_LABEL"] = $arLabelNames;
        $arFields["LIST_COLUMN_LABEL"] = $arLabelNames;
        $arFields["LIST_FILTER_LABEL"] = $arLabelNames;

        $ID_USER_FIELD = $obUserField->Add($arFields);
    }
}