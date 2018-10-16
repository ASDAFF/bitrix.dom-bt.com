<?$APPLICATION->IncludeFile(
	SITE_DIR."smt_include/sidebar_article_header.php",
	Array(),
	Array("MODE"=>"html")
);?>
<?$APPLICATION->IncludeComponent(
	"simpletemplates:elements.filter", 
	".default", 
	array(
		"FILTER_NAME" => "articleFilter",
		"IBLOCK_ID" => "24",
		"IBLOCK_TYPE" => "smt_content",
		"COMPONENT_TEMPLATE" => ".default",
		"PROPERTY_CODE" => array(
			0 => "SIDEBAR",
			1 => "",
		),
		"PROPERTY_VALUES" => array(
			0 => "Да",
		)
	),
	false
);?><?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"smt_article_line", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "smt_content",
		"IBLOCK_ID" => "24",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "articleFilter",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
		),
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "ICON",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N"
	),
	false
);
?>