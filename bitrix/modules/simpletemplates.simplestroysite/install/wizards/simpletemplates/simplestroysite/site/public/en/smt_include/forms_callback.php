<?$APPLICATION->IncludeComponent(
	"simpletemplates:form.callback", 
	"", 
	array(
		"AJAX_FORM_ID" => array(
			0 => "orderformmain",
			1 => "callbackform",
			2 => "questionform",
			3 => "orderform",
			4 => "consultform",
			5 => "orderforsidebar",
			6 => "contactpageform",
		),
		"FILTER_NAME" => "formFilter",
		"FORM_FILES" => array(
			0 => "smt_include/form_order_main.php",
			1 => "smt_include/form_callback.php",
			2 => "smt_include/form_question.php",
			3 => "smt_include/form_order.php",
			4 => "smt_include/form_consult.php",
			5 => "smt_include/form_order_sidebar.php",
			6 => "smt_include/contact_form.php",
		)
	),
	false
);?>