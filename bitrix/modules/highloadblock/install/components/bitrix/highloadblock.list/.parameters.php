<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
	'GROUPS' => array(
	),
	'PARAMETERS' => array(
		'BLOCK_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_BLOCK_ID_PARAM'),
			'TYPE' => 'TEXT'
		),
		'DETAIL_URL' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_DETAIL_URL_PARAM'),
			'TYPE' => 'TEXT'
		),
		'ROWS_PER_PAGE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_ROWS_PER_PAGE_PARAM'),
			'TYPE' => 'TEXT'
		),
		'PAGEN_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_PAGEN_ID_PARAM'),
			'TYPE' => 'TEXT',
			'DEFAULT' => 'page'
		),
		'FILTER_NAME' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_FILTER_NAME_PARAM'),
			'TYPE' => 'TEXT',
		),
		'CHECK_PERMISSIONS' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_CHECK_PERMISSIONS_PARAM'),
			'TYPE' => 'CHECKBOX',
		),
	),
);