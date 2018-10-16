<section class="smt-widget smt-widget_padding smt-widget_background smt-widget-project-list">
    <div class="container">
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_projects_header.php",
            Array(),
            Array("MODE"=>"html")
        );?>
		<?$APPLICATION->IncludeComponent(
	"simpletemplates:elements.filter", 
	".default", 
	array(
		"FILTER_NAME" => "projectsFilter",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "smt_company",
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
	"bitrix:catalog.section", 
	"smt_projects", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "name",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "projectsFilter",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "smt_company",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENT_COUNT" => "12",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => "",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array(
			0 => "NUMBER_ROOMS",
			1 => "NUMBER_FLOORS",
			2 => "WALL_MATERIAL",
			3 => "AREA_COMMON",
			4 => "AREA_BUILDING",
			5 => "SIZE",
			6 => "BEDROOMS",
			7 => "PRICE",
			8 => "PRICE_DISCOUNT",
			9 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "smt_projects",
		"MAIN_BLOCK_PROPERTY_CODE" => array(
			0 => "AREA_COMMON",
		),
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_DESCRIPTION" => "N",
		"CURRENCY" => "руб.",
		"CURRENCY_DECIMALS" => "",
		"CURRENCY_DECIMALS_POINT" => ".",
		"CURRENCY_THOUSANDS_SEP" => " ",
		"PRICE_HEADER" => "Стоимость проекта",
		"PICTURE_RESIZE" => "Y",
		"PICTURE_RESIZE_MODE" => "2",
		"PICTURE_RESOLUTION" => "1x1",
		"PICTURE_RESIZE_SOURCE" => "DETAIL_PICTURE",
		"PICTURE_RESIZE_WIDTH" => "640",
		"PICTURE_RESIZE_HEIGHT" => "640",
		"SMT_SLIDER" => "N",
		"SMT_SLIDER_ITEMS" => "",
		"SMT_SLIDER_MARGIN" => "",
		"SMT_SLIDER_NAV" => "N",
		"SMT_SLIDER_DOTS" => "N",
		"SMT_SLIDER_VERTICAL_ALIGN" => "N",
		"SMT_SLIDER_RESPONSIVE" => "",
		"SMT_SLIDER_CUSTOM" => "",
		"COMPATIBLE_MODE" => "Y"
	),
	false
);?>
        <style type="text/css">
            .smt-widget-project-list .smt-project-list div > div {
                height: auto !important;
            }
        </style>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="text-center">
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR."smt_include/main_projects_link.php",
                        Array(),
                        Array("MODE"=>"html")
                    );?>
                </div>
            </div>
        </div>
    </div>
</section>