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