<div class="smt-widget smt-widget_padding-sm">
    <div class="container">
        <div class="row">
            <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_responses', '', SITE_ID) == "Y"):?>
            <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_form', '', SITE_ID) == "Y"):?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <?else:?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?endif?>
                <section class="smt-widget-response-list">
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR."smt_include/main_reviews_header.php",
                        Array(),
                        Array("MODE"=>"html")
                    );?>
                    <div class="smt-response-list__content">
                        <?$APPLICATION->IncludeComponent(
	"simpletemplates:elements.filter", 
	".default", 
	array(
		"FILTER_NAME" => "responsesFilter",
		"IBLOCK_ID" => "#SMT_REVIEW_IBLOCK_ID#",
		"IBLOCK_TYPE" => "smt_content",
		"COMPONENT_TEMPLATE" => ".default",
		"PROPERTY_CODE" => array(
			0 => "MAIN",
			1 => "",
		),
		"PROPERTY_VALUES" => array(
			0 => "Да",
		),
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y"
	),
	false
);?>
                        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"smt_reviews_widget", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "smt_content",
		"IBLOCK_ID" => "#SMT_REVIEW_IBLOCK_ID#",
		"NEWS_COUNT" => "8",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "responsesFilter",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "INFO",
			1 => "",
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
		"COMPONENT_TEMPLATE" => "smt_reviews_widget",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);
                        ?>
                    </div>
                </section>
            </div>
            <?endif?>
            <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_form', '', SITE_ID) == "Y"):?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <section class="smt-widget-project-search">
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR."smt_include/main_form_header.php",
                        Array(),
                        Array("MODE"=>"html")
                    );?>
                    <div class="smt-project-search__content">
                        <div class="smt-form">
                            <?$APPLICATION->IncludeFile(
                                SITE_DIR."smt_include/form_order_main.php",
                                Array(),
                                Array("MODE"=>"html", "SHOW_BORDER" => false)
                            );?>
                        </div>
                    </div>
                </section>
            </div>
            <?endif?>
        </div>
    </div>
</div>