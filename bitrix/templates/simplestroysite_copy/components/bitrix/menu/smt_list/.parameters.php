<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTemplateParameters['DROPDOWN_MENU'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('SMT_CPT_MENU_DROPDOWN_MENU'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N',
);