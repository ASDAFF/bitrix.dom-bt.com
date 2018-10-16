<?$APPLICATION->IncludeComponent(
	"simpletemplates:form.order", 
	".default", 
	array(
		"FORM_SUFFIX" => "questionform",
		"AJAX_URL" => "/smt_ajax/ajax_form.php",
		"CUSTOM_FORM_SUBMIT" => "Отправить заявку",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "Текст сообщения",
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
		"EVENT_MESSAGE_ID" => array(
		),
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
			0 => "100",
			1 => "101",
			2 => "102",
			3 => "103",
			4 => "209",
			5 => "NAME",
			6 => "DETAIL_TEXT",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "100",
			1 => "102",
			2 => "NAME",
		),
		"REDIRECT_URL" => "",
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "NEW",
		"USER_MESSAGE_ADD" => "Ваша заявка успешно отправлена",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"CUSTOM_TITLE_102" => " ",
		"COMPONENT_TEMPLATE" => ".default",
		"SHOW_FORM_BORDER" => "N",
		"FIELDS_ORDER" => "NAME,100,101,DETAIL_TEXT,209,102,103",
		"DISPLAY_ICON" => "Y",
		"FORMS_DISABLE_AGREEMENT" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CUSTOM_TITLE_100" => "Ваш телефон",
		"CUSTOM_TITLE_101" => "",
		"CUSTOM_TITLE_103" => "",
		"CUSTOM_TITLE_209" => "Прикрепить файл проекта"
	),
	false
);?>