<?$APPLICATION->IncludeComponent(
	"simpletemplates:form.order", 
	"", 
	array(
		"OBJECT_ID" => isset($arParams["OBJECT_ID"])?$arParams["OBJECT_ID"]:"",
		"FORM_SUFFIX" => "consultform",
		"AJAX_URL" => "/smt_ajax/ajax_form.php",
		"CUSTOM_FORM_SUBMIT" => "Отправить",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "Комментарий",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Ваше имя",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_80" => " ",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"EMAIL_TO" => "",
		"EVENT_MESSAGE_ID" => "",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "smt_form",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "NAME",
			1 => "100",
			2 => "101",
			3 => "104",
			4 => "103",
			5 => "DETAIL_TEXT",
			6 => "102",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "NAME",
			1 => "100",
			2 => "102",
		),
		"REDIRECT_URL" => "",
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "NEW",
		"USER_MESSAGE_ADD" => "Ваша заявка успешно отправлена",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"CUSTOM_TITLE_104" => "Проект",
		"CUSTOM_TITLE_102" => " "
	),
	false
);?>