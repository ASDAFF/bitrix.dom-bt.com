<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

	CModule::IncludeModule('fileman');
	$arMenuTypes = GetMenuTypes(WIZARD_SITE_ID);

	if(!$arMenuTypes['smt_service_main']) {
		$arMenuTypes['smt_service_main'] = GetMessage("WIZ_SMT_MENU_SERVICE_MAIN");
	}

	if(!$arMenuTypes['smt_footer']) {
		$arMenuTypes['smt_footer'] = GetMessage("WIZ_SMT_MENU_FOOTER");
	}

	if(!$arMenuTypes['smt_popular']) {
		$arMenuTypes['smt_popular'] = GetMessage("WIZ_SMT_MENU_POPULAR");
	}

	if(!$arMenuTypes['smt_sidebar']) {
		$arMenuTypes['smt_sidebar'] = GetMessage("WIZ_SMT_MENU_SIDEBAR");
	}

	SetMenuTypes($arMenuTypes, WIZARD_SITE_ID);
	COption::SetOptionInt("fileman", "num_menu_param", 2, false ,WIZARD_SITE_ID);

?>