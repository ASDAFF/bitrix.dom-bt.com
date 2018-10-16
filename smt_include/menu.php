<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"smt_menu", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => "",
		"SMT_ADD_CLASS" => ($APPLICATION->GetProperty("smt_menu_main_smart"))?"smt-menu-main_js-smart smt-menu-main_js-hidden":""
	),
	false
);?>