<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!WIZARD_INSTALL_DEMO_DATA) {
    return;
}

$dbSite = CSite::GetByID(WIZARD_SITE_ID);
if($arSite = $dbSite -> Fetch()) {
    $lid = $arSite["LANGUAGE_ID"];
}
if(strlen($lid) <= 0) {
    $lid = "ru";
}

$dbEvent = CEventMessage::GetList($b="ID", $order="ASC", Array("EVENT_NAME" => "FEEDBACK_FORM", "SITE_ID" => WIZARD_SITE_ID));
if(!($dbEvent->Fetch())) {

    IncludeModuleLangFile(__FILE__, $lid);

    $arMessagesFields = array(
        "EVENT_NAME" => "FEEDBACK_FORM",
        "LID" => WIZARD_SITE_ID,
        "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
        "EMAIL_TO" => "#EMAIL_TO#",
        "SUBJECT" => GetMessage("MF_EVENT_SUBJECT"),
        "MESSAGE" => GetMessage("MF_EVENT_MESSAGE")
    );

    $message = new CEventMessage();
    $message->Add($arMessagesFields);
}