<section class="smt-widget smt-widget_padding smt-widget-about">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
				<div class="smt-widget-about__text">
					<?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_about', '', SITE_ID) == "Y"):?>
					<?$APPLICATION->IncludeFile(
						SITE_DIR."smt_include/main_services_text.php",
						Array(),
						Array("MODE"=>"html")
					);?>
					<?endif?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
				<?$APPLICATION->IncludeFile(
					SITE_DIR."smt_include/main_services_text1.php",
					Array(),
					Array("MODE"=>"html")
				);?>
				<?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_services', '', SITE_ID) == "Y"):?>
				<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"smt_service_main", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "smt_promo",
		"IBLOCK_ID" => "#SMT_SERVICE_MAIN_IBLOCK_ID#",
		"NEWS_COUNT" => "8",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "ICON",
			3 => "",
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
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "smt_service_main",
		"MAIN_BLOCK_PROPERTY_CODE" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"LINE_ELEMENT_COUNT" => "2",
		"SMT_LINK_SHOW_MODE" => "NONE",
		"DISPLAY_DESCRIPTION" => "Y",
		"DISPLAY_BUTTON" => "N",
		"DISPLAY_IMAGE_NAME" => "N",
		"DISPLAY_IMAGE_PREVIEW_TEXT" => "N",
		"PICTURE_RESIZE" => "Y",
		"PICTURE_RESIZE_MODE" => "2",
		"PICTURE_RESIZE_SOURCE" => "DETAIL_PICTURE",
		"PICTURE_RESIZE_WIDTH" => "120",
		"PICTURE_RESIZE_HEIGHT" => "120",
		"SMT_SLIDER" => "N",
		"SMT_SLIDER_ITEMS" => "2",
		"SMT_SLIDER_MARGIN" => "",
		"SMT_SLIDER_NAV" => "N",
		"SMT_SLIDER_DOTS" => "N",
		"SMT_SLIDER_VERTICAL_ALIGN" => "N",
		"SMT_SLIDER_RESPONSIVE" => "",
		"SMT_SLIDER_CUSTOM" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);
				?>
				<?endif?>
			</div>
		</div>
	</div>
</section>