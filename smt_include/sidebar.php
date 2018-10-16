<div class="smt-widget<?$APPLICATION->ShowViewContent('smt_sidebar');?>">
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"smt_list", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => "",
		"DROPDOWN_MENU" => "Y"
	),
	false
);?>
</div>
<?if($APPLICATION->GetProperty("smt_show_sidebar_article")):?>
    <div class="smt-widget smt-widget_margin">
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/sidebar_article.php",
            Array(),
            Array("MODE"=>"html")
        );?>
    </div>
<?endif?>
<?if($APPLICATION->GetProperty("smt_show_sidebar_form")):?>
    <div class="smt-widget smt-widget_margin">
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/form_order_sidebar.php",
            Array(),
            Array("MODE"=>"html")
        );?>
    </div>
<?endif?>
<?if($APPLICATION->GetProperty("smt_show_sidebar_banner")):?>
    <div class="smt-widget smt-widget_margin">
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/sidebar_banner.php",
            Array(),
            Array("MODE"=>"html")
        );?>
    </div>
<?endif?>
<?if($APPLICATION->GetProperty("smt_show_sidebar_search")):?>
<div class="smt-widget smt-widget_margin">
    <?$APPLICATION->IncludeComponent(
	"bitrix:search.form", 
	"smt_search", 
	array(
		"PAGE" => "#SITE_DIR#search/",
		"USE_SUGGEST" => "N"
	),
	false
);?>
</div>
<?endif?>
<?if($APPLICATION->GetProperty("smt_show_sidebar_text")):?>
    <?$APPLICATION->IncludeFile(
        SITE_DIR."smt_include/sidebar_text.php",
        Array(),
        Array("MODE"=>"html")
    );?>

<?endif?>

<!-- форма обратной связи -->

<h3 style="padding-top:10px">Оставить заявку:</h3>


<?$APPLICATION->IncludeComponent(
	"simpletemplates:form.order", 
	"", 
	array(
		"FORM_SUFFIX" => "orderforsidebar",
		"SHOW_FORM_BORDER" => "",
		"AJAX_URL" => "/smt_ajax/ajax_form.php",
		"CUSTOM_FORM_SUBMIT" => "Отправить",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
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
		"EVENT_MESSAGE_ID" => "",
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
			0 => "NAME",
			1 => "100",
			2 => "101",
			3 => "103",
			4 => "102",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "NAME",
			1 => "100",
			2 => "102",
		),
		"REDIRECT_URL" => "",
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "NEW",
		"USER_MESSAGE_ADD" => "Ваша заявка успешно отправлена",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"CUSTOM_TITLE_102" => " "
	),
	false
);?>