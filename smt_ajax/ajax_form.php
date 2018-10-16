<?
define("PUBLIC_AJAX_MODE", true);
define("NO_KEEP_STATISTIC", true);
define('NO_AGENT_CHECK', true);
define("NO_AGENT_STATISTIC", true);
define("DisableEventsCheck", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]. SITE_DIR . 'smt_include/forms_callback.php');

$FORM_CODE = array();
if(isset($formFilter) && !empty($formFilter)) {
    $FORM_CODE = $formFilter;
}

if ($_REQUEST["AJAX_CALL"] === "Y" && array_key_exists($_REQUEST["AJAX_FORM_ID"], $FORM_CODE))
{
    $APPLICATION->RestartBuffer();
    CUtil::JSPostUnescape();

    require_once($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . $FORM_CODE[$_REQUEST["AJAX_FORM_ID"]]);
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
}
die();